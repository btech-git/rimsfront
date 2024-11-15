<?php

/**
 * This is the model class for table "rims_insurance_company".
 *
 * The followings are the available columns in table 'rims_insurance_company':
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property integer $province_id
 * @property integer $city_id
 * @property string $email
 * @property string $phone
 * @property string $fax
 * @property string $npwp
 * @property integer $is_deleted
 * @property string $deleted_at
 * @property integer $deleted_by
 * @property integer $coa_id
 *
 * The followings are the available model relations:
 * @property Province $province
 * @property City $city
 * @property Coa $coa
 * @property InvoiceHeader[] $invoiceHeaders
 * @property RegistrationTransaction[] $registrationTransactions
 * @property Vehicle[] $vehicles
 */
class InsuranceCompany extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rims_insurance_company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, address, province_id, city_id, email, phone, fax, npwp', 'required'),
			array('province_id, city_id, is_deleted, deleted_by, coa_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>30),
			array('email', 'length', 'max'=>50),
			array('phone, fax, npwp', 'length', 'max'=>20),
			array('deleted_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, address, province_id, city_id, email, phone, fax, npwp, is_deleted, deleted_at, deleted_by, coa_id', 'safe', 'on'=>'search'),
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
			'province' => array(self::BELONGS_TO, 'Province', 'province_id'),
			'city' => array(self::BELONGS_TO, 'City', 'city_id'),
			'coa' => array(self::BELONGS_TO, 'Coa', 'coa_id'),
			'invoiceHeaders' => array(self::HAS_MANY, 'InvoiceHeader', 'insurance_company_id'),
			'registrationTransactions' => array(self::HAS_MANY, 'RegistrationTransaction', 'insurance_company_id'),
			'vehicles' => array(self::HAS_MANY, 'Vehicle', 'insurance_company_id'),
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
			'address' => 'Address',
			'province_id' => 'Province',
			'city_id' => 'City',
			'email' => 'Email',
			'phone' => 'Phone',
			'fax' => 'Fax',
			'npwp' => 'Npwp',
			'is_deleted' => 'Is Deleted',
			'deleted_at' => 'Deleted At',
			'deleted_by' => 'Deleted By',
			'coa_id' => 'Coa',
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
		$criteria->compare('address',$this->address,true);
		$criteria->compare('province_id',$this->province_id);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('deleted_at',$this->deleted_at,true);
		$criteria->compare('deleted_by',$this->deleted_by);
		$criteria->compare('coa_id',$this->coa_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InsuranceCompany the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
