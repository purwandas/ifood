<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datatable extends CI_Model {

	private function _get_datatables_query($table='',$column='',$odb='')
	{
		
		$this->db->from($table);
		$i = 0;
	
		foreach ($column as $item) 
		{
			if($_POST['search']['value']) 
			{
				
				if($i===0) 
				{
					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($column) - 1 == $i) 
					$this->db->group_end(); 
			}
			$column[$i] = $item; 
			$i++;
		}
		
		if(isset($_POST['order'])) 
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
			$order = $odb;
			$this->db->order_by(key($order), "desc");
	}

	private function _get_datatables_query_users($table='',$column='',$odb='')
	{
		
		$this->db->from($table);
		$i = 0;
	
		foreach ($column as $item) 
		{
			if($_POST['search']['value']) 
			{
				
				if($i===0) 
				{
					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);
					$this->db->where("status","Y");
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
					$this->db->where("status","Y");
				}

				if(count($column) - 1 == $i) 
					$this->db->group_end(); 
			}
			$column[$i] = $item; 
			$i++;
		}
		
		if(isset($_POST['order'])) 
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
			$order = $odb;
			$this->db->order_by(key($order), "desc");
	}

	function get_datatables_users($table='',$column='',$odb='')
	{
		$this->_get_datatables_query_users($table,$column,$odb);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function get_datatables($table='',$column='',$odb='')
	{
		$this->_get_datatables_query($table,$column,$odb);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	private function _get_datatables_from_query($query='',$column='',$odb='')
	{
		
		$this->db->query($query);
		$i = 0;
	
		foreach ($column as $item) 
		{
			if($_POST['search']['value']) 
			{
				
				if($i===0) 
				{
					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($column) - 1 == $i) 
					$this->db->group_end(); 
			}
			$column[$i] = $item; 
			$i++;
		}
		
		if(isset($_POST['order'])) 
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
			$order = $odb;
			$this->db->order_by(key($order), "desc");
	}


	function get_datatables_from_query($query='',$column='',$odb='')
	{
		$this->_get_datatables_from_query($query,$column,$odb);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function count_all($table)
	{
		$this->db->from($table);
		return $this->db->count_all_results();
	}

	function count_filtered($table='',$column='',$odb='')
	{
		$this->_get_datatables_query($table,$column,$odb);
		$query = $this->db->get();
		return $query->num_rows();
	}

}

/* End of file datatable.php */
/* Location: ./application/models/datatable.php */