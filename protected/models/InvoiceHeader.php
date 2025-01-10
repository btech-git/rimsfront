<?php

/**
 * This is the model class for table "rims_invoice_header".
 *
 * The followings are the available columns in table 'rims_invoice_header':
 * @property integer $id
 * @property string $invoice_number
 * @property string $invoice_date
 * @property string $due_date
 * @property integer $reference_type
 * @property integer $sales_order_id
 * @property integer $registration_transaction_id
 * @property integer $customer_id
 * @property integer $vehicle_id
 * @property integer $ppn
 * @property integer $pph
 * @property integer $branch_id
 * @property integer $user_id
 * @property integer $supervisor_id
 * @property string $status
 * @property string $service_price
 * @property string $product_price
 * @property string $quick_service_price
 * @property integer $total_product
 * @property integer $total_service
 * @property integer $total_quick_service
 * @property string $pph_total
 * @property string $ppn_total
 * @property string $total_price
 * @property string $in_words
 * @property string $note
 * @property string $payment_amount
 * @property string $payment_left
 * @property string $payment_date_estimate
 * @property integer $coa_bank_id_estimate
 * @property integer $tax_percentage
 * @property string $created_datetime
 * @property string $cancelled_datetime
 * @property integer $user_id_cancelled
 * @property integer $insurance_company_id
 * @property integer $number_of_print
 * @property string $edited_datetime
 * @property integer $user_id_edited
 *
 * The followings are the available model relations:
 * @property InvoiceDetail[] $invoiceDetails
 * @property RegistrationTransaction $registrationTransaction
 * @property TransactionSalesOrder $salesOrder
 * @property Customer $customer
 * @property Vehicle $vehicle
 * @property Branch $branch
 * @property Users $user
 * @property Users $supervisor
 * @property InsuranceCompany $insuranceCompany
 * @property PaymentIn[] $paymentIns
 * @property PaymentInDetail[] $paymentInDetails
 */
class InvoiceHeader extends MonthlyTransactionActiveRecord {

