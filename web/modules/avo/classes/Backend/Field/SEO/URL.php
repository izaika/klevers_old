<?php defined('SYSPATH') or die('No direct access allowed.');

class Backend_Field_SEO_URL extends AVO_Field {

	const MAX_LENGTH = 128;

	public function __construct(array $array = array()) {

		$this->name = 'url_title';
		$this->type = self::TYPE_STRING;
		$this->title = new AVO_Label(array(
			'value'	=> __('URL title'),
			'hint'	=> __("Used as a part of the url to identify the object.\nLimited to :max_length characters.", array(':max_length' => self::MAX_LENGTH)),
		));

		$this->width = 400;
		$this->max_length = self::MAX_LENGTH;
		$this->validator = array(
			new AVO_Validator_Not_Null(),
			new AVO_Validator_URL_Title(),
		);

		parent::__construct($array);
	}

}
