<?php

namespace App\Services;


class ResponseService 
{
	private $code   = 0,
			$msg    = "",
			$errors = [],
			$data   = "";

	public function setCode($code)
	{
		$this->code = $code;
		return $this;
	}

	public function setMsg($msg)
	{
		$this->msg = $msg;
		return $this;
	}

	public function setErrors($errors)
	{
		$this->errors = $errors;
		return $this;
	}

	public function setData($data)
	{
		$this->data = $data;
		return $this;
	}

	public function get()
	{
		return [
				'code' => $this->code,
				'data' => $this->data
				];
	}

	public function error()
	{
		return [
		        'code'   => $this->code,
		        'errors' => view('components.errors',['errors' => $this->errors])->render()
	    		];	
	}

	public function success()
	{
		return [
		        'code'   => $this->code,
		        'msg'    => $this->msg

        		];
	}
}


