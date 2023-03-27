<?php

class TagModel extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}
	
	function createTag($tagData)
	{
		$this->db->insert('tag', $tagData);
		return $this->db->insert_id();
	}

	function getTagId($tagName)
	{
		$this->db->where('name', $tagName);
		$tag = $this->db->get('tag');
		$data = $tag->result_array();

		return $data[0]['id'];
	}

	function isTagNameExist($tagName)
	{
		$this->db->select('*');
		$this->db->from('tag');
		$this->db->where('name', $tagName);

		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			return false;
		}

		return true;
	}

	function getTagName($tagId)
	{
		$this->db->where('id', $tagId);
		$tag = $this->db->get('tag');
		$data = $tag->result_array();

		if(count($data) > 0){
			return $data[0]['name'];		}
		else{
			return null;
		}
	}
}
?>
