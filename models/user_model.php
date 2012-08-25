<?php
class User_model extends IIC_Model 
{
	// ------------------------------------------------------------------------
	// Setup database
	// ------------------------------------------------------------------------
	
	protected $table = array(
						       'main'	=> 'backoffice_user',
						       'group'	=> 'backoffice_user_group',
						       'role'	=> 'backoffice_user_role'
						  	);
	
	// ------------------------------------------------------------------------
	
    /**
     * Get user list
     *
     * @access  public
     * @param   int     $limit
     * @param   int     $offset    
     * @param   string  $select     
     * @param   array   $where     
     * @param   string	$order_by     
     * @param   string	$order_direction      
     * @return  array
     */
    
    function list_content($limit = 25, $offset = 0, $select = NULL, $where = NULL, $order_by = NULL, $order_direction = 'ASC')
	{		
    	// Select
    	if($select != '')
		{
			$this->db->select($select);
		}  
		
    	// Where
    	if(is_array($where))
		{
			$this->db->where($where);
		}   
		
		// Ordering
		if(is_null($order_by))
		{
			$this->db->order_by('id', 'DESC');
		}  
		else
		{
			$this->db->order_by($order_by, $order_direction);
		}
		
		$this->db->select(
							$this->table['main'].'.id, '.
							$this->table['main'].'.name, '.
							$this->table['main'].'.username, '.
							$this->table['group'].'.name as "group", '.
							$this->table['role'].'.name as "role"'
						 );
						 
		$this->db->join(
							$this->table['group'], 
							$this->table['main'].'.id_group = '.$this->table['group'].'.id'
					   );
		
		$this->db->join(
							$this->table['role'],
							$this->table['main'].'.id_role = '.$this->table['role'].'.id'
					   );
					   
    	$_query = $this->db->get($this->table['main'], $limit, $offset);
			
		return $_query->result_array();
	}

	// ------------------------------------------------------------------------
	
	/**
	 * Search user group
	 *
	 * @access	public
	 * @param 	string		$keyword		
	 * @param 	string		$criteria	
	 * @return	array
	 */
	
	function search_user($keyword, $criteria)
	{	
		if($criteria == 'id_group')
		{
			$_criteria = $this->table['group'].'.name';
		}
		else if($criteria == 'id_role')
		{
			$_criteria= $this->table['role'].'.name';
		}
		else
		{
			$_criteria = $this->table['user'].'.'.$criteria;
		}
	
		$this->db->select(
							$this->table['main'].'.id, '.
							$this->table['main'].'.name, '.
							$this->table['main'].'.username, '.
							$this->table['group'].'.name as "group", '.
							$this->table['role'].'.name as "role"'
						 );
						 
		$this->db->join(
							$this->table['group'], 
							$this->table['main'].'."id_group" = '.$this->table['group'].'.id'
						);
		
		$this->db->join(
							$this->table['role'], 
							$this->table['main'].'.id_role = '.$this->table['role'].'.id'
						);			
		
		$this->db->like($_criteria, $keyword);
		
		$_query = $this->db->get($this->table['main']);
		
		return $_query->result();
	}	
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get user detail by username
	 *
	 * @access	public
	 * @param 	sting	$username
	 * @return	array
	 */
	  
	function get_detail_by_username($username)  
	{  
		$this->db->select(
							$this->table['main'].'.*, '.
							$this->table['group'].'.name as "group", '.
							$this->table['role'].'.name as "role"'
						 );
						 
 		$this->db->join(
							$this->table['group'], 
							$this->table['main'].'.id_group = '.$this->table['group'].'.id'
					   );
						
 		$this->db->join(
							$this->table['role'],
							$this->table['main'].'.id_role = '.$this->table['role'].'.id'
					   );
							
		$this->db->where($this->table['main'].'.username', $username); 
		
		$_query = $this->db->get($this->table['main']);
		
		return $_query->row_array();  
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Validate user
 	 *
 	 * @access	public
 	 */
 	 
 	function validate($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		
		$_query = $this->db->get($this->table['main']);
		
		$_validation = (count($_query->row_array()) > 0) ? TRUE : FALSE;
		
		return $_validation;
	}
	
	// ------------------------------------------------------------------------
}


/* End of file user_model.php */
/* Location: ./application/modules/backoffice/model/user_model.php */