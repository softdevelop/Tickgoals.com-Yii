<?php

/**
 * This is the model class for table "twitter_mapped".
 *
 * The followings are the available columns in table 'twitter_mapped':
 * @property string $id
 * @property string $user_id
 * @property string $twitter_id
 * @property string $fbemail
 */
class TwitterMapped extends JLActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TwitterMapped the static model class
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
		return 'twitter_mapped';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, user_id', 'length', 'max'=>16),
			array('twitter_id', 'length', 'max'=>100),
			array('fbemail', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, twitter_id, fbemail', 'safe', 'on'=>'search'),
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
			'twitter_id' => 'Twitter',
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
		$criteria->compare('twitter_id',$this->twitter_id,true);
		$criteria->compare('fbemail',$this->fbemail,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}