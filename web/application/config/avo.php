<?php

return array(

	/**
	 * Cookie salt
	 * Random unique (per application) string
	 *
	 */
	'cookie_salt' => 'nuno_2016_05',


	/**
	 * Queries to execute when a connection to the database is established. This aims to perform additional configuration on the database server.
	 * Normally this is a Database::UPDATE query. For example, turning on the foriegn keys support for sqlite database:
	 * 	'PRAGMA auto_vacuum = FULL',
	 * 	'PRAGMA foreign_keys = ON'
	 *
	 * If other kind of query is used it should be passed as Database_Query object:
	 *  DB::query(Database::DELETE, 'DELETE FROM table1 WHERE calls > 100')
	 *
	 */
	'db_initialization_queries'	=> array(
		'SET net_read_timeout=300',
		'SET net_write_timeout=300',
	),


	/**
	 * A Database::SELECT query that infomrs whether to perform the garbage collection or not
	 * Returns single field value. 1 to perform, 0 - skip
	 *
	 * MYSQL example:
	 *	'SELECT datetime_val <= DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL 1 DAY) FROM variables WHERE str_id = "gc_datetime"'
	 *
	 * SQLite example:
	 *	'SELECT datetime_val <= date("now", "-1 day") FROM variables WHERE str_id = "gc_datetime"'
	 *
	 */
	'gc_run_query'	=> 'SELECT datetime_val <= DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL 1 DAY) FROM variables WHERE str_id = "gc_datetime"',


	/**
	 * A Database::UPDATE query executed when a garbage collection is complete
	 *
	 * MYSQL example:
	 *	'UPDATE variables SET datetime_val = CURRENT_TIMESTAMP(), modified = CURRENT_TIMESTAMP(), modify_count = modify_count + 1 WHERE str_id = "gc_datetime"'
	 *
	 * SQLite example:
	 * 	'UPDATE variables SET datetime_val = date("now"), modified = date("now"), modify_count = modify_count + 1 WHERE str_id = "gc_datetime"'
	 *
	 */
	'gc_done_query'	=> 'UPDATE variables SET datetime_val = CURRENT_TIMESTAMP(), modified = CURRENT_TIMESTAMP(), modify_count = modify_count + 1 WHERE str_id = "gc_datetime"',


	/**
	 * Queries to execute during the garbage collection to remove the resouces from the database which are no longer reference by others
	 * Used for the database engines that do not support the referential integrity.
	 *
	 * These queries also are used to remove the unsaved records in dufferent tables
	 *
	 * Normally this is a Database::DELETE query. Example:
	 * 	'DELETE FROM categories WHERE category_id NOT IN (SELECT id FROM categories)'
	 *  'DELETE FROM articles WHERE is_new = 1 AND created <= DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL 2 DAY)'
	 *
	 * If other kind of query is used it should be passed as Database_Query object:
	 * 	DB::query(Database::UPDATE, 'UPDATE categories SET active = 0 WHERE category_id NOT IN (SELECT id FROM categories)')
	 *
	 */
	'lost_reference_delete_queries' => [
		'DELETE FROM articles WHERE is_new = 1 AND created <= DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL 2 DAY)',
		'DELETE FROM projects WHERE is_new = 1 AND created <= DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL 2 DAY)',
	],


	/**
	 * A list of models which should be checked for assets existance during the grabage collection.
	 *
	 */
	'orphan_models' => [
		'Model_About_Block',
		'Model_Article_Image',
		'Model_Article',
		'Model_Employee',
		'Model_Homeslide',
		'Model_Project_Block',
		'Model_Project',
	],
);
