<?php

use yii\db\Migration;

/**
 * Связь книги с категориями (link_book_category)
 *  
 * @author oleg
 * @version 11.03.2016
 */
class m160310_122027_link_book_category extends Migration
{
	
    public function up()
    {
		$this->createTable('{{%link_book_category}}', [
			'id' => $this->primaryKey(),
			'id_book' => $this->integer()->notNull(),
			'category' => $this->string(30)->notNull(),			
		]);
		
		/*
		$this->addForeignKey('fk_link_book_category__book', 
			'{{%link_book_category}}', 'id_book', '{{%book}}', 'id');
		$this->addForeignKey('fk_link_book_category__category',
			'{{%link_book_category}}', 'category', '{{%category}}', 'name');	
		*/	
    }

    public function down()
    {
        /*
    	$this->dropForeignKey('fk_link_book_category__book', '{{%link_book_category}}');
    	$this->dropForeignKey('fk_link_book_category__category', '{{%link_book_category}}');
    	*/
    	$this->dropTable('{{%link_book_category}}');
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
