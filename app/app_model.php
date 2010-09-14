<?php

class AppModel extends Model {
    
    var $appConfigurations;

    function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
        $this->appConfigurations = Configure::read('App');
    }

    function matchFields($data = array(), $compare_field) {
        foreach ($data as $key => $value) {
            $v1 = $value;

            if (!empty($this->data[$this->name][$compare_field])) {
                $v2 = $this->data[$this->name][$compare_field];
                if ($v1 !== $v2) {
                    return false;
                } else {
                    continue;
                }
            } else {
                continue;
            }
        }
        return true;
    }

    function checkRut($data, $fieldName) {
        $val = array_shift(array_values($data));
        if (!empty($val)) {
            $rut = strtoupper(trim($val));
            if (strlen($rut)>9) {
                return false;
            }

            if (!preg_match('/^([0-9])+\-([K0-9])+$/', $rut)) {
                return false;
            }

            while($rut < 9) {
                $rut = "0".$rut;
            }
        }
    }
                 
}
