<?php defined('SYSPATH') OR die('No direct script access.');

class AVO_Button extends AVO_Control {

	// types
	const TYPE_BUTTON = 0;
	const TYPE_UPLOAD = 1;

	// standard button types
	const STD_SAVE		= 0;
	const STD_CLOSE		= 1;
	const STD_CANCEL	= 2;
	const STD_LOGIN		= 3;

	/**
	 * server action initiated by button
	 * @var string
	 */
	public $action;

	/**
	 * java script AVO_Button class extension
	 * @var unknown_type
	 */
	public $class_extension;

	/**
	 * html class of the control
	 * @var string
	 */
	public $html_class;

	/**
	 * icon name (will be used ico-xxx style for the button value
	 * @var string
	 */
	public $icon;

	/**
	 * default button state. IE does not correctly processes the forms submit so we must say which button is default
	 * @var bool
	 */
	public $is_default = false;

	/**
	 * properties to update during the form action execution
	 * @var mixed
	 */
	public $properties_to_update;

	/**
	 * button style
	 * @var string json hash
	 */
	public $style;

	/**
	 * button type
	 * @var int
	 */
	public $type = self::TYPE_BUTTON;

	/**
	 * button value/title
	 * @var string
	 */
	public $value;


	/**
	 * standard buttons factory
	 *
	 */
	public static function standard($type)
	{
		switch ($type)
		{
			case self::STD_SAVE:
				return new AVO_Button(array(
					'name'			=> 'btn_submit',
					'is_default'	=> TRUE,
					'html_class'	=> 'btn btn-success',
					'icon'			=> 'ok-circle icon-white',
					'action'		=> 'save',
					'value'			=> __('save'),
				));

			case self::STD_CLOSE:
				return new AVO_Button(array(
					'name'				=> 'btn_close',
					'icon'				=> 'remove-circle',
					'class_extension'	=> '{
						onClick: function() {
							this.parent().escalateControl();
							return false;
						}
					}',
					'value'				=> __('close')
				));

			case self::STD_CANCEL:
				return new AVO_Button(array(
					'name'				=> 'btn_cancel',
					'icon'				=> 'ban-circle',
					'html_class'		=> 'btn',
					'class_extension'	=> '{
						onClick: function() {
							this.parent().escalateControl();
							return false;
						}
					}',
					'value'				=> __('cancel')
				));

			case self::STD_LOGIN:
				return new AVO_Button(array(
					'name'			=> 'btn_login',
					'icon'			=> 'user icon-white',
					'html_class'	=> 'btn-primary btn-lg',
					'is_default'	=> TRUE,
					'action'		=> 'login',
					'value'			=> __('login')
				));

			default:
				return null;
		}
	}


	/**
	 * Renders the javascript object for the client
	 *
	 **/
	public function render()
	{
		$properties = array(
			'name' => $this->name,
			'value' => $this->value,
		);
		if ($this->type !== self::TYPE_BUTTON) $properties['type'] = self::TYPE_UPLOAD;
		if ($this->icon) $properties['icon'] = $this->icon;
		if ($this->is_default) $properties['is_default'] = TRUE;
		if ($this->action) $properties['action'] = $this->action;
		if ($this->html_class) $properties['html_class'] = $this->html_class;
		$result = json_encode($properties);
		if ($this->class_extension) $result = '$.extend('.$result.','.$this->class_extension.')';
		return 'new AVO.Button('.$result.')';
	}

}
