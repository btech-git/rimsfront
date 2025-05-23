<?php

/**
 * This is the model class for table "rims_warehouse".
 *
 * The followings are the available columns in table 'rims_warehouse':
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property integer $row
 * @property integer $column
 * @property string $status
 * @property integer $branch_id
 * @property string $date_approval
 * @property integer $is_approved
 * @property integer $user_id
 * @property string $created_datetime
 */
class Warehouse extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rims_warehouse';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, name, description, row, column, user_id, created_datetime', 'required'),
			array('row, column, branch_id, is_approved, user_id', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>20),
			array('name', 'length', 'max'=>50),
			array('description', 'length', 'max'=>100),
			array('status', 'length', 'max'=>10),
			array('date_approval', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, code, name, description, row, column, status, branch_id, date_approval, is_approved, user_id, created_datetime', 'safe', 'on'=>'search'),
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
			'code' => 'Code',
			'name' => 'Name',
			'description' => 'Description',
			'row' => 'Row',
			'column' => 'Column',
			'status' => 'Status',
			'branch_id' => 'Branch',
			'date_approval' => 'Date Approval',
			'is_approved' => 'Is Approved',
			'user_id' => 'User',
			'created_datetime' => 'Created Datetime',
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
		$criteria->compare('row',$this->row);
		$criteria->compare('column',$this->column);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('branch_id',$this->branch_id);
		$criteria->compare('date_approval',$this->date_approval,true);
		$criteria->compare('is_approved',$this->is_approved);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('created_datetime',$this->created_datetime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Warehouse the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
