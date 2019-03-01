<?php

use yii\db\Migration;

/**
 * Связь заказа с книгами (link_order_book)
 *
 * @author oleg
 * @version 11.03.2016
 */
class m160310_122056_link_order_book extends Migration
{
	
    public function up()
    {
    	$this->createTable('{{%link_order_book}}', [
    		'id' => $this->primaryKey(),
			'id_order' => $this->integer()->notNull(),
			'id_book' => $this->integer()->notNull(),
			'price' => $this->decimal()->notNull()->defaultValue(0),
			'discount' => $this->decimal()->notNull()->defaultValue(0),
    	]);
    	
    	/*
    	$this->addForeignKey('fk_link_order_book__order',
    			'{{%link_order_book}}', 'id_order', '{{%order}}', 'id');
    	$this->addForeignKey('fk_link_order_book__book',
    			'{{%link_order_book}}', 'id_book', '{{%book}}', 'id');
    	*/
    }

    public function down()
    {
    	/*
        $this->dropForeignKey('fk_link_order_book__order', '{{%link_order_book}}');
    	$this->dropForeignKey('fk_link_order_book__book', '{{%link_order_book}}');
    	*/
    	
    	$this->dropTable('{{%link_order_book}}');
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
