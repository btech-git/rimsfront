<?php

/**
 * This is the model class for table "rims_registration_memo".
 *
 * The followings are the available columns in table 'rims_registration_memo':
 * @property integer $id
 * @property string $memo
 * @property string $date_time
 * @property integer $user_id
 * @property integer $registration_transaction_id
 *
 * The followings are the available model relations:
 * @property RegistrationTransaction $registrationTransaction
 * @property Users $user
 */
class RegistrationMemo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rims_registration_memo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('memo, date_time, user_id, registration_transaction_id', 'required'),
			array('user_id, registration_transaction_id', 'numerical', 'integerOnly'=>true),
			array('memo', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, memo, date_time, user_id, registration_transaction_id', 'safe', 'on'=>'search'),
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
			'registrationTransaction' => array(self::BELONGS_TO, 'RegistrationTransaction', 'registration_transaction_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'memo' => 'Memo',
			'date_time' => 'Date Time',
			'user_id' => 'User',
			'registration_transaction_id' => 'Registration Transaction',
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
		$criteria->compare('memo',$this->memo,true);
		$criteria->compare('date_time',$this->date_time,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('registration_transaction_id',$this->registration_transaction_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RegistrationMemo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
