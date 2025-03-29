<?php

/**
 * This is the model class for table "rims_vehicle_condition_recommendation".
 *
 * The followings are the available columns in table 'rims_vehicle_condition_recommendation':
 * @property integer $id
 * @property string $initial_condition
 * @property string $initial_recommendation
 * @property string $initial_date
 * @property string $initial_time
 * @property string $final_condition
 * @property string $final_recommendation
 * @property string $final_date
 * @property string $final_time
 * @property string $note
 * @property integer $vehicle_id
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property Vehicle $vehicle
 * @property Users $user
 */
class VehicleConditionRecommendation extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rims_vehicle_condition_recommendation';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('initial_condition, initial_recommendation, initial_date, initial_time, vehicle_id, user_id', 'required'),
            array('vehicle_id, user_id', 'numerical', 'integerOnly' => true),
            array('final_condition, final_recommendation, final_date, final_time, note', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, initial_condition, initial_recommendation, initial_date, initial_time, final_condition, final_recommendation, final_date, final_time, note, vehicle_id, user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'vehicle' => array(self::BELONGS_TO, 'Vehicle', 'vehicle_id'),
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'initial_condition' => 'Initial Condition',
            'initial_recommendation' => 'Initial Recommendation',
            'initial_date' => 'Initial Date',
            'initial_time' => 'Initial Time',
            'final_condition' => 'Final Condition',
            'final_recommendation' => 'Final Recommendation',
            'final_date' => 'Final Date',
            'final_time' => 'Final Tiime',
            'note' => 'Note',
            'vehicle_id' => 'Vehicle',
            'user_id' => 'User',
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
        $criteria->compare('initial_condition', $this->initial_condition, true);
        $criteria->compare('initial_recommendation', $this->initial_recommendation, true);
        $criteria->compare('initial_date', $this->initial_date, true);
        $criteria->compare('initial_time', $this->initial_time, true);
        $criteria->compare('final_condition', $this->final_condition, true);
        $criteria->compare('final_recommendation', $this->final_recommendation, true);
        $criteria->compare('final_date', $this->final_date, true);
        $criteria->compare('final_time', $this->final_time, true);
        $criteria->compare('note', $this->note, true);
        $criteria->compare('vehicle_id', $this->vehicle_id);
        $criteria->compare('user_id', $this->user_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return VehicleConditionRecommendation the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
