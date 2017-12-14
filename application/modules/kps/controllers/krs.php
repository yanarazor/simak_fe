<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * krs controller
 */
class krs extends Admin_Controller
{

	//--------------------------------------------------------------------


	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Kps.Krs.View');
		$this->lang->load('kps');
		
		Template::set_block('sub_nav', 'krs/_sub_nav');

		Assets::add_module_js('kps', 'kps.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{

		Template::set('toolbar_title', 'Manage kps');
		Template::render();
	}

	//--------------------------------------------------------------------



}