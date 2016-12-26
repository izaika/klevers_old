<?php defined('SYSPATH') or die('No direct script access.');

class AVO_Link extends AVO_Control {

	public $child;
	public $params;
	public $properties_to_update;

	/**
	 * rendering the javascript object for the client
	 *
	 **/
	public function render() {
		$result =
			'new AVO.Link({' .
				'name:' . json_encode($this->name);
		if ($this->params !== null) {
			$result .= ', params:{';
			$i = 0;
			foreach ($this->params as $key => $value) {
				if ($i++) {
					$result .= ',';
				}
				$result .= json_encode($key) . ':' . json_encode($value);
			}
			$result .= '}';
		}
		return $result . ',child:' . $this->child->render(null) . '})';
	}
}