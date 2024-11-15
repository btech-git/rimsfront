<?php

/**
 * This is the model class for table "rims_inventory".
 *
 * The followings are the available columns in table 'rims_inventory':
 * @property integer $id
 * @property integer $product_id
 * @property integer $warehouse_id
 * @property string $total_stock
 * @property integer $minimal_stock
 * @property string $status
 * @property double $category
 * @property integer $inventory_result
 */
class Inventory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rims_inventory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, warehouse_id', 'required'),
			array('product_id, warehouse_id, minimal_stock, inventory_result', 'numerical', 'integerOnly'=>true),
			array('category', 'numerical'),
			array('total_stock, status', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, product_id, warehouse_id, total_stock, minimal_stock, status, category, inventory_result', 'safe', 'on'=>'search'),
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
			'product_id' => 'Product',
			'warehouse_id' => 'Warehouse',
			'total_stock' => 'Total Stock',
			'minimal_stock' => 'Minimal Stock',
			'status' => 'Status',
			'category' => 'Category',
			'inventory_result' => 'Inventory Result',
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
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('warehouse_id',$this->warehouse_id);
		$criteria->compare('total_stock',$this->total_stock,true);
		$criteria->compare('minimal_stock',$this->minimal_stock);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('category',$this->category);
		$criteria->compare('inventory_result',$this->inventory_result);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Inventory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
