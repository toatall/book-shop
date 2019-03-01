<?php

use yii\db\Migration;

/**
 * Заказы (order)
 * @author oleg
 * @version 10.03.2016
 */
class m160310_122009_order extends Migration
{
	
    public function up()
    {
		$this->createTable('{{%order}}', [
			'id' => $this->primaryKey(),
			'id_user' => $this->integer()->notNull(),
			'pay_type' => $this->smallInteger()->notNull(),
			'status' => $this->smallInteger()->notNull(),
			'date_create' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
			'date_edit' => $this->timestamp(),
			'author' => $this->string(250)->notNull(),
		]);
    }

    public function down()
    {
        $this->dropTable('{{%order}}');
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
