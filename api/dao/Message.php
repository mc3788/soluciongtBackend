<?php

class Message
{

	public $code;
	public $message;

	/**
	 * Message constructor.
	 */
	public function __construct()
	{
	}

	function __toString()
	{
		return "{Message: {code: " . $this->code . ", message: " . $this->message ."}}";
	}


	/**
	 * @return mixed
	 */
	public function getCode()
	{
		return $this->code;
	}

	/**
	 * @param mixed $code
	 */
	public function setCode($code)
	{
		$this->code = $code;
	}

	/**
	 * @return mixed
	 */
	public function getMessage()
	{
		return $this->message;
	}

	/**
	 * @param mixed $message
	 */
	public function setMessage($message)
	{
		$this->message = $message;
	}

}