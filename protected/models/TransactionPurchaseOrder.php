<?php

/**
 * This is the model class for table "rims_transaction_purchase_order".
 *
 * The followings are the available columns in table 'rims_transaction_purchase_order':
 * @property integer $id
 * @property string $purchase_order_no
 * @property string $purchase_order_date
 * @property string $status_document
 * @property integer $purchase_type
 * @property integer $supplier_id
 * @property string $payment_type
 * @property string $estimate_date_arrival
 * @property integer $requester_id
 * @property integer $main_branch_id
 * @property integer $destination_branch_id
 * @property integer $approved_id
 * @property integer $total_quantity
 * @property string $price_before_discount
 * @property string $discount
 * @property string $subtotal
 * @property integer $ppn
 * @property string $ppn_price
 * @property string $total_price
 * @property string $payment_amount
 * @property string $payment_left
 * @property integer $company_bank_id
 * @property string $payment_status
 * @property string $payment_date_estimate
 * @property integer $coa_bank_id_estimate
 * @property integer $registration_transaction_id
 * @property string $created_datetime
 * @property integer $tax_percentage
 * @property string $note
 * @property string $cancelled_datetime
 * @property integer $user_id_cancelled
 * @property integer $user_id_created
 */
class TransactionPurchaseOrder extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rims_transaction_purchase_order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('purchase_order_no, status_document, supplier_id, payment_type, requester_id, main_branch_id', 'required'),
			array('purchase_type, supplier_id, requester_id, main_branch_id, destination_branch_id, approved_id, total_quantity, ppn, company_bank_id, coa_bank_id_estimate, registration_transaction_id, tax_percentage, user_id_cancelled, user_id_created', 'numerical', 'integerOnly'=>true),
			array('purchase_order_no, status_document', 'length', 'max'=>30),
			array('payment_type', 'length', 'max'=>20),
			array('price_before_discount, discount, subtotal, ppn_price, total_price, payment_amount, payment_left', 'length', 'max'=>18),
			array('payment_status', 'length', 'max'=>50),
			array('purchase_order_date, estimate_date_arrival, payment_date_estimate, created_datetime, note, cancelled_datetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, purchase_order_no, purchase_order_date, status_document, purchase_type, supplier_id, payment_type, estimate_date_arrival, requester_id, main_branch_id, destination_branch_id, approved_id, total_quantity, price_before_discount, discount, subtotal, ppn, ppn_price, total_price, payment_amount, payment_left, company_bank_id, payment_status, payment_date_estimate, coa_bank_id_estimate, registration_transaction_id, created_datetime, tax_percentage, note, cancelled_datetime, user_id_cancelled, user_id_created', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'purchase_order_no' => 'Purchase Order No',
			'purchase_order_date' => 'Purchase Order Date',
			'status_document' => 'Status Document',
			'purchase_type' => 'Purchase Type',
			'supplier_id' => 'Supplier',
			'payment_type' => 'Payment Type',
			'estimate_date_arrival' => 'Estimate Date Arrival',
			'requester_id' => 'Requester',
			'main_branch_id' => 'Main Branch',
			'destination_branch_id' => 'Destination Branch',
			'approved_id' => 'Approved',
			'total_quantity' => 'Total Quantity',
			'price_before_discount' => 'Price Before Discount',
			'discount' => 'Discount',
			'subtotal' => 'Subtotal',
			'ppn' => 'Ppn',
			'ppn_price' => 'Ppn Price',
			'total_price' => 'Total Price',
			'payment_amount' => 'Payment Amount',
			'payment_left' => 'Payment Left',
			'company_bank_id' => 'Company Bank',
			'payment_status' => 'Payment Status',
			'payment_date_estimate' => 'Payment Date Estimate',
			'coa_bank_id_estimate' => 'Coa Bank Id Estimate',
			'registration_transaction_id' => 'Registration Transaction',
			'created_datetime' => 'Created Datetime',
			'tax_percentage' => 'Tax Percentage',
			'note' => 'Note',
			'cancelled_datetime' => 'Cancelled Datetime',
			'user_id_cancelled' => 'User Id Cancelled',
			'user_id_created' => 'User Id Created',
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
		$criteria->compare('purchase_order_no',$this->purchase_order_no,true);
		$criteria->compare('purchase_order_date',$this->purchase_order_date,true);
		$criteria->compare('status_document',$this->status_document,true);
		$criteria->compare('purchase_type',$this->purchase_type);
		$criteria->compare('supplier_id',$this->supplier_id);
		$criteria->compare('payment_type',$this->payment_type,true);
		$criteria->compare('estimate_date_arrival',$this->estimate_date_arrival,true);
		$criteria->compare('requester_id',$this->requester_id);
		$criteria->compare('main_branch_id',$this->main_branch_id);
		$criteria->compare('destination_branch_id',$this->destination_branch_id);
		$criteria->compare('approved_id',$this->approved_id);
		$criteria->compare('total_quantity',$this->total_quantity);
		$criteria->compare('price_before_discount',$this->price_before_discount,true);
		$criteria->compare('discount',$this->discount,true);
		$criteria->compare('subtotal',$this->subtotal,true);
		$criteria->compare('ppn',$this->ppn);
		$criteria->compare('ppn_price',$this->ppn_price,true);
		$criteria->compare('total_price',$this->total_price,true);
		$criteria->compare('payment_amount',$this->payment_amount,true);
		$criteria->compare('payment_left',$this->payment_left,true);
		$criteria->compare('company_bank_id',$this->company_bank_id);
		$criteria->compare('payment_status',$this->payment_status,true);
		$criteria->compare('payment_date_estimate',$this->payment_date_estimate,true);
		$criteria->compare('coa_bank_id_estimate',$this->coa_bank_id_estimate);
		$criteria->compare('registration_transaction_id',$this->registration_transaction_id);
		$criteria->compare('created_datetime',$this->created_datetime,true);
		$criteria->compare('tax_percentage',$this->tax_percentage);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('cancelled_datetime',$this->cancelled_datetime,true);
		$criteria->compare('user_id_cancelled',$this->user_id_cancelled);
		$criteria->compare('user_id_created',$this->user_id_created);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TransactionPurchaseOrder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
