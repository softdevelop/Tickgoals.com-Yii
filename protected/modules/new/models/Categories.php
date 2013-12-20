<?php

/**
 * This is the model class for table "categories".
 *
 * The followings are the available columns in table 'categories':
 * @property string $id
 * @property string $name
 * @property string $alias
 */
class Categories extends JLActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Categories the static model class
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
		return 'categories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required','message'=>'Vui lòng nhập {attribute} '),
			array('id', 'length', 'max'=>16),
			array('name, alias', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, alias', 'safe', 'on'=>'search'),
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
			'new' => array(self::HAS_MANY, 'News', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Tên',
			'alias' => 'Bí danh',
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
		$criteria->compare('alias',$this->alias,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function createAliasBusiness($cs){
		$marTViet=array("à","á","?","?","ã","â","?","?","?","?","?","a",
		"?","?","?","?","?","è","é","?","?","?","ê","?"
		,"?","?","?","?",
		"ì","í","?","?","i",
		"ò","ó","?","?","õ","ô","?","?","?","?","?","o"
		,"?","?","?","?","?",
		"ù","ú","?","?","u","u","?","?","?","?","?",
		"?","ý","?","?","?",
		"d",
		"À","Á","?","?","Ã","Â","?","?","?","?","?","A"
		,"?","?","?","?","?",
		"È","É","?","?","?","Ê","?","?","?","?","?",
		"Ì","Í","?","?","I",
		"Ò","Ó","?","?","Õ","Ô","?","?","?","?","?","O"
		,"?","?","?","?","?",
		"Ù","Ú","?","?","U","U","?","?","?","?","?",
		"?","Ý","?","?","?",
		"Ð"," ");

		
		$marKoDau=array("a","a","a","a","a","a","a","a","a","a","a"
		,"a","a","a","a","a","a",
		"e","e","e","e","e","e","e","e","e","e","e",
		"i","i","i","i","i",
		"o","o","o","o","o","o","o","o","o","o","o","o"
		,"o","o","o","o","o",
		"u","u","u","u","u","u","u","u","u","u","u",
		"y","y","y","y","y",
		"d",
		"A","A","A","A","A","A","A","A","A","A","A","A"
		,"A","A","A","A","A",
		"E","E","E","E","E","E","E","E","E","E","E",
		"I","I","I","I","I",
		"O","O","O","O","O","O","O","O","O","O","O","O"
		,"O","O","O","O","O",
		"U","U","U","U","U","U","U","U","U","U","U",
		"Y","Y","Y","Y","Y",
		"D","-");
		
		$a = str_replace($marTViet,$marKoDau,$cs);
		$KETQUA = strtolower($a);
		$KETQUA = preg_replace('/[^a-z0-9\-_]/','',$KETQUA);
		$KETQUA = preg_replace('/[\-]/','-',$KETQUA);
		$temp = explode("-",$KETQUA);
		$txt = "";
		if(!empty($temp)){
			foreach($temp as $key=>$value){
				if($value!=""){
					if($key!=count($temp)-1)
						$txt .= $value."-";
					else
						$txt .= $value;
				}
			}
		}
		return $txt;
	}
}