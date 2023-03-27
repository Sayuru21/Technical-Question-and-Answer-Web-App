<?php

class QuestionTagModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('TagModel');
	}

	function createQuestionTag($questionTagData)
	{
		$this->db->insert('question_tag', $questionTagData);
	}

	function getTagsRelatedToAQuestion($questionId)
	{

		$query = $this->db->where('question_id', $questionId)->get('question_tag');
		$questionTags = $query->result_array();

		$tags = array();

		foreach ($questionTags as $questionTag) {
			$tagName = $this->TagModel->getTagName($questionTag['tag_id']);

			if (in_array($tagName, $tags) == false) {
				array_push($tags, $tagName);
			}
		}

		if(count($tags) > 0){
			return $tags;
		}
		else{
			return null;
		}
	}
}
