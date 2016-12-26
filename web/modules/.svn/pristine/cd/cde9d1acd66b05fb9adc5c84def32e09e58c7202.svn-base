<?php defined('SYSPATH') OR die('No direct script access.');

interface AVO_Search_Searchable {

	/**
	* Map for indexing
	*
	* Possible types of fields: keyword, unIndexed, binary, text, unStored
	*
	* Example map:
	*
	* public static function index_map()
	* {
	*		return array(
	*			array('name' => 'id', 			'type' => 'text'),
	*			array('name' => 'body_text', 	'type' => 'unStored'),
	*			array('name' => 'category_id', 	'type' => 'UnIndexed'),
	*			array('name' => 'heading', 		'type' => 'text'),
	*			array('name' => 'title', 		'type' => 'text', 'method' => 'get_title_for_search'),
	*			array('name' => 'seo_keywords', 'type' => 'text'),
	*			array('name' => 'article_url', 	'type' => 'text'),
	*	);
	* }
	*/
	public static function index_map();


	/**
	 * Map with important fields and values that must match.
	 * For example is_new must be 0, or is_password_protected = FALSE.
	 */
	public static function index_filters();


	/*
	 * this method should return url that is used as link in search results
	 */
	public function url();
}