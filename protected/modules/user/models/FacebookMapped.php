<?php

/**
 * This is the model class for table "facebook_mapped".
 *
 * The followings are the available columns in table 'facebook_mapped':
 * @property string $id
 * @property string $user_id
 * @property string $facebook_id
 * @property string $fbemail
 */
class FacebookMapped extends JLActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return FacebookMapped the static model class
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
		return 'facebook_mapped';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, facebook_id', 'required'),
			array('user_id', 'length', 'max'=>16),
			array('facebook_id', 'length', 'max'=>25),
			array('fbemail', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, facebook_id, fbemail', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'facebook_id' => 'Facebook',
			'fbemail' => 'Fbemail',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('facebook_id',$this->facebook_id,true);
		$criteria->compare('fbemail',$this->fbemail,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function mapAccount($binUserID, $fbInfo) {
		$fid = $fbInfo['fid'];
		if (!self::model()->exists('facebook_id = :fid', array(':fid' => $fid)))
		{
			$fbModel = new FacebookMapped;
			$fbModel->user_id = $binUserID;
			$fbModel->facebook_id = $fid;
			
			if(isset($fbInfo['email']))
				$fbModel->fbemail = $fbInfo['email'];
			
			if (!$fbModel->save()) {
				throw new Exception("Can't map Facebook account with your current Justlook account");
			}
		} else {
			//  remove old mapping and user
			$fbMap = self::model()->find('facebook_id = :fid', array(':fid' => $fid));
		
			// find user and remove
			if (!empty($fbMap)) {
				$fbMap->user_id = $binUserID;
				if(! $fbMap->save() ) {
					throw new Exception('Error occurs while mapping Facebook account with current Justlook account.');
				}
			}
		}
	}
	
}