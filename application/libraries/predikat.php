<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Predikat
{
	var $CI;
    public function getpredikat($ipk)
    {
    	$this->CI =& get_instance();
		$ipk = TRIM($ipk);
        $this->CI->load->model('predikat/predikat_model', null, true);
        $record =$this->CI->predikat_model->find_predikat($ipk);

        return $record;
    }
	 

}

?>