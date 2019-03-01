<?php

use yii\db\Migration;

/**
 * Категории (category)
 * @author oleg
 * @version 10.03.2016
 */
class m160310_121939_category extends Migration
{
	
    public function up()
    {
		$this->createTable('{{%category}}', [
			'name' => $this->string(30)->notNull()->unique(),
			'date_create' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
			'author' => $this->string(250)->notNull(),
		]);
    }

    public function down()
    {
        $this->dropTable('{{%category}}');
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
