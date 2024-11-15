<?php

class RoleItem  {

    public static function all() {

        $sql = "SELECT name FROM AuthItem2";

        $resultSet = Yii::app()->db->createCommand($sql)->queryAll();

        return array_map(function($row) { return $row['name']; }, $resultSet);
    }
}
