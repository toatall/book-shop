<?php

use yii\db\Migration;

/**
 * Книги (book)
 * @author Олег
 * @version 08.03.2016
 */
class m160308_145715_book extends Migration
{
    public function up()
    {
		$this->createTable('{{%book}}', [
			'id' => $this->primaryKey(),
			'title' => $this->string(500)->notNull(),
			'description' => $this->text()->notNull(),
			'pages' => $this->integer()->notNull(),
			'ISBN' => $this->string(100),
			'publishung' => $this->string(200)->notNull(),
			'photo' => $this->string(250),
			'author' => $this->string(200)->notNull(),
			'date_create' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
			'date_modificate' => $this->timestamp(),	
		]);
    }

    public function down()
    {
        $this->dropTable('{{%book}}');
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