    const CONSTANT = 'INV';
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rims_invoice_header';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('invoice_number, invoice_date, due_date, reference_type, branch_id, user_id, status', 'required'),
            array('reference_type, sales_order_id, registration_transaction_id, customer_id, vehicle_id, ppn, pph, branch_id, user_id, supervisor_id, total_product, total_service, total_quick_service, coa_bank_id_estimate, tax_percentage, user_id_cancelled, insurance_company_id, number_of_print, user_id_edited', 'numerical', 'integerOnly' => true),
            array('invoice_number', 'length', 'max' => 50),
            array('status', 'length', 'max' => 30),
            array('service_price, product_price, quick_service_price, pph_total, ppn_total, total_price, payment_amount, payment_left', 'length', 'max' => 18),
            array('in_words, note, payment_date_estimate, created_datetime, cancelled_datetime, edited_datetime', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, invoice_number, invoice_date, due_date, reference_type, sales_order_id, registration_transaction_id, customer_id, vehicle_id, ppn, pph, branch_id, user_id, supervisor_id, status, service_price, product_price, quick_service_price, total_product, total_service, total_quick_service, pph_total, ppn_total, total_price, in_words, note, payment_amount, payment_left, payment_date_estimate, coa_bank_id_estimate, tax_percentage, created_datetime, cancelled_datetime, user_id_cancelled, insurance_company_id, number_of_print, edited_datetime, user_id_edited', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'invoiceDetails' => array(self::HAS_MANY, 'InvoiceDetail', 'invoice_id'),
            'registrationTransaction' => array(self::BELONGS_TO, 'RegistrationTransaction', 'registration_transaction_id'),
            'salesOrder' => array(self::BELONGS_TO, 'TransactionSalesOrder', 'sales_order_id'),
            'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
            'vehicle' => array(self::BELONGS_TO, 'Vehicle', 'vehicle_id'),
            'branch' => array(self::BELONGS_TO, 'Branch', 'branch_id'),
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'supervisor' => array(self::BELONGS_TO, 'Users', 'supervisor_id'),
            'insuranceCompany' => array(self::BELONGS_TO, 'InsuranceCompany', 'insurance_company_id'),
            'paymentIns' => array(self::HAS_MANY, 'PaymentIn', 'invoice_id'),
            'paymentInDetails' => array(self::HAS_MANY, 'PaymentInDetail', 'invoice_header_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'invoice_number' => 'Invoice Number',
            'invoice_date' => 'Invoice Date',
            'due_date' => 'Due Date',
            'reference_type' => 'Reference Type',
            'sales_order_id' => 'Sales Order',
            'registration_transaction_id' => 'Registration Transaction',
            'customer_id' => 'Customer',
            'vehicle_id' => 'Vehicle',
            'ppn' => 'Ppn',
            'pph' => 'Pph',
            'branch_id' => 'Branch',
            'user_id' => 'User',
            'supervisor_id' => 'Supervisor',
            'status' => 'Status',
            'service_price' => 'Service Price',
            'product_price' => 'Product Price',
            'quick_service_price' => 'Quick Service Price',
            'total_product' => 'Total Product',
            'total_service' => 'Total Service',
            'total_quick_service' => 'Total Quick Service',
            'pph_total' => 'Pph Total',
            'ppn_total' => 'Ppn Total',
            'total_price' => 'Total Price',
            'in_words' => 'In Words',
            'note' => 'Note',
            'payment_amount' => 'Payment Amount',
            'payment_left' => 'Payment Left',
            'payment_date_estimate' => 'Payment Date Estimate',
            'coa_bank_id_estimate' => 'Coa Bank Id Estimate',
            'tax_percentage' => 'Tax Percentage',
            'created_datetime' => 'Created Datetime',
            'cancelled_datetime' => 'Cancelled Datetime',
            'user_id_cancelled' => 'User Id Cancelled',
            'insurance_company_id' => 'Insurance Company',
            'number_of_print' => 'Number Of Print',
            'edited_datetime' => 'Edited Datetime',
            'user_id_edited' => 'User Id Edited',
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
        $criteria->compare('invoice_number', $this->invoice_number, true);
        $criteria->compare('invoice_date', $this->invoice_date, true);
        $criteria->compare('due_date', $this->due_date, true);
        $criteria->compare('reference_type', $this->reference_type);
        $criteria->compare('sales_order_id', $this->sales_order_id);
        $criteria->compare('registration_transaction_id', $this->registration_transaction_id);
        $criteria->compare('customer_id', $this->customer_id);
        $criteria->compare('vehicle_id', $this->vehicle_id);
        $criteria->compare('ppn', $this->ppn);
        $criteria->compare('pph', $this->pph);
        $criteria->compare('branch_id', $this->branch_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('supervisor_id', $this->supervisor_id);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('service_price', $this->service_price, true);
        $criteria->compare('product_price', $this->product_price, true);
        $criteria->compare('quick_service_price', $this->quick_service_price, true);
        $criteria->compare('total_product', $this->total_product);
        $criteria->compare('total_service', $this->total_service);
        $criteria->compare('total_quick_service', $this->total_quick_service);
        $criteria->compare('pph_total', $this->pph_total, true);
        $criteria->compare('ppn_total', $this->ppn_total, true);
        $criteria->compare('total_price', $this->total_price, true);
        $criteria->compare('in_words', $this->in_words, true);
        $criteria->compare('note', $this->note, true);
        $criteria->compare('payment_amount', $this->payment_amount, true);
        $criteria->compare('payment_left', $this->payment_left, true);
        $criteria->compare('payment_date_estimate', $this->payment_date_estimate, true);
        $criteria->compare('coa_bank_id_estimate', $this->coa_bank_id_estimate);
        $criteria->compare('tax_percentage', $this->tax_percentage);
        $criteria->compare('created_datetime', $this->created_datetime, true);
        $criteria->compare('cancelled_datetime', $this->cancelled_datetime, true);
        $criteria->compare('user_id_cancelled', $this->user_id_cancelled);
        $criteria->compare('insurance_company_id', $this->insurance_company_id);
        $criteria->compare('number_of_print', $this->number_of_print);
        $criteria->compare('edited_datetime', $this->edited_datetime, true);
        $criteria->compare('user_id_edited', $this->user_id_edited);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'invoice_date DESC',
            ),
            'pagination' => array(
                'pageSize' => 50,
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return InvoiceHeader the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function searchByAdmin() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.invoice_number', $this->invoice_number, true);
        $criteria->compare('t.reference_type', $this->reference_type);
        $criteria->compare('t.sales_order_id', $this->sales_order_id);
        $criteria->compare('t.registration_transaction_id', $this->registration_transaction_id);
        $criteria->compare('t.customer_id', $this->customer_id);
        $criteria->compare('t.vehicle_id', $this->vehicle_id);
        $criteria->compare('t.coa_bank_id_estimate', $this->coa_bank_id_estimate);
        $criteria->compare('payment_date_estimate', $this->payment_date_estimate);
        $criteria->compare('ppn', $this->ppn);
        $criteria->compare('pph', $this->pph);
        $criteria->compare('t.branch_id', $this->branch_id);
        $criteria->compare('t.user_id', $this->user_id);
        $criteria->compare('supervisor_id', $this->supervisor_id);
        $criteria->compare('t.status', $this->status, FALSE);
        $criteria->compare('service_price', $this->service_price, true);
        $criteria->compare('product_price', $this->product_price, true);
        $criteria->compare('quick_service_price', $this->quick_service_price, true);
        $criteria->compare('total_product', $this->total_product);
        $criteria->compare('total_service', $this->total_service);
        $criteria->compare('total_quick_service', $this->total_quick_service);
        $criteria->compare('pph_total', $this->pph_total, true);
        $criteria->compare('ppn_total', $this->ppn_total, true);
        $criteria->compare('total_price', $this->total_price, true);
        $criteria->compare('in_words', $this->in_words, true);
        $criteria->compare('note', $this->note, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'invoice_date DESC',
            ),
            'pagination' => array(
                'pageSize' => 100,
            ),
        ));
    }

