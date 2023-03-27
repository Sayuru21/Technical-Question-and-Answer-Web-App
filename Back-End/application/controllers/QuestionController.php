<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';

class QuestionController extends RestController
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('QuestionModel');
		$this->load->model('TagModel');
		$this->load->model('AnswerModel');
		$this->load->model('QuestionTagModel');
	}

	public function getLatestQuestions_get()
	{
		try {
			$latestQuestions = $this->QuestionModel->getLatestQuestions();

			$data = array();

			for ($x = 0; $x < count($latestQuestions); $x++) {
				$tagsArray = $this->QuestionTagModel->getTagsRelatedToAQuestion($latestQuestions[$x]['id']);

				$answers = $this->AnswerModel->getAnswersOfAQuestion((int)$latestQuestions[$x]['id']);

				$questionData = array(
					'id' => $latestQuestions[$x]['id'],
					'title_of_question' => $latestQuestions[$x]['title_of_question'],
					'description_of_question' => $latestQuestions[$x]['description_of_question'],
					'category' => $latestQuestions[$x]['category'],
					'reference_link' => $latestQuestions[$x]['reference_link'],
					'is_answered' => $latestQuestions[$x]['is_answered'],
					'user_id' => $latestQuestions[$x]['user_id'],
					'tags' => $tagsArray,
					'answers' => $answers
				);

				array_push($data, $questionData);
			}

			if (count($data) > 0) {
				return $this->response(['success' => true, 'message' => "Data Retrieved Successfully", 'data' => $data], RestController::HTTP_OK);
			} elseif (count($data) == 0) {
				return $this->response(['success' => true, 'message' => "No Data", 'data' => null], RestController::HTTP_OK);
			}
		} catch (Exception $e) {
			return $this->response(['success' => false, 'message' => "Data Retrieved Unsuccessfully", 'data' => $e->getMessage()], RestController::HTTP_INTERNAL_ERROR);
		}
	}

	public function getAllQuestions_get()
	{
		try {
			$allQuestions = $this->QuestionModel->getAllQuestions();

			$data = array();

			for ($x = 0; $x < count($allQuestions); $x++) {
				$tagsArray = $this->QuestionTagModel->getTagsRelatedToAQuestion($allQuestions[$x]['id']);

				$answers = $this->AnswerModel->getAnswersOfAQuestion((int)$allQuestions[$x]['id']);

				$questionData = array(
					'id' => $allQuestions[$x]['id'],
					'title_of_question' => $allQuestions[$x]['title_of_question'],
					'description_of_question' => $allQuestions[$x]['description_of_question'],
					'category' => $allQuestions[$x]['category'],
					'reference_link' => $allQuestions[$x]['reference_link'],
					'is_answered' => $allQuestions[$x]['is_answered'],
					'user_id' => $allQuestions[$x]['user_id'],
					'tags' => $tagsArray,
					'answers' => $answers
				);

				array_push($data, $questionData);
			}


			if (count($data) > 0) {
				return $this->response(['success' => true, 'message' => "Data Retrieved Successfully", 'data' => $data], RestController::HTTP_OK);
			} elseif (count($data) == 0) {
				return $this->response(['success' => true, 'message' => "No Data", 'data' => null], RestController::HTTP_OK);
			}
		} catch (Exception $e) {
			return $this->response(['success' => false, 'message' => "Data Retrieved Unsuccessfully", 'data' => $e->getMessage()], RestController::HTTP_INTERNAL_ERROR);
		}
	}

	public function getUnansweredQuestions_get()
	{
		try {
			$unansweredQuestions = $this->QuestionModel->getUnansweredQuestions();

			$data = array();

			for ($x = 0; $x < count($unansweredQuestions); $x++) {

				$tagsArray = $this->QuestionTagModel->getTagsRelatedToAQuestion($unansweredQuestions[$x]['id']);

				$questionData = array(
					'id' => $unansweredQuestions[$x]['id'],
					'title_of_question' => $unansweredQuestions[$x]['title_of_question'],
					'description_of_question' => $unansweredQuestions[$x]['description_of_question'],
					'category' => $unansweredQuestions[$x]['category'],
					'reference_link' => $unansweredQuestions[$x]['reference_link'],
					'is_answered' => $unansweredQuestions[$x]['is_answered'],
					'user_id' => $unansweredQuestions[$x]['user_id'],
					'tags' => $tagsArray,
				);

				array_push($data, $questionData);
			}

			if (count($data) > 0) {
				return $this->response(['success' => true, 'message' => "Data Retrieved Successfully", 'data' => $data], RestController::HTTP_OK);
			} elseif (count($data) == 0) {
				return $this->response(['success' => true, 'message' => "No Data", 'data' => null], RestController::HTTP_OK);
			}
		} catch (Exception $e) {
			return $this->response(['success' => false, 'message' => "Data Retrieved Unsuccessfully", 'data' => $e->getMessage()], RestController::HTTP_INTERNAL_ERROR);
		}
	}

	public function createAQuestion_post()
	{
		try {

			if ($this->input->post()) {

				$titleOfQuestion = $this->input->post('title_of_question');
				$descriptionOfQuestion = $this->input->post('description_of_question');
				$category = $this->input->post('category');
				$referenceLink = $this->input->post('reference_link');
				$userId = $this->input->post('user_id');
				$tagNames = $this->input->post('tags');

				if ($titleOfQuestion == null) {
					return $this->response(['success' => false, 'message' => "Question's Title is Null"], RestController::HTTP_BAD_REQUEST);
				}
				if ($descriptionOfQuestion == null) {
					return $this->response(['success' => false, 'message' => "Question's Description is Null"], RestController::HTTP_BAD_REQUEST);
				}
				if ($category == null) {
					return $this->response(['success' => false, 'message' => "Question's Category is Null"], RestController::HTTP_BAD_REQUEST);
				}
				if ($userId == null) {
					return $this->response(['success' => false, 'message' => "Question's User Id is Null"], RestController::HTTP_BAD_REQUEST);
				}
				if ($tagNames == null) {
					return $this->response(['success' => false, 'message' => "Question's Tag Names are Null"], RestController::HTTP_BAD_REQUEST);
				}
				if (is_string($titleOfQuestion) == false) {
					return $this->response(['success' => false, 'message' => "Question's Title Must be a String"], RestController::HTTP_BAD_REQUEST);
				}
				if (is_string($descriptionOfQuestion) == false) {
					return $this->response(['success' => false, 'message' => "Question's Description Must be a String"], RestController::HTTP_BAD_REQUEST);
				}
				if (is_string($category) == false) {
					return $this->response(['success' => false, 'message' => "Question's Category Must be a String"], RestController::HTTP_BAD_REQUEST);
				}
				if (is_string($referenceLink) == false and $referenceLink != null) {
					return $this->response(['success' => false, 'message' => "Question's Reference Link Must be a String"], RestController::HTTP_BAD_REQUEST);
				}
				if (is_int((int)$userId) == false) {
					return $this->response(['success' => false, 'message' => "Question's User Id Must be a Integer"], RestController::HTTP_BAD_REQUEST);
				}
				if (is_array($tagNames) == false) {
					return $this->response(['success' => false, 'message' => "Question's Tag Names Must be an array"], RestController::HTTP_BAD_REQUEST);
				}

				for ($i = 0; $i < count($tagNames); $i++) {

					if (is_string($tagNames[$i]) == false) {
						return $this->response(['success' => false, 'message' => "Question's Tag Name array's all elements Must be a String"], RestController::HTTP_BAD_REQUEST);
					}
				}

				$questionData = array(
					'title_of_question' => $titleOfQuestion,
					'description_of_question' => $descriptionOfQuestion,
					'category' => $category,
					'reference_link' => $referenceLink,
					'user_id' => $userId,
				);

				$questionId = $this->QuestionModel->createQuestion($questionData);

				for ($i = 0; $i < count($tagNames); $i++) {

					$isTagExist = $this->TagModel->isTagNameExist($tagNames[$i]);

					if ($isTagExist == false) {

						$tagData = array(
							'name' => $tagNames[$i],
						);

						$tagId = $this->TagModel->createTag($tagData);

						$questionTagData = array(
							'question_id' => $questionId,
							'tag_id' => $tagId
						);

						$this->QuestionTagModel->createQuestionTag($questionTagData);
					} else {
						$tagId = $this->TagModel->getTagId($tagNames[$i]);

						$questionTagData = array(
							'question_id' => $questionId,
							'tag_id' => $tagId
						);

						$this->QuestionTagModel->createQuestionTag($questionTagData);
					}
				}

				return $this->response(['success' => true, 'message' => "Data Saved Successfully"], RestController::HTTP_CREATED);
			}
		} catch (Exception $e) {
			return $this->response(['success' => false, 'message' => "Data Saved Unsuccessfully", 'data' => $e->getMessage()], RestController::HTTP_INTERNAL_ERROR);
		}
	}
}
