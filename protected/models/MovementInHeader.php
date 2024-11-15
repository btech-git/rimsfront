<?php

/**
 * This is the model class for table "rims_movement_in_header".
 *
 * The followings are the available columns in table 'rims_movement_in_header':
 * @property integer $id
 * @property string $movement_in_number
 * @property string $date_posting
 * @property integer $branch_id
 * @property integer $movement_type
 * @property integer $return_item_id
 * @property integer $receive_item_id
 * @property integer $user_id
 * @property integer $supervisor_id
 * @property string $status
 * @property string $created_datetime
 * @property string $cancelled_datetime
 * @property integer $user_id_cancelled
 *
 * The followings are the available model relations:
 * @property MovementInApproval[] $movementInApprovals
 * @property MovementInDetail[] $movementInDetails
 * @property Branch $branch
 * @property TransactionReceiveItem $receiveItem
 * @property TransactionReturnItem $returnItem
 * @property Users $user
 * @property Users $supervisor
 * @property Users $userIdCancelled
 */
class MovementInHeader extends MonthlyTransactionActiveRecord {

    const CONSTANT = 'MI';
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rims_movement_in_header';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('movement_in_number, branch_id, movement_type, user_id, status, created_datetime', 'required'),
            array('branch_id, movement_type, return_item_id, receive_item_id, user_id, supervisor_id, user_id_cancelled', 'numerical', 'integerOnly' => true),
            array('movement_in_number, status', 'length', 'max' => 30),
            array('date_posting, cancelled_datetime', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, movement_in_number, date_posting, branch_id, movement_type, return_item_id, receive_item_id, user_id, supervisor_id, status, created_datetime, cancelled_datetime, user_id_cancelled', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'movementInApprovals' => array(self::HAS_MANY, 'MovementInApproval', 'movement_in_id'),
            'movementInDetails' => array(self::HAS_MANY, 'MovementInDetail', 'movement_in_header_id'),
            'branch' => array(self::BELONGS_TO, 'Branch', 'branch_id'),
            'receiveItem' => array(self::BELONGS_TO, 'TransactionReceiveItem', 'receive_item_id'),
            'returnItem' => array(self::BELONGS_TO, 'TransactionReturnItem', 'return_item_id'),
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
            'movement_in_number' => 'Movement In Number',
            'date_posting' => 'Date Posting',
            'branch_id' => 'Branch',
            'movement_type' => 'Movement Type',
            'return_item_id' => 'Return Item',
            'receive_item_id' => 'Receive Item',
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
        $criteria->compare('movement_in_number', $this->movement_in_number, true);
        $criteria->compare('date_posting', $this->date_posting, true);
        $criteria->compare('branch_id', $this->branch_id);
        $criteria->compare('movement_type', $this->movement_type);
        $criteria->compare('return_item_id', $this->return_item_id);
        $criteria->compare('receive_item_id', $this->receive_item_id);
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
     * @return MovementInHeader the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
