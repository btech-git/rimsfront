<?php

/**
 * This is the model class for table "rims_registration_realization_process".
 *
 * The followings are the available columns in table 'rims_registration_realization_process':
 * @property integer $id
 * @property integer $registration_transaction_id
 * @property string $name
 * @property integer $checked
 * @property integer $checked_by
 * @property string $checked_date
 * @property string $detail
 * @property integer $service_id
 * @property integer $registration_service_id
 */
class RegistrationRealizationProcess extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rims_registration_realization_process';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('registration_transaction_id', 'required'),
			array('registration_transaction_id, checked, checked_by, service_id, registration_service_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('checked_date, detail', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, registration_transaction_id, name, checked, checked_by, checked_date, detail, service_id, registration_service_id', 'safe', 'on'=>'search'),
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
			'registration_transaction_id' => 'Registration Transaction',
			'name' => 'Name',
			'checked' => 'Checked',
			'checked_by' => 'Checked By',
			'checked_date' => 'Checked Date',
			'detail' => 'Detail',
			'service_id' => 'Service',
			'registration_service_id' => 'Registration Service',
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
		$criteria->compare('registration_transaction_id',$this->registration_transaction_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('checked',$this->checked);
		$criteria->compare('checked_by',$this->checked_by);
		$criteria->compare('checked_date',$this->checked_date,true);
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('registration_service_id',$this->registration_service_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RegistrationRealizationProcess the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
