<?php defined('SYSPATH') or die('No direct access allowed.');

class Backend_Field_SEO_Description extends AVO_Field {

	public function __construct(array $array = array()) {

		$this->name = 'seo_description';
		$this->type = self::TYPE_TEXT;
		$this->title = new AVO_Label(array(
			'value'	=> __('SEO description'),
			'hint'	=> __("Used in META description.\nLimited to 150 characters."),
		));

		$this->width = 400;
		$this->height = '6em';
		$this->max_length = 150;
		$this->validator = new AVO_Validator_Not_Null();
		$this->filter = array('Filter', 'seo_description');

		parent::__construct($array);
	}

}
