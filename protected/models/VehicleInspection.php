<?php

/**
 * This is the model class for table "rims_vehicle_inspection".
 *
 * The followings are the available columns in table 'rims_vehicle_inspection':
 * @property integer $id
 * @property integer $vehicle_id
 * @property integer $inspection_id
 * @property string $inspection_date
 * @property string $inspection_date_after_service
 * @property string $work_order_number
 * @property string $status
 * @property integer $service_advisor_id
 *
 * The followings are the available model relations:
 * @property Inspection $inspection
 * @property Vehicle $vehicle
 * @property Users $serviceAdvisor
 */
class VehicleInspection extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rims_vehicle_inspection';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vehicle_id, inspection_id, inspection_date, work_order_number, status, service_advisor_id', 'required'),
			array('vehicle_id, inspection_id, service_advisor_id', 'numerical', 'integerOnly'=>true),
			array('work_order_number', 'length', 'max'=>30),
			array('status', 'length', 'max'=>10),
			array('inspection_date_after_service', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, vehicle_id, inspection_id, inspection_date, inspection_date_after_service, work_order_number, status, service_advisor_id', 'safe', 'on'=>'search'),
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
			'inspection' => array(self::BELONGS_TO, 'Inspection', 'inspection_id'),
			'vehicle' => array(self::BELONGS_TO, 'Vehicle', 'vehicle_id'),
			'serviceAdvisor' => array(self::BELONGS_TO, 'Users', 'service_advisor_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'vehicle_id' => 'Vehicle',
			'inspection_id' => 'Inspection',
			'inspection_date' => 'Inspection Date',
			'inspection_date_after_service' => 'Inspection Date After Service',
			'work_order_number' => 'Work Order Number',
			'status' => 'Status',
			'service_advisor_id' => 'Service Advisor',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('vehicle_id',$this->vehicle_id);
		$criteria->compare('inspection_id',$this->inspection_id);
		$criteria->compare('inspection_date',$this->inspection_date,true);
		$criteria->compare('inspection_date_after_service',$this->inspection_date_after_service,true);
		$criteria->compare('work_order_number',$this->work_order_number,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('service_advisor_id',$this->service_advisor_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VehicleInspection the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
