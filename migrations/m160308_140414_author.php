<?php

use yii\db\Migration;

/**
 * Авторы (author)
 * @author Олег
 * @version 08.03.2016
 */
class m160308_140414_author extends Migration
{
    public function up()
    {
		$this->createTable('{{%author}}', [
			'id' => $this->primaryKey(),
			'surname' => $this->string(200)->notNull(),
			'name' => $this->string(200)->notNull(),
			'patronymic' => $this->string(200),
			'initials' => $this->string(10),
			'author' => $this->string(200)->notNull(),
			'date_create' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
			'date_modificate' => $this->timestamp(),
		]);
		
    }

    public function down()
    {
        $this->dropTable('{{%author}}');
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
