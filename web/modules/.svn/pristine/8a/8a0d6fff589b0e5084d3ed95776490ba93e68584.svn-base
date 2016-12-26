<?php defined('SYSPATH') OR die('No direct script access.');

class AVO_Data_Source_Range extends AVO_Data_Source_Array {

	public function __construct($from, $to)
	{
		$dataset = array();
		settype($from, 'int');
		settype($to, 'int');
		if ($from <= $to)
		{
			for ($i = $from; $i <= $to; $i++)
			{
				$dataset[] = array('id' => $i, 'name' => $i);
			}
		}
		else
		{
			for ($i = $from; $i >= $to; $i--)
			{
				$dataset[] = array('id' => $i, 'name' => $i);
			}
		}
		parent::__construct(array(
			'dataset'	=> $dataset
		));
	}
}
