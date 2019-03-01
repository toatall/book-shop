<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property boolean $blocked
 * @property string $role
 * @property string $email
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $date_birthday
 * @property string $photo
 * @property string $address
 * @property string $last_username
 * @property string $date_create
 * @property string $date_edit
 * @property string $author
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
	
	public $password_confirm;
	public $_password;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email'], 'required'],
        	[['password_confirm'], 'required', 'on'=>'insert'],
        	['password_confirm', 'compare', 'compareAttribute' => 'password'],
            [['blocked'], 'boolean'],
            [['date_birthday', 'last_login', 'date_create', 'date_edit'], 'safe'],
            [['address'], 'string'],
            [['username', 'email', 'name', 'surname', 'patronymic', 'photo', 'author'], 'string', 'max' => 250],
            [['password', 'role'], 'string', 'max' => 500],
            [['email', 'username'], 'unique'],
        	[['email'], 'email'],
            [['username'], 'unique'],
        	[['role'], 'default', 'value'=>'user'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'username' => 'Логин',
            'password' => 'Пароль',
        	'password_confirm' => 'Подтверждение пароля',
            'blocked' => 'Блокировка',
            'role' => 'Роль',
            'email' => 'Email',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'date_birthday' => 'Дата рождения',
            'photo' => 'Фото',
            'address' => 'Адрес доставки',
            'last_login' => 'Последний вход',
            'date_create' => 'Дата создания',
            'date_edit' => 'Дата изменения',
            'author' => 'Автор',
        ];
    }
    
    
    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
    	return new UserQuery(get_called_class());
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {  
		return static::findOne($id);
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {    	
    	return null;
    }
    
    /**
     * @inheritdoc
     */
    public function getId()
    {
    	return $this->getPrimaryKey();
    }
    
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
    	return 'auth_' . $this->id . '_key';
    }
    
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
    	return $this->authKey === $authKey;
    }
    
    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username'=>$username]);
    }
    
    
    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
    	return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }
    
    /**
     * Событие перед сохранением данных в БД
     * @see \yii\db\BaseActiveRecord::beforeSave($insert)
     */
    public function beforeSave($insert)
    {
    	if ($this->isNewRecord)
    	{
    		$this->author = isset(Yii::$app->user->identity->username) ? Yii::$app->user->identity->username : 'guest';    		
    	}
    	
    	if ($this->password == '')
    		$this->password = $this->_password;
    	
    	$this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
    	
    	
    	return parent::beforeSave($insert);    	
    }
    
    /**
     * Событие после поиска данных в БД
     * @see \yii\db\BaseActiveRecord::afterFind()
     */
    public function afterFind()
    {
    	$this->_password = $this->password;
    	return parent::afterFind();    
    }
    
    
    
    /**
     * Проверка у пользователя роли администратора
     * @return boolean
     */
    public function getIsAdmin()
    {
    	return (!Yii::$app->user->isGuest && isset(Yii::$app->user->identity->role) 
    			&& (Yii::$app->user->identity->role == 'admin'));
    }
    
    
    /**
     * Проверка возможности предоставления 
     * 	 доступа на основании ролей $roles
     * @param [] $roles
     */
    public static function checkRoles($roles)
    {
    	if (Yii::$app->user->isGuest || !isset(Yii::$app->user->identity->role))
    		return false;
    	
    	$userRole = Yii::$app->user->identity->role;
    	if ($userRole == 'admin') return true;
    	
    	foreach ($roles as $role)
    	{
    		if ($role == $userRole) return true; 
    	}
    	
    	return false;
    		
    }
    
    
}
