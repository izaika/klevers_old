<?php defined('SYSPATH') or die('No direct script access.');

class AVO_Layout_Control extends AVO_Control {

	/**
	 * command list
	 * @var array
	 */
	public $commands;

	/**
	 * block name
	 * @var string
	 */
	public $name;

	public function __construct(array $commands, $name = null) {
		$this->commands = $commands;
		$this->name = $name;
	}

	public static function end_layout() {
		return new self(array('end_layout'));
	}

	public function render() {
		$result = 'new AVO.Layout_Control([';
		$i = 0;
		foreach ($this->commands as $item) {
			if ($i++) $result .= ',';
			if (is_string($item)) {
				if (Text::starts_with($item, 'new ') || (Text::starts_with($item, '{') && Text::ends_with($item, '}'))) {
					$result .= $item;
				} else {
					$result .= json_encode($item);
				}
			} else {
				$result .= $item;
			}
		}
		return $result . '])';
	}
}

