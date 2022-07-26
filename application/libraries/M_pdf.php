<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
include_once APPPATH.'/third_party/mpdf/mpdf.php';
 
class M_pdf {
 
public $param;
public $pdf;

	public function __construct($param = "'utf-8', 'c', 'A5-L'")
	{
	    $this->param =$param;
	    //$this->pdf = new mPDF($this->param);
		$this->pdf = new mPDF('utf-8', array(300,200),"'c', 'A5-L'");
	}
}

?>