<?php defined('SYSPATH') or die('No direct script access.');

return array(

	/**
	 * Cookie salt
	 * Random unique (per application) string
	 *
	 */
	'cookie_salt' => '',


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
	'gc_run_query'	=> 'SELECT (datetime_val <= DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL 1 SECOND)) AS value FROM variables WHERE str_id = "gc_datetime"',


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
	 * A Database::SELECT query executed when a garbage collection about to find it's variable
	 *
	 * MYSQL example:
	 *	'SELECT datetime_val FROM variables WHERE str_id = "gc_datetime"'
	 *
	 * SQLite example:
	 * 	'SELECT datetime_val FROM variables WHERE str_id = "gc_datetime"'
	 *
	 */
	'gc_check_query'	=> 'SELECT datetime_val FROM variables WHERE str_id = "gc_datetime"',


	/**
	 * A Database::INSERT query executed when a garbage collection can not find it's initial variable
	 *
	 * MYSQL example:
	 *	'INSERT INTO variables SET datetime_val = CURRENT_TIMESTAMP(), created = CURRENT_TIMESTAMP(), modified = CURRENT_TIMESTAMP(), modify_count = modify_count + 1, str_id = "gc_datetime"'
	 *
	 * SQLite example:
	 * 	'INSERT INTO variables SET datetime_val = date("now"), created = date("now"), modified = date("now"), modify_count = modify_count + 1, str_id = "gc_datetime"'
	 *
	 */
	'gc_init_query'	=> 'INSERT INTO variables SET datetime_val = CURRENT_TIMESTAMP(), created = CURRENT_TIMESTAMP(), modified = CURRENT_TIMESTAMP(), modify_count = modify_count + 1, str_id = "gc_datetime"',


	/**
	 * Queries to execute during the garbage collection to remove the resouces from the database which are no longer reference by others
	 * Used for the database engines that do not support the referential integrity.
	 *
	 * Normally this is a Database::DELETE query. Example:
	 * 	'DELETE FROM categories WHERE category_id NOT IN (SELECT id FROM categories)'
	 *
	 * If other kind of query is used it should be passed as Database_Query object:
	 * 	DB::query(Database::UPDATE, 'UPDATE categories SET active = 0 WHERE category_id NOT IN (SELECT id FROM categories)')
	 *
	 */
	'lost_reference_delete_queries' => array(
	),


	/**
	 * A list of database tables and matching resource paths which should be checked for existance during the grabage collection.
	 * Match is performed by the value from the field named 'id' that is normally a key field of the table. If the table does not
	 * contain a record corresponding to the name of the file or directory the orphaned resource is removed from the disk.
	 * Example item:
	 * 	'articles'	=> array(DOCROOT . Model_File::STORAGE_PATH)
	 *
	 * would check the directory DOCROOT . Article_file_Model::PATH_FILES for files or directories that do not have a corresponding
	 * record in the 'articles' table by a value of field 'id'
	 *
	 */
	'orphan_resources_map' => array(
	),
);
