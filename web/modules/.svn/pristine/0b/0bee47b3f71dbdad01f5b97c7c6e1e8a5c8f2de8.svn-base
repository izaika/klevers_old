<?php defined('SYSPATH') OR die('No direct script access.');

class AVO_Data_Source_Array extends AVO_Data_Source_Abstract {

	public $dataset;

	private $total;
	private $ds_pos;
	private $pos = 0;

	public static function dummy()
	{
		return new self(array(
			'dataset' => array(
				array('id' => 1)
			)
		));
	}

	public function init(array $parameters = array()) {}


	public function save(AVO_Controls_List $controls, AVO_Controls_List $parameters = NULL)
	{
		throw new Kohana_Exception(':method has no sense in :class', array(':method' => __METHOD__, ':class' => __CLASS__));
	}


	public function ds_total($argument = NULL, AVO_Controls_List $parameters = NULL)
	{
		if ($this->total === NULL) $this->total = count($this->dataset);
		return $this->total;
	}


	public function find(AVO_Controls_List $controls, AVO_Controls_List $parameters = NULL)
	{
		$key_field = $controls->get_key_field();
		if ($key_field === NULL) return FALSE;
		$key_value = $key_field->value();
		$key_name = $key_field->name;
		foreach ($this->dataset as $item)
		{
			if ($item[$key_name] === $key_value) return $item;
		}

		return FALSE;
	}


	public function fetch(AVO_Controls_List $parameters = NULL)
	{
		if ($this->ds_pos === NULL)
		{
			$this->ds_pos = 0;
			$this->pos = 0;
		}
		if ($this->ds_pos < $this->ds_total())
		{
			$row = $this->dataset[$this->ds_pos];
			$this->pos++;
			$this->ds_pos++;
			return $row;
		}
		else
		{
			$this->ds_pos = NULL;
			return NULL;
		}
	}


	public function ds_abspos($argument = NULL, AVO_Controls_List $parameters = NULL)
	{
		return $this->pos;
	}


	public function delete(AVO_Controls_List $controls, AVO_Controls_List $parameters = NULL)
	{
		throw new Kohana_Exception(':method has no sense in :class', array(':method' => __METHOD__, ':class' => __CLASS__));
	}

}
