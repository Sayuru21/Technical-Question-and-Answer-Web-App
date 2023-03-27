<?php

class AnswerModel extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}
	
	function createAnswer($data)
	{
		$this->db->insert('answer', $data);
		return $this->db->insert_id();
	}

	function updateAnswer($answerId, $descriptionOfAnswer)
	{
		$this->db->set('description_of_answer', $descriptionOfAnswer)
			->where('id', $answerId)
			->update('answer');
		return true;
	}

	function deleteAnswer($answerId)
	{
		$this->db->where('id', $answerId);
		$this->db->delete('answer');
		return true;
	}

	function getAllAnswersOfAQuestion($questionId)
	{
		$query = $this->db->where('question_id', $questionId)
			->get('answer');
		return $query->result_array();
	}

	function getUpVoteCount($answerId)
	{
		$this->db->where('id', $answerId);
		$answer = $this->db->get('answer');
		$data = $answer->result_array();

		return $data[0]['up_vote'];
	}

	function updateUpVoteCount($answerId, $upVoteCount)
	{
		$this->db->set('up_vote', $upVoteCount + 1)
			->where('id', $answerId)
			->update('answer');
		return true;
	}

	function getDownVoteCount($answerId)
	{
		$this->db->where('id', $answerId);
		$answer = $this->db->get('answer');
		$data = $answer->result_array();

		return $data[0]['down_vote'];
	}

	function updateDownVoteCount($answerId, $downVoteCount)
	{
		$this->db->set('down_vote', $downVoteCount + 1)
			->where('id', $answerId)
			->update('answer');
		return true;
	}

	function getAnswersOfAQuestion($questionId)
	{
		$query = $this->db->where('question_id', $questionId)->get('answer');

		if($query->num_rows() > 0){
			return $query->result_array();
		}
		else{
			return null;
		}
	}

	function checkAnswerIsExist($answerId)
	{
		$query = $this->db->where('id', $answerId)->get('answer');

		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}

	function getUserId($answerId)
	{
		$this->db->where('id', $answerId);
		$answer = $this->db->get('answer');
		$data = $answer->result_array();

		return $data[0]['user_id'];
	}
}
?>
