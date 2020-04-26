<?php

/*
 *  File "ParserCommand" created 23.04.2020 14:21:08 in UTF-8 by Sazonov V.
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

/**
 * Description of ParserCommand
 *
 * @author Sazonov V.
 */
class ParserCommand extends \CConsoleCommand {
    public function run($args) {
       $result = \Yii::app()->getComponent(\application\components\ApacheAccessLog\Parser::COMPONENT_ID, true)->parse();
       foreach ($result as $log){
           foreach ($log as $line){
               $model = new Log;
               $model->setAttributes($line, false);
               if($model->save()){
                   echo "Line {$model->line_num} from {$model->file} parsed\n";
               }
           }
       }
    }
}
