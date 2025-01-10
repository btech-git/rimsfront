<?php

/**
 * This is the model class for table "rims_registration_transaction".
 *
 * The followings are the available columns in table 'rims_registration_transaction':
 * @property integer $id
 * @property string $transaction_number
 * @property string $transaction_date
 * @property string $repair_type
 * @property string $problem
 * @property integer $customer_id
 * @property integer $pic_id
 * @property integer $vehicle_id
 * @property integer $branch_id
 * @property integer $user_id
 * @property integer $total_quickservice
 * @property string $total_quickservice_price
 * @property integer $total_service
 * @property string $subtotal_service
 * @property string $discount_service
 * @property string $total_service_price
 * @property string $total_product
 * @property string $subtotal_product
 * @property string $discount_product
 * @property string $total_product_price
 * @property integer $is_quick_service
 * @property integer $is_insurance
 * @property integer $insurance_company_id
 * @property string $grand_total
 * @property string $work_order_number
 * @property string $work_order_date
 * @property string $work_order_time
 * @property string $status
 * @property string $payment_status
 * @property string $payment_type
 * @property string $down_payment_amount
 * @property integer $laststatusupdate_by
 * @property string $sales_order_number
 * @property string $sales_order_date
 * @property integer $ppn
 * @property integer $pph
 * @property string $subtotal
 * @property string $ppn_price
 * @property string $pph_price
 * @property string $vehicle_mileage
 * @property string $note
 * @property integer $is_passed
 * @property integer $total_time
 * @property string $service_status
 * @property integer $priority_level
 * @property string $customer_work_order_number
 * @property string $vehicle_status
 * @property string $transaction_date_out
 * @property string $transaction_time_out
 * @property integer $employee_id_assign_mechanic
 * @property integer $employee_id_sales_person
 * @property integer $tax_percentage
 * @property string $created_datetime
 * @property string $cancelled_datetime
 * @property integer $user_id_cancelled
 * @property string $feedback
 * @property string $edited_datetime
 * @property integer $user_id_edited
 * @property integer $sale_estimation_header_id
 *
 * The followings are the available model relations:
 * @property InvoiceHeader[] $invoiceHeaders
 * @property RegistrationProduct[] $registrationProducts
 * @property Customer $customer
 * @property Users $userIdEdited
 * @property SaleEstimationHeader $saleEstimationHeader
 * @property CustomerPic $pic
 * @property Vehicle $vehicle
 * @property Branch $branch
 * @property Users $user
 * @property InsuranceCompany $insuranceCompany
 * @property Employee $employeeIdAssignMechanic
 * @property Employee $employeeIdSalesPerson
 * @property Users $userIdCancelled
 */
class RegistrationTransaction extends MonthlyTransactionActiveRecord {

