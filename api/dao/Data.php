<?php


class Data
{

	public $data;

	/**
	 * Data constructor.
	 */
	public function __construct()
	{
	}

	/**
	 * @return array
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * @param array $data
	 */
	public function setData($data)
	{
		$this->data = $data;
	}
}