<?php

class Validation extends Kohana_Validation {

	// Rules that are executed even when the value is empty
	protected $_empty_rules = array('not_empty', 'matches', 'not_empty_if_img_uploaded');

}
