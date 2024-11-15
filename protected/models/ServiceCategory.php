<?php

/**
 * This is the model class for table "rims_service_category".
 *
 * The followings are the available columns in table 'rims_service_category':
 * @property integer $id
 * @property string $code
 * @property integer $service_number
 * @property string $name
 * @property string $status
 * @property integer $service_type_id
 * @property integer $coa_id
 * @property integer $is_deleted
 * @property string $deleted_at
 * @property integer $deleted_by
 * @property integer $coa_diskon_service
 *
 * The followings are the available model relations:
 * @property Service[] $services
 */
class ServiceCategory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rims_service_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, service_number, name, service_type_id', 'required'),
			array('service_number, service_type_id, coa_id, is_deleted, deleted_by, coa_diskon_service', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>20),
			array('name', 'length', 'max'=>30),
			array('status', 'length', 'max'=>10),
			array('deleted_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, code, service_number, name, status, service_type_id, coa_id, is_deleted, deleted_at, deleted_by, coa_diskon_service', 'safe', 'on'=>'search'),
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
			'services' => array(self::HAS_MANY, 'Service', 'service_category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code' => 'Code',
			'service_number' => 'Service Number',
			'name' => 'Name',
			'status' => 'Status',
			'service_type_id' => 'Service Type',
			'coa_id' => 'Coa',
			'is_deleted' => 'Is Deleted',
			'deleted_at' => 'Deleted At',
			'deleted_by' => 'Deleted By',
			'coa_diskon_service' => 'Coa Diskon Service',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('service_number',$this->service_number);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('service_type_id',$this->service_type_id);
		$criteria->compare('coa_id',$this->coa_id);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('deleted_at',$this->deleted_at,true);
		$criteria->compare('deleted_by',$this->deleted_by);
		$criteria->compare('coa_diskon_service',$this->coa_diskon_service);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ServiceCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