    const CONSTANT = 'RG';
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rims_registration_transaction';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('customer_id, vehicle_id, service_status', 'required'),
            array('customer_id, pic_id, vehicle_id, branch_id, user_id, total_quickservice, total_service, is_quick_service, is_insurance, insurance_company_id, laststatusupdate_by, ppn, pph, is_passed, total_time, priority_level, employee_id_assign_mechanic, employee_id_sales_person, tax_percentage, user_id_cancelled, user_id_edited, sale_estimation_header_id', 'numerical', 'integerOnly' => true),
            array('transaction_number, repair_type, work_order_number, payment_status, payment_type, sales_order_number, customer_work_order_number', 'length', 'max' => 30),
            array('total_quickservice_price, subtotal_service, discount_service, total_service_price, subtotal_product, discount_product, total_product_price, grand_total, down_payment_amount', 'length', 'max' => 18),
            array('total_product, subtotal, ppn_price, pph_price', 'length', 'max' => 10),
            array('status', 'length', 'max' => 50),
            array('service_status', 'length', 'max' => 100),
            array('vehicle_status', 'length', 'max' => 20),
            array('transaction_date, problem, work_order_date, work_order_time, sales_order_date, vehicle_mileage, note, transaction_date_out, transaction_time_out, created_datetime, cancelled_datetime, feedback, edited_datetime', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, transaction_number, transaction_date, repair_type, problem, customer_id, pic_id, vehicle_id, branch_id, user_id, total_quickservice, total_quickservice_price, total_service, subtotal_service, discount_service, total_service_price, total_product, subtotal_product, discount_product, total_product_price, is_quick_service, is_insurance, insurance_company_id, grand_total, work_order_number, work_order_date, work_order_time, status, payment_status, payment_type, down_payment_amount, laststatusupdate_by, sales_order_number, sales_order_date, ppn, pph, subtotal, ppn_price, pph_price, vehicle_mileage, note, is_passed, total_time, service_status, priority_level, customer_work_order_number, vehicle_status, transaction_date_out, transaction_time_out, employee_id_assign_mechanic, employee_id_sales_person, tax_percentage, created_datetime, cancelled_datetime, user_id_cancelled, feedback, edited_datetime, user_id_edited, sale_estimation_header_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'invoiceHeaders' => array(self::HAS_MANY, 'InvoiceHeader', 'registration_transaction_id'),
            'registrationProducts' => array(self::HAS_MANY, 'RegistrationProduct', 'registration_transaction_id'),
            'registrationServices' => array(self::HAS_MANY, 'RegistrationService', 'registration_transaction_id'),
            'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
            'userIdEdited' => array(self::BELONGS_TO, 'Users', 'user_id_edited'),
            'saleEstimationHeader' => array(self::BELONGS_TO, 'SaleEstimationHeader', 'sale_estimation_header_id'),
            'pic' => array(self::BELONGS_TO, 'CustomerPic', 'pic_id'),
            'vehicle' => array(self::BELONGS_TO, 'Vehicle', 'vehicle_id'),
            'branch' => array(self::BELONGS_TO, 'Branch', 'branch_id'),
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'insuranceCompany' => array(self::BELONGS_TO, 'InsuranceCompany', 'insurance_company_id'),
            'employeeIdAssignMechanic' => array(self::BELONGS_TO, 'Employee', 'employee_id_assign_mechanic'),
            'employeeIdSalesPerson' => array(self::BELONGS_TO, 'Employee', 'employee_id_sales_person'),
            'userIdCancelled' => array(self::BELONGS_TO, 'Users', 'user_id_cancelled'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'transaction_number' => 'Transaction Number',
            'transaction_date' => 'Transaction Date',
            'repair_type' => 'Repair Type',
            'problem' => 'Problem',
            'customer_id' => 'Customer',
            'pic_id' => 'Pic',
            'vehicle_id' => 'Vehicle',
            'branch_id' => 'Branch',
            'user_id' => 'User',
            'total_quickservice' => 'Total Quickservice',
            'total_quickservice_price' => 'Total Quickservice Price',
            'total_service' => 'Total Service',
            'subtotal_service' => 'Subtotal Service',
            'discount_service' => 'Discount Service',
            'total_service_price' => 'Total Service Price',
            'total_product' => 'Total Product',
            'subtotal_product' => 'Subtotal Product',
            'discount_product' => 'Discount Product',
            'total_product_price' => 'Total Product Price',
            'is_quick_service' => 'Is Quick Service',
            'is_insurance' => 'Is Insurance',
            'insurance_company_id' => 'Insurance Company',
            'grand_total' => 'Grand Total',
            'work_order_number' => 'Work Order Number',
            'work_order_date' => 'Work Order Date',
            'work_order_time' => 'Work Order Time',
            'status' => 'Status',
            'payment_status' => 'Payment Status',
            'payment_type' => 'Payment Type',
            'down_payment_amount' => 'Down Payment Amount',
            'laststatusupdate_by' => 'Laststatusupdate By',
            'sales_order_number' => 'Sales Order Number',
            'sales_order_date' => 'Sales Order Date',
            'ppn' => 'Ppn',
            'pph' => 'Pph',
            'subtotal' => 'Subtotal',
            'ppn_price' => 'Ppn Price',
            'pph_price' => 'Pph Price',
            'vehicle_mileage' => 'Vehicle Mileage',
            'note' => 'Note',
            'is_passed' => 'Is Passed',
            'total_time' => 'Total Time',
            'service_status' => 'Service Status',
            'priority_level' => 'Priority Level',
            'customer_work_order_number' => 'Customer Work Order Number',
            'vehicle_status' => 'Vehicle Status',
            'transaction_date_out' => 'Transaction Date Out',
            'transaction_time_out' => 'Transaction Time Out',
            'employee_id_assign_mechanic' => 'Employee Id Assign Mechanic',
            'employee_id_sales_person' => 'Employee Id Sales Person',
            'tax_percentage' => 'Tax Percentage',
            'created_datetime' => 'Created Datetime',
            'cancelled_datetime' => 'Cancelled Datetime',
            'user_id_cancelled' => 'User Id Cancelled',
            'feedback' => 'Feedback',
            'edited_datetime' => 'Edited Datetime',
            'user_id_edited' => 'User Id Edited',
            'sale_estimation_header_id' => 'Sale Estimation Header',
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
        $criteria->compare('transaction_number', $this->transaction_number, true);
        $criteria->compare('transaction_date', $this->transaction_date, true);
        $criteria->compare('repair_type', $this->repair_type, true);
        $criteria->compare('problem', $this->problem, true);
        $criteria->compare('customer_id', $this->customer_id);
        $criteria->compare('pic_id', $this->pic_id);
        $criteria->compare('vehicle_id', $this->vehicle_id);
        $criteria->compare('branch_id', $this->branch_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('total_quickservice', $this->total_quickservice);
        $criteria->compare('total_quickservice_price', $this->total_quickservice_price, true);
        $criteria->compare('total_service', $this->total_service);
        $criteria->compare('subtotal_service', $this->subtotal_service, true);
        $criteria->compare('discount_service', $this->discount_service, true);
        $criteria->compare('total_service_price', $this->total_service_price, true);
        $criteria->compare('total_product', $this->total_product, true);
        $criteria->compare('subtotal_product', $this->subtotal_product, true);
        $criteria->compare('discount_product', $this->discount_product, true);
        $criteria->compare('total_product_price', $this->total_product_price, true);
        $criteria->compare('is_quick_service', $this->is_quick_service);
        $criteria->compare('is_insurance', $this->is_insurance);
        $criteria->compare('insurance_company_id', $this->insurance_company_id);
        $criteria->compare('grand_total', $this->grand_total, true);
        $criteria->compare('work_order_number', $this->work_order_number, true);
        $criteria->compare('work_order_date', $this->work_order_date, true);
        $criteria->compare('work_order_time', $this->work_order_time, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('payment_status', $this->payment_status, true);
        $criteria->compare('payment_type', $this->payment_type, true);
        $criteria->compare('down_payment_amount', $this->down_payment_amount, true);
        $criteria->compare('laststatusupdate_by', $this->laststatusupdate_by);
        $criteria->compare('sales_order_number', $this->sales_order_number, true);
        $criteria->compare('sales_order_date', $this->sales_order_date, true);
        $criteria->compare('ppn', $this->ppn);
        $criteria->compare('pph', $this->pph);
        $criteria->compare('subtotal', $this->subtotal, true);
        $criteria->compare('ppn_price', $this->ppn_price, true);
        $criteria->compare('pph_price', $this->pph_price, true);
        $criteria->compare('vehicle_mileage', $this->vehicle_mileage, true);
        $criteria->compare('note', $this->note, true);
        $criteria->compare('is_passed', $this->is_passed);
        $criteria->compare('total_time', $this->total_time);
        $criteria->compare('service_status', $this->service_status, true);
        $criteria->compare('priority_level', $this->priority_level);
        $criteria->compare('customer_work_order_number', $this->customer_work_order_number, true);
        $criteria->compare('vehicle_status', $this->vehicle_status, true);
        $criteria->compare('transaction_date_out', $this->transaction_date_out, true);
        $criteria->compare('transaction_time_out', $this->transaction_time_out, true);
        $criteria->compare('employee_id_assign_mechanic', $this->employee_id_assign_mechanic);
        $criteria->compare('employee_id_sales_person', $this->employee_id_sales_person);
        $criteria->compare('tax_percentage', $this->tax_percentage);
        $criteria->compare('created_datetime', $this->created_datetime, true);
        $criteria->compare('cancelled_datetime', $this->cancelled_datetime, true);
        $criteria->compare('user_id_cancelled', $this->user_id_cancelled);
        $criteria->compare('feedback', $this->feedback, true);
        $criteria->compare('edited_datetime', $this->edited_datetime, true);
        $criteria->compare('user_id_edited', $this->user_id_edited);
        $criteria->compare('sale_estimation_header_id', $this->sale_estimation_header_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'transaction_date DESC',
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
     * @return RegistrationTransaction the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function searchAdmin() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('transaction_number', $this->transaction_number, true);
        $criteria->compare('t.transaction_date', $this->transaction_date);
        $criteria->compare('repair_type', $this->repair_type, true);
        $criteria->compare('problem', $this->problem, true);
        $criteria->compare('t.customer_id', $this->customer_id);
        $criteria->compare('pic_id', $this->pic_id);
        $criteria->compare('vehicle_id', $this->vehicle_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('total_quickservice', $this->total_quickservice);
        $criteria->compare('total_quickservice_price', $this->total_quickservice_price, true);
        $criteria->compare('total_service', $this->total_service);
        $criteria->compare('subtotal_service', $this->subtotal_service, true);
        $criteria->compare('discount_service', $this->discount_service, true);
        $criteria->compare('total_service_price', $this->total_service_price, true);
        $criteria->compare('total_product', $this->total_product, true);
        $criteria->compare('subtotal_product', $this->subtotal_product, true);
        $criteria->compare('discount_product', $this->discount_product, true);
        $criteria->compare('total_product_price', $this->total_product_price, true);
        $criteria->compare('is_quick_service', $this->is_quick_service);
        $criteria->compare('is_insurance', $this->is_insurance);
        $criteria->compare('insurance_company_id', $this->insurance_company_id);
        $criteria->compare('grand_total', $this->grand_total, true);
        $criteria->compare('t.work_order_number', $this->work_order_number, true);
        $criteria->compare('t.work_order_date', $this->work_order_date, true);
        $criteria->compare('t.status', $this->status, true);
        $criteria->compare('payment_status', $this->payment_status, true);
        $criteria->compare('payment_type', $this->payment_type, true);
        $criteria->compare('down_payment_amount', $this->down_payment_amount, true);
        $criteria->compare('laststatusupdate_by', $this->laststatusupdate_by);
        $criteria->compare('sales_order_number', $this->sales_order_number, true);
        $criteria->compare('sales_order_date', $this->sales_order_date, true);
        $criteria->compare('ppn', $this->ppn);
        $criteria->compare('pph', $this->pph);
        $criteria->compare('subtotal', $this->subtotal, true);
        $criteria->compare('ppn_price', $this->ppn_price, true);
        $criteria->compare('pph_price', $this->pph_price, true);
        $criteria->compare('vehicle_mileage', $this->vehicle_mileage, true);
        $criteria->compare('note', $this->note, true);
        $criteria->compare('is_passed', $this->is_passed);
        $criteria->compare('total_time', $this->total_time);
        $criteria->compare('priority_level', $this->priority_level);
        $criteria->compare('customer_work_order_number', $this->customer_work_order_number);
        $criteria->compare('t.branch_id', $this->branch_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'transaction_date DESC',
            ),
            'pagination' => array(
                'pageSize' => 50,
            ),
        ));
    }

    public function searchByInvoice() {
        $criteria = new CDbCriteria;

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.transaction_number', $this->transaction_number, true);
        $criteria->compare('t.repair_type', $this->repair_type, true);
        $criteria->compare('problem', $this->problem, true);
        $criteria->compare('t.customer_id', $this->customer_id);
        $criteria->compare('t.vehicle_id', $this->vehicle_id);
        $criteria->compare('t.branch_id', $this->branch_id);
        $criteria->compare('t.user_id', $this->user_id);
        $criteria->compare('t.insurance_company_id', $this->insurance_company_id);
        $criteria->compare('t.employee_id_sales_person', $this->employee_id_sales_person);
        $criteria->compare('t.note', $this->note, true);

        $criteria->addCondition("t.status <> 'Finished' AND t.payment_status = 'INVOICING'");
        $criteria->order = 't.transaction_date DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'transaction_date DESC',
            ),
            'pagination' => array(
                'pageSize' => 50,
            ),
        ));
    }

