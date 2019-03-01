<?php

use yii\db\Migration;

/**
 * Первоначальное наполнение таблиц
 * 
 * @author oleg
 * @version 11.03.2016
 */
class m160311_051805_first_data extends Migration
{
	
    public function up()
    {
		// category		
    	/*
    	$this->insert('{{%category}}', [
			'name' => 'Учебная литература',
			'author' => 'system',
		]);
		$this->insert('{{%category}}', [
			'name' => 'Бизнес литература',
			'author' => 'system',
		]);
		$this->insert('{{%category}}', [
			'name' => 'Художественная литература',
			'author' => 'system',
		]);
		$this->insert('{{%category}}', [
			'name' => 'Иностранные языки',
			'author' => 'system',
		]);
		$this->insert('{{%category}}', [
			'name' => 'Творчество',
			'author' => 'system',
		]);
		$this->insert('{{%category}}', [
			'name' => 'Компьютерная литература',
			'author' => 'system',
		]);
		$this->insert('{{%category}}', [
			'name' => 'Искусство',
			'author' => 'system',
		]);
		*/
    	
		$this->insert('{{%user}}', [
			'login' => 'admin',
			'password' => Yii::$app->getSecurity()->generatePasswordHash('admin'),
			'role' => 'admin',
			'email' => '_alexeevich_@list.ru',
			'name' => 'Олег',
			'surname' => 'Трусов',
			'patronymic' => 'Алексеевич',
			'date_birthday' => '24.01.1987',
			'author' => 'system',
		]);
		
		
    }

    public function down()
    {
        echo 'Not delete information from table!';
        return false;
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
