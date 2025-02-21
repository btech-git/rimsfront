<?php

/**
 * This is the model class for table "rims_vehicle_car_sub_model_detail".
 *
 * The followings are the available columns in table 'rims_vehicle_car_sub_model_detail':
 * @property integer $id
 * @property integer $car_sub_model_id
 * @property string $name
 * @property string $chasis_code
 * @property string $assembly_year_start
 * @property string $assembly_year_end
 * @property string $transmission
 * @property string $fuel_type
 * @property integer $power
 * @property string $drivetrain
 * @property string $description
 * @property string $status
 * @property string $luxury_value
 * @property string $created_datetime
 *
 * The followings are the available model relations:
 * @property Vehicle[] $vehicles
 */
class VehicleCarSubModelDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rims_vehicle_car_sub_model_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('car_sub_model_id, name, assembly_year_start, assembly_year_end, transmission, fuel_type, power, drivetrain, status, created_datetime', 'required'),
			array('car_sub_model_id, power', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('chasis_code, assembly_year_start, assembly_year_end, drivetrain, status', 'length', 'max'=>10),
			array('transmission', 'length', 'max'=>30),
			array('fuel_type', 'length', 'max'=>20),
			array('luxury_value', 'length', 'max'=>8),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, car_sub_model_id, name, chasis_code, assembly_year_start, assembly_year_end, transmission, fuel_type, power, drivetrain, description, status, luxury_value, created_datetime', 'safe', 'on'=>'search'),
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
			'vehicles' => array(self::HAS_MANY, 'Vehicle', 'car_sub_model_detail_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'car_sub_model_id' => 'Car Sub Model',
			'name' => 'Name',
			'chasis_code' => 'Chasis Code',
			'assembly_year_start' => 'Assembly Year Start',
			'assembly_year_end' => 'Assembly Year End',
			'transmission' => 'Transmission',
			'fuel_type' => 'Fuel Type',
			'power' => 'Power',
			'drivetrain' => 'Drivetrain',
			'description' => 'Description',
			'status' => 'Status',
			'luxury_value' => 'Luxury Value',
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
		$criteria->compare('car_sub_model_id',$this->car_sub_model_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('chasis_code',$this->chasis_code,true);
		$criteria->compare('assembly_year_start',$this->assembly_year_start,true);
		$criteria->compare('assembly_year_end',$this->assembly_year_end,true);
		$criteria->compare('transmission',$this->transmission,true);
		$criteria->compare('fuel_type',$this->fuel_type,true);
		$criteria->compare('power',$this->power);
		$criteria->compare('drivetrain',$this->drivetrain,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('luxury_value',$this->luxury_value,true);
		$criteria->compare('created_datetime',$this->created_datetime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VehicleCarSubModelDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
