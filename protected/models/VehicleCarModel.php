<?php

/**
 * This is the model class for table "rims_vehicle_car_model".
 *
 * The followings are the available columns in table 'rims_vehicle_car_model':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $car_make_id
 * @property integer $service_group_id
 * @property string $status
 * @property integer $is_approved
 * @property integer $user_id
 * @property string $created_datetime
 */
class VehicleCarModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rims_vehicle_car_model';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, car_make_id, service_group_id, status, user_id, created_datetime', 'required'),
			array('car_make_id, service_group_id, is_approved, user_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>30),
			array('description', 'length', 'max'=>60),
			array('status', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description, car_make_id, service_group_id, status, is_approved, user_id, created_datetime', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'description' => 'Description',
			'car_make_id' => 'Car Make',
			'service_group_id' => 'Service Group',
			'status' => 'Status',
			'is_approved' => 'Is Approved',
			'user_id' => 'User',
			'created_datetime' => 'Created Datetime',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('car_make_id',$this->car_make_id);
		$criteria->compare('service_group_id',$this->service_group_id);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('is_approved',$this->is_approved);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('created_datetime',$this->created_datetime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VehicleCarModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
