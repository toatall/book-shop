<?php

use yii\db\Migration;


/**
 * Категории (category)
 * @author Олег
 * @version 08.03.2016
 */
class m160308_131309_category extends Migration
{
    public function up()
    {
		$this->createTable('{{%category}}', [
			'id' => $this->primaryKey(),
			'name' => $this->string(250)->notNull()->unique(),
			'author' => $this->string(200)->notNull(),
			'date_create' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
			'date_modificate' => $this->timestamp(),			
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
