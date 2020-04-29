<?php
/*
 *  File "_item" created 27.04.2020 23:01:52 in UTF-8 by Sazonov V.
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
?>
<?php /* @var $data Log */ ?>
<div id="item<?=$data->id?>" class="span12" style="margin-bottom: 10px;">
    <span class="label label-warning">ID</span><i> <?= $data->id ?> </i>
    <span class="label label-info">Remote host</span><i> <?= $data->remote_host ?> </i>
    <span class="label label-info">Last status</span><i> <?= $data->status_last ?> </i>
    <span class="label label-inverse">Time</span><i> <?= date('D, d M Y H:i:s', $data->time) . " (timestamp {$data->time})" ?> </i>
    <span class="label label-info">File</span><i> <?= $data->file ?> </i>

    <a href="#fullModal<?= $data->id ?>" role="button" data-toggle="modal">Full info</a>
    <i style='cursor:pointer;' class="icon-remove" onclick="Search.deleteItem('item<?=$data->id?>', '<?= \Yii::app()->createUrl('site/delete', ['id'=>$data->id, 'json'=>'1']) ?>')"></i>

    <!-- Modal -->
    <div id="fullModal<?= $data->id ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="fullModal<?= $data->id ?>Label" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="fullModal<?= $data->id ?>Label">Detailed <?= $data->id ?></h3>
        </div>
        <div class="modal-body">
            <?php
            $this->widget('bootstrap.widgets.TbDetailView', array(
                'data' => $data,
                'attributes' => array(
                    'id',
                    'file',
                    'line_num',
                    'line_uid',
                    'parsed_at',
                    'remote_ip',
                    'local_ip',
                    'res_size',
                    'res_size_clf',
                    'cookie',
                    'req_time_ms',
                    'env_var',
                    'filename',
                    'remote_host',
                    'req_protocol',
                    'req_header',
                    'ka_requests_num',
                    'remote_logname',
                    'method',
                    'module_note',
                    'res_header',
                    'server_port_canonical',
                    'port',
                    'child_id',
                    'child_id_formatted',
                    'query_string',
                    'req_first_line',
                    'res_handler',
                    'status_orig',
                    'status_last',
                    'time',
                    'time_formatted',
                    'serve_req_time',
                    'serve_req_time_in_units',
                    'remote_user',
                    'url',
                    'server_name',
                    'server_name_ucn',
                    'connection_status',
                    'received_bytes',
                    'sended_bytes',
                    'req_trailer_line',
                    'res_trailer_line',
                ),
            ));
            ?>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
    </div>
</div>




