<?php

/**
 * This is the model class for table "rims_registration_product".
 *
 * The followings are the available columns in table 'rims_registration_product':
 * @property integer $id
 * @property integer $registration_transaction_id
 * @property integer $product_id
 * @property integer $sale_estimation_product_detail_id
 * @property string $quantity
 * @property string $retail_price
 * @property string $hpp
 * @property string $recommended_selling_price
 * @property string $sale_price
 * @property string $discount
 * @property string $total_price
 * @property string $discount_type
 * @property string $quantity_movement
 * @property string $quantity_movement_left
 * @property integer $is_material
 * @property string $quantity_receive
 * @property string $quantity_receive_left
 * @property string $note
 *
 * The followings are the available model relations:
 * @property RegistrationTransaction $registrationTransaction
 * @property Product $product
 */
class RegistrationProduct extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rims_registration_product';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('registration_transaction_id, product_id, is_material', 'numerical', 'integerOnly' => true),
            array('quantity, quantity_movement, quantity_movement_left, quantity_receive, quantity_receive_left', 'length', 'max' => 10),
            array('retail_price, hpp, recommended_selling_price, sale_price, discount, total_price', 'length', 'max' => 18),
            array('discount_type', 'length', 'max' => 30),
            array('note', 'length', 'max' => 100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, registration_transaction_id, product_id, quantity, retail_price, hpp, recommended_selling_price, sale_price, discount, total_price, discount_type, quantity_movement, quantity_movement_left, is_material, quantity_receive, quantity_receive_left, note', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'registrationTransaction' => array(self::BELONGS_TO, 'RegistrationTransaction', 'registration_transaction_id'),
            'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'registration_transaction_id' => 'Registration Transaction',
            'product_id' => 'Product',
            'quantity' => 'Quantity',
            'retail_price' => 'Retail Price',
            'hpp' => 'Hpp',
            'recommended_selling_price' => 'Recommended Selling Price',
            'sale_price' => 'Sale Price',
            'discount' => 'Discount',
            'total_price' => 'Total Price',
            'discount_type' => 'Discount Type',
            'quantity_movement' => 'Quantity Movement',
            'quantity_movement_left' => 'Quantity Movement Left',
            'is_material' => 'Is Material',
            'quantity_receive' => 'Quantity Receive',
            'quantity_receive_left' => 'Quantity Receive Left',
            'note' => 'Note',
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
        $criteria->compare('registration_transaction_id', $this->registration_transaction_id);
        $criteria->compare('product_id', $this->product_id);
        $criteria->compare('quantity', $this->quantity, true);
        $criteria->compare('retail_price', $this->retail_price, true);
        $criteria->compare('hpp', $this->hpp, true);
        $criteria->compare('recommended_selling_price', $this->recommended_selling_price, true);
        $criteria->compare('sale_price', $this->sale_price, true);
        $criteria->compare('discount', $this->discount, true);
        $criteria->compare('total_price', $this->total_price, true);
        $criteria->compare('discount_type', $this->discount_type, true);
        $criteria->compare('quantity_movement', $this->quantity_movement, true);
        $criteria->compare('quantity_movement_left', $this->quantity_movement_left, true);
        $criteria->compare('is_material', $this->is_material);
        $criteria->compare('quantity_receive', $this->quantity_receive, true);
        $criteria->compare('quantity_receive_left', $this->quantity_receive_left, true);
        $criteria->compare('note', $this->note, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return RegistrationProduct the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getTotalBeforeDiscount() {
        
        return $this->quantity * $this->sale_price;
    }

    public function getDiscountAmount() {

        return ($this->discount_type == 'Nominal') ? $this->discount : $this->quantity * $this->sale_price * $this->discount / 100;
    }

    public function getTotalPrice() {

        return $this->quantity * $this->sale_price - $this->discountAmount;
    }
    
}