    public function searchForPaymentIn() {
        $criteria = new CDbCriteria;

        $criteria->condition = "t.payment_left > 0";
        
        $criteria->compare('id', $this->id);
        $criteria->compare('invoice_number', $this->invoice_number, true);
        $criteria->compare('invoice_date', $this->invoice_date, true);
        $criteria->compare('due_date', $this->due_date, true);
        $criteria->compare('reference_type', $this->reference_type);
        $criteria->compare('sales_order_id', $this->sales_order_id);
        $criteria->compare('registration_transaction_id', $this->registration_transaction_id);
        $criteria->compare('customer_id', $this->customer_id);
        $criteria->compare('vehicle_id', $this->vehicle_id);
        $criteria->compare('ppn', $this->ppn);
        $criteria->compare('pph', $this->pph);
        $criteria->compare('branch_id', $this->branch_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('supervisor_id', $this->supervisor_id);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('service_price', $this->service_price, true);
        $criteria->compare('product_price', $this->product_price, true);
        $criteria->compare('quick_service_price', $this->quick_service_price, true);
        $criteria->compare('total_product', $this->total_product);
        $criteria->compare('total_service', $this->total_service);
        $criteria->compare('total_quick_service', $this->total_quick_service);
        $criteria->compare('pph_total', $this->pph_total, true);
        $criteria->compare('ppn_total', $this->ppn_total, true);
        $criteria->compare('total_price', $this->total_price, true);
        $criteria->compare('in_words', $this->in_words, true);
        $criteria->compare('note', $this->note, true);
        $criteria->compare('payment_amount', $this->payment_amount, true);
        $criteria->compare('payment_left', $this->payment_left, true);
        $criteria->compare('payment_date_estimate', $this->payment_date_estimate, true);
        $criteria->compare('coa_bank_id_estimate', $this->coa_bank_id_estimate);
        $criteria->compare('tax_percentage', $this->tax_percentage);
        $criteria->compare('created_datetime', $this->created_datetime, true);
        $criteria->compare('cancelled_datetime', $this->cancelled_datetime, true);
        $criteria->compare('user_id_cancelled', $this->user_id_cancelled);
        $criteria->compare('insurance_company_id', $this->insurance_company_id);
        $criteria->compare('number_of_print', $this->number_of_print);
        $criteria->compare('edited_datetime', $this->edited_datetime, true);
        $criteria->compare('user_id_edited', $this->user_id_edited);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'Pagination' => array(
                'PageSize' => 50
            ),
            'sort' => array(
                'defaultOrder' => 't.invoice_date DESC',
            ),
        ));
    }
    
    public function getSubTotal() {
        return $this->service_price + $this->product_price + $this->quick_service_price;
    }

    public function getTotalPayment() {
        $total = 0.00;
        
        foreach ($this->paymentInDetails as $detail) {
            $total += $detail->amount + $detail->tax_service_amount;
        }
        
        return $total;
    }
    
    public function getTotalRemaining() {
        
        return $this->total_price - $this->payment_amount;
    }

    public function getTotalDiscountProductService() {
        $total = 0; 
        
        foreach ($this->invoiceDetails as $detail) {
            if (!empty($detail->product_id)) {
                $total += $detail->discount;
            }
        }
        
        foreach ($this->invoiceDetails as $detail) {
            if (!empty($detail->service_id)) {
                $total += $detail->discount;
            }
        }
        
        return $total;
    }
    
    public function getRemainingDueDate() {
        $date = date('Y-m-d');

        $date1 = new DateTime($date);
        $date2 = new DateTime($this->due_date);

        $diff = $date2->diff($date1)->format("%r%a");

        return (int)$diff;
    }

    public function getReferenceTypeLiteral() {
        return $this->reference_type  == 1 ? 'Sales Order' : 'Retail Sales';
    }
}
