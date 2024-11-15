<?php

/**
 * This is the model class for table "rims_branch".
 *
 * The followings are the available columns in table 'rims_branch':
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $address
 * @property integer $province_id
 * @property integer $city_id
 * @property string $zipcode
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property string $status
 * @property string $coa_prefix
 * @property integer $company_id
 * @property integer $coa_interbranch_inventory
 *
 * The followings are the available model relations:
 * @property SaleEstimationHeader[] $saleEstimationHeaders
 */
class Branch extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rims_branch';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, name, address, province_id, city_id, zipcode, email, status, coa_prefix', 'required'),
			array('province_id, city_id, company_id, coa_interbranch_inventory', 'numerical', 'integerOnly'=>true),
			array('code, phone, fax', 'length', 'max'=>20),
			array('name', 'length', 'max'=>30),
			array('zipcode, status', 'length', 'max'=>10),
			array('email', 'length', 'max'=>60),
			array('coa_prefix', 'length', 'max'=>3),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, code, name, address, province_id, city_id, zipcode, phone, fax, email, status, coa_prefix, company_id, coa_interbranch_inventory', 'safe', 'on'=>'search'),
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
			'saleEstimationHeaders' => array(self::HAS_MANY, 'SaleEstimationHeader', 'branch_id'),
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
			'name' => 'Name',
			'address' => 'Address',
			'province_id' => 'Province',
			'city_id' => 'City',
			'zipcode' => 'Zipcode',
			'phone' => 'Phone',
			'fax' => 'Fax',
			'email' => 'Email',
			'status' => 'Status',
			'coa_prefix' => 'Coa Prefix',
			'company_id' => 'Company',
			'coa_interbranch_inventory' => 'Coa Interbranch Inventory',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('province_id',$this->province_id);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('coa_prefix',$this->coa_prefix,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('coa_interbranch_inventory',$this->coa_interbranch_inventory);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Branch the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
