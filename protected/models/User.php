<?php

/**
 * This is the model class for table "rims_user".
 *
 * The followings are the available columns in table 'rims_user':
 * @property integer $id
 * @property integer $employee_id
 * @property string $username
 * @property string $password
 * @property string $last_logged_in
 * @property string $status
 * @property integer $created_by
 * @property string $created_date
 * @property integer $modified_by
 * @property string $modified_date
 * @property integer $is_deleted
 * @property string $session_key
 * @property string $session_expired
 * @property string $email
 * @property string $avatar
 */
class User extends CActiveRecord {

    public $roles = array();
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rims_user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, password, created_date', 'required'),
            array('employee_id, created_by, modified_by, is_deleted', 'numerical', 'integerOnly' => true),
            array('username, status', 'length', 'max' => 20),
            array('password', 'length', 'max' => 64),
            array('session_key', 'length', 'max' => 100),
            array('email', 'length', 'max' => 200),
            array('avatar', 'length', 'max' => 500),
            array('last_logged_in, modified_date, session_expired', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, employee_id, username, password, last_logged_in, status, created_by, created_date, modified_by, modified_date, is_deleted, session_key, session_expired, email, avatar', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'employee_id' => 'Employee',
            'username' => 'Username',
            'password' => 'Password',
            'last_logged_in' => 'Last Logged In',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'modified_by' => 'Modified By',
            'modified_date' => 'Modified Date',
            'is_deleted' => 'Is Deleted',
            'session_key' => 'Session Key',
            'session_expired' => 'Session Expired',
            'email' => 'Email',
            'avatar' => 'Avatar',
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
        $criteria->compare('employee_id', $this->employee_id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('last_logged_in', $this->last_logged_in, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('created_date', $this->created_date, true);
        $criteria->compare('modified_by', $this->modified_by);
        $criteria->compare('modified_date', $this->modified_date, true);
        $criteria->compare('is_deleted', $this->is_deleted);
        $criteria->compare('session_key', $this->session_key, true);
        $criteria->compare('session_expired', $this->session_expired, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('avatar', $this->avatar, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function afterFind() {
        parent::afterFind();

        $auth = Yii::app()->authManager;

        $authItems = array_keys($auth->getAuthItems(null, $this->id));
        $this->roles = empty($authItems) ? array() : array_combine($authItems, $authItems);
    }

    public function afterSave() {
        parent::afterSave();

        $auth = Yii::app()->authManager;

        if ($this->scenario === 'insert') {
            foreach ($this->roles as $role) {
                $auth->assign($role, $this->id);
            }
        } else {
            $authItems = array_keys($auth->getAuthItems(null, $this->id));
            $assignedRoles = empty($authItems) ? array() : array_combine($authItems, $authItems);

            foreach ($this->roles as $role) {
                if (!$auth->isAssigned($role, $this->id)) {
                    $auth->assign($role, $this->id);
                }

                unset($assignedRoles[$role]);
            }

            foreach ($assignedRoles as $role) {
                $auth->revoke($role, $this->id);
            }
        }
    }

}
