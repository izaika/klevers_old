<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 *
 * @property int id
 * @property string created
 * @property string modified
 * @property int modify_count
 * @property string str_id
 * @property string group_title
 * @property string title
 * @property string note
 * @property int is_from_required
 * @property string from_name
 * @property string from_address
 * @property int is_to_required
 * @property string to_name
 * @property string to_address
 * @property string subject
 * @property string body
 * @property string macro_description
 */
class Model_Message_Template extends ORM {

	/**
	 * Searches for a template identified by a string identificator
	 *
	 * @param string identificator
	 * @return Model_Message_Template
	 * @throws Kohana_Exception if template is not found
	 */
	public static function find_by_id($id) {
		$template = new self();
		$template->where('str_id', '=', $id)->find();
		if ($template->loaded()) return $template;
		throw new Kohana_Exception('Message template :name is not found', array(':name' => $id));
	}

}
