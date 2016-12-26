<?php defined('SYSPATH') or die('No direct access allowed.');

class Backend_Field_SEO_Title extends AVO_Field {

	public function __construct(array $array = array()) {

		$this->name = 'seo_title';
		$this->type = self::TYPE_STRING;
		$this->title = new AVO_Label(array(
			'value'	=> __('SEO title'),
			'hint'	=> __("Used in META title\nLimited to 150 characters"),
		));

		$this->width = 400;
		$this->max_length = 150;
		$this->validator = new AVO_Validator_Not_Null();

		parent::__construct($array);
	}

}
