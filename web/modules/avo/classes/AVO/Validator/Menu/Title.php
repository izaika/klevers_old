<?php defined('SYSPATH') or die('No direct script access.');

class AVO_Validator_Menu_Title extends AVO_Validator_URL_Title {

	public function __construct(array $properties = array()) {
		parent::__construct($properties);
		if (!isset($properties['message'])) $this->message = __('invalid menu title');
	}

}