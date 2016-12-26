<?php defined('SYSPATH') or die('No direct script access.');

class AVO_Label extends AVO_Control {

	/**
	 * javascript AVO_Label class extension
	 * @var string
	 */
	public $class_extension;

	/**
	 * does value require encoding
	 * @var bool
	 */
	public $encoded = false;

	/**
	 * hint text
	 * @var string
	 */
	public $hint;

	/**
	 * html class of the control
	 * @var string
	 */
	public $html_class;

	/**
	 * properties to update during the form action execution
	 * @var mixed
	 */
	public $properties_to_update;

	/**
	 * value
	 * @var string
	 */
	public $value;


	/**
	 * rendering the javascript object for the client
	 *
	 **/
	public function render() {
		$properties = array(
			'value' => $this->value,
		);
		if ($this->encoded) $properties['encoded'] = true;
		if ($this->html_class) $properties['html_class'] = $this->html_class;
		if ($this->hint) $properties['hint'] = $this->hint;

		$result = json_encode($properties);
		if ($this->class_extension) $result = '$.extend(' . $result . ', ' . $this->class_extension . ')';
		return 'new AVO.Label(' . $result . ')';
	}
}
