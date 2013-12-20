<?php

/**
 * This is the model class for table "goals".
 *
 * The followings are the available columns in table 'goals':
 * @property string $id
 * @property string $name
 * @property string $list_id
 * @property integer $time
 * @property string $reminder
 * @property string $completion
 */
class Goal extends JLActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Goals the static model class
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
		return 'goals';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required','message'=>'Please enter name'),
			array('reminder', 'required','message'=>'Please select a reminder'),
			array('completion', 'required'),
			array('time', 'numerical', 'integerOnly'=>true),
			array('id, list_id', 'length', 'max'=>16),
			array('name, reminder', 'length', 'max'=>255),
			array('completion', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, list_id, time, reminder, completion', 'safe', 'on'=>'search'),
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
			'list' => array(self::BELONGS_TO, 'Lists', 'list_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'list_id' => 'List',
			'time' => 'Time',
			'reminder' => 'Reminder',
			'completion' => 'Date completion',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('list_id',$this->list_id,true);
		$criteria->compare('time',$this->time);
		$criteria->compare('reminder',$this->reminder,true);
		$criteria->compare('completion',$this->completion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}