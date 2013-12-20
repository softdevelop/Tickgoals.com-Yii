<?php

/**
 * This is the model class for table "predict".
 *
 * The followings are the available columns in table 'predict':
 * @property string $id
 * @property string $name
 * @property integer $ty_so_z
 * @property integer $ty_so_n
 * @property string $obj_z_id
 * @property string $obj_n_id
 * @property string $created
 */
class Predict extends JLActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Predict the static model class
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
		return 'predict';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, ty_so_z, ty_so_n, obj_z_id, obj_n_id, created', 'required','message'=>'{attribute} không thể rỗng'),
			array('ty_so_z, ty_so_n', 'numerical', 'integerOnly'=>true,'message'=>'{attribute} phải nhập số'),
			array('id, obj_z_id, obj_n_id', 'length', 'max'=>16,'message'=>'{attribute} tối đa là 16 kí tự'),
			array('ty_so_z, ty_so_n', 'length', 'max'=>2,'message'=>'{attribute} tối đa là 2 số'),
			array('name', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, ty_so_z, ty_so_n, obj_z_id, obj_n_id, created', 'safe', 'on'=>'search'),
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
			'name' => '[Tên]',
			'ty_so_z' => '[Tỷ số đội đầu]',
			'ty_so_n' => '[Tỷ số đội sau]',
			'obj_z_id' => '[Team 1]',
			'obj_n_id' => '[Team 2]',
			'created' => '[Ngày tạo]',
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
		$criteria->compare('ty_so_z',$this->ty_so_z);
		$criteria->compare('ty_so_n',$this->ty_so_n);
		$criteria->compare('obj_z_id',$this->obj_z_id,true);
		$criteria->compare('obj_n_id',$this->obj_n_id,true);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}