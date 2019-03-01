<?php

use yii\db\Migration;

/**
 * Связь книги с авторами (link_book_author)
 *
 * @author oleg
 * @version 11.03.2016
 */
class m160310_122037_link_book_author extends Migration
{
	
    public function up()
    {
    	$this->createTable('{{%link_book_author}}', [
    			'id' => $this->primaryKey(),
    			'id_book' => $this->integer()->notNull(),
    			'author' => $this->string(50)->notNull(),
    	]);
    	
    	/*
    	$this->addForeignKey('fk_link_book_author__book',
    			'{{%link_book_author}}', 'id_book', '{{%book}}', 'id');
    	$this->addForeignKey('fk_link_book_author__author',
    			'{{%link_book_author}}', 'author', '{{%author}}', 'name');
    	*/
    }

    public function down()
    {
    	/*
        $this->dropForeignKey('fk_link_book_author__book', '{{%link_book_author}}');
    	$this->dropForeignKey('fk_link_book_author__author', '{{%link_book_author}}');
    	*/
    	
    	$this->dropTable('{{%link_book_author}}');
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
