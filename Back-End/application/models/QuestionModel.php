<?php

class QuestionModel extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	function getLatestQuestions()
	{

		$query = $this->db->order_by('id', "desc")
			->limit(10)
			->get('question');
		return $query->result_array();
	}

	function getAllQuestions()
	{

		// $query = $this->db->get('question');
		// $data = $query->result_array();
		// return $data;
		
		$query = $this->db->get('question');

		$data = array();
		if ($query !== FALSE && $query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$data[] = $row;
			}
		}

		return $data;
	}

	function getUnansweredQuestions()
	{

		$query = $this->db->where('is_answered', 0)->get('question');
		return $query->result_array();
	}

	function createQuestion($questionData)
	{

		$this->db->insert('question', $questionData);
		return $this->db->insert_id();
	}
}
