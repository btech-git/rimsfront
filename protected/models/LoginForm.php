<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel {

    public $username;
    public $password;
    public $branchId;
    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            // username and password are required
            array('username, password, branchId', 'required'),
            array('username', 'exists'),
            array('branchId', 'assigned'),
            // password needs to be authenticated
            array('password', 'authenticate'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array();
    }
    
    public function exists($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = Users::model()->findByAttributes(array('username' => $this->username));
            if ($user === null) {
                $this->addError("username", "Username is not found!");
            }
        }
    }
    
    public function assigned($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = Users::model()->findByAttributes(array('username' => $this->username));
            $userBranches = UserBranch::model()->findAllByAttributes(array('users_id' => $user->id));
            $userBranchIds = array_map(function($userBranch) { return $userBranch->branch_id; }, $userBranches);
            if (!in_array($this->branchId, $userBranchIds)) {
                $this->addError("branchId", "Branch is not assigned to user.");
            }
        }
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params) {
        if (!$this->hasErrors()) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            if (!$this->_identity->authenticate()) {
                $this->addError('password', 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login() {
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            $userBranches = UserBranch::model()->findAllByAttributes(array('users_id' => $this->_identity->getId()));
            $branchIds = array_map(function ($userBranch) {
                return $userBranch->branch_id;
            }, $userBranches);
            $this->_identity->setState('branch_ids', $branchIds);
            $this->_identity->setState('branch_id', $this->branchId);
            Yii::app()->user->login($this->_identity, 36000);
            return true;
        } else {
            return false;
        }
    }

}
