<?php

use yii\db\Migration;

/**
 * Пользователи (user)
 * @author oleg
 * @version 10.03.2016
 */
class m160310_122002_user extends Migration
{
	
    public function up()
    {
		$this->createTable('{{%user}}', [
			'id' => $this->primaryKey(),
			'login' => $this->string(250)->notNull()->unique(),
			'password' => $this->string(50)->notNull(),
			'blocked' => $this->boolean()->notNull()->defaultValue(0),
			'role' => $this->string(50)->notNull(),
			'email' => $this->string(250)->notNull()->unique(),
			'name' => $this->string(250),
			'surname' => $this->string(250),
			'patronymic' => $this->string(250),
			'date_birthday' => $this->date(),
			'photo' => $this->string(250),			
			'address' => $this->text(),
			'last_login' => $this->timestamp(),
			'date_create' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
			'date_edit' => $this->timestamp(),
			'author' => $this->string(250)->notNull(),
		]);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
