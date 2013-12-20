<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property integer $actived
 * @property string $created
 * @property string $email
 * @property integer $lastvisit
 * @property string $password
 * @property integer $is_closed
 * @property integer $identity_card
 */
class Users extends JLActiveRecord
{
	public static $key = "Where is my salk key";
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, password,first_name,last_name', 'required'),
			array('actived, lastvisit, is_closed, identity_card,phone', 'numerical', 'integerOnly'=>true,'message'=>'Vui lòng nhập số'),
			array('id,group_id', 'length', 'max'=>16),
			array('password', 'length', 'min'=>6),
			array('first_name,last_name', 'length', 'min'=>2,'max'=>200),
			array('first_name, last_name, email', 'length', 'max'=>200),
			array('created,birth,phone,gender', 'safe'),
			array('email', 'unique'),
			array('email', 'email'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, first_name, last_name, actived,birth, created, email, lastvisit,  is_closed, identity_card', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'group' => array(self::BELONGS_TO, 'Groups', 'group_id'),
			'map_class' => array(self::HAS_MANY, 'MapDepartments', 'user_id'),
			'map_team' => array(self::HAS_MANY, 'TeamMapping', 'user_id'),
			
			'ulist' => array(self::HAS_MANY, 'Lists', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'first_name' => 'First name',
			'last_name' => 'Last name',
			'actived' => 'Actived',
			'created' => 'Created',
			'email' => 'Email',
			'lastvisit' => 'Last visit',
			'password' => 'Password',
			'is_closed' => 'is closed',
			'identity_card' => 'Identity Card',
			'birth' => 'Birthday',
			'phone' => 'Phone number',
			'gender' => 'Gender',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('actived',$this->actived);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('lastvisit',$this->lastvisit);
		$criteria->compare('password',$this->password);
		$criteria->compare('is_closed',$this->is_closed);
		$criteria->compare('birth',$this->is_closed);
		$criteria->compare('identity_card',$this->identity_card);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function encodePassword($str=NULL){
		return sha1(md5($str));
	}
	public function comparePassword($pass=NULL){
		if(sha1(md5($pass))==$this->password) return true;
		else false;
	}
	public function getInfo($binID=NULL){
		return $this->findByPk($binID);
	}
	public static function forceLoginByEmail($email, $remember = false) {
		$user = Users::model()->find('email=:email', array(':email' => $email));
		if (!empty($user)) {
			self::forceLogin($user->id, $remember);
		} else {
			throw new Exception("This email doesn't exist in our database");
		}
	}
	public static function forceLogin($binUserID, $remember = false) {
		$hexID = IDHelper::uuidFromBinary($binUserID, true);
		
		$identity = UUserIdentity::processAuth($hexID);
		
		$duration = 0;
		if ($remember) {
			$duration = 3600*24*30;
			//setcookie("rememberMe", 1, time() + $duration);
		}
			
		$key = Users::$key;
		Yii::app()->user->login($identity, $duration);
		$user  = Users::model()->getInfo($binUserID);
			
		if ($remember) {
			$duration = 3600*24*30;
			$code = $this->encode($user->id, $key);
			
			$cookieName = 'rememberMe';
			if (isset(Yii::app()->request->cookies[$cookieName]))
				unset(Yii::app()->request->cookies[$cookieName]);
	
			$cookie = new CHttpCookie($cookieName, $code['hash']);
			$cookie->expire = time() + $duration;
			$cookie->domain = Yii::app()->session->cookieParams['domain'];
	
			Yii::app()->request->cookies[$cookieName] = $cookie;
		}

		// Update time last visit
		$user->lastvisit = time();
		$user->save();
		
		return $user;
	}
	public function encode($binUserID, $key) {
		$token = substr(sha1(uniqid()), 0, 10);
		$key = substr(sha1($key), 0, 10);
		$string = IDHelper::uuidFromBinary($binUserID, true)."|".$token;
		$result = "";
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)+ord($keychar));
			$result .= $char;
		}
		//return urlencode(base64_encode($result));
		return array(
				//'hash'	=> urlencode(base64_encode($result)),
				'hash'		=> urlencode(base64_encode($string)),
				'token'		=> $token
		);
	}
	public function getUsers(){
		$criteria	=	new CDbCriteria;
		$criteria->with = 'group';
		$criteria->together = true;
		$criteria->compare('superuser',0);
		$criteria->order = "group.level asc";
		$result = $this->findAll($criteria);
		return $result;
	}
}