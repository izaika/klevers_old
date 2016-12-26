<?php defined('SYSPATH') or die('No direct script access.');

abstract class AVO_Data_Source_Abstract extends AVO_Abstract_Parametrized_Class {

	abstract public function init(array $parameters = array());
	abstract public function save(AVO_Controls_List $controls, AVO_Controls_List $parameters = NULL);
	abstract public function find(AVO_Controls_List $controls, AVO_Controls_List $parameters = NULL);
	abstract public function fetch(AVO_Controls_List $parameters = NULL);

	/**
	 * deletes a record according to the $controls state
	 * @param $controls AVO_Controls_List
	 * @return AVO_DB_Action_Result
	 */
	abstract public function delete(AVO_Controls_List $controls, AVO_Controls_List $parameters = NULL);
	abstract public function ds_total($argument = NULL, AVO_Controls_List $parameters = NULL);
	abstract public function ds_abspos($argument = NULL, AVO_Controls_List $parameters = NULL);

}
