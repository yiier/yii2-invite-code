<?php

use yii\db\Migration;

class m160427_083412_create_invite_code extends Migration
{
    public $tableName = '{{%invite_code}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'code' => $this->string(32)->notNull(),
            'user_id' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(0), // 0 未使用 1已经使用
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
