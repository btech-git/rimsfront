<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;
//    private $_branchId;

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $user = Users::model()->findByAttributes(array('username' => $this->username));

        if ($user === null || !$user->is_front_access) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if ($user->password !== md5($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->_id = $user->id;
            $this->username = $user->username;
            $this->errorCode = self::ERROR_NONE;
        }

        return !$this->errorCode;
    }

    /**
     * @return integer the ID of the user record
     */
    public function getId() {
        return $this->_id;
    }

//    public function setBranchId($branchId) {
//        $this->_branchId = $branchId;
//    }

//    private function checkRoles($roles, $user) {
//        $rolesValid = array_map(function($userRole) use ($roles) { return in_array($userRole, $roles); }, $user->roles);
//        return array_reduce($rolesValid, function($leftValid, $rightValid) { return $leftValid || $rightValid; }, false);
//    }
}
