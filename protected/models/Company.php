<?php

/**
 * This is the model class for table "rims_company".
 *
 * The followings are the available columns in table 'rims_company':
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property integer $province_id
 * @property integer $city_id
 * @property integer $branch_id
 * @property string $phone
 * @property string $npwp
 * @property string $tax_status
 * @property integer $is_deleted
 * @property string $deleted_at
 * @property integer $deleted_by
 *
 * The followings are the available model relations:
 * @property CompanyBank[] $companyBanks
 */
class Company extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rims_company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, address, province_id, city_id, phone, npwp, tax_status', 'required'),
			array('province_id, city_id, branch_id, is_deleted, deleted_by', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>30),
			array('phone, npwp, tax_status', 'length', 'max'=>20),
			array('deleted_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, address, province_id, city_id, branch_id, phone, npwp, tax_status, is_deleted, deleted_at, deleted_by', 'safe', 'on'=>'search'),
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
			'companyBanks' => array(self::HAS_MANY, 'CompanyBank', 'company_id'),
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
			'branch_id' => 'Branch',
			'phone' => 'Phone',
			'npwp' => 'Npwp',
			'tax_status' => 'Tax Status',
			'is_deleted' => 'Is Deleted',
			'deleted_at' => 'Deleted At',
			'deleted_by' => 'Deleted By',
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
		$criteria->compare('branch_id',$this->branch_id);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('tax_status',$this->tax_status,true);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('deleted_at',$this->deleted_at,true);
		$criteria->compare('deleted_by',$this->deleted_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Company the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
