<?php

/**
 * This is the model class for table "result_war".
 *
 * The followings are the available columns in table 'result_war':
 * @property string $id
 * @property string $teama
 * @property string $teamb
 * @property integer $rsa
 * @property integer $rsb
 * @property string $created
 */
class ResultWar extends JLActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ResultWar the static model class
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
		return 'result_war';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rsa, rsb', 'numerical', 'integerOnly'=>true),
			array('id, teama, teamb', 'length', 'max'=>16),
			array('created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, teama, teamb, rsa, rsb, created', 'safe', 'on'=>'search'),
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
			'teama' => 'Teama',
			'teamb' => 'Teamb',
			'rsa' => 'Rsa',
			'rsb' => 'Rsb',
			'created' => 'Created',
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
		$criteria->compare('teama',$this->teama,true);
		$criteria->compare('teamb',$this->teamb,true);
		$criteria->compare('rsa',$this->rsa);
		$criteria->compare('rsb',$this->rsb);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getTablePoint($d=NULL){
		$team = Team::model()->findAll();
		$data = array();
		
		$arrTongDiem = array();
		if(!empty($team)){
		
			foreach($team as $k=>$v){
				if($k<=2){
					$win = 0;
					$lose = 0;
					$equal = 0;
					$banthang = 0;
					$banthua = 0;
					

					if($d==NULL){
						$recordA = $this->findAllByAttributes(array('teama'=>$v->id));
					}else{
					
						$monthCurrent = date("m",strtotime("01-".$d));
						$yearCurrent = date("Y",strtotime("01-".$d));
						$totalDay = cal_days_in_month(CAL_GREGORIAN, $monthCurrent, $yearCurrent);
						
						$recordA = $this->findAll(
							array(
								'condition' => 'teama = :teama and created >=:fday AND created<= :lday',
								'params' => array(
									':teama' => $v->id,
									':fday' => date("Y-m-d",strtotime("01-".$d)),
									':lday' => date("Y-m-d",strtotime($totalDay."-".$d)),
								)
							)
						);
						
					}
					$countA = count($recordA);
					if(!empty($recordA)){
						foreach($recordA as $key=>$r){
							if($r->rsa>$r->rsb) $win++;
							if($r->rsa<$r->rsb) $lose++;
							if($r->rsa==$r->rsb) $equal++;
							$banthang = $banthang+$r->rsa;
							$banthua = $banthua+$r->rsb;
						}
					}
					if($d==NULL){
						$recordB = $this->findAllByAttributes(array('teamb'=>$v->id));
					}else{
						$monthCurrent = date("m",strtotime("01-".$d));
						$yearCurrent = date("Y",strtotime("01-".$d));
						$totalDay = cal_days_in_month(CAL_GREGORIAN, $monthCurrent, $yearCurrent);
						
						$recordB = $this->findAll(
							array(
								'condition' => 'teamb = :teamb and created >=:fday AND created<= :lday',
								'params' => array(
									':teamb' => $v->id,
									':fday' => date("Y-m-d",strtotime("01-".$d)),
									':lday' => date("Y-m-d",strtotime($totalDay."-".$d)),
								)
							)
						);
					}
					$countB = count($recordB);
					if(!empty($recordB)){
						foreach($recordB as $key=>$r){
							if($r->rsb>$r->rsa) $win++;
							if($r->rsb<$r->rsa) $lose++;
							if($r->rsb==$r->rsa) $equal++;
							$banthang = $banthang+$r->rsb;
							$banthua = $banthua+$r->rsa;
						}
					}
					$arrTongDiem[] = ($win*3)+($equal*1);
					$data[outStr($v->id)] = array(
						'name'=>$v->name,
						'tongTran'=>$countB+$countA,
						'win'=>$win,
						'lose'=>$lose,
						'equal'=>$equal,
						'banthang'=>$banthang,
						'banthua'=>$banthua,
						'hieuso'=>$banthang-$banthua,
						'tongdiem'=>($win*3)+($equal*1),
					);
				}
				
			}
		}
		
		$maxTongDiem = max($arrTongDiem);
		
		$minTongDiem = min($arrTongDiem);
		$bangDiem1 = array();
		$bangDiem2 = array();
		$bangDiem3 = array();
		$bangDiem = array();
		if(!empty($data)){
			$cnt = 0;
			$tmpCnt = 0;
			foreach($data as $k=>$v){
				if($maxTongDiem==$v['tongdiem']){
					$tmpCnt++;
					switch($tmpCnt){
						case 2:
							$bangDiem1[$tmpCnt] = $v;
							$bangDiem1[$tmpCnt]['id'] = $k;
							unset($data[$k]);						
						break;
						case 3:
							$bangDiem1[$tmpCnt] = $v;
							$bangDiem1[$tmpCnt]['id'] = $k;
							unset($data[$k]);						
						break;
						default:
							$bangDiem1[$cnt] = $v;
							$bangDiem1[$cnt]['id'] = $k;
							unset($data[$k]);
						break;
					}

				}else if($minTongDiem==$v['tongdiem']){
					$bangDiem2[$cnt] = $v;
					$bangDiem2[$cnt]['id'] = $k;
					unset($data[$k]);
				}else{
					
					$bangDiem3[$cnt] = $v;
					$bangDiem3[$cnt]['id'] = $k;
					unset($data[$k]);
				}
			}
		}

		//sort($bangDiem);
		$bangDiem = array_merge($bangDiem1,$bangDiem3,$bangDiem2);
		
		return $bangDiem;
	}
}