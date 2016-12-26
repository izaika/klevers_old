<?php defined('SYSPATH') or die('No direct script access.');

class AVO_Data_Source_Pager {

	private $_parent;

	/**
	 * session prefix
	 * @var string
	 */
	private $_session_prefix;

	/**
	 * page size
	 * @var int
	 */
	private $_page_size;

	/**
	 * page number
	 * @var int
	 */
	private $_page_num;

	public function __construct(&$parent) {
		$this->_parent = $parent;
		$this->_session_prefix = $parent->get_session_prefix() . 'pager.';
		if ($parent->page_size) { // process only if default page_size is defined
			$this->_page_size = $this->load_page_size();
			$this->_page_num = $this->load_page_number();
		} else {
			$this->_page_size = 0;
			$this->_page_num = 1;
		}
	}

	public function offset() {
		return ($this->_page_size) ? max(0, ($this->_page_num - 1) * $this->_page_size) : null;
	}

	public function size() {
		return ($this->_page_size) ? $this->_page_size : null;
	}

	public function set_size($value) {
		$this->_page_size = $value;
	}

	public function number() {
		return $this->_page_num;
	}

	public function fix($total) {
		if ($this->_page_size) {
			$last_page = ceil($total / $this->_page_size);
			$last_page = ($last_page == 0) ? 1 : $last_page;
			if ($this->_page_num > $last_page) {
				$this->_page_num = $last_page;
				return true;
			}
		}
		return false;
	}

	public function go2page($page_num) {
		$this->_page_num = max(1, $page_num);
	}

	public function save() {
		$this->save_page_number();
		$this->save_page_size();
	}

	private function load_page_size() {
		return Session::instance()->get($this->_session_prefix . 'size', $this->_parent->page_size);
	}

	private function save_page_size() {
		Session::instance()->set($this->_session_prefix . 'size', $this->_page_size);
	}

	private function load_page_number() {
		return Session::instance()->get($this->_session_prefix . 'num', 1);
	}

	private function save_page_number() {
		Session::instance()->set($this->_session_prefix . 'num', $this->_page_num);
	}
}
