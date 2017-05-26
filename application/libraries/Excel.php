<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
//require_once APPPATH."/libraries/phpexcel/PHPExcel.php";

require_once APPPATH."/third_party/PHPExcel.php";
 
class Excel extends PHPExcel {
  
    public function __construct() {
		parent::__construct();
    /** PHPExcel */
//require_once 'phpexcel/PHPExcel.php';
/** PHPExcel_IOFactory */
//require_once 'phpexcel/PHPExcel/IOFactory.php';
  }
  
}