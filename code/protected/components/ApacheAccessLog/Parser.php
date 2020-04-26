<?php

/*
 *  File "Parser" created 23.04.2020 14:46:34 in UTF-8 by Sazonov V.
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
 * Description of Parser
 *
 * @author Sazonov V.
 */
class Parser extends \CComponent {

    const COMPONENT_ID = 'ApacheAccessLog';

    /**
     * Path to apache configuration file.
     * e.g. this may be '/etc/apache2/httpd.conf'
     * or FALSE if you don't have access to this file
     * @var string|boolean 
     */
    public $apacheConfigFile = false;

    /**
     * Path to folder with enabled VHosts configurations
     * <br>e.g. this may be <code>'/etc/apache2/sites-enabled'</code>
     * or <code>FALSE</code> if you don't have access to this folder
     * @var string|boolean 
     */
    public $enabledVHostsPath = false;

    /**
     * Array with configurations for each log file
     * <br>if you provided $apacheConfigFile and $enabledVHostsPath variables
     * this array will fill up automaticallyarray will fill up automatically,
     * in other cases you must fill the array yourself. Each item in array 
     * is nested array with two keys 'path' and 'format', where 'path' is
     * path to log file and 'format' is value of LogFormat directive for  
     * this log file in apache config file or VHost config file, e.g.:
     * <br><pre>...,
     * [
     *      'path'=>'/var/log/apache2/access.log',
     *      'format'=>"%v:%p %h %l %u %t \"%r\" %>s %O \"%{Referer}i\" \"%{User-Agent}i\""
     * ],
     * ...,</pre>
     * @var mixed 
     */
    public $logFiles = [];
    protected $_parsedLogs = [];

    /**
     * Instanse of ConfigParser
     * @var ConfigParser 
     */
    public $configParser;

    public function init() {
        $this->configParser = \Yii::createComponent(ConfigParser::class, [$this->apacheConfigFile, $this->enabledVHostsPath]);
        $this->logFiles = array_merge($this->logFiles, $this->configParser->configuration);
    }

    public function parse() {
        foreach ($this->logFiles as $log) {
            $logParser = new LogParser($log['path'], $log['format']);
            $this->_parsedLogs[$log['path']] = $logParser->parsed;
        }
        return $this->_parsedLogs;
    }

    public static function GetDictionary() {
        return require(__DIR__ . "/apache_vars_dictionary.php");
    }

    public static function JustPregMatch($template, $subject, $all = true, $unset_key = false) {
        $matches = [];
        if ($all)
            preg_match_all($template, $subject, $matches, PREG_SET_ORDER + PREG_OFFSET_CAPTURE);
        else
            preg_match($template, $subject, $matches, PREG_OFFSET_CAPTURE);
        if($unset_key!==false && isset($matches[$unset_key])){
            unset($matches[$unset_key]);
            $matches = array_values($matches);
        }
        return $matches;
    }

}
