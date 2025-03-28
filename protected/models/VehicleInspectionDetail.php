<?php

/**
 * This is the model class for table "rims_vehicle_inspection_detail".
 *
 * The followings are the available columns in table 'rims_vehicle_inspection_detail':
 * @property integer $id
 * @property integer $vehicle_inspection_id
 * @property integer $section_id
 * @property integer $module_id
 * @property integer $checklist_type_id
 * @property integer $checklist_module_id
 * @property string $value
 * @property integer $checklist_module_id_after_service
 * @property string $value_after_service
 */
class VehicleInspectionDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rims_vehicle_inspection_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vehicle_inspection_id, section_id, module_id, checklist_type_id, checklist_module_id', 'required'),
			array('vehicle_inspection_id, section_id, module_id, checklist_type_id, checklist_module_id, checklist_module_id_after_service', 'numerical', 'integerOnly'=>true),
			array('value, value_after_service', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, vehicle_inspection_id, section_id, module_id, checklist_type_id, checklist_module_id, value, checklist_module_id_after_service, value_after_service', 'safe', 'on'=>'search'),
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
			'vehicle_inspection_id' => 'Vehicle Inspection',
			'section_id' => 'Section',
			'module_id' => 'Module',
			'checklist_type_id' => 'Checklist Type',
			'checklist_module_id' => 'Checklist Module',
			'value' => 'Value',
			'checklist_module_id_after_service' => 'Checklist Module Id After Service',
			'value_after_service' => 'Value After Service',
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
		$criteria->compare('vehicle_inspection_id',$this->vehicle_inspection_id);
		$criteria->compare('section_id',$this->section_id);
		$criteria->compare('module_id',$this->module_id);
		$criteria->compare('checklist_type_id',$this->checklist_type_id);
		$criteria->compare('checklist_module_id',$this->checklist_module_id);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('checklist_module_id_after_service',$this->checklist_module_id_after_service);
		$criteria->compare('value_after_service',$this->value_after_service,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VehicleInspectionDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
