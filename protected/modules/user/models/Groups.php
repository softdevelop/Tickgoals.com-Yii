<?php

/**
 * This is the model class for table "groups".
 *
 * The followings are the available columns in table 'groups':
 * @property string $id
 * @property string $name
 * @property integer $level
 */
class Groups extends JLActiveRecord
{
	const A = 0;
	const USER = 1;
	const PGD= 2;
	const GDDA= 3;
	const TP= 4;
	const PP = 5;
	const PM = 6;
	const NV = 7;
	const TE = 8;
	const FR = 9;
	const HV = 10;
	const NVVP = 11;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Groups the static model class
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
		return 'groups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required','message'=>'Vui lòng nhập {attribute}'),
			array('level', 'numerical', 'integerOnly'=>true,'message'=>'Vui lòng nhập số'),
			array('id', 'length', 'max'=>16),
			array('name', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, level', 'safe', 'on'=>'search'),
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
			'user' => array(self::HAS_MANY, 'Users', 'group_id'),
			'role' => array(self::HAS_MANY, 'Role', 'group_id'),
			'mapper' => array(self::HAS_MANY, 'MapPermission', 'permission_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Tên nhóm',
			'level' => 'Chức vụ',
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
		$criteria->compare('level',$this->level);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function notAdmin(){
		$criteria	=	new CDbCriteria;
		$criteria->condition = "level=:level";
		$criteria->params = array (	
			':level' => Groups::USER,
		);
		return $this->find($criteria);
	}
}