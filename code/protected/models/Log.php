<?php

/**
 * This is the model class for table "log".
 *
 * The followings are the available columns in table 'log':
 * @property string $id
 * @property string $file
 * @property string $line_num
 * @property string $line_uid
 * @property integer $parsed_at
 * @property string $remote_ip
 * @property string $local_ip
 * @property string $res_size
 * @property string $res_size_clf
 * @property string $cookie
 * @property string $req_time_ms
 * @property string $env_var
 * @property string $filename
 * @property string $remote_host
 * @property string $req_protocol
 * @property string $req_header
 * @property string $ka_requests_num
 * @property string $remote_logname
 * @property string $method
 * @property string $module_note
 * @property string $res_header
 * @property string $server_port_canonical
 * @property string $port
 * @property string $child_id
 * @property string $child_id_formatted
 * @property string $query_string
 * @property string $req_first_line
 * @property string $res_handler
 * @property string $status_orig
 * @property string $status_last
 * @property string $time
 * @property string $time_formatted
 * @property string $serve_req_time
 * @property string $serve_req_time_in_units
 * @property string $remote_user
 * @property string $url
 * @property string $server_name
 * @property string $server_name_ucn
 * @property string $connection_status
 * @property string $received_bytes
 * @property string $sended_bytes
 * @property string $req_trailer_line
 * @property string $res_trailer_line
 */
class Log extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'log';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('file, line_num, line_uid, parsed_at', 'required'),
            array('parsed_at', 'numerical', 'integerOnly' => true),
            array('file, line_uid, remote_ip, local_ip, cookie, env_var, filename, remote_host, req_protocol, req_header, remote_logname, method, module_note, res_header, child_id, child_id_formatted, query_string, req_first_line, res_handler, remote_user, url, server_name, server_name_ucn, connection_status, req_trailer_line, res_trailer_line', 'length', 'max' => 255),
            array('res_size, res_size_clf, req_time_ms, ka_requests_num, server_port_canonical, port, status_orig, status_last, time, time_formatted, serve_req_time, serve_req_time_in_units, received_bytes, sended_bytes', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, file, line_num, line_uid, parsed_at, remote_ip, local_ip, res_size, res_size_clf, cookie, req_time_ms, env_var, filename, remote_host, req_protocol, req_header, ka_requests_num, remote_logname, method, module_note, res_header, server_port_canonical, port, child_id, child_id_formatted, query_string, req_first_line, res_handler, status_orig, status_last, time, time_formatted, serve_req_time, serve_req_time_in_units, remote_user, url, server_name, server_name_ucn, connection_status, received_bytes, sended_bytes, req_trailer_line, res_trailer_line', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    public function setAttributes($values, $safeOnly = true) {
        if (!is_array($values))
            return;
        $attributes = array_flip($safeOnly ? $this->getSafeAttributeNames() : $this->attributeNames());
        foreach ($values as $name => $_value) {
            $value = $_value;
            if (is_array($value)) {
                $value = json_encode($value, JSON_PRETTY_PRINT);
            }
            if (isset($attributes[$name]))
                $this->$name = $value;
            elseif ($safeOnly)
                $this->onUnsafeAttribute($name, $value);
        }
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'file' => 'File',
            'line_num' => 'Line Num',
            'line_uid' => 'Line Uid',
            'parsed_at' => 'Parsed At',
            'remote_ip' => 'Remote IP-address',
            'local_ip' => 'Local IP-address',
            'res_size' => 'Size of response in bytes, excluding HTTP headers',
            'res_size_clf' => 'Size of response in bytes, excluding HTTP headers. In CLF format',
            'cookie' => 'The contents of cookie in the request sent to the server',
            'req_time_ms' => 'The time taken to serve the request, in microseconds',
            'env_var' => 'The contents of the environment variable',
            'filename' => 'Filename',
            'remote_host' => 'Remote host',
            'req_protocol' => 'The request protocol',
            'req_header' => 'The contents of Foobar: header line(s) in the request sent to the server',
            'ka_requests_num' => 'Number of keepalive requests handled on this connection',
            'remote_logname' => 'Remote logname (from identd, if supplied)',
            'method' => 'The request method',
            'module_note' => 'The contents of note from another module',
            'res_header' => 'The contents of header line(s) in the reply',
            'server_port_canonical' => 'The canonical port of the server serving the request',
            'port' => 'The canonical port of the server serving the request or the server actual port or the clients actual port. Valid formats are canonical, local, or remote',
            'child_id' => 'The process ID of the child that serviced the request',
            'child_id_formatted' => 'The process ID or thread id of the child that serviced the request. Valid formats are pid, tid, and hextid. hextid',
            'query_string' => 'The query string',
            'req_first_line' => 'First line of request',
            'res_handler' => 'The handler generating the response (if any)',
            'status_orig' => 'Status. For requests that got internally redirected, this is the status of the *original* request --- %>s for the last.',
            'status_last' => 'Status. Last',
            'time' => 'Time the request was received (standard english format)',
            'time_formatted' => 'The time, in the form given by format, which should be in an extended strftime(3) format (potentially localized)',
            'serve_req_time' => 'The time taken to serve the request, in seconds',
            'serve_req_time_in_units' => 'The time taken to serve the request, in a time unit.',
            'remote_user' => 'Remote user (from auth; may be bogus if return status (%s) is 401)',
            'url' => 'The URL path requested, not including any query string',
            'server_name' => 'The canonical ServerName of the server serving the request',
            'server_name_ucn' => 'The server name according to the UseCanonicalName setting',
            'connection_status' => 'Connection status when response is completed',
            'received_bytes' => 'Bytes received, including request and headers, cannot be zero',
            'sended_bytes' => 'Bytes sent, including headers, cannot be zero',
            'req_trailer_line' => 'The contents of trailer line(s) in the request sent to the server',
            'res_trailer_line' => 'The contents of trailer line(s) in the response sent from the server',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        foreach ($this->attributes as $name => $attr) {
            if (strpos($attr, "{AND}") !== false) {
                $expl = explode("{AND}", $attr);
                foreach ($expl as $val){
                    $criteria->compare($name, $val, true);
                }
            }
            else{
                $criteria->compare($name, $attr, true);
            }
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Log the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function save($runValidation = true, $attributes = null) {
        $check = static::model()->count("line_uid='{$this->line_uid}'");
        if ($check > 0) {
            if (Yii::app()->getComponent(\application\components\ApacheAccessLog\Parser::COMPONENT_ID, false)) {
                echo "Record exists, file:{$this->file}, line:{$this->line_num}\n";
            }
            return false;
        }
        return parent::save($runValidation, $attributes);
    }

}
