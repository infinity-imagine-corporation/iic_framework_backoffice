<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_region extends MX_Controller {
    
    // -------------------------------------------------------------------------
    // Variable
    // -------------------------------------------------------------------------

    protected $module = 'region';
    protected $result = array();

    // -------------------------------------------------------------------------
    // Constructor
    // -------------------------------------------------------------------------
    
    function __construct()
    {
        parent::__construct();
    }

    // -------------------------------------------------------------------------

    public function test_create_content()
    {
        $content = array(
                            'name' => 'test create content'
                        );
        
        $create_result = Modules::run('backoffice/'.$this->module.'/create_content', $content);
        $this->result['create_content'] = $create_result;

        $content_form_db = Modules::run('backoffice/'.$this->module.'/get_content', $create_result);

        $this->unit->run($create_result, 'is_int', 
            'Test create_content must return content id', $create_result);

        $this->unit->run($content_form_db['name'], $content['name'], 
            'Test create_content is save name', $content_form_db['name']);
    }
    
    // -------------------------------------------------------------------------

        public function test_get_content()
    {
        $get_result = Modules::run('backoffice/'.$this->module.'/get_content', 
            $this->result['create_content']);

        $this->result['get_content'] = $get_result;

        $this->unit->run($get_result, 'is_array', 'Test get_content is return array', $get_result);

        $this->unit->run(isset($get_result['id']), 'is_true', 
            'Test get_content is return field id', $get_result['id']);

        $this->unit->run(isset($get_result['name']), 'is_true', 
            'Test get_content is return field name', $get_result['name']);
    }

    // -------------------------------------------------------------------------

    public function test_update_content()
    {
        $content = array(
                            'id' => $this->result['create_content'],
                            'name' => 'test update content'
                        );

        $update_result = Modules::run('backoffice/'.$this->module.'/update_content', $content);
        $this->result['update_content'] = $update_result;

        $this->unit->run($update_result, 'Updated', 
            'Test update_content is return Updated', $update_result);

        $content_form_db = Modules::run('backoffice/'.$this->module.'/get_content', $this->result['create_content']);

        $this->unit->run($content_form_db['name'], $content['name'], 
            'Test update_content is save name', $content_form_db['name']);
    }
    
    // -------------------------------------------------------------------------

    public function test_list_content()
    {
        $content = array(
                            'name' => 'test create name'
                        );

        // Insert 2 rows
        Modules::run('backoffice/'.$this->module.'/create_content', $content);
        Modules::run('backoffice/'.$this->module.'/create_content', $content);

        $list_result = Modules::run('backoffice/'.$this->module.'/list_content');
        $this->result['list_content'] = $list_result;

        $get_result = Modules::run('backoffice/'.$this->module.'/get_content', $this->result['create_content']);

        $this->unit->run($list_result, 'is_array', 
            'Test list_content is return array', $list_result);

        $this->unit->run(count($list_result), '3', 
            'Test list_content is return 3 rows', count($list_result));

        $this->unit->run($list_result[2], $get_result, 
            'Test list_content is return correct fields', $list_result[2]);
    }
    
    // -------------------------------------------------------------------------

    public function test_sort_content()
    {
        $sort_result = Modules::run('backoffice/'.$this->module.'/sort_content', 'id', 'DESC');

        $this->unit->run($sort_result, 'is_array', 
            'Test sort_content is return array', $sort_result);

        $this->unit->run($sort_result, $this->result['list_content'], 
            'Test sort_content can order by DESC', $sort_result);

        $sort_result = Modules::run('backoffice/'.$this->module.'/sort_content', 'id', 'ASC');

        $this->unit->run($sort_result, array_reverse($this->result['list_content']), 
            'Test sort_content can order by ASC', $sort_result);
    }
    
    // -------------------------------------------------------------------------

    public function test_search_content()
    {
        $search_result = Modules::run('backoffice/'.$this->module.'/search_content', 'name', 'update');

        $this->unit->run($search_result, 'is_array', 
            'Test search_content is return array', $search_result);

        $this->unit->run(count($search_result), '1', 
            'Test search_content will return only matched content', $search_result);

        $this->unit->run(strpos($search_result[0]['name'], 'update'), 'is_int', 
            'Test search_content result will contain keyword', 
            strpos($search_result[0]['name'], 'update'));
    }

    // -------------------------------------------------------------------------

    public function test_delete_content()
    {
        $list_result = Modules::run('backoffice/'.$this->module.'/list_content');
        $id_list = array();

        foreach($list_result as $value)
        {
            array_push($id_list, $value['id']);
        }

        $delete_result = Modules::run('backoffice/'.$this->module.'/delete_content', $id_list);

        $this->unit->run($delete_result, count($id_list), 
            'Test delete_content is return number of deteted content', $delete_result);

        $list_result = Modules::run('backoffice/'.$this->module.'/list_content');

        $this->unit->run(count($list_result), 0, 
            'Test delete_content is deteted content', count($list_result));
    }
    
    // -------------------------------------------------------------------------
}

    
/* End of file test_student_status.php */
/* Location: application/modules/tests/controllers/test_student_status.php */