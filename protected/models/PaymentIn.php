<?php

/**
 * This is the model class for table "rims_payment_in".
 *
 * The followings are the available columns in table 'rims_payment_in':
 * @property integer $id
 * @property integer $invoice_id
 * @property string $payment_number
 * @property string $payment_date
 * @property string $payment_time
 * @property string $payment_amount
 * @property string $notes
 * @property integer $is_tax_service
 * @property string $tax_service_amount
 * @property integer $customer_id
 * @property integer $vehicle_id
 * @property string $payment_type
 * @property integer $user_id
 * @property integer $branch_id
 * @property string $status
 * @property integer $company_bank_id
 * @property string $nomor_giro
 * @property integer $cash_payment_type
 * @property integer $bank_id
 * @property integer $payment_type_id
 * @property string $created_datetime
 * @property integer $user_id_cancelled
 * @property string $cancelled_datetime
 * @property string $downpayment_amount
 * @property integer $insurance_company_id
 * @property string $edited_datetime
 * @property integer $user_id_edited
 * @property string $discount_product_amount
 * @property string $discount_service_amount
 * @property string $bank_administration_fee
 * @property string $merimen_fee
 *
 * The followings are the available model relations:
 * @property InvoiceHeader $invoice
 * @property InsuranceCompany $insuranceCompany
 * @property Users $userIdEdited
 * @property Customer $customer
 * @property Vehicle $vehicle
 * @property Users $user
 * @property Branch $branch
 * @property CompanyBank $companyBank
 * @property Bank $bank
 * @property PaymentType $paymentType
 * @property Users $userIdCancelled
 * @property PaymentInDetail[] $paymentInDetails
 * @property PaymentInImages[] $paymentInImages
 */
class PaymentIn extends MonthlyTransactionActiveRecord {

    const CONSTANT = 'Pin';
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rims_payment_in';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('payment_number, payment_date, notes, user_id, branch_id, status, payment_type_id, created_datetime', 'required'),
            array('invoice_id, is_tax_service, customer_id, vehicle_id, user_id, branch_id, company_bank_id, cash_payment_type, bank_id, payment_type_id, user_id_cancelled, insurance_company_id, user_id_edited', 'numerical', 'integerOnly' => true),
            array('payment_number', 'length', 'max' => 50),
            array('payment_amount, tax_service_amount, downpayment_amount, discount_product_amount, discount_service_amount, bank_administration_fee, merimen_fee', 'length', 'max' => 18),
            array('payment_type, status', 'length', 'max' => 30),
            array('nomor_giro', 'length', 'max' => 20),
            array('payment_time, cancelled_datetime, edited_datetime', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, invoice_id, payment_number, payment_date, payment_time, payment_amount, notes, is_tax_service, tax_service_amount, customer_id, vehicle_id, payment_type, user_id, branch_id, status, company_bank_id, nomor_giro, cash_payment_type, bank_id, payment_type_id, created_datetime, user_id_cancelled, cancelled_datetime, downpayment_amount, insurance_company_id, edited_datetime, user_id_edited, discount_product_amount, discount_service_amount, bank_administration_fee, merimen_fee', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'invoice' => array(self::BELONGS_TO, 'InvoiceHeader', 'invoice_id'),
            'insuranceCompany' => array(self::BELONGS_TO, 'InsuranceCompany', 'insurance_company_id'),
            'userIdEdited' => array(self::BELONGS_TO, 'Users', 'user_id_edited'),
            'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
            'vehicle' => array(self::BELONGS_TO, 'Vehicle', 'vehicle_id'),
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'branch' => array(self::BELONGS_TO, 'Branch', 'branch_id'),
            'companyBank' => array(self::BELONGS_TO, 'CompanyBank', 'company_bank_id'),
            'bank' => array(self::BELONGS_TO, 'Bank', 'bank_id'),
            'paymentType' => array(self::BELONGS_TO, 'PaymentType', 'payment_type_id'),
            'userIdCancelled' => array(self::BELONGS_TO, 'Users', 'user_id_cancelled'),
            'paymentInDetails' => array(self::HAS_MANY, 'PaymentInDetail', 'payment_in_id'),
            'paymentInImages' => array(self::HAS_MANY, 'PaymentInImages', 'payment_in_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'invoice_id' => 'Invoice',
            'payment_number' => 'Payment Number',
            'payment_date' => 'Payment Date',
            'payment_time' => 'Payment Time',
            'payment_amount' => 'Payment Amount',
            'notes' => 'Notes',
            'is_tax_service' => 'Is Tax Service',
            'tax_service_amount' => 'Tax Service Amount',
            'customer_id' => 'Customer',
            'vehicle_id' => 'Vehicle',
            'payment_type' => 'Payment Type',
            'user_id' => 'User',
            'branch_id' => 'Branch',
            'status' => 'Status',
            'company_bank_id' => 'Company Bank',
            'nomor_giro' => 'Nomor Giro',
            'cash_payment_type' => 'Cash Payment Type',
            'bank_id' => 'Bank',
            'payment_type_id' => 'Payment Type',
            'created_datetime' => 'Created Datetime',
            'user_id_cancelled' => 'User Id Cancelled',
            'cancelled_datetime' => 'Cancelled Datetime',
            'downpayment_amount' => 'Downpayment Amount',
            'insurance_company_id' => 'Insurance Company',
            'edited_datetime' => 'Edited Datetime',
            'user_id_edited' => 'User Id Edited',
            'discount_product_amount' => 'Discount Product Amount',
            'discount_service_amount' => 'Discount Service Amount',
            'bank_administration_fee' => 'Bank Administration Fee',
            'merimen_fee' => 'Merimen Fee',
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
        $criteria->compare('invoice_id', $this->invoice_id);
        $criteria->compare('payment_number', $this->payment_number, true);
        $criteria->compare('payment_date', $this->payment_date, true);
        $criteria->compare('payment_time', $this->payment_time, true);
        $criteria->compare('payment_amount', $this->payment_amount, true);
        $criteria->compare('notes', $this->notes, true);
        $criteria->compare('is_tax_service', $this->is_tax_service);
        $criteria->compare('tax_service_amount', $this->tax_service_amount, true);
        $criteria->compare('customer_id', $this->customer_id);
        $criteria->compare('vehicle_id', $this->vehicle_id);
        $criteria->compare('payment_type', $this->payment_type, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('branch_id', $this->branch_id);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('company_bank_id', $this->company_bank_id);
        $criteria->compare('nomor_giro', $this->nomor_giro, true);
        $criteria->compare('cash_payment_type', $this->cash_payment_type);
        $criteria->compare('bank_id', $this->bank_id);
        $criteria->compare('payment_type_id', $this->payment_type_id);
        $criteria->compare('created_datetime', $this->created_datetime, true);
        $criteria->compare('user_id_cancelled', $this->user_id_cancelled);
        $criteria->compare('cancelled_datetime', $this->cancelled_datetime, true);
        $criteria->compare('downpayment_amount', $this->downpayment_amount, true);
        $criteria->compare('insurance_company_id', $this->insurance_company_id);
        $criteria->compare('edited_datetime', $this->edited_datetime, true);
        $criteria->compare('user_id_edited', $this->user_id_edited);
        $criteria->compare('discount_product_amount', $this->discount_product_amount, true);
        $criteria->compare('discount_service_amount', $this->discount_service_amount, true);
        $criteria->compare('bank_administration_fee', $this->bank_administration_fee, true);
        $criteria->compare('merimen_fee', $this->merimen_fee, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'payment_date DESC',
            ),
            'pagination' => array(
                'pageSize' => 25,
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PaymentIn the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getTotalDetail() {
        $total = '0.00';

        foreach ($this->paymentInDetails as $detail) {
            $total += $detail->amount + $detail->tax_service_amount;
        }

        return $total;
    }

    public function getTotalPayment() {

        return $this->payment_amount + $this->tax_service_amount + $this->downpayment_amount + $this->discount_product_amount + $this->discount_service_amount + $this->bank_administration_fee + $this->merimen_fee;
    }

    public function getTotalInvoice() {
        $total = '0.00';

        foreach ($this->paymentInDetails as $detail) {
            $total += $detail->total_invoice;
        }

        return $total;
    }

    public function getTotalServiceTax() {
        $total = '0.00';

        foreach ($this->paymentInDetails as $detail) {
            $total += $detail->tax_service_amount;
        }

        return $total;
    }
}
