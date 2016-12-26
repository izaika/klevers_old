<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Creates an on-update/insert trigger for the table
 *
 * Available options:
 * - table - a name of the table to attache the triggers to. Must be provided
 *
 */
class Task_Db_Row_Sizes extends Minion_Task {

	protected function _execute(array $params)
	{
		// current database name
		$db_config = Kohana::$config->load('database');
		$db_name = $db_config['default']['connection']['username'];

		// max lengths for charsets
		$charset_maxlen = array();
		foreach (DB::query(Database::SELECT, 'SELECT CHARACTER_SET_NAME, MAXLEN FROM information_schema.CHARACTER_SETS')->execute() as $charset)
		{
			$charset_maxlen[$charset['CHARACTER_SET_NAME']] = (int) $charset['MAXLEN'];
		}

		// max lengths for collations
		$collation_maxlen = array();
		$query =
			'SELECT COLLATION_NAME, MAXLEN
			FROM information_schema.CHARACTER_SETS
				INNER JOIN information_schema.COLLATIONS USING (CHARACTER_SET_NAME)';
		foreach (DB::query(Database::SELECT, $query)->execute() as $charset)
		{
			$collation_maxlen[$charset['COLLATION_NAME']] = (int) $charset['MAXLEN'];
		}

		$data_types = array(
			'TINYINT' => 1, 'SMALLINT' => 2, 'MEDIUMINT' => 3, 'INT' =>4, 'INTEGER' => 4, 'BIGINT' => 8,
			'FLOAT' =>
				function ($m)
				{
					return ($m <= 24) ? 4 : 8;
				},
			'DOUBLE' => 8,
			'DECIMAL' =>
				function ($m, $d)
				{
					return (int) (($m - $d) / 9) * 4 + (int) (((($m - $d) % 9) + 1) / 2) + (int) ($d / 9) * 4 + (int) ((($d % 9) + 1) / 2);
				},
			'NUMERIC' =>
				function ($m, $d)
				{
					return (int) (($m - $d) / 9) * 4 + (int) (((($m - $d) % 9) + 1) / 2) + (int) ($d / 9) * 4 + (int) ((($d % 9) + 1) / 2);
				},
			'BIT' =>
				function ($m)
				{
					return ($m + 7) >> 3;
				},
			'DATE' => 3, 'TIME' => 3, 'DATETIME' => 8, 'TIMESTAMP' => 4, 'YEAR' => 1,
			'BINARY' =>
				function ($m)
				{
					return $m;
				},
			'CHAR' =>
				function ($m, $d, $cl)
				{
					return $m * $cl;
				},
			'VARBINARY' =>
				function ($m)
				{
					return min(768, $m + (($m > 255) ? 2 : 1));
				},
			'VARCHAR' =>
				function ($m, $d, $cl)
				{
					return min(768, $m * $cl + (($m > 255) ? 2 : 1));
				},
			'ENUM' =>
				function ($m)
				{
					return ($m > 255) ? 2 : 1;
				},
			'SET' =>
				function ($m)
				{
					return ($m + 7) >> 3;
				},
			'TINYBLOB' => 768, 'TINYTEXT' => 768,
			'BLOB' => 768, 'TEXT' => 768,
			'MEDIUMBLOB' => 768, 'MEDIUMTEXT' => 768,
			'LONGBLOB' => 768, 'LONGTEXT' => 768
		);
		
		// enumerate the tables
		$tables_ds = DB::query(Database::SELECT,
			'SELECT TABLE_NAME, TABLE_COLLATION
			FROM information_schema.TABLES
			WHERE
				TABLE_SCHEMA = :TABLE_SCHEMA
			ORDER BY TABLE_NAME'
		)->param(':TABLE_SCHEMA', $db_name)->execute();
		foreach ($tables_ds as $table)
		{
			$table_name = $table['TABLE_NAME'];
			$def_table_charset_len = $collation_maxlen[$table['TABLE_COLLATION']];

			$table_bytes = 0;

			// go through table fields
			$fields_ds = DB::query(Database::SELECT,
				'SELECT COLUMN_NAME, UPPER(DATA_TYPE) AS DATA_TYPE, CHARACTER_SET_NAME, COLLATION_NAME, CHARACTER_MAXIMUM_LENGTH, NUMERIC_PRECISION, NUMERIC_SCALE
				FROM information_schema.COLUMNS
				WHERE
					TABLE_SCHEMA = :TABLE_SCHEMA
					AND TABLE_NAME = :TABLE_NAME
				ORDER BY TABLE_NAME'
			)->param(':TABLE_SCHEMA', $db_name)->param(':TABLE_NAME', $table_name)->execute();
			foreach ($fields_ds as $fields)
			{
				$column_name = $fields['COLUMN_NAME'];
				$data_type_name = $fields['DATA_TYPE'];
				$collation_name = $fields['COLLATION_NAME'];
				$character_set_name = $fields['CHARACTER_SET_NAME'];
				$character_max_length = $fields['CHARACTER_MAXIMUM_LENGTH'];
				$numeric_precision = $fields['NUMERIC_PRECISION'];
				$numeric_scale = $fields['NUMERIC_SCALE'];

				$data_type = $data_types[$data_type_name];
				$m = ($character_max_length !== NULL) ? $character_max_length : $numeric_precision;
				$d = (int) $numeric_scale;
				$cl = isset($charset_maxlen[$character_set_name]) ? $charset_maxlen[$character_set_name] : 1;

				if (is_callable($data_type))
				{
					$field_bytes = $data_type($m, $d, $cl);
				}
				else
				{
					$field_bytes = $data_type;
				}

 				$table_bytes += $field_bytes;
			}

			if ($table_bytes < 4000)
			{
				Minion_CLI::write("$table_name: $table_bytes");
			}
			elseif ($table_bytes < 6000)
			{
				Minion_CLI::write("$table_name: ".Minion_CLI::color($table_bytes, 'white', 'blue'));
			}
			else
			{
				Minion_CLI::write("$table_name: ".Minion_CLI::color($table_bytes, 'white', 'red'));
			}
		}
	}

}
