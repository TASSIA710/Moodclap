<?php

class ApiRequest {
	private $responseCode, $responseData, $requestData, $method;

	public function __construct($data, $method) {
		$this->responseCode = 200;
		$this->responseData = [];
		$this->requestData = $data;
		$this->method = $method;
	}

	public function getCode() {
		return $this->responseCode;
	}

	public function setCode($code) {
		$this->responseCode = $code;
	}

	public function getResponse() {
		return $this->responseData;
	}

	public function setResponse($data) {
		$this->responseData = $data;
	}

	public function getRequest() {
		return $this->requestData;
	}

	public function getMethod() {
		return $this->method;
	}

	public function isGET() {
		return $this->getMethod() == 'GET';
	}

	public function isPOST() {
		return $this->getMethod() == 'POST';
	}

}
