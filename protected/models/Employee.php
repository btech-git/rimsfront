<?php

/**
 * This is the model class for table "rims_employee".
 *
 * The followings are the available columns in table 'rims_employee':
 * @property integer $id
 * @property string $name
 * @property string $recruitment_date
 * @property string $local_address
 * @property string $home_address
 * @property integer $province_id
 * @property integer $city_id
 * @property integer $home_province
 * @property integer $home_city
 * @property string $sex
 * @property string $email
 * @property string $id_card
 * @property string $driving_license
 * @property integer $branch_id
 * @property string $status
 * @property string $salary_type
 * @property string $basic_salary
 * @property string $payment_type
 * @property string $code
 * @property string $availability
 * @property string $skills
 * @property integer $registration_service_id
 * @property integer $is_deleted
 * @property string $deleted_at
 * @property integer $deleted_by
 * @property string $off_day
 * @property string $mobile_phone_number
 * @property string $marriage_status
 * @property integer $children_quantity
 * @property string $emergency_contact_relationship
 * @property integer $division_id
 * @property integer $position_id
 * @property integer $level_id
 * @property integer $employee_head_id
 * @property string $mother_name
 * @property string $bank_name
 * @property string $birth_place
 * @property string $emergency_contact_name
 * @property string $religion
 * @property string $family_card_number
 * @property string $bank_account_number
 * @property string $tax_registration_number
 * @property string $school_degree
 * @property string $school_subject
 * @property string $employment_type
 * @property string $emergency_contact_mobile_phone
 * @property string $birth_date
 * @property string $emergency_contact_address
 * @property integer $onleave_allocation
 * @property integer $user_id
 * @property string $clock_in_time
 * @property string $clock_out_time
 *
 * The followings are the available model relations:
 * @property RegistrationService[] $registrationServices
 * @property RegistrationService[] $registrationServices1
 * @property RegistrationService[] $registrationServices2
 * @property RegistrationService[] $registrationServices3
 * @property RegistrationService[] $registrationServices4
 */
