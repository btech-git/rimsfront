<?php

/**
 * This is the model class for table "rims_movement_out_detail".
 *
 * The followings are the available columns in table 'rims_movement_out_detail':
 * @property integer $id
 * @property integer $movement_out_header_id
 * @property integer $delivery_order_detail_id
 * @property integer $return_order_detail_id
 * @property integer $material_request_detail_id
 * @property integer $registration_product_id
 * @property integer $registration_service_id
 * @property integer $product_id
 * @property string $quantity_transaction
 * @property integer $warehouse_id
 * @property integer $unit_id
 * @property string $quantity
 * @property string $quantity_receive
 * @property string $quantity_receive_left
 * @property string $quantity_stock
 *
 * The followings are the available model relations:
 * @property MovementOutHeader $movementOutHeader
 * @property TransactionDeliveryOrderDetail $deliveryOrderDetail
 * @property TransactionReturnOrderDetail $returnOrderDetail
 * @property MaterialRequestDetail $materialRequestDetail
 * @property RegistrationProduct $registrationProduct
 * @property RegistrationService $registrationService
 * @property Product $product
 * @property Warehouse $warehouse
 * @property Unit $unit
 */
class MovementOutDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rims_movement_out_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('movement_out_header_id, product_id, warehouse_id, unit_id', 'required'),
			array('movement_out_header_id, delivery_order_detail_id, return_order_detail_id, material_request_detail_id, registration_product_id, registration_service_id, product_id, warehouse_id, unit_id', 'numerical', 'integerOnly'=>true),
			array('quantity_transaction, quantity, quantity_receive, quantity_receive_left, quantity_stock', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, movement_out_header_id, delivery_order_detail_id, return_order_detail_id, material_request_detail_id, registration_product_id, registration_service_id, product_id, quantity_transaction, warehouse_id, unit_id, quantity, quantity_receive, quantity_receive_left, quantity_stock', 'safe', 'on'=>'search'),
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
			'movementOutHeader' => array(self::BELONGS_TO, 'MovementOutHeader', 'movement_out_header_id'),
			'deliveryOrderDetail' => array(self::BELONGS_TO, 'TransactionDeliveryOrderDetail', 'delivery_order_detail_id'),
			'returnOrderDetail' => array(self::BELONGS_TO, 'TransactionReturnOrderDetail', 'return_order_detail_id'),
			'materialRequestDetail' => array(self::BELONGS_TO, 'MaterialRequestDetail', 'material_request_detail_id'),
			'registrationProduct' => array(self::BELONGS_TO, 'RegistrationProduct', 'registration_product_id'),
			'registrationService' => array(self::BELONGS_TO, 'RegistrationService', 'registration_service_id'),
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
			'warehouse' => array(self::BELONGS_TO, 'Warehouse', 'warehouse_id'),
			'unit' => array(self::BELONGS_TO, 'Unit', 'unit_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'movement_out_header_id' => 'Movement Out Header',
			'delivery_order_detail_id' => 'Delivery Order Detail',
			'return_order_detail_id' => 'Return Order Detail',
			'material_request_detail_id' => 'Material Request Detail',
			'registration_product_id' => 'Registration Product',
			'registration_service_id' => 'Registration Service',
			'product_id' => 'Product',
			'quantity_transaction' => 'Quantity Transaction',
			'warehouse_id' => 'Warehouse',
			'unit_id' => 'Unit',
			'quantity' => 'Quantity',
			'quantity_receive' => 'Quantity Receive',
			'quantity_receive_left' => 'Quantity Receive Left',
			'quantity_stock' => 'Quantity Stock',
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
		$criteria->compare('movement_out_header_id',$this->movement_out_header_id);
		$criteria->compare('delivery_order_detail_id',$this->delivery_order_detail_id);
		$criteria->compare('return_order_detail_id',$this->return_order_detail_id);
		$criteria->compare('material_request_detail_id',$this->material_request_detail_id);
		$criteria->compare('registration_product_id',$this->registration_product_id);
		$criteria->compare('registration_service_id',$this->registration_service_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('quantity_transaction',$this->quantity_transaction,true);
		$criteria->compare('warehouse_id',$this->warehouse_id);
		$criteria->compare('unit_id',$this->unit_id);
		$criteria->compare('quantity',$this->quantity,true);
		$criteria->compare('quantity_receive',$this->quantity_receive,true);
		$criteria->compare('quantity_receive_left',$this->quantity_receive_left,true);
		$criteria->compare('quantity_stock',$this->quantity_stock,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MovementOutDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
