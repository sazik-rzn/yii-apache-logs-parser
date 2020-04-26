<?php

/*
 *  File "apache_vars_dictionary" created 24.04.2020 16:13:03 in UTF-8 by Sazonov V.
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

return [
    '%a' => [
        'description' => 'Remote IP-address',
        'template' => '([:\.\d]+)',
        'name' => 'remote_ip'
    ],
    '%A' => [
        'description' => 'Local IP-address',
        'template' => '([:\.\d]+)',
        'name' => 'local_ip'
    ],
    '%B' => [
        'description' => 'Size of response in bytes, excluding HTTP headers',
        'template' => '(\d+)',
        'name' => 'res_size',
        'data_type' => 'int'
    ],
    '%b' => [
        'description' => 'Size of response in bytes, excluding HTTP headers. In CLF format, i.e. a "-" rather than a 0 when no bytes are sent',
        'template' => '([\d\-]+)',
        'name' => 'res_size_clf',
        'data_type' => 'int'
    ],
    '%\\\*{([\S]+)\\\*}C' => [
        'description' => 'The contents of cookie in the request sent to the server',
        'template' => '(.+)', //TODO
        'name' => 'cookie'
    ],
    '%D' => [
        'description' => 'The time taken to serve the request, in microseconds',
        'template' => '(\d\.)+',
        'name' => 'req_time_ms',
        'data_type' => 'int'
    ],
    '%\\\*{([\S]+)\\\*}e' => [
        'description' => 'The contents of the environment variable',
        'template' => '(.+)', //TODO
        'name' => 'env_var'
    ],
    '%f' => [
        'description' => 'Filename',
        'template' => '(\S+)',
        'name' => 'filename'
    ],
    '%h' => [
        'description' => 'Remote host',
        'template' => '(\S+)',
        'name' => 'remote_host'
    ],
    '%H' => [
        'description' => 'The request protocol',
        'template' => '(\S+)', //TODO
        'name' => 'req_protocol'
    ],
    '%\\\*{([\S]+)\\\*}i' => [
        'description' => 'The contents of Foobar: header line(s) in the request sent to the server',
        'template' => '(.+)', //TODO
        'name' => 'req_header'
    ],
    '%k' => [
        'description' => 'Number of keepalive requests handled on this connection',
        'template' => '([0-9\-]+)',
        'name' => 'ka_requests_num',
        'data_type' => 'int'
    ],
    '%l' => [
        'description' => 'Remote logname (from identd, if supplied)',
        'template' => '(.+)',//TODO
        'name' => 'remote_logname'
    ],
    '%m' => [
        'description' => 'The request method',
        'template' => '(\w+)',
        'name' => 'method'
    ],
    '%\\\*{([\S]+)\\\*}n' => [
        'description' => 'The contents of note from another module',
        'template' => '(.+)',//TODO
        'name' => 'module_note'
    ],
    '%\\\*{([\S]+)\\\*}o' => [
        'description' => 'The contents of header line(s) in the reply',
        'template' => '(.+)',//TODO
        'name' => 'res_header'
    ],
    '%p' => [
        'description' => 'The canonical port of the server serving the request',
        'template' => '(\d+)',
        'name' => 'server_port_canonical',
        'data_type' => 'int'
    ],
    '%\\\*{([\S]+)\\\*}p' => [
        'description' => 'The canonical port of the server serving the request or the server actual port or the clients actual port. Valid formats are canonical, local, or remote',
        'template' => '(\d+)',
        'name' => 'port',
        'data_type' => 'int'
    ],
    '%P' => [
        'description' => 'The process ID of the child that serviced the request',
        'template' => '(\d+)',
        'name' => 'child_id'
    ],
    '%\\\*{([\S]+)\\\*}P' => [
        'description' => 'The process ID or thread id of the child that serviced the request. Valid formats are pid, tid, and hextid. hextid',
        'template' => '(.+)',//TODO
        'name' => 'child_id_formatted'
    ],
    '%q' => [
        'description' => 'The query string',
        'template' => '(.+)',//TODO
        'name' => 'query_string'
    ],
    '%r' => [
        'description' => 'First line of request',
        'template' => '(.+)',//TODO
        'name' => 'req_first_line'
    ],
    '%R' => [
        'description' => 'The handler generating the response (if any)',
        'template' => '(.+)',//TODO
        'name' => 'res_handler'
    ],
    '%s' => [
        'description' => 'Status. For requests that got internally redirected, this is the status of the *original* request --- %>s for the last.',
        'template' => '(\d+)',
        'name' => 'status_orig',
        'data_type' => 'int'
    ],
    '%\\\*>s'=> [
        'description' => 'Status. Last',
        'template' => '(\d+)',
        'name' => 'status_last',
        'data_type' => 'int'
    ],
    '%t' => [
        'description' => 'Time the request was received (standard english format)',
        'template' => '\[([\w\/\:\s\+]+)\]',
        'name' => 'time',
        'data_type' => 'int' // timestamp TODO convertation
    ],
    '%\{([^\}\{]+)\}t' => [
        'description' => 'The time, in the form given by format, which should be in an extended strftime(3) format (potentially localized)',
        'template' => '\[(.+)\]',
        'name' => 'time_formatted', // timestamp TODO convertation
        'data_type' => 'int'
    ],
    '%T' => [
        'description' => 'The time taken to serve the request, in seconds',
        'template' => '([\d\.\,])+',
        'name' => 'serve_req_time',
        'data_type' => 'int'
    ],
    '%\\\*{([\S]+)\\\*}T' => [
        'description' => 'The time taken to serve the request, in a time unit.',
        'template' => '(\d)+',
        'name' => 'serve_req_time_in_units',
        'data_type' => 'int'
    ],
    '%u' => [
        'description' => 'Remote user (from auth; may be bogus if return status (%s) is 401)',
        'template' => '(\S+)',
        'name' => 'remote_user'
    ],
    '%U' => [
        'description' => 'The URL path requested, not including any query string',
        'template' => '(\S+)',
        'name' => 'url'
    ],
    '%v' => [
        'description' => 'The canonical ServerName of the server serving the request',
        'template' => '([\.\w]+)',
        'name' => 'server_name'
    ],
    '%V' => [
        'description' => 'The server name according to the UseCanonicalName setting',
        'template' => '([\.\w]+)',
        'name' => 'server_name_ucn'
    ],
    '%X' => [
        'description' => 'Connection status when response is completed',
        'template' => '([X\+\-])',
        'name' => 'connection_status'
    ],
    '%I' => [
        'description' => 'Bytes received, including request and headers, cannot be zero',
        'template' => '(\d+)',
        'name' => 'received_bytes',
        'data_type' => 'int'
    ],
    '%O' => [
        'description' => 'Bytes sent, including headers, cannot be zero',
        'template' => '(\d+)',
        'name' => 'sended_bytes',
        'data_type' => 'int'
    ],
    '%\\\*{([\S]+)\\\*}\^ti' => [
        'description' => 'The contents of trailer line(s) in the request sent to the server',
        'template' => '(.+)',//TODO
        'name' => 'req_trailer_line'
    ],
    '%\\\*{([\S]+)\\\*}\^to' => [
        'description' => 'The contents of trailer line(s) in the response sent from the server',
        'template' => '(.+)',//TODO
        'name' => 'res_trailer_line'
    ],
];

