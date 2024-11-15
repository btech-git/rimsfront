<?php

/**
 * This is the model class for table "rims_service_type".
 *
 * The followings are the available columns in table 'rims_service_type':
 * @property integer $id
 * @property string $name
 * @property string $status
 * @property string $code
 * @property integer $is_deleted
 * @property string $deleted_at
 * @property integer $deleted_by
 * @property integer $coa_id
 * @property integer $coa_diskon_service
 *
 * The followings are the available model relations:
 * @property RegistrationService[] $registrationServices
 * @property SaleEstimationServiceDetail[] $saleEstimationServiceDetails
 * @property Service[] $services
 */
class ServiceType extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rims_service_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, code', 'required'),
			array('is_deleted, deleted_by, coa_id, coa_diskon_service', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			array('status', 'length', 'max'=>10),
			array('code', 'length', 'max'=>20),
			array('deleted_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, status, code, is_deleted, deleted_at, deleted_by, coa_id, coa_diskon_service', 'safe', 'on'=>'search'),
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
			'registrationServices' => array(self::HAS_MANY, 'RegistrationService', 'service_type_id'),
			'saleEstimationServiceDetails' => array(self::HAS_MANY, 'SaleEstimationServiceDetail', 'service_type_id'),
			'services' => array(self::HAS_MANY, 'Service', 'service_type_id'),
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
			'status' => 'Status',
			'code' => 'Code',
			'is_deleted' => 'Is Deleted',
			'deleted_at' => 'Deleted At',
			'deleted_by' => 'Deleted By',
			'coa_id' => 'Coa',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('deleted_at',$this->deleted_at,true);
		$criteria->compare('deleted_by',$this->deleted_by);
		$criteria->compare('coa_id',$this->coa_id);
		$criteria->compare('coa_diskon_service',$this->coa_diskon_service);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ServiceType the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
