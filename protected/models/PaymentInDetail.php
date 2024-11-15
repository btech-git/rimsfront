<?php

/**
 * This is the model class for table "rims_payment_in_detail".
 *
 * The followings are the available columns in table 'rims_payment_in_detail':
 * @property integer $id
 * @property string $total_invoice
 * @property string $amount
 * @property string $memo
 * @property string $tax_service_percentage
 * @property string $tax_service_amount
 * @property integer $is_tax_service
 * @property integer $payment_in_id
 * @property integer $invoice_header_id
 *
 * The followings are the available model relations:
 * @property PaymentIn $paymentIn
 * @property InvoiceHeader $invoiceHeader
 */
class PaymentInDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rims_payment_in_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('payment_in_id, invoice_header_id', 'required'),
			array('is_tax_service, payment_in_id, invoice_header_id', 'numerical', 'integerOnly'=>true),
			array('total_invoice, amount, tax_service_amount', 'length', 'max'=>18),
			array('memo', 'length', 'max'=>100),
			array('tax_service_percentage', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, total_invoice, amount, memo, tax_service_percentage, tax_service_amount, is_tax_service, payment_in_id, invoice_header_id', 'safe', 'on'=>'search'),
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
			'paymentIn' => array(self::BELONGS_TO, 'PaymentIn', 'payment_in_id'),
			'invoiceHeader' => array(self::BELONGS_TO, 'InvoiceHeader', 'invoice_header_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'total_invoice' => 'Total Invoice',
			'amount' => 'Amount',
			'memo' => 'Memo',
			'tax_service_percentage' => 'Tax Service Percentage',
			'tax_service_amount' => 'Tax Service Amount',
			'is_tax_service' => 'Is Tax Service',
			'payment_in_id' => 'Payment In',
			'invoice_header_id' => 'Invoice Header',
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
		$criteria->compare('total_invoice',$this->total_invoice,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('memo',$this->memo,true);
		$criteria->compare('tax_service_percentage',$this->tax_service_percentage,true);
		$criteria->compare('tax_service_amount',$this->tax_service_amount,true);
		$criteria->compare('is_tax_service',$this->is_tax_service);
		$criteria->compare('payment_in_id',$this->payment_in_id);
		$criteria->compare('invoice_header_id',$this->invoice_header_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PaymentInDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
