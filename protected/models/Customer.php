<?php

/**
 * This is the model class for table "rims_customer".
 *
 * The followings are the available columns in table 'rims_customer':
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property integer $province_id
 * @property integer $city_id
 * @property string $zipcode
 * @property string $mobile_phone
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property string $note
 * @property string $customer_type
 * @property integer $default_payment_type
 * @property integer $tenor
 * @property string $status
 * @property string $birthdate
 * @property string $flat_rate
 * @property integer $coa_id
 * @property string $date_created
 * @property string $date_approval
 * @property integer $is_approved
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property Province $province
 * @property Coa $coa
 * @property City $city
 * @property Users $user
 * @property Vehicle[] $vehicles
 */
class Customer extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rims_customer';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, address, province_id, city_id, customer_type, user_id', 'required'),
            array('province_id, city_id, default_payment_type, tenor, coa_id, is_approved, user_id', 'numerical', 'integerOnly' => true),
            array('name, mobile_phone, phone, email', 'length', 'max' => 100),
            array('zipcode, customer_type, status, flat_rate', 'length', 'max' => 10),
            array('fax', 'length', 'max' => 20),
            array('note, birthdate, date_created, date_approval', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, address, province_id, city_id, zipcode, mobile_phone, phone, fax, email, note, customer_type, default_payment_type, tenor, status, birthdate, flat_rate, coa_id, date_created, date_approval, is_approved, user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'province' => array(self::BELONGS_TO, 'Province', 'province_id'),
            'coa' => array(self::BELONGS_TO, 'Coa', 'coa_id'),
            'city' => array(self::BELONGS_TO, 'City', 'city_id'),
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'vehicles' => array(self::HAS_MANY, 'Vehicle', 'customer_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'province_id' => 'Province',
            'city_id' => 'City',
            'zipcode' => 'Zipcode',
            'mobile_phone' => 'Mobile Phone',
            'phone' => 'Phone',
            'fax' => 'Fax',
            'email' => 'Email',
            'note' => 'Note',
            'customer_type' => 'Customer Type',
            'default_payment_type' => 'Default Payment Type',
            'tenor' => 'Tenor',
            'status' => 'Status',
            'birthdate' => 'Birthdate',
            'flat_rate' => 'Flat Rate',
            'coa_id' => 'Coa',
            'date_created' => 'Date Created',
            'date_approval' => 'Date Approval',
            'is_approved' => 'Is Approved',
            'user_id' => 'User',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('province_id', $this->province_id);
        $criteria->compare('city_id', $this->city_id);
        $criteria->compare('zipcode', $this->zipcode, true);
        $criteria->compare('mobile_phone', $this->mobile_phone, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('fax', $this->fax, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('note', $this->note, true);
        $criteria->compare('customer_type', $this->customer_type, true);
        $criteria->compare('default_payment_type', $this->default_payment_type);
        $criteria->compare('tenor', $this->tenor);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('birthdate', $this->birthdate, true);
        $criteria->compare('flat_rate', $this->flat_rate, true);
        $criteria->compare('coa_id', $this->coa_id);
        $criteria->compare('date_created', $this->date_created, true);
        $criteria->compare('date_approval', $this->date_approval, true);
        $criteria->compare('is_approved', $this->is_approved);
        $criteria->compare('user_id', $this->user_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 25,
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Customer the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function searchByDashboard() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.name', $this->name, true);
        $criteria->compare('t.address', $this->address, true);
        $criteria->compare('t.zipcode', $this->zipcode, true);
        $criteria->compare('t.province_id', $this->province_id);
        $criteria->compare('t.city_id', $this->city_id);
        $criteria->compare('fax', $this->fax, true);
        $criteria->compare('t.email', $this->email, true);
        $criteria->compare('t.note', $this->note, true);
        $criteria->compare('t.default_payment_type', $this->default_payment_type);
        $criteria->compare('t.customer_type', $this->customer_type, true);
        $criteria->compare('tenor', $this->tenor);
        $criteria->compare('LOWER(t.status)', strtolower($this->status), FALSE);
        $criteria->compare('birthdate', $this->birthdate, true);
        $criteria->compare('flat_rate', $this->flat_rate, true);
        $criteria->compare('mobile_phone', $this->mobile_phone, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('t.coa_id', $this->coa_id);
        $criteria->compare('t.is_approved', $this->is_approved);
        $criteria->compare('t.date_approval', $this->date_approval);
        $criteria->compare('t.user_id', $this->user_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.name ASC',
            ),
            'pagination' => array(
                'pageSize' => 25,
            ),
        ));
    }

}
