<?php

/**
 * This is the model class for table "rims_inventory_detail".
 *
 * The followings are the available columns in table 'rims_inventory_detail':
 * @property integer $id
 * @property integer $inventory_id
 * @property integer $product_id
 * @property integer $warehouse_id
 * @property string $transaction_type
 * @property string $transaction_number
 * @property string $transaction_date
 * @property string $stock_in
 * @property string $stock_out
 * @property string $purchase_price
 * @property string $notes
 * @property string $transaction_time
 */
class InventoryDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rims_inventory_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, warehouse_id, transaction_type, transaction_number, transaction_date, transaction_time', 'required'),
			array('inventory_id, product_id, warehouse_id', 'numerical', 'integerOnly'=>true),
			array('transaction_type, stock_in, stock_out', 'length', 'max'=>10),
			array('transaction_number', 'length', 'max'=>50),
			array('purchase_price', 'length', 'max'=>18),
			array('notes', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, inventory_id, product_id, warehouse_id, transaction_type, transaction_number, transaction_date, stock_in, stock_out, purchase_price, notes, transaction_time', 'safe', 'on'=>'search'),
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
			'inventory_id' => 'Inventory',
			'product_id' => 'Product',
			'warehouse_id' => 'Warehouse',
			'transaction_type' => 'Transaction Type',
			'transaction_number' => 'Transaction Number',
			'transaction_date' => 'Transaction Date',
			'stock_in' => 'Stock In',
			'stock_out' => 'Stock Out',
			'purchase_price' => 'Purchase Price',
			'notes' => 'Notes',
			'transaction_time' => 'Transaction Time',
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
		$criteria->compare('inventory_id',$this->inventory_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('warehouse_id',$this->warehouse_id);
		$criteria->compare('transaction_type',$this->transaction_type,true);
		$criteria->compare('transaction_number',$this->transaction_number,true);
		$criteria->compare('transaction_date',$this->transaction_date,true);
		$criteria->compare('stock_in',$this->stock_in,true);
		$criteria->compare('stock_out',$this->stock_out,true);
		$criteria->compare('purchase_price',$this->purchase_price,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('transaction_time',$this->transaction_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InventoryDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
