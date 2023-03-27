<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';

class AuthController extends RestController
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->library('encrypt');
	}

	public function login_post()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		if ($email == null) {
			return $this->response(['success' => false, 'message' => "User's Email is Null"], RestController::HTTP_BAD_REQUEST);
		}
		if ($password == null) {
			return $this->response(['success' => false, 'message' => "User's Password is Null"], RestController::HTTP_BAD_REQUEST);
		}
		if (is_string($email) == false) {
			return $this->response(['success' => false, 'message' => "User's Email Must be a String"], RestController::HTTP_BAD_REQUEST);
		}
		if (is_string($password) == false) {
			return $this->response(['success' => false, 'message' => "User's Password Must be a String"], RestController::HTTP_BAD_REQUEST);
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return $this->response(['success' => false, 'message' => "User's Email is Not Well Formed"], RestController::HTTP_BAD_REQUEST);
		}

		$userPassword = $this->UserModel->getPassword($email);

		$decodedPassword = $this->encrypt->decode($userPassword);

		if ($decodedPassword == $password) {
			$user = $this->UserModel->getUser($email);
			return $this->response(['success' => true, 'message' => "User login Successful", 'data' => $user], RestController::HTTP_OK);
		} else {
			return $this->response(['success' => false, 'message' => "User Not Found"], RestController::HTTP_NOT_FOUND);
		}
	}

	public function signup_post()
	{
		if ($this->input->post()) {

			$fullName = $this->input->post('full_name');
			$displayName = $this->input->post('display_name');
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			if ($fullName == null) {
				return $this->response(['success' => false, 'message' => "User's Full Name is Null"], RestController::HTTP_BAD_REQUEST);
			}
			if ($displayName == null) {
				return $this->response(['success' => false, 'message' => "User's Display Name is Null"], RestController::HTTP_BAD_REQUEST);
			}
			if ($email == null) {
				return $this->response(['success' => false, 'message' => "User's Email is Null"], RestController::HTTP_BAD_REQUEST);
			}
			if ($password == null) {
				return $this->response(['success' => false, 'message' => "User's Password is Null"], RestController::HTTP_BAD_REQUEST);
			}
			if (is_string($fullName) == false) {
				return $this->response(['success' => false, 'message' => "User's Full Name Must be a String"], RestController::HTTP_BAD_REQUEST);
			}
			if (is_string($displayName) == false) {
				return $this->response(['success' => false, 'message' => "User's Display Name Must be a String"], RestController::HTTP_BAD_REQUEST);
			}
			if (is_string($email) == false) {
				return $this->response(['success' => false, 'message' => "User's Email Must be a String"], RestController::HTTP_BAD_REQUEST);
			}
			if (is_string($password) == false) {
				return $this->response(['success' => false, 'message' => "User's Password Must be a String"], RestController::HTTP_BAD_REQUEST);
			}
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				return $this->response(['success' => false, 'message' => "User's Email is Not Well Formed"], RestController::HTTP_BAD_REQUEST);
			}

			$pass_word = $this->encrypt->encode($password);

			$isUserExist = $this->UserModel->checkUserIsExist($email, $pass_word);

			if ($isUserExist == true) {
				return $this->response(['success' => false, 'message' => "User Already Exist"], RestController::HTTP_BAD_REQUEST);
			}

			$isDisplayNameExist = $this->UserModel->checkDisplayNameIsExist($displayName);

			if ($isDisplayNameExist == true) {
				return $this->response(['success' => false, 'message' => "User's Display Name is Already Taken"], RestController::HTTP_BAD_REQUEST);
			}

			$isEmailExist = $this->UserModel->checkEmailIsExist($email);

			if ($isEmailExist == true) {
				return $this->response(['success' => false, 'message' => "User's Email is Already Taken"], RestController::HTTP_BAD_REQUEST);
			}

			$data = array(
				'full_name' => $fullName,
				'display_name' => $displayName,
				'email' => $email,
				'password' => $pass_word
			);

			$user = $this->UserModel->signup($data);

			if ($user) {
				return $this->response(['success' => true, 'message' => "Data Saved Successfully"], RestController::HTTP_CREATED);
			} else {
				return $this->response(['success' => false, 'message' => "Data Saved Unsuccessfully"], RestController::HTTP_INTERNAL_ERROR);
			}
		}
	}
}
