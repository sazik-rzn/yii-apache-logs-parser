<?php

/*
 *  File "LogParser" created 23.04.2020 19:41:25 in UTF-8 by Sazonov V.
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
 * Description of LogParser
 *
 * @author Sazonov V.
 */
class LogParser extends \CComponent {

    protected $_file;
    protected $_format;
    protected $_logContent;
    protected $_logMap = [];
    protected $_parsedLog = [];
    protected $_template;
    protected $_dictionary;

    public function __construct($file, $format) {
        $this->_dictionary = Parser::GetDictionary();
        $this->_file = $file;
        $this->_format = stripslashes($format);
        $this->_template = preg_quote($this->_format);
        $this->_readLog();
        $this->_mapLog();
        $this->_parseLog();
    }

    public function getParsed() {
        return $this->_parsedLog;
    }

    protected function _readLog() {
        if (file_exists($this->_file)) {
            $this->_logContent = file($this->_file);
        } else {
            throw new \ErrorException("Can't read log file {$this->_file}");
        }
    }

    protected function _mapLog() {
        foreach ($this->_dictionary as $tpl => $config) {
            foreach (Parser::JustPregMatch('/' . $tpl . '/', $this->_format) as $match) {
                if (isset($match[0]) && $match[0]) {
                    $_match = [
                        'template' => $config['template'],
                        'name' => $config['name'],
                        'description' => $config['description']
                    ];
                    if (isset($match[1])) {
                        $_match['value_key'] = $match[1][0];
                    }
                    $this->_logMap[$match[0][1]] = $_match;
                    $this->_replaceFormatByTemplate($tpl, $config['template']);
                }
            }
        }
        $this->_arrayKsortAndResetKeys($this->_logMap);
    }

    protected function _parseLog() {
        foreach ($this->_logContent as $line_num => $line) {
            foreach (Parser::JustPregMatch('/' . $this->_template . '/', $line, false, 0) as $key => $match) {
                $value_name = (isset($this->_logMap[$key]['name']) ? $this->_logMap[$key]['name'] : "unknown_{$key}");
                $value = ($value_name != 'time') ? $match[0] : strtotime($match[0]);
                if (!isset($this->_parsedLog[$line_num])) {
                    $this->_parsedLog[$line_num] = [];
                }
                if (isset($this->_logMap[$key]['value_key'])) {
                    if (!isset($this->_parsedLog[$line_num][$value_name])) {
                        $this->_parsedLog[$line_num][$value_name] = [];
                    }
                    $this->_parsedLog[$line_num][$value_name][$this->_logMap[$key]['value_key']] = $value;
                } else {
                    $this->_parsedLog[$line_num][$value_name] = $value;
                }
            }
            if (isset($this->_parsedLog[$line_num])) {
                $this->_parsedLog[$line_num]['file'] = $this->_file;
                $this->_parsedLog[$line_num]['line_num'] = $line_num;
                $this->_parsedLog[$line_num]['line_uid'] = md5("{$this->_file}{$line_num}{$line}");
                $this->_parsedLog[$line_num]['parsed_at'] = time();
            }
        }
    }

    protected function _arrayKsortAndResetKeys(&$array) {
        ksort($array);
        $array = array_values($array);
    }

    protected function _replaceFormatByTemplate($format, $template) {
        $this->_template = preg_replace_callback('/' . $format . '/', function($matches) use($template) {
            return $template;
        }, $this->_template);
    }

}
