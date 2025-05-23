<?php

/**
 * This is the model class for table "{{unit}}".
 *
 * The followings are the available columns in table '{{unit}}':
 * @property integer $id
 * @property string $name
 * @property string $status
 *
 * The followings are the available model relations:
 * @property ProductUnit[] $productUnits
 * @property UnitConversion[] $unitConversions
 * @property UnitConversion[] $unitConversions1
 */
class Unit extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rims_unit';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, status', 'required'),
            array('name', 'length', 'max' => 30),
            array('status', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'productUnits' => array(self::HAS_MANY, 'ProductUnit', 'unit_id'),
            'unitConversions' => array(self::HAS_MANY, 'UnitConversion', 'unit_from_id'),
            'unitConversions1' => array(self::HAS_MANY, 'UnitConversion', 'unit_to_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('LOWER(status)', strtolower($this->status), FALSE);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Unit the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
