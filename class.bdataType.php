<?php

/*
 * Copyright (C) 2015 bened
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

const decimal_Point = '.';
const thousends_Step = ',';
const default_Money = '€';
const defaultDateformat = 'd.m.Y';
const defaultTimeformat = 'H:i';
const defaultDateTimeformat = 'd.m.Y H.i';


class dataType {

    const string = 'string';
    const money = 'money';
    const bool = 'bool';
    const real = 'real';
    const bit = 'bit';
    const email = 'email';
    const htmlvaluestring = 'htmlvaluestring';
    const ValueArraySEARCH = 'search';
    const ValueArrayREPLACE = 'replace';

    public $datatype = null;
    public $dataTypes = array('');
    public $value = null;
    public $moneyType = default_Money;
    public $dateFormatt = defaultDateformat;
    public $timeFormat = defaultTimeformat;
    public $dateTimeFormat = defaultDateTimeformat;
    public $dataValueArray = null;

    public function __construct($dataType = 'text', $dataValueArray = null) {
        $this->value = $value;
        $this->dataType = strtolower($dataType);
        $this->dataValueArray = $dataValueArray;
    }

    function setValue($value) {
        $this->value = $value;
    }

    function money($raw) {
        
        if ($raw == true){
            
        return (real) number_format($this->value, 2, decimal_Point, thousends_Step) ;
        }else{
            
        return (string) number_format($this->value, 2, decimal_Point, thousends_Step) . $this->moneyType;
        }
        
    }

    function string($raw= false) {
        return (string) $this->value;
    }

    private function defaultDataType($raw = false)  {
        return $this->value;
    }

    private function email($raw = false) {
        return (string) '<a onlick="' . $this->value . '">' . $this->value . '</a>';
    }

    function int($raw = false) {
        return (int) $this->value;
    }

    function real($raw = false) {
        return (double) $this->value;
    }

    function date($raw = false) {
        $date = new DateTime($this->value);
        return $date->format($this->dateFormat);
    }

    function dateTime($raw = false) {
        $date = new DateTime($this->value);
        return $date->format($this->dateTimeFormat);
    }

    function time($raw= false) {
        $date = new DateTime($this->value);
        return $date->format($this->timeFormat);
    }

    function bool($raw = false) {
        $value = $this->value;
        if ($value == null or $value == false or $value == 0 or $value == '' or $value == 'on') {
            $return = 0;
        } else {
            $return = 1;
        }
        return (int) $return;
    }

    function bit($raw = false) {
        $value = $this->value;
        if ($value == null or $value == false or $value == 0 or $value == '' or $value == 'on') {
            $return = false;
        } else {
            $return = true;
        }
        return (bool) $return;
    }

    function arrayReplace() {
        $this->dataValueArray;
        return (string) str_replace($this->dataValueArray['search'], $this->dataValueArray['replace'], $this->value);
    }

    function htmlvaluestring() {
        $this->dataValueArray;
        return (string) str_replace($this->dataValueArray['search'], $this->dataValueArray['replace'], $this->value);
    }

    function render($value ,$raw = false) {
        $this->setValue($value);
        if (method_exists(__CLASS__, $this->dataType)) {
            $dt = $this->dataType;
            $return = $this->$dt($raw);
        } else {
            $return = $this->defaultDataType();
        }


        return $return;
    }

}
