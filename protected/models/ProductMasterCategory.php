<?php

/**
 * This is the model class for table "rims_product_master_category".
 *
 * The followings are the available columns in table 'rims_product_master_category':
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $status
 * @property integer $coa_persediaan_barang_dagang
 * @property integer $coa_hpp
 * @property integer $coa_penjualan_barang_dagang
 * @property integer $coa_retur_penjualan
 * @property integer $coa_diskon_penjualan
 * @property integer $coa_retur_pembelian
 * @property integer $coa_diskon_pembelian
 * @property integer $coa_inventory_in_transit
 * @property integer $coa_consignment_inventory
 * @property integer $coa_outstanding_part_id
 * @property integer $user_id
 * @property string $date_posting
 * @property integer $user_id_approval
 * @property string $date_approval
 * @property integer $is_approved
 *
 * The followings are the available model relations:
 * @property Product[] $products
 */
class ProductMasterCategory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rims_product_master_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, name, status, user_id, date_posting', 'required'),
			array('coa_persediaan_barang_dagang, coa_hpp, coa_penjualan_barang_dagang, coa_retur_penjualan, coa_diskon_penjualan, coa_retur_pembelian, coa_diskon_pembelian, coa_inventory_in_transit, coa_consignment_inventory, coa_outstanding_part_id, user_id, user_id_approval, is_approved', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>20),
			array('name', 'length', 'max'=>30),
			array('status', 'length', 'max'=>10),
			array('description, date_approval', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, code, name, description, status, coa_persediaan_barang_dagang, coa_hpp, coa_penjualan_barang_dagang, coa_retur_penjualan, coa_diskon_penjualan, coa_retur_pembelian, coa_diskon_pembelian, coa_inventory_in_transit, coa_consignment_inventory, coa_outstanding_part_id, user_id, date_posting, user_id_approval, date_approval, is_approved', 'safe', 'on'=>'search'),
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
			'products' => array(self::HAS_MANY, 'Product', 'product_master_category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code' => 'Code',
			'name' => 'Name',
			'description' => 'Description',
			'status' => 'Status',
			'coa_persediaan_barang_dagang' => 'Coa Persediaan Barang Dagang',
			'coa_hpp' => 'Coa Hpp',
			'coa_penjualan_barang_dagang' => 'Coa Penjualan Barang Dagang',
			'coa_retur_penjualan' => 'Coa Retur Penjualan',
			'coa_diskon_penjualan' => 'Coa Diskon Penjualan',
			'coa_retur_pembelian' => 'Coa Retur Pembelian',
			'coa_diskon_pembelian' => 'Coa Diskon Pembelian',
			'coa_inventory_in_transit' => 'Coa Inventory In Transit',
			'coa_consignment_inventory' => 'Coa Consignment Inventory',
			'coa_outstanding_part_id' => 'Coa Outstanding Part',
			'user_id' => 'User',
			'date_posting' => 'Date Posting',
			'user_id_approval' => 'User Id Approval',
			'date_approval' => 'Date Approval',
			'is_approved' => 'Is Approved',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('coa_persediaan_barang_dagang',$this->coa_persediaan_barang_dagang);
		$criteria->compare('coa_hpp',$this->coa_hpp);
		$criteria->compare('coa_penjualan_barang_dagang',$this->coa_penjualan_barang_dagang);
		$criteria->compare('coa_retur_penjualan',$this->coa_retur_penjualan);
		$criteria->compare('coa_diskon_penjualan',$this->coa_diskon_penjualan);
		$criteria->compare('coa_retur_pembelian',$this->coa_retur_pembelian);
		$criteria->compare('coa_diskon_pembelian',$this->coa_diskon_pembelian);
		$criteria->compare('coa_inventory_in_transit',$this->coa_inventory_in_transit);
		$criteria->compare('coa_consignment_inventory',$this->coa_consignment_inventory);
		$criteria->compare('coa_outstanding_part_id',$this->coa_outstanding_part_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('date_posting',$this->date_posting,true);
		$criteria->compare('user_id_approval',$this->user_id_approval);
		$criteria->compare('date_approval',$this->date_approval,true);
		$criteria->compare('is_approved',$this->is_approved);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductMasterCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
