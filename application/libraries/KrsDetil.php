<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class KrsDetil
{
	var $CI;
    public function getdetilkrs($sms,$mhs)
    {
    	$this->CI =& get_instance();
    	//$this->CI->load->model('predikat/predikat_model', null, true);
		$this->CI->load->model('datakrs/datakrs_model', null, true);
        $record =$this->CI->datakrs_model->find_krsprint($sms,$mhs);
        return $record;
    }
	 

}

?>