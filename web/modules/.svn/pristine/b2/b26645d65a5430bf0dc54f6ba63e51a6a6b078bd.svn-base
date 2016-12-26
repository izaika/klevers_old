<?php defined('SYSPATH') or die('No direct script access.');

class AVO_Data_Source_Sorter {

	private $_parent;
	private $_session_prefix;
	private $_field_name;
	private $_direction;

	public function __construct($parent) {
		$this->_parent = $parent;
		$this->_session_prefix = $parent->get_session_prefix() . 'sorter.';
		$this->_field_name = $this->load_field_name();
		$this->_direction = $this->load_direction();
		if ($this->_field_name) {
			$field = $this->_parent->fields->{$this->_field_name};
			$init_name = (!$field || !$field->sortable);
		} else {
			$init_name = true;
		}
		// check if direction is already set
		$init_direction = !$this->_direction;

		// find the default field
		if ($init_direction || $init_name) {
			$def_sortable = $def_sort_direction = $first_sortable = $first_sortable_direction = null;
			foreach ($this->_parent->fields as $field) {
				if ($field->sortable) {
					if (!$first_sortable) {
						$first_sortable = $field->name;
						$first_sortable_direction = $field->default_sort_direction ? $field->default_sort_direction : 'asc';
					}
					if ($field->default_sortable) {
						$def_sortable = $field->name;
						$def_sort_direction = $field->default_sort_direction ? $field->default_sort_direction : 'asc';
						break;
					}
				}
			}
		}
		if ($init_name) $this->_field_name = $def_sortable ? $def_sortable : $first_sortable;
		if ($init_direction) $this->set_direction($def_sortable ? $def_sort_direction : $first_sortable_direction);
	}

	public function set_field_name($field_name) {
		if ($field_name === NULL) return;
		$field = $this->_parent->fields->$field_name;
		if ($field === null || !$field->sortable) return;
		$this->_field_name = $field->name;
	}

	public function set_direction($dir) {
		if ($dir === NULL) return;
		$dir = strtolower($dir);
		if (in_array($dir, array('desc', 'asc'))) $this->_direction = $dir;
	}

	public function direction() {
		return $this->_direction;
	}

	public function field_name() {
		return $this->_field_name;
	}

	/**
	 * changes the sorting criteria or sorting direction
	 *
	 **/
	public function set($field_name, $dir) {
		$field = $this->_parent->fields->$field_name;
		if ($field !== null && $field->sortable) {
			$this->_field_name = $field_name;
			$this->set_direction($dir);
		}
	}

	public function save() {
		$this->save_direction();
		$this->save_field_name();
	}

	private function load_direction() {
		return Session::instance()->get($this->_session_prefix . 'dir');
	}

	private function save_direction() {
		Session::instance()->set($this->_session_prefix . 'dir', $this->direction());
	}

	private function load_field_name() {
		return Session::instance()->get($this->_session_prefix . 'name');
	}

	private function save_field_name() {
		Session::instance()->set($this->_session_prefix . 'name', $this->_field_name);
	}
}