    public function searchByFollowUp() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('transaction_number', $this->transaction_number, true);
        $criteria->compare('t.transaction_date', $this->transaction_date);
        $criteria->compare('repair_type', $this->repair_type, true);
        $criteria->compare('problem', $this->problem, true);
        $criteria->compare('t.customer_id', $this->customer_id);
        $criteria->compare('pic_id', $this->pic_id);
        $criteria->compare('vehicle_id', $this->vehicle_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('total_quickservice', $this->total_quickservice);
        $criteria->compare('total_quickservice_price', $this->total_quickservice_price, true);
        $criteria->compare('total_service', $this->total_service);
        $criteria->compare('subtotal_service', $this->subtotal_service, true);
        $criteria->compare('discount_service', $this->discount_service, true);
        $criteria->compare('total_service_price', $this->total_service_price, true);
        $criteria->compare('total_product', $this->total_product, true);
        $criteria->compare('subtotal_product', $this->subtotal_product, true);
        $criteria->compare('discount_product', $this->discount_product, true);
        $criteria->compare('total_product_price', $this->total_product_price, true);
        $criteria->compare('is_quick_service', $this->is_quick_service);
        $criteria->compare('is_insurance', $this->is_insurance);
        $criteria->compare('insurance_company_id', $this->insurance_company_id);
        $criteria->compare('grand_total', $this->grand_total, true);
        $criteria->compare('t.work_order_number', $this->work_order_number, true);
        $criteria->compare('t.work_order_date', $this->work_order_date, true);
        $criteria->compare('payment_status', $this->payment_status, true);
        $criteria->compare('payment_type', $this->payment_type, true);
        $criteria->compare('down_payment_amount', $this->down_payment_amount, true);
        $criteria->compare('laststatusupdate_by', $this->laststatusupdate_by);
        $criteria->compare('sales_order_number', $this->sales_order_number, true);
        $criteria->compare('sales_order_date', $this->sales_order_date, true);
        $criteria->compare('ppn', $this->ppn);
        $criteria->compare('pph', $this->pph);
        $criteria->compare('subtotal', $this->subtotal, true);
        $criteria->compare('ppn_price', $this->ppn_price, true);
        $criteria->compare('pph_price', $this->pph_price, true);
        $criteria->compare('vehicle_mileage', $this->vehicle_mileage, true);
        $criteria->compare('note', $this->note, true);
        $criteria->compare('is_passed', $this->is_passed);
        $criteria->compare('total_time', $this->total_time);
        $criteria->compare('priority_level', $this->priority_level);
        $criteria->compare('customer_work_order_number', $this->customer_work_order_number);
        $criteria->compare('t.branch_id', $this->branch_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'transaction_date DESC',
            ),
            'pagination' => array(
                'pageSize' => 500,
            ),
        ));
    }
    
    public function getTotalQuantityMovementLeft() {
        $total = 0;
        
        foreach ($this->registrationProducts as $registrationProduct) {
            $total+= $registrationProduct->quantity_movement_left;
        }
        
        return $total;
    }

    public function getTotalDiscount() {
        $total = 0;
        
        foreach ($this->registrationProducts as $registrationProduct) {
            $total+= $registrationProduct->discountAmount;
        }
        
        foreach ($this->registrationServices as $registrationService) {
            $total+= $registrationService->discountAmount;
        }
        
        return $total;        
    }
}