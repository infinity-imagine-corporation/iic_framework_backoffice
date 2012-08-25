<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends IIC_Controller 
{
	// ------------------------------------------------------------------------
	// Constructor
	// ------------------------------------------------------------------------
	
	function __construct()
	{
		parent::__construct();
		
		// Load model
		$this->load->model('user_model');
		
		// Set variable
		$this->module_config['module'] = 'user_form';
		$this->module_config['controller'] = 'user_form';
		$this->module_config['form'] = 'user_form';
		
		$this->content_model = $this->user_model;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * User 
	 *
	 * @access	public
	 */
	
	function index()
	{		
		// Check permission
		Modules::run('backoffice/auth/check_permission');	
		
		// Set module
		$_data['module']		= 'backoffice';
		$_data['controller']	= 'user';
		$_data['ajax_uri']		= 'content';
		$_data['page']			= 'user';
		$_data['template']		= 'backoffice/tpl_module_index';
		$_data['title']			= $this->lang->line('page_user');
		
		// Set navigator
		$_data['navigator'] = array();
		array_push($_data['navigator'], array('label' => $this->lang->line('home'),			'link' => 'backoffice'));
		array_push($_data['navigator'], array('label' => $this->lang->line('page_user'),	'link' => 'backoffice/user'));
		
		// Set table haed
		$_data['th'] = array();
		array_push($_data['th'], array('axis'=>'name',		'label' => $this->lang->line('name'),		'is_criteria' => TRUE));
		array_push($_data['th'], array('axis'=>'username',	'label' => $this->lang->line('username'),	'is_criteria' => TRUE));
		array_push($_data['th'], array('axis'=>'id_group',	'label' => $this->lang->line('page_group'),	'is_criteria' => TRUE));
		array_push($_data['th'], array('axis'=>'id_role',	'label' => $this->lang->line('page_role'),	'is_criteria' => TRUE));
		
		// Set pagination
		$this->load->library('pagination');
		
		$_data['content']['total'] = $this->content_model->count_content();

		$_config['base_url']	= site_url().'/'.$_data['module'].'/'.$_data['controller'].'/index/page/';
		$_config['total_rows']	= $_data['content']['total'];
		$_config['per_page']	= 25; 
		$_config['uri_segment']	= 5;
		
		$this->pagination->initialize($_config); 
		
		$_data['pagination'] = $this->pagination->create_links();
		
		// Display
		$this->load->view('main', $_data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * User group
	 *
	 * @access	public
	 */
	
	function group()
	{		
		echo Modules::run('backoffice/user_group/index');	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * User role
	 *
	 * @access	public
	 */
	
	function role()
	{		
		echo Modules::run('backoffice/user_role/index');	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Update content 
	 *
	 * @access	public
	 */
	
	function update_content()
	{
		$_data = $this->input->post();
		$_id = $_data['id'];
		
		unset($_data['id']);
				 
		$this->content_model->update_content($_id, $_data);
		
		// Get content data for update session
		$_content = $this->content_model->get_detail_by_contentname($this->input->post('contentname'));		
		
		// Update content session
		$this->content_model->set_session($_content);	
	}
	
	// ------------------------------------------------------------------------
}


/* End of file user.php */
/* Location: ./application/modules/backoffice/controllers/user.php */