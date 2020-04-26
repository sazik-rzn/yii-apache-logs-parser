<?php

/*
 *  File "ConfigParser" created 23.04.2020 12:25:24 in UTF-8 by Sazonov V.
 *  Contacts: 
 *  * Email: sazik.rzn@gmail.com
 *  * Telegram: @sazik_rzn
 *  * Skype: vladimir_s_sazonov
 *  * Git: https://github.com/sazik-rzn
 *  * Phone: +7(920)972-24-88
 * 
 * Copyright (c) 2020, Sazonov Vladimir
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of the Sazonov Vladimir nor the
 *       names of its contributors may be used to endorse or promote products
 *       derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

namespace application\components\ApacheAccessLog;

/**
 * Description of ConfigParser
 *
 * @author Sazonov V.
 */
class ConfigParser extends \CComponent {

    /**
     * Full content of all defined config files (apache config + VHosts)
     * @var array 
     */
    protected $_apacheConfigFileContent = false;
    protected $_configuration = [];

    public function getConfiguration() {
        return $this->_configuration;
    }

    public function __construct($path_list = []) {
        foreach ($path_list as $path) {
            $this->_readFiles($path);
        }
        if ($this->_apacheConfigFileContent) {
            $this->_tryParseConfiguration();
        }
    }

    protected function _readFiles($path) {
        if ($path && strpos($path, ".") !== 0 && strpos($path, ".") !== false && file_exists($path)) {
            if (is_dir($path)) {
                foreach (scandir($path) as $file) {
                    $this->_readFiles("{$path}/{$file}");
                }
            } else {
                $tryFile = $this->_tryGetConfFile($path);
                if ($tryFile) {
                    if ($this->_apacheConfigFileContent === FALSE) {
                        $this->_apacheConfigFileContent = [];
                    }
                    $this->_apacheConfigFileContent = array_merge($this->_apacheConfigFileContent, $tryFile);
                }
            }
        }
    }

    protected function _tryGetConfFile($filename) {
        $split = explode(".", $filename);
        $isConf = (array_pop($split) == "conf");
        if ($isConf && file_exists($filename)) {
            return file($filename);
        }
        return false;
    }

    protected function _tryParseConfiguration() {
        echo "Try to find logs in configuration files\n";
        if (is_array($this->_apacheConfigFileContent)) {
            $vHost = false;
            $formats = [];
            $logs = [];
            $hosts = [];
            foreach ($this->_apacheConfigFileContent as $line) {
                $clearLine = trim($line);
                $isComment = $this->_detectComment($clearLine);
                if (!$isComment) {
                    if ($this->_detectVHostBegin($clearLine)) {
                        $vHost = ['formats' => [], 'logs' => []];
                    } elseif ($format = $this->_detectLogFormat($clearLine)) {
                        if (is_array($vHost)) {
                            $vHost['formats'][$format['nickname']] = $format['format'];
                        } else {
                            $formats[$format['nickname']] = $format['format'];
                        }
                    } elseif ($customLog = $this->_detectCustomLog($clearLine)) {
                        if (is_array($vHost)) {
                            $vHost['logs'][] = $customLog;
                        } else {
                            $logs[] = $customLog;
                        }
                    } elseif ($this->_detectVHostEnd($clearLine)) {
                        $hosts[] = $vHost;
                        $vHost = FALSE;
                    }
                }
            }
            foreach ($logs as $log) {
                $this->_createLogConfigItem($log, $formats);
            }

            foreach ($hosts as $host) {
                foreach ($host['logs'] as $log){
                    $this->_createLogConfigItem($log, $host['formats'], $formats);
                }
            }
        }
    }

    protected function _createLogConfigItem($log, $localFormats, $commonFormats = []) {
        if (isset($log['file'])) {
            $config = [
                'path' => $log['file']
            ];
            if (isset($log['nickname']) && isset($localFormats[$log['nickname']])) {
                $config['format'] = $localFormats[$log['nickname']];
            } elseif(isset($log['nickname']) && isset($commonFormats[$log['nickname']])){
                $config['format'] = $commonFormats[$log['nickname']];
            }
            elseif (isset($log['format'])) {
                $config['format'] = $log['format'];
            }
            else {
                $config['format'] = "%h %l %u %t \"%r\" %>s %b"; // CLF as default
            }
            $this->_configuration[] = $config;
            echo "Finded access log {$config['path']} with format {$config['format']}\n";
        }
    }

    protected function _detectComment($string) {
        $pos = strpos($string, "#");
        return ($pos !== false && $pos === 0);
    }

    protected function _detectVHostBegin($string) {
        $pos = strpos($string, "<VirtualHost");
        return ($pos !== false && $pos === 0);
    }

    protected function _detectVHostEnd($string) {
        $pos = strpos($string, "</VirtualHost>");
        return ($pos !== false && $pos === 0);
    }

    protected function _detectCustomLog($string) {
        $pos = strpos($string, "CustomLog");
        if ($pos !== false && $pos === 0) {
            $matches = [];
            preg_match('/^CustomLog\s\"?([^\"]+)\"+?\s\"?(.+)\"?/', $string, $matches);
            if (count($matches) >= 2) {
                $result = [
                    'file' => $matches[1]
                ];
                if (isset($matches[2])) {
                    if (strpos($matches[2], "%") !== false) {
                        $result['format'] = preg_replace('/\"\"$/', '"', $matches[2]);
                    } else {
                        $result['nickname'] = $matches[2];
                    }
                }
                return $result;
            }
        }
        return false;
    }

    protected function _detectLogFormat($string) {
        $pos = strpos($string, "LogFormat");
        if ($pos !== false && $pos === 0) {
            $matches = [];
            preg_match('/^LogFormat\s\"(.+)\"\s(.+)$/', $string, $matches);
            if (count($matches) >= 2) {
                $result = [
                    'format' => $matches[1]
                ];
                if (isset($matches[2])) {
                    $result['nickname'] = $matches[2];
                }
                return $result;
            }
        }
        return false;
    }

}
