<?php

use yii\db\Migration;

/**
 * Книги (book)
 * @author oleg
 * @version 10.03.2016
 */
class m160310_121955_book extends Migration
{
	
    public function up()
    {
		$this->createTable('{{%book}}', [
			'id' => $this->primaryKey(),
			'title' => $this->string(500)->notNull(),
			'description' => $this->text()->notNull(),
			'ISBN' => $this->string(50),
			'count_page' => $this->integer()->notNull()->defaultValue(0),
			'count_book_stock' => $this->integer()->notNull()->defaultValue(0),
			'image' => $this->string(500),
			'price' => $this->decimal()->notNull()->defaultValue(0),
			'discount' => $this->decimal()->notNull()->defaultValue(0),
			'date_create' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
			'date_edit' => $this->timestamp(),
			'author' => $this->string(250)->notNull(),
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
