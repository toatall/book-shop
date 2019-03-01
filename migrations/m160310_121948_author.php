<?php

use yii\db\Migration;

/**
 * Авторы (author)
 * @author oleg
 * @version 10.03.2016 
 */
class m160310_121948_author extends Migration
{
	
    public function up()
    {
		$this->createTable('{{%author}}', [
			'name' => $this->string(200)->notNull()->unique(),
			'date_create' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
			'author' => $this->string(50)->notNull(),
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
