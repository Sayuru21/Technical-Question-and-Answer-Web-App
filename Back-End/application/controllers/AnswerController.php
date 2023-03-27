<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';

class AnswerController extends RestController
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AnswerModel');
	}

	public function getAllAnswersOfAQuestion_post()
	{
		try {
			if ($this->input->post()) {

				$questionId = $this->input->post('question_id');

				if ($questionId == null) {
					return $this->response(['success' => false, 'message' => "Answer's Question Id is Null"], RestController::HTTP_BAD_REQUEST);
				}
				if (is_int((int)$questionId) == false) {
					return $this->response(['success' => false, 'message' => "Answer's Question Id Must be a Integer"], RestController::HTTP_BAD_REQUEST);
				}

				$questionSpecificAnswers = $this->AnswerModel->getAllAnswersOfAQuestion($questionId);

				if (count($questionSpecificAnswers) > 0) {
					return $this->response(['success' => true, 'message' => "Data Retrieved Successfully", 'data' => $questionSpecificAnswers], RestController::HTTP_OK);
				} elseif (count($questionSpecificAnswers) == 0) {
					return $this->response(['success' => true, 'message' => "No Data", 'data' => null], RestController::HTTP_OK);
				}
			}
		} catch (Exception $e) {
			return $this->response(['success' => false, 'message' => "Data Retrieved Unsuccessfully", 'data' => $e->getMessage()], RestController::HTTP_INTERNAL_ERROR);
		}
	}

	public function upVoteAnswer_post()
	{
		try {

			if ($this->input->post()) {

				$answerId = $this->input->post('answer_id');

				if ($answerId == null) {
					return $this->response(['success' => false, 'message' => "Answer's Id is Null"], RestController::HTTP_BAD_REQUEST);
				}
				if (is_int((int)$answerId) == false) {
					return $this->response(['success' => false, 'message' => "Answer's Id Must be a Integer"], RestController::HTTP_BAD_REQUEST);
				}

				$isAnswerIdExists = $this->AnswerModel->checkAnswerIsExist($answerId);

				if ($isAnswerIdExists == false) {
					return $this->response(['success' => false, 'message' => "Answer's Id is Not Exist"], RestController::HTTP_BAD_REQUEST);
				}

				$upVoteCount = $this->AnswerModel->getUpVoteCount($answerId);

				$isUpdated = $this->AnswerModel->updateUpVoteCount($answerId, $upVoteCount);

				if ($isUpdated == true) {
					return $this->response(['success' => true, 'message' => "Data Updated Successfully"], RestController::HTTP_OK);
				}
			}
		} catch (Exception $e) {
			return $this->response(['success' => false, 'message' => "Data Updated Unsuccessfully", 'data' => $e->getMessage()], RestController::HTTP_INTERNAL_ERROR);
		}
	}

	public function downVoteAnswer_post()
	{
		try {
			if ($this->input->post()) {

				$answerId = $this->input->post('answer_id');

				if ($answerId == null) {
					return $this->response(['success' => false, 'message' => "Answer's Id is Null"], RestController::HTTP_BAD_REQUEST);
				}
				if (is_int((int)$answerId) == false) {
					return $this->response(['success' => false, 'message' => "Answer's Id Must be a Integer"], RestController::HTTP_BAD_REQUEST);
				}

				$isAnswerIdExists = $this->AnswerModel->checkAnswerIsExist($answerId);

				if ($isAnswerIdExists == false) {
					return $this->response(['success' => false, 'message' => "Answer's Id is Not Exist"], RestController::HTTP_BAD_REQUEST);
				}

				$downVoteCount = $this->AnswerModel->getDownVoteCount($answerId);

				$isUpdated = $this->AnswerModel->updateDownVoteCount($answerId, $downVoteCount);

				if ($isUpdated == true) {
					return $this->response(['success' => true, 'message' => "Data Updated Successfully"], RestController::HTTP_OK);
				}
			}
		} catch (Exception $e) {
			return $this->response(['success' => false, 'message' => "Data Updated Unsuccessfully", 'data' => $e->getMessage()], RestController::HTTP_INTERNAL_ERROR);
		}
	}

	public function createAnAnswerForAQuestion_post()
	{
		if ($this->input->post()) {

			$descriptionOfAnswer = $this->input->post('description_of_answer');
			$userId = $this->input->post('user_id');
			$questionId = $this->input->post('question_id');

			if ($descriptionOfAnswer == null) {
				return $this->response(['success' => false, 'message' => "Answer's Description is Null"], RestController::HTTP_BAD_REQUEST);
			}
			if ($userId == null) {
				return $this->response(['success' => false, 'message' => "Answer's User Id is Null"], RestController::HTTP_BAD_REQUEST);
			}
			if ($questionId == null) {
				return $this->response(['success' => false, 'message' => "Answer's Question Id is Null"], RestController::HTTP_BAD_REQUEST);
			}
			if (is_string($descriptionOfAnswer) == false) {
				return $this->response(['success' => false, 'message' => "Answer's Description Must be a String"], RestController::HTTP_BAD_REQUEST);
			}
			if (is_int((int)$userId) == false) {
				return $this->response(['success' => false, 'message' => "Answer's User Id Must be a Integer"], RestController::HTTP_BAD_REQUEST);
			}
			if (is_int((int)$questionId) == false) {
				return $this->response(['success' => false, 'message' => "Answer's Question Id Must be a Integer"], RestController::HTTP_BAD_REQUEST);
			}

			$answerData = array(
				'description_of_answer' => $descriptionOfAnswer,
				'question_id' => $questionId,
				'user_id' => $userId,
			);

			$answerId = $this->AnswerModel->createAnswer($answerData);

			if ($answerId) {
				return $this->response(['success' => true, 'message' => "Data Saved Successfully"], RestController::HTTP_CREATED);
			} else {
				return $this->response(['success' => false, 'message' => "Data Saved Unsuccessfully"], RestController::HTTP_INTERNAL_ERROR);
			}
		}
	}

	public function updateAnAnswerOfAQuestion_post()
	{
		if ($this->input->post()) {

			$descriptionOfAnswer = $this->input->post('description_of_answer');
			$answerId = $this->input->post('answer_id');
			$userId = $this->input->post('user_id');

			if ($userId == null) {
				return $this->response(['success' => false, 'message' => "Answer's User Id is Null"], RestController::HTTP_BAD_REQUEST);
			}
			if ($descriptionOfAnswer == null) {
				return 	$this->response(['success' => false, 'message' => "Answer's Description is Null"], RestController::HTTP_BAD_REQUEST);
			}
			if ($answerId == null) {
				return 	$this->response(['success' => false, 'message' => "Answer's Id is Null"], RestController::HTTP_BAD_REQUEST);
			}
			if (is_string($descriptionOfAnswer) == false) {
				return $this->response(['success' => false, 'message' => "Answer's Description Must be a String"], RestController::HTTP_BAD_REQUEST);
			}
			if (is_int((int)$answerId) == false) {
				return $this->response(['success' => false, 'message' => "Answer's Id Must be a Integer"], RestController::HTTP_BAD_REQUEST);
			}
			if (is_int((int)$userId) == false) {
				return $this->response(['success' => false, 'message' => "Answer's User Id Must be a Integer"], RestController::HTTP_BAD_REQUEST);
			}

			if ($userId != $this->AnswerModel->getUserId($answerId)) {
				return $this->response(['success' => false, 'message' => "Owner of the Answer Can Only Update"], RestController::HTTP_BAD_REQUEST);
			}

			$isUpdated = $this->AnswerModel->updateAnswer($answerId, $descriptionOfAnswer);

			if ($isUpdated == true) {
				return 	$this->response(['success' => true, 'message' => "Data Updated Successfully"], RestController::HTTP_CREATED);
			} else {
				return 	$this->response(['success' => false, 'message' => "Data Updated Unsuccessfully"], RestController::HTTP_INTERNAL_ERROR);
			}
		}
	}

	public function deleteAnAnswerOfAQuestion_post()
	{
		if ($this->input->post()) {

			$answerId = $this->input->post('answer_id');
			$userId = $this->input->post('user_id');


			if ($userId == null) {
				return $this->response(['success' => false, 'message' => "Answer's User Id is Null"], RestController::HTTP_BAD_REQUEST);
			}
			if ($answerId == null) {
				return 	$this->response(['success' => false, 'message' => "Answer's Id is Null"], RestController::HTTP_BAD_REQUEST);
			}
			if (is_int((int)$answerId) == false) {
				return $this->response(['success' => false, 'message' => "Answer's Id Must be a Integer"], RestController::HTTP_BAD_REQUEST);
			}
			if (is_int((int)$userId) == false) {
				return $this->response(['success' => false, 'message' => "Answer's User Id Must be a Integer"], RestController::HTTP_BAD_REQUEST);
			}

			if ($userId != $this->AnswerModel->getUserId($answerId)) {
				return $this->response(['success' => false, 'message' => "Owner of the Answer Can Only Delete"], RestController::HTTP_BAD_REQUEST);
			}

			$isDeleted = $this->AnswerModel->deleteAnswer($answerId);

			if ($isDeleted == true) {
				return 	$this->response(['success' => true, 'message' => "Data Deleted Successfully"], RestController::HTTP_CREATED);
			} else {
				return 	$this->response(['success' => false, 'message' => "Data Deleted Unsuccessfully"], RestController::HTTP_INTERNAL_ERROR);
			}
		}
	}
}
