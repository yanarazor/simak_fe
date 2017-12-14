<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Akademik
{
	var $CI;
    public function GetTahunAktif()
    {
    	$this->CI =& get_instance();
        $this->CI->load->model('tahunakademik/tahunakademik_model', null, true);
        $record =$this->CI->tahunakademik_model->getaktif();
			
        return $record;
    }
	 

}

?>