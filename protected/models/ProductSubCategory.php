<?php

/**
 * This is the model class for table "rims_product_sub_category".
 *
 * The followings are the available columns in table 'rims_product_sub_category':
 * @property integer $id
 * @property integer $product_master_category_id
 * @property integer $product_sub_master_category_id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $status
 * @property integer $user_id
 * @property integer $user_id_approval
 * @property string $date_approval
 * @property string $date_posting
 * @property integer $is_approved
 *
 * The followings are the available model relations:
 * @property Product[] $products
 */
class ProductSubCategory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rims_product_sub_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_master_category_id, product_sub_master_category_id, code, name, status, user_id, date_posting', 'required'),
			array('product_master_category_id, product_sub_master_category_id, user_id, user_id_approval, is_approved', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>20),
			array('name', 'length', 'max'=>30),
			array('status', 'length', 'max'=>10),
			array('description, date_approval', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, product_master_category_id, product_sub_master_category_id, code, name, description, status, user_id, user_id_approval, date_approval, date_posting, is_approved', 'safe', 'on'=>'search'),
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
			'products' => array(self::HAS_MANY, 'Product', 'product_sub_category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'product_master_category_id' => 'Product Master Category',
			'product_sub_master_category_id' => 'Product Sub Master Category',
			'code' => 'Code',
			'name' => 'Name',
			'description' => 'Description',
			'status' => 'Status',
			'user_id' => 'User',
			'user_id_approval' => 'User Id Approval',
			'date_approval' => 'Date Approval',
			'date_posting' => 'Date Posting',
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
		$criteria->compare('product_master_category_id',$this->product_master_category_id);
		$criteria->compare('product_sub_master_category_id',$this->product_sub_master_category_id);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_id_approval',$this->user_id_approval);
		$criteria->compare('date_approval',$this->date_approval,true);
		$criteria->compare('date_posting',$this->date_posting,true);
		$criteria->compare('is_approved',$this->is_approved);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductSubCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
