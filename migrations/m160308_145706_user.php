<?php

use yii\db\Migration;

/**
 * Пользователи (user)
 * @author Олег
 * @version 08.03.2016
 */
class m160308_145706_user extends Migration
{
    public function up()
    {
    	$this->createTable('{{%user}}', [
    			'id' => $this->primaryKey(),
    			'login' => $this->string(200)->notNull()->unique(),
    			'password' => $this->string(100)->notNull(),
    			'role' => $this->string(50)->notNull(),
    			'surname' => $this->string(200)->notNull(),
    			'name' => $this->string(200)->notNull(),
    			'patronymic' => $this->string(200),    			
    			'blocked' => $this->boolean()->notNull()->defaultValue(0),
    			'date_create' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
    			'date_modificate' => $this->timestamp(),
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