class Employee extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rims_employee';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, recruitment_date, sex, branch_id, user_id, clock_in_time, clock_out_time', 'required'),
			array('province_id, city_id, home_province, home_city, branch_id, registration_service_id, is_deleted, deleted_by, children_quantity, division_id, position_id, level_id, employee_head_id, onleave_allocation, user_id', 'numerical', 'integerOnly'=>true),
			array('name, mother_name, bank_name, birth_place, emergency_contact_name', 'length', 'max'=>100),
			array('sex, status, basic_salary', 'length', 'max'=>10),
			array('email, mobile_phone_number, marriage_status, emergency_contact_relationship', 'length', 'max'=>60),
			array('id_card, driving_license, off_day, religion, family_card_number, bank_account_number, tax_registration_number', 'length', 'max'=>30),
			array('salary_type, payment_type, code, school_degree, school_subject, employment_type, emergency_contact_mobile_phone', 'length', 'max'=>50),
			array('availability', 'length', 'max'=>5),
			array('local_address, home_address, skills, deleted_at, birth_date, emergency_contact_address', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, recruitment_date, local_address, home_address, province_id, city_id, home_province, home_city, sex, email, id_card, driving_license, branch_id, status, salary_type, basic_salary, payment_type, code, availability, skills, registration_service_id, is_deleted, deleted_at, deleted_by, off_day, mobile_phone_number, marriage_status, children_quantity, emergency_contact_relationship, division_id, position_id, level_id, employee_head_id, mother_name, bank_name, birth_place, emergency_contact_name, religion, family_card_number, bank_account_number, tax_registration_number, school_degree, school_subject, employment_type, emergency_contact_mobile_phone, birth_date, emergency_contact_address, onleave_allocation, user_id, clock_in_time, clock_out_time', 'safe', 'on'=>'search'),
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
			'registrationServices' => array(self::HAS_MANY, 'RegistrationService', 'start_mechanic_id'),
			'registrationServices1' => array(self::HAS_MANY, 'RegistrationService', 'finish_mechanic_id'),
			'registrationServices2' => array(self::HAS_MANY, 'RegistrationService', 'pause_mechanic_id'),
			'registrationServices3' => array(self::HAS_MANY, 'RegistrationService', 'resume_mechanic_id'),
			'registrationServices4' => array(self::HAS_MANY, 'RegistrationService', 'assign_mechanic_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'recruitment_date' => 'Recruitment Date',
			'local_address' => 'Local Address',
			'home_address' => 'Home Address',
			'province_id' => 'Province',
			'city_id' => 'City',
			'home_province' => 'Home Province',
			'home_city' => 'Home City',
			'sex' => 'Sex',
			'email' => 'Email',
			'id_card' => 'Id Card',
			'driving_license' => 'Driving License',
			'branch_id' => 'Branch',
			'status' => 'Status',
			'salary_type' => 'Salary Type',
			'basic_salary' => 'Basic Salary',
			'payment_type' => 'Payment Type',
			'code' => 'Code',
			'availability' => 'Availability',
			'skills' => 'Skills',
			'registration_service_id' => 'Registration Service',
			'is_deleted' => 'Is Deleted',
			'deleted_at' => 'Deleted At',
			'deleted_by' => 'Deleted By',
			'off_day' => 'Off Day',
			'mobile_phone_number' => 'Mobile Phone Number',
			'marriage_status' => 'Marriage Status',
			'children_quantity' => 'Children Quantity',
			'emergency_contact_relationship' => 'Emergency Contact Relationship',
			'division_id' => 'Division',
			'position_id' => 'Position',
			'level_id' => 'Level',
			'employee_head_id' => 'Employee Head',
			'mother_name' => 'Mother Name',
			'bank_name' => 'Bank Name',
			'birth_place' => 'Birth Place',
			'emergency_contact_name' => 'Emergency Contact Name',
			'religion' => 'Religion',
			'family_card_number' => 'Family Card Number',
			'bank_account_number' => 'Bank Account Number',
			'tax_registration_number' => 'Tax Registration Number',
			'school_degree' => 'School Degree',
			'school_subject' => 'School Subject',
			'employment_type' => 'Employment Type',
			'emergency_contact_mobile_phone' => 'Emergency Contact Mobile Phone',
			'birth_date' => 'Birth Date',
			'emergency_contact_address' => 'Emergency Contact Address',
			'onleave_allocation' => 'Onleave Allocation',
			'user_id' => 'User',
			'clock_in_time' => 'Clock In Time',
			'clock_out_time' => 'Clock Out Time',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('recruitment_date',$this->recruitment_date,true);
		$criteria->compare('local_address',$this->local_address,true);
		$criteria->compare('home_address',$this->home_address,true);
		$criteria->compare('province_id',$this->province_id);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('home_province',$this->home_province);
		$criteria->compare('home_city',$this->home_city);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_card',$this->id_card,true);
		$criteria->compare('driving_license',$this->driving_license,true);
		$criteria->compare('branch_id',$this->branch_id);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('salary_type',$this->salary_type,true);
		$criteria->compare('basic_salary',$this->basic_salary,true);
		$criteria->compare('payment_type',$this->payment_type,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('availability',$this->availability,true);
		$criteria->compare('skills',$this->skills,true);
		$criteria->compare('registration_service_id',$this->registration_service_id);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('deleted_at',$this->deleted_at,true);
		$criteria->compare('deleted_by',$this->deleted_by);
		$criteria->compare('off_day',$this->off_day,true);
		$criteria->compare('mobile_phone_number',$this->mobile_phone_number,true);
		$criteria->compare('marriage_status',$this->marriage_status,true);
		$criteria->compare('children_quantity',$this->children_quantity);
		$criteria->compare('emergency_contact_relationship',$this->emergency_contact_relationship,true);
		$criteria->compare('division_id',$this->division_id);
		$criteria->compare('position_id',$this->position_id);
		$criteria->compare('level_id',$this->level_id);
		$criteria->compare('employee_head_id',$this->employee_head_id);
		$criteria->compare('mother_name',$this->mother_name,true);
		$criteria->compare('bank_name',$this->bank_name,true);
		$criteria->compare('birth_place',$this->birth_place,true);
		$criteria->compare('emergency_contact_name',$this->emergency_contact_name,true);
		$criteria->compare('religion',$this->religion,true);
		$criteria->compare('family_card_number',$this->family_card_number,true);
		$criteria->compare('bank_account_number',$this->bank_account_number,true);
		$criteria->compare('tax_registration_number',$this->tax_registration_number,true);
		$criteria->compare('school_degree',$this->school_degree,true);
		$criteria->compare('school_subject',$this->school_subject,true);
		$criteria->compare('employment_type',$this->employment_type,true);
		$criteria->compare('emergency_contact_mobile_phone',$this->emergency_contact_mobile_phone,true);
		$criteria->compare('birth_date',$this->birth_date,true);
		$criteria->compare('emergency_contact_address',$this->emergency_contact_address,true);
		$criteria->compare('onleave_allocation',$this->onleave_allocation);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('clock_in_time',$this->clock_in_time,true);
		$criteria->compare('clock_out_time',$this->clock_out_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Employee the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
