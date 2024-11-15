<?php

/**
 * This is the model class for table "rims_movement_in_detail".
 *
 * The followings are the available columns in table 'rims_movement_in_detail':
 * @property integer $id
 * @property integer $receive_item_detail_id
 * @property integer $return_item_detail_id
 * @property integer $movement_in_header_id
 * @property integer $product_id
 * @property string $quantity_transaction
 * @property string $quantity
 * @property integer $warehouse_id
 *
 * The followings are the available model relations:
 * @property TransactionReceiveItemDetail $receiveItemDetail
 * @property TransactionReturnItemDetail $returnItemDetail
 * @property MovementInHeader $movementInHeader
 * @property Product $product
 * @property Warehouse $warehouse
 */
class MovementInDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rims_movement_in_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('movement_in_header_id, product_id, warehouse_id', 'required'),
			array('receive_item_detail_id, return_item_detail_id, movement_in_header_id, product_id, warehouse_id', 'numerical', 'integerOnly'=>true),
			array('quantity_transaction, quantity', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, receive_item_detail_id, return_item_detail_id, movement_in_header_id, product_id, quantity_transaction, quantity, warehouse_id', 'safe', 'on'=>'search'),
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
			'receiveItemDetail' => array(self::BELONGS_TO, 'TransactionReceiveItemDetail', 'receive_item_detail_id'),
			'returnItemDetail' => array(self::BELONGS_TO, 'TransactionReturnItemDetail', 'return_item_detail_id'),
			'movementInHeader' => array(self::BELONGS_TO, 'MovementInHeader', 'movement_in_header_id'),
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
			'warehouse' => array(self::BELONGS_TO, 'Warehouse', 'warehouse_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'receive_item_detail_id' => 'Receive Item Detail',
			'return_item_detail_id' => 'Return Item Detail',
			'movement_in_header_id' => 'Movement In Header',
			'product_id' => 'Product',
			'quantity_transaction' => 'Quantity Transaction',
			'quantity' => 'Quantity',
			'warehouse_id' => 'Warehouse',
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
		$criteria->compare('receive_item_detail_id',$this->receive_item_detail_id);
		$criteria->compare('return_item_detail_id',$this->return_item_detail_id);
		$criteria->compare('movement_in_header_id',$this->movement_in_header_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('quantity_transaction',$this->quantity_transaction,true);
		$criteria->compare('quantity',$this->quantity,true);
		$criteria->compare('warehouse_id',$this->warehouse_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MovementInDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
