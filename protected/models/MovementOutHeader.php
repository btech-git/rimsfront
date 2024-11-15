<?php

/**
 * This is the model class for table "rims_movement_out_header".
 *
 * The followings are the available columns in table 'rims_movement_out_header':
 * @property integer $id
 * @property string $movement_out_no
 * @property string $date_posting
 * @property integer $delivery_order_id
 * @property integer $return_order_id
 * @property integer $material_request_header_id
 * @property integer $registration_transaction_id
 * @property integer $registration_service_id
 * @property integer $branch_id
 * @property integer $movement_type
 * @property integer $user_id
 * @property integer $supervisor_id
 * @property string $status
 * @property string $created_datetime
 * @property string $cancelled_datetime
 * @property integer $user_id_cancelled
 *
 * The followings are the available model relations:
 * @property MovementOutApproval[] $movementOutApprovals
 * @property MovementOutDetail[] $movementOutDetails
 * @property TransactionDeliveryOrder $deliveryOrder
 * @property TransactionReturnOrder $returnOrder
 * @property MaterialRequestHeader $materialRequestHeader
 * @property RegistrationTransaction $registrationTransaction
 * @property RegistrationService $registrationService
 * @property Branch $branch
 * @property Users $user
 * @property Users $supervisor
 * @property Users $userIdCancelled
 */
class MovementOutHeader extends MonthlyTransactionActiveRecord {

    const CONSTANT = 'MO';
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rims_movement_out_header';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('movement_out_no, branch_id, movement_type, user_id, status, created_datetime', 'required'),
            array('delivery_order_id, return_order_id, material_request_header_id, registration_transaction_id, registration_service_id, branch_id, movement_type, user_id, supervisor_id, user_id_cancelled', 'numerical', 'integerOnly' => true),
            array('movement_out_no', 'length', 'max' => 30),
            array('status', 'length', 'max' => 20),
            array('date_posting, cancelled_datetime', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, movement_out_no, date_posting, delivery_order_id, return_order_id, material_request_header_id, registration_transaction_id, registration_service_id, branch_id, movement_type, user_id, supervisor_id, status, created_datetime, cancelled_datetime, user_id_cancelled', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'movementOutApprovals' => array(self::HAS_MANY, 'MovementOutApproval', 'movement_out_id'),
            'movementOutDetails' => array(self::HAS_MANY, 'MovementOutDetail', 'movement_out_header_id'),
            'deliveryOrder' => array(self::BELONGS_TO, 'TransactionDeliveryOrder', 'delivery_order_id'),
            'returnOrder' => array(self::BELONGS_TO, 'TransactionReturnOrder', 'return_order_id'),
            'materialRequestHeader' => array(self::BELONGS_TO, 'MaterialRequestHeader', 'material_request_header_id'),
            'registrationTransaction' => array(self::BELONGS_TO, 'RegistrationTransaction', 'registration_transaction_id'),
            'registrationService' => array(self::BELONGS_TO, 'RegistrationService', 'registration_service_id'),
            'branch' => array(self::BELONGS_TO, 'Branch', 'branch_id'),
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'supervisor' => array(self::BELONGS_TO, 'Users', 'supervisor_id'),
            'userIdCancelled' => array(self::BELONGS_TO, 'Users', 'user_id_cancelled'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'movement_out_no' => 'Movement Out No',
            'date_posting' => 'Date Posting',
            'delivery_order_id' => 'Delivery Order',
            'return_order_id' => 'Return Order',
            'material_request_header_id' => 'Material Request Header',
            'registration_transaction_id' => 'Registration Transaction',
            'registration_service_id' => 'Registration Service',
            'branch_id' => 'Branch',
            'movement_type' => 'Movement Type',
            'user_id' => 'User',
            'supervisor_id' => 'Supervisor',
            'status' => 'Status',
            'created_datetime' => 'Created Datetime',
            'cancelled_datetime' => 'Cancelled Datetime',
            'user_id_cancelled' => 'User Id Cancelled',
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
        $criteria->compare('movement_out_no', $this->movement_out_no, true);
        $criteria->compare('date_posting', $this->date_posting, true);
        $criteria->compare('delivery_order_id', $this->delivery_order_id);
        $criteria->compare('return_order_id', $this->return_order_id);
        $criteria->compare('material_request_header_id', $this->material_request_header_id);
        $criteria->compare('registration_transaction_id', $this->registration_transaction_id);
        $criteria->compare('registration_service_id', $this->registration_service_id);
        $criteria->compare('branch_id', $this->branch_id);
        $criteria->compare('movement_type', $this->movement_type);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('supervisor_id', $this->supervisor_id);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('created_datetime', $this->created_datetime, true);
        $criteria->compare('cancelled_datetime', $this->cancelled_datetime, true);
        $criteria->compare('user_id_cancelled', $this->user_id_cancelled);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return MovementOutHeader the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
