<?php

/**
 * This is the model class for table "rims_registration_service".
 *
 * The followings are the available columns in table 'rims_registration_service':
 * @property integer $id
 * @property integer $registration_transaction_id
 * @property integer $service_id
 * @property integer $service_type_id
 * @property integer $sale_estimation_service_detail_id
 * @property string $claim
 * @property string $price
 * @property string $total_price
 * @property string $discount_price
 * @property string $discount_type
 * @property integer $is_quick_service
 * @property string $start
 * @property string $end
 * @property string $pause
 * @property string $resume
 * @property integer $pause_time
 * @property integer $total_time
 * @property integer $is_paused
 * @property string $note
 * @property integer $is_body_repair
 * @property string $status
 * @property integer $start_mechanic_id
 * @property integer $finish_mechanic_id
 * @property integer $pause_mechanic_id
 * @property integer $resume_mechanic_id
 * @property integer $supervisor_id
 * @property string $hour
 * @property integer $assign_mechanic_id
 *
 * The followings are the available model relations:
 * @property Service $service
 * @property ServiceType $serviceType
 * @property Employee $startMechanic
 * @property Employee $finishMechanic
 * @property Employee $pauseMechanic
 * @property Employee $resumeMechanic
 * @property Users $supervisor
 * @property Employee $assignMechanic
 */
class RegistrationService extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rims_registration_service';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('registration_transaction_id, service_id', 'required'),
            array('registration_transaction_id, service_id, service_type_id, is_quick_service, pause_time, total_time, is_paused, is_body_repair, start_mechanic_id, finish_mechanic_id, pause_mechanic_id, resume_mechanic_id, supervisor_id, assign_mechanic_id', 'numerical', 'integerOnly' => true),
            array('claim, price, hour', 'length', 'max' => 10),
            array('total_price, discount_price', 'length', 'max' => 18),
            array('discount_type', 'length', 'max' => 50),
            array('status', 'length', 'max' => 30),
            array('start, end, pause, resume, note', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, registration_transaction_id, service_id, service_type_id, claim, price, total_price, discount_price, discount_type, is_quick_service, start, end, pause, resume, pause_time, total_time, is_paused, note, is_body_repair, status, start_mechanic_id, finish_mechanic_id, pause_mechanic_id, resume_mechanic_id, supervisor_id, hour, assign_mechanic_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'service' => array(self::BELONGS_TO, 'Service', 'service_id'),
            'serviceType' => array(self::BELONGS_TO, 'ServiceType', 'service_type_id'),
            'startMechanic' => array(self::BELONGS_TO, 'Employee', 'start_mechanic_id'),
            'finishMechanic' => array(self::BELONGS_TO, 'Employee', 'finish_mechanic_id'),
            'pauseMechanic' => array(self::BELONGS_TO, 'Employee', 'pause_mechanic_id'),
            'resumeMechanic' => array(self::BELONGS_TO, 'Employee', 'resume_mechanic_id'),
            'supervisor' => array(self::BELONGS_TO, 'Users', 'supervisor_id'),
            'assignMechanic' => array(self::BELONGS_TO, 'Employee', 'assign_mechanic_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'registration_transaction_id' => 'Registration Transaction',
            'service_id' => 'Service',
            'service_type_id' => 'Service Type',
            'claim' => 'Claim',
            'price' => 'Price',
            'total_price' => 'Total Price',
            'discount_price' => 'Discount Price',
            'discount_type' => 'Discount Type',
            'is_quick_service' => 'Is Quick Service',
            'start' => 'Start',
            'end' => 'End',
            'pause' => 'Pause',
            'resume' => 'Resume',
            'pause_time' => 'Pause Time',
            'total_time' => 'Total Time',
            'is_paused' => 'Is Paused',
            'note' => 'Note',
            'is_body_repair' => 'Is Body Repair',
            'status' => 'Status',
            'start_mechanic_id' => 'Start Mechanic',
            'finish_mechanic_id' => 'Finish Mechanic',
            'pause_mechanic_id' => 'Pause Mechanic',
            'resume_mechanic_id' => 'Resume Mechanic',
            'supervisor_id' => 'Supervisor',
            'hour' => 'Hour',
            'assign_mechanic_id' => 'Assign Mechanic',
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
        $criteria->compare('registration_transaction_id', $this->registration_transaction_id);
        $criteria->compare('service_id', $this->service_id);
        $criteria->compare('service_type_id', $this->service_type_id);
        $criteria->compare('claim', $this->claim, true);
        $criteria->compare('price', $this->price, true);
        $criteria->compare('total_price', $this->total_price, true);
        $criteria->compare('discount_price', $this->discount_price, true);
        $criteria->compare('discount_type', $this->discount_type, true);
        $criteria->compare('is_quick_service', $this->is_quick_service);
        $criteria->compare('start', $this->start, true);
        $criteria->compare('end', $this->end, true);
        $criteria->compare('pause', $this->pause, true);
        $criteria->compare('resume', $this->resume, true);
        $criteria->compare('pause_time', $this->pause_time);
        $criteria->compare('total_time', $this->total_time);
        $criteria->compare('is_paused', $this->is_paused);
        $criteria->compare('note', $this->note, true);
        $criteria->compare('is_body_repair', $this->is_body_repair);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('start_mechanic_id', $this->start_mechanic_id);
        $criteria->compare('finish_mechanic_id', $this->finish_mechanic_id);
        $criteria->compare('pause_mechanic_id', $this->pause_mechanic_id);
        $criteria->compare('resume_mechanic_id', $this->resume_mechanic_id);
        $criteria->compare('supervisor_id', $this->supervisor_id);
        $criteria->compare('hour', $this->hour, true);
        $criteria->compare('assign_mechanic_id', $this->assign_mechanic_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return RegistrationService the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getDiscountAmount() {
        $discountPrice = 0;

        if (!empty($this->discount_type)) {
            $discountPrice = ($this->discount_type == 'Nominal') ? $this->discount_price : $this->price * $this->discount_price / 100;
        }

        return $discountPrice;
    }

    public function getTotalAmount() {

        return $this->price - $this->discountAmount;
    }
}