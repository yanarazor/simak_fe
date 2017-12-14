<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Admin Controller
 *
 * This class provides a base class for all admin-facing controllers.
 * It automatically loads the form, form_validation and pagination
 * helpers/libraries, sets defaults for pagination and sets our
 * Admin Theme.
 *
 * @package    Bonfire
 * @subpackage MY_Controller
 * @category   Controllers
 * @author     Bonfire Dev Team
 * @link       http://guides.cibonfire.com/helpers/file_helpers.html
 *
 */
class Admin_Controller extends Authenticated_Controller
{
    protected $pager;
    protected $limit;

    //--------------------------------------------------------------------

    /**
     * Class constructor - setup paging and keyboard shortcuts as well as
     * load various libraries
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->library('template');
        $this->load->library('assets');
        $this->load->library('ui/contexts');

        // Pagination config
        $this->pager = array(
            'full_tag_open'     => '<div class="pagination pagination-right"><ul>',
            'full_tag_close'    => '</ul></div>',
            'next_link'         => '&rarr;',
            'prev_link'         => '&larr;',
            'next_tag_open'     => '<li>',
            'next_tag_close'    => '</li>',
            'prev_tag_open'     => '<li>',
            'prev_tag_close'    => '</li>',
            'first_tag_open'    => '<li>',
            'first_tag_close'   => '</li>',
            'last_tag_open'     => '<li>',
            'last_tag_close'    => '</li>',
            'cur_tag_open'      => '<li class="active"><a href="#">',
            'cur_tag_close'     => '</a></li>',
            'num_tag_open'      => '<li>',
            'num_tag_close'     => '</li>',
        );
        $this->limit = $this->settings_lib->item('site.list_limit');

        // load the keyboard shortcut keys
        $shortcut_data = array(
            'shortcuts' => config_item('ui.current_shortcuts'),
            'shortcut_keys' => $this->settings_lib->find_all_by('module', 'core.ui'),
        );
        Template::set('shortcut_data', $shortcut_data);

        // Profiler Bar?
        if (ENVIRONMENT == 'development')
        {
            if ($this->settings_lib->item('site.show_profiler') AND has_permission('Bonfire.Profiler.View'))
            {
                // Profiler bar?
                if ( ! $this->input->is_cli_request() AND ! $this->input->is_ajax_request())
                {
                    $this->load->library('Console');
                    $this->output->enable_profiler(TRUE);
                }
            }
        }
		$role = $this->current_user->role_id;
		if($role == "11" or $role == "8"){
			$nidn 			=  $this->current_user->nim;
			Template::set_theme("adminlte", 'junk');
			$this->load->model('pesan/pesan_model', null, true);
			$messages 	= $this->pesan_model->limit(20)->find_blmbaca("",$nidn);
			$totalmsg = 0;
			if(isset($messages) && is_array($messages) && count($messages)){
				$totalmsg = count($messages);
			}
			Template::set('totalmsg', $totalmsg);
			Template::set('messages', $messages);
		}else{	
        	// Basic setup
        	Template::set_theme($this->config->item('template.admin_theme'), 'junk');
        }
    }//end construct()

    //--------------------------------------------------------------------

}

/* End of file Admin_Controller.php */
/* Location: ./application/core/Admin_Controller.php */