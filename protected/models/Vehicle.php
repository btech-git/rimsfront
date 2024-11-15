<?php

/**
 * This is the model class for table "rims_vehicle".
 *
 * The followings are the available columns in table 'rims_vehicle':
 * @property integer $id
 * @property string $plate_number
 * @property integer $plate_number_prefix_id
 * @property string $plate_number_ordinal
 * @property string $plate_number_suffix
 * @property string $machine_number
 * @property string $frame_number
 * @property integer $car_make_id
 * @property integer $car_model_id
 * @property integer $car_sub_model_id
 * @property integer $car_sub_model_detail_id
 * @property integer $color_id
 * @property string $year
 * @property integer $customer_id
 * @property integer $customer_pic_id
 * @property integer $insurance_company_id
 * @property string $chasis_code
 * @property string $transmission
 * @property string $fuel_type
 * @property integer $power
 * @property string $drivetrain
 * @property string $notes
 *
 * The followings are the available model relations:
 * @property VehicleCarMake $carMake
 * @property VehicleCarModel $carModel
 * @property VehicleCarSubModel $carSubModel
 * @property VehicleCarSubModelDetail $carSubModelDetail
 * @property Colors $color
 * @property Customer $customer
 * @property InsuranceCompany $insuranceCompany
 */
class Vehicle extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rims_vehicle';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('plate_number, car_make_id, car_model_id, car_sub_model_id, color_id, customer_id', 'required'),
            array('plate_number_prefix_id, car_make_id, car_model_id, car_sub_model_id, car_sub_model_detail_id, color_id, customer_id, customer_pic_id, insurance_company_id, power', 'numerical', 'integerOnly' => true),
            array('plate_number', 'length', 'max' => 15),
            array('plate_number_ordinal, fuel_type', 'length', 'max' => 20),
            array('plate_number_suffix, year, drivetrain', 'length', 'max' => 10),
            array('machine_number, frame_number, chasis_code, transmission', 'length', 'max' => 30),
            array('notes', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, plate_number, plate_number_prefix_id, plate_number_ordinal, plate_number_suffix, machine_number, frame_number, car_make_id, car_model_id, car_sub_model_id, car_sub_model_detail_id, color_id, year, customer_id, customer_pic_id, insurance_company_id, chasis_code, transmission, fuel_type, power, drivetrain, notes', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'carMake' => array(self::BELONGS_TO, 'VehicleCarMake', 'car_make_id'),
            'carModel' => array(self::BELONGS_TO, 'VehicleCarModel', 'car_model_id'),
            'carSubModel' => array(self::BELONGS_TO, 'VehicleCarSubModel', 'car_sub_model_id'),
            'carSubModelDetail' => array(self::BELONGS_TO, 'VehicleCarSubModelDetail', 'car_sub_model_detail_id'),
            'color' => array(self::BELONGS_TO, 'Colors', 'color_id'),
            'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
            'insuranceCompany' => array(self::BELONGS_TO, 'InsuranceCompany', 'insurance_company_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'plate_number' => 'Plate Number',
            'plate_number_prefix_id' => 'Plate Number Prefix',
            'plate_number_ordinal' => 'Plate Number Ordinal',
            'plate_number_suffix' => 'Plate Number Suffix',
            'machine_number' => 'Machine Number',
            'frame_number' => 'Frame Number',
            'car_make_id' => 'Car Make',
            'car_model_id' => 'Car Model',
            'car_sub_model_id' => 'Car Sub Model',
            'car_sub_model_detail_id' => 'Car Sub Model Detail',
            'color_id' => 'Color',
            'year' => 'Year',
            'customer_id' => 'Customer',
            'customer_pic_id' => 'Customer Pic',
            'insurance_company_id' => 'Insurance Company',
            'chasis_code' => 'Chasis Code',
            'transmission' => 'Transmission',
            'fuel_type' => 'Fuel Type',
            'power' => 'Power',
            'drivetrain' => 'Drivetrain',
            'notes' => 'Notes',
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
        $criteria->compare('plate_number', $this->plate_number, true);
        $criteria->compare('plate_number_prefix_id', $this->plate_number_prefix_id);
        $criteria->compare('plate_number_ordinal', $this->plate_number_ordinal, true);
        $criteria->compare('plate_number_suffix', $this->plate_number_suffix, true);
        $criteria->compare('machine_number', $this->machine_number, true);
        $criteria->compare('frame_number', $this->frame_number, true);
        $criteria->compare('car_make_id', $this->car_make_id);
        $criteria->compare('car_model_id', $this->car_model_id);
        $criteria->compare('car_sub_model_id', $this->car_sub_model_id);
        $criteria->compare('car_sub_model_detail_id', $this->car_sub_model_detail_id);
        $criteria->compare('color_id', $this->color_id);
        $criteria->compare('year', $this->year, true);
        $criteria->compare('customer_id', $this->customer_id);
        $criteria->compare('customer_pic_id', $this->customer_pic_id);
        $criteria->compare('insurance_company_id', $this->insurance_company_id);
        $criteria->compare('chasis_code', $this->chasis_code, true);
        $criteria->compare('transmission', $this->transmission, true);
        $criteria->compare('fuel_type', $this->fuel_type, true);
        $criteria->compare('power', $this->power);
        $criteria->compare('drivetrain', $this->drivetrain, true);
        $criteria->compare('notes', $this->notes, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 50,
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Vehicle the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function searchByDashboard() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('t.plate_number', $this->plate_number, true);
        $criteria->compare('t.plate_number_prefix_id', $this->plate_number_prefix_id);
        $criteria->compare('t.plate_number_ordinal', $this->plate_number_ordinal, true);
        $criteria->compare('t.plate_number_suffix', $this->plate_number_suffix, true);
        $criteria->compare('t.machine_number', $this->machine_number, true);
        $criteria->compare('frame_number', $this->frame_number, true);
        $criteria->compare('t.car_make_id', $this->car_make_id);
        $criteria->compare('t.car_model_id', $this->car_model_id);
        $criteria->compare('t.car_sub_model_id', $this->car_sub_model_id);
        $criteria->compare('t.car_sub_model_detail_id', $this->car_sub_model_detail_id);
        $criteria->compare('t.color_id', $this->color_id);
        $criteria->compare('year', $this->year, true);
        $criteria->compare('t.customer_id', $this->customer_id);
        $criteria->compare('customer_pic_id', $this->customer_pic_id);
        $criteria->compare('chasis_code', $this->chasis_code, true);
        $criteria->compare('transmission', $this->transmission, true);
        $criteria->compare('fuel_type', $this->fuel_type, true);
        $criteria->compare('power', $this->power);
        $criteria->compare('drivetrain', $this->drivetrain, true);
        $criteria->compare('notes', $this->notes, true);
        $criteria->compare('insurance_company_id', $this->insurance_company_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.plate_number ASC',
            ),
            'pagination' => array(
                'pageSize' => 100,
            ),
        ));
    }
    
    public function getCarMakeModelSubCombination() {
        return $this->carMake->name . ' ' . $this->carModel->name . ' ' . $this->carSubModel->name;
    }

}
