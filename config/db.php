<?php

$_fn=realpath(__DIR__."/../data")."/book.db3";

return [
    'class' => 'yii\db\Connection',
	'dsn' => 'sqlite:' . $_fn,
];
