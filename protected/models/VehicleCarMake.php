<?php

/**
 * This is the model class for table "rims_vehicle_car_make".
 *
 * The followings are the available columns in table 'rims_vehicle_car_make':
 * @property integer $id
 * @property string $name
 * @property integer $service_difficulty_rate
 * @property string $status
 * @property integer $is_approved
 * @property integer $user_id
 * @property string $created_datetime
 */
class VehicleCarMake extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rims_vehicle_car_make';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, user_id, created_datetime', 'required'),
			array('service_difficulty_rate, is_approved, user_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>30),
			array('status', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, service_difficulty_rate, status, is_approved, user_id, created_datetime', 'safe', 'on'=>'search'),
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
			'service_difficulty_rate' => 'Service Difficulty Rate',
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
		$criteria->compare('service_difficulty_rate',$this->service_difficulty_rate);
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
	 * @return VehicleCarMake the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
