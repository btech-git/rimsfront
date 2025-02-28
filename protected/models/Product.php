<?php

/**
 * This is the model class for table "rims_product".
 *
 * The followings are the available columns in table 'rims_product':
 * @property integer $id
 * @property string $code
 * @property string $manufacturer_code
 * @property string $barcode
 * @property string $name
 * @property string $description
 * @property integer $production_year
 * @property integer $brand_id
 * @property integer $sub_brand_id
 * @property integer $sub_brand_series_id
 * @property string $extension
 * @property integer $product_master_category_id
 * @property integer $product_sub_master_category_id
 * @property integer $product_sub_category_id
 * @property integer $vehicle_car_make_id
 * @property integer $vehicle_car_model_id
 * @property string $purchase_price
 * @property string $recommended_selling_price
 * @property string $hpp
 * @property string $retail_price
 * @property integer $stock
 * @property integer $minimum_stock
 * @property integer $margin_type
 * @property integer $margin_amount
 * @property string $minimum_selling_price
 * @property string $is_usable
 * @property string $status
 * @property integer $ppn
 * @property integer $unit_id
 * @property integer $user_id
 * @property integer $user_id_approval
 * @property string $date_posting
 * @property string $date_approval
 * @property integer $is_approved
 * @property integer $user_id_edit
 *
 * The followings are the available model relations:
 * @property Inventory[] $inventories
 * @property InventoryDetail[] $inventoryDetails
 * @property Brand $brand
 * @property Users $user
 * @property Users $userIdApproval
 * @property Users $userIdEdit
 * @property SubBrand $subBrand
 * @property SubBrandSeries $subBrandSeries
 * @property ProductMasterCategory $productMasterCategory
 * @property ProductSubCategory $productSubCategory
 * @property ProductSubMasterCategory $productSubMasterCategory
 * @property VehicleCarMake $vehicleCarMake
 * @property VehicleCarModel $vehicleCarModel
 * @property Unit $unit
 * @property RegistrationProduct[] $registrationProducts
 * @property SaleEstimationProductDetail[] $saleEstimationProductDetails
 */
class Product extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rims_product';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('code, manufacturer_code, name, production_year, extension, product_master_category_id, product_sub_master_category_id, product_sub_category_id, user_id, date_posting', 'required'),
            array('production_year, brand_id, sub_brand_id, sub_brand_series_id, product_master_category_id, product_sub_master_category_id, product_sub_category_id, vehicle_car_make_id, vehicle_car_model_id, stock, minimum_stock, margin_type, margin_amount, ppn, unit_id, user_id, user_id_approval, is_approved, user_id_edit', 'numerical', 'integerOnly' => true),
            array('code', 'length', 'max' => 20),
            array('manufacturer_code, barcode, extension', 'length', 'max' => 50),
            array('name', 'length', 'max' => 30),
            array('purchase_price, recommended_selling_price, hpp, minimum_selling_price, status', 'length', 'max' => 10),
            array('retail_price', 'length', 'max' => 18),
            array('is_usable', 'length', 'max' => 5),
            array('description, date_approval', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, code, manufacturer_code, barcode, name, description, production_year, brand_id, sub_brand_id, sub_brand_series_id, extension, product_master_category_id, product_sub_master_category_id, product_sub_category_id, vehicle_car_make_id, vehicle_car_model_id, purchase_price, recommended_selling_price, hpp, retail_price, stock, minimum_stock, margin_type, margin_amount, minimum_selling_price, is_usable, status, ppn, unit_id, user_id, user_id_approval, date_posting, date_approval, is_approved, user_id_edit', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'inventories' => array(self::HAS_MANY, 'Inventory', 'product_id'),
            'inventoryDetails' => array(self::HAS_MANY, 'InventoryDetail', 'product_id'),
            'brand' => array(self::BELONGS_TO, 'Brand', 'brand_id'),
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'userIdApproval' => array(self::BELONGS_TO, 'Users', 'user_id_approval'),
            'userIdEdit' => array(self::BELONGS_TO, 'Users', 'user_id_edit'),
            'subBrand' => array(self::BELONGS_TO, 'SubBrand', 'sub_brand_id'),
            'subBrandSeries' => array(self::BELONGS_TO, 'SubBrandSeries', 'sub_brand_series_id'),
            'productMasterCategory' => array(self::BELONGS_TO, 'ProductMasterCategory', 'product_master_category_id'),
            'productSubCategory' => array(self::BELONGS_TO, 'ProductSubCategory', 'product_sub_category_id'),
            'productSubMasterCategory' => array(self::BELONGS_TO, 'ProductSubMasterCategory', 'product_sub_master_category_id'),
            'vehicleCarMake' => array(self::BELONGS_TO, 'VehicleCarMake', 'vehicle_car_make_id'),
            'vehicleCarModel' => array(self::BELONGS_TO, 'VehicleCarModel', 'vehicle_car_model_id'),
            'unit' => array(self::BELONGS_TO, 'Unit', 'unit_id'),
            'registrationProducts' => array(self::HAS_MANY, 'RegistrationProduct', 'product_id'),
            'saleEstimationProductDetails' => array(self::HAS_MANY, 'SaleEstimationProductDetail', 'product_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'code' => 'Code',
            'manufacturer_code' => 'Manufacturer Code',
            'barcode' => 'Barcode',
            'name' => 'Name',
            'description' => 'Description',
            'production_year' => 'Production Year',
            'brand_id' => 'Brand',
            'sub_brand_id' => 'Sub Brand',
            'sub_brand_series_id' => 'Sub Brand Series',
            'extension' => 'Extension',
            'product_master_category_id' => 'Product Master Category',
            'product_sub_master_category_id' => 'Product Sub Master Category',
            'product_sub_category_id' => 'Product Sub Category',
            'vehicle_car_make_id' => 'Vehicle Car Make',
            'vehicle_car_model_id' => 'Vehicle Car Model',
            'purchase_price' => 'Purchase Price',
            'recommended_selling_price' => 'Recommended Selling Price',
            'hpp' => 'Hpp',
            'retail_price' => 'Retail Price',
            'stock' => 'Stock',
            'minimum_stock' => 'Minimum Stock',
            'margin_type' => 'Margin Type',
            'margin_amount' => 'Margin Amount',
            'minimum_selling_price' => 'Minimum Selling Price',
            'is_usable' => 'Is Usable',
            'status' => 'Status',
            'ppn' => 'Ppn',
            'unit_id' => 'Unit',
            'user_id' => 'User',
            'user_id_approval' => 'User Id Approval',
            'date_posting' => 'Date Posting',
            'date_approval' => 'Date Approval',
            'is_approved' => 'Is Approved',
            'user_id_edit' => 'User Id Edit',
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
        $criteria->compare('code', $this->code, true);
        $criteria->compare('manufacturer_code', $this->manufacturer_code, true);
        $criteria->compare('barcode', $this->barcode, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('production_year', $this->production_year);
        $criteria->compare('brand_id', $this->brand_id);
        $criteria->compare('sub_brand_id', $this->sub_brand_id);
        $criteria->compare('sub_brand_series_id', $this->sub_brand_series_id);
        $criteria->compare('extension', $this->extension, true);
        $criteria->compare('product_master_category_id', $this->product_master_category_id);
        $criteria->compare('product_sub_master_category_id', $this->product_sub_master_category_id);
        $criteria->compare('product_sub_category_id', $this->product_sub_category_id);
        $criteria->compare('vehicle_car_make_id', $this->vehicle_car_make_id);
        $criteria->compare('vehicle_car_model_id', $this->vehicle_car_model_id);
        $criteria->compare('purchase_price', $this->purchase_price, true);
        $criteria->compare('recommended_selling_price', $this->recommended_selling_price, true);
        $criteria->compare('hpp', $this->hpp, true);
        $criteria->compare('retail_price', $this->retail_price, true);
        $criteria->compare('stock', $this->stock);
        $criteria->compare('minimum_stock', $this->minimum_stock);
        $criteria->compare('margin_type', $this->margin_type);
        $criteria->compare('margin_amount', $this->margin_amount);
        $criteria->compare('minimum_selling_price', $this->minimum_selling_price, true);
        $criteria->compare('is_usable', $this->is_usable, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('ppn', $this->ppn);
        $criteria->compare('unit_id', $this->unit_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('user_id_approval', $this->user_id_approval);
        $criteria->compare('date_posting', $this->date_posting, true);
        $criteria->compare('date_approval', $this->date_approval, true);
        $criteria->compare('is_approved', $this->is_approved);
        $criteria->compare('user_id_edit', $this->user_id_edit);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Product the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function searchByStockCheck($pageNumber, $endDate, $stockOperator) {

        $criteria = new CDbCriteria;

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.code', $this->code, true);
        $criteria->compare('t.manufacturer_code', $this->manufacturer_code, true);
        $criteria->compare('t.name', $this->name, true);
        $criteria->compare('t.brand_id', $this->brand_id);
        $criteria->compare('t.sub_brand_id', $this->sub_brand_id);
        $criteria->compare('t.sub_brand_series_id', $this->sub_brand_series_id);
        $criteria->compare('t.product_master_category_id', $this->product_master_category_id);
        $criteria->compare('t.product_sub_master_category_id', $this->product_sub_master_category_id);
        $criteria->compare('t.product_sub_category_id', $this->product_sub_category_id);
        $criteria->compare('t.unit_id', $this->unit_id);
        $criteria->compare('t.status', 'Active');

        $criteria->addCondition("EXISTS (
            SELECT SUM(stock_in + stock_out) AS total_stock
            FROM " . InventoryDetail::model()->tableName() . " i
            INNER JOIN " . Warehouse::model()->tableName() . " w ON w.id = i.warehouse_id
            WHERE t.id = i.product_id AND w.status = 'Active' AND i.transaction_date BETWEEN '" . AppParam::BEGINNING_TRANSACTION_DATE . "' AND :end_date
            HAVING SUM(stock_in + stock_out) {$stockOperator} 0
        )");
        $criteria->params[':end_date'] = $endDate;

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 25,
                'currentPage' => $pageNumber - 1,
            ),
        ));
    }

    public function getInventoryTotalQuantitiesByPeriodic($endDate) {
        $sql = "SELECT w.branch_id, COALESCE(SUM(i.stock_in + i.stock_out), 0) AS total_stock, COALESCE(SUM((i.stock_in + i.stock_out) * i.purchase_price), 0) AS stock_amount
                FROM " . InventoryDetail::model()->tableName() . " i
                INNER JOIN " . Warehouse::model()->tableName() . " w ON w.id = i.warehouse_id
                WHERE i.product_id = :product_id AND w.status = 'Active' AND i.transaction_date BETWEEN '" . AppParam::BEGINNING_TRANSACTION_DATE . "' AND :end_date
                GROUP BY w.branch_id";

        $resultSet = Yii::app()->db->createCommand($sql)->queryAll(true, array(
            ':product_id' => $this->id,
            ':end_date' => $endDate
        ));

        return $resultSet;
    }

    public function searchBySaleEstimation($endDate) {

        $criteria = new CDbCriteria;

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.code', $this->code, true);
        $criteria->compare('t.manufacturer_code', $this->manufacturer_code, true);
        $criteria->compare('t.name', $this->name, true);
        $criteria->compare('t.brand_id', $this->brand_id);
        $criteria->compare('t.sub_brand_id', $this->sub_brand_id);
        $criteria->compare('t.sub_brand_series_id', $this->sub_brand_series_id);
        $criteria->compare('t.product_master_category_id', $this->product_master_category_id);
        $criteria->compare('t.product_sub_master_category_id', $this->product_sub_master_category_id);
        $criteria->compare('t.product_sub_category_id', $this->product_sub_category_id);
        $criteria->compare('t.unit_id', $this->unit_id);
        $criteria->compare('t.status', 'Active');

        $criteria->addCondition("EXISTS (
            SELECT SUM(stock_in + stock_out) AS total_stock
            FROM " . InventoryDetail::model()->tableName() . " i
            INNER JOIN " . Warehouse::model()->tableName() . " w ON w.id = i.warehouse_id
            WHERE t.id = i.product_id AND w.status = 'Active' AND i.transaction_date BETWEEN '" . AppParam::BEGINNING_TRANSACTION_DATE . "' AND :end_date
            HAVING SUM(stock_in + stock_out) > 0
        )");
        $criteria->params[':end_date'] = $endDate;

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getMasterSubCategoryCode() {
        $masterCategoryCode = empty($this->productMasterCategory) ? '' : $this->productMasterCategory->code;
        $subMasterCategory = empty($this->productSubMasterCategory) ? '' : $this->productSubMasterCategory->code;
        $subCategoryCode = empty($this->productSubCategory) ? '' : $this->productSubCategory->code;

        return $masterCategoryCode . $subMasterCategory . $subCategoryCode;
    }

    public function getAverageCogs() {
        
        $sql = "
            SELECT COALESCE(SUM(unit_price * quantity) / SUM(quantity), 0) as cogs
            FROM " . TransactionPurchaseOrderDetail::model()->tableName() . " d
            INNER JOIN " . TransactionPurchaseOrder::model()->tableName() . " h ON h.id = d.purchase_order_id
            WHERE d.product_id = :product_id AND h.purchase_order_date > '" . AppParam::BEGINNING_TRANSACTION_DATE . "'
            GROUP BY d.product_id
        ";

        $value = Yii::app()->db->createCommand($sql)->queryScalar(array(
            ':product_id' => $this->id,
        ));

        return ($value === false) ? 0 : $value;
    }
    
}
