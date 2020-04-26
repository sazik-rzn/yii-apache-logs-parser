<?php

class m200423_001236_initial extends CDbMigration {

    protected $MySqlOptions = 'ENGINE=InnoDB CHARSET=utf8';

    public function up() {
        $logTable = [
            'id'=>'bigpk',
            'file'=>'string NOT NULL',
            'line_num'=>'bigint NOT NULL',
            'line_uid'=>'string NOT NULL',
            'parsed_at'=>'integer NOT NULL'
        ];
        foreach (application\components\ApacheAccessLog\Parser::GetDictionary() as $key=>$val){
            $type = 'string NULL';
            if(isset($val['data_type']) && $val['data_type']==='int'){
                $type = "bigint NULL";
            }
            $logTable[$val['name']] = "{$type} COMMENT '{$val['description']}'";
        }
        $this->createTable('log', $logTable, $this->MySqlOptions);
        $this->createIndex('logUidIDX', 'log', ['line_uid'], true);
    }

    public function down() {
        $this->dropTable('log');
    }

    /*
      // Use safeUp/safeDown to do migration with transaction
      public function safeUp()
      {
      }

      public function safeDown()
      {
      }
     */
}
