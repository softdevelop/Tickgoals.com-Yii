<?php

/**
 * This is the model class for table "active_mail".
 *
 * The followings are the available columns in table 'active_mail':
 * @property string $id
 * @property string $sender
 * @property string $receiver
 * @property string $keycode
 * @property integer $time
 */
class ActiveMail extends JLActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ActiveMail the static model class
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
		return 'active_mail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('time', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>16),
			array('sender, receiver', 'length', 'max'=>250),
			array('keycode', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sender, receiver, keycode, time', 'safe', 'on'=>'search'),
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
			'sender' => 'Sender',
			'receiver' => 'Receiver',
			'keycode' => 'Keycode',
			'time' => 'Time',
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
		$criteria->compare('sender',$this->sender,true);
		$criteria->compare('receiver',$this->receiver,true);
		$criteria->compare('keycode',$this->keycode,true);
		$criteria->compare('time',$this->time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function saveActiveMail($attributes=NULL){
		$model = new ActiveMail;
		if(!empty($attributes)){
			// assign attributes in model.
			foreach($attributes as $key=>$attr){
				$model->$key = $attr;
			}
		}
		$model->time = time();
		if($model->validate()){
			if(!$model->save()){
				$errors  = $model->getErrors();
				list ($field, $_errors) = each ($errors);
				throw new Exception($_errors[0]);
			}
		}else{
			$errors  = $model->getErrors();
			list ($field, $_errors) = each ($errors);
			throw new Exception($_errors[0]);

		}
	}
}