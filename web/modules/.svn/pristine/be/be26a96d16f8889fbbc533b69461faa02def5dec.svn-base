<?php defined('SYSPATH') OR die('No direct script access.');

class AVO_Lock {

	const FS_LOCKS_PATH = 'locks';
	const FS_LOCKS_SUFFIX = '.txt';

	/**
	 * Aquires a lock using the Mysql database
	 *
	 * @param String $lock_name - name of the lock
	 * @param int $wait - time in seconds before failing to aquire
	 */
	public static function db_aquire($lock_name, $wait = 0)
	{
		$db = Database::instance();
		if ($db instanceof Database_MsSQL)
		{
			if (PHP_OS == 'Darwin') {
				$query = 'SELECT 1';
			} else {
				$query =
					"DECLARE @result int
					EXEC @result = sp_getapplock @Resource = :lock_name, @LockMode = 'Exclusive', @LockTimeout = :wait, @LockOwner= 'Session'
					IF @result >= 0
						SELECT 1
					ELSE
						SELECT 0";
			}
		}
		elseif ($db instanceof Database_MySQL || $db instanceof Database_PDO_MySQL)
		{
			$query = 'SELECT GET_LOCK(:lock_name, :wait)';
		}
		else
		{
			return FALSE;
		}
		$is_lock_aquired = DB::query(Database::SELECT, $query)->parameters(array(
			':lock_name' => $lock_name,
			':wait' => $wait,
		))->execute()->get(0);
		if ($is_lock_aquired > 0)
		{
			return $lock_name;
		}
		else
		{
			return FALSE;
		}

	}


	/**
	 * Releases a lock aquired using the Mysql database
	 *
	 * @param String $lock_name - name of the lock
	 */
	public static function db_release($lock_name)
	{
		$db = Database::instance();
		if ($db instanceof Database_MsSQL)
		{
			if (PHP_OS == 'Darwin') {
				$query = 'SELECT 1';
			} else {
				$query =
					"DECLARE @result int;
					EXEC @result = sp_releaseapplock @Resource = :lock_name, @LockOwner= 'Session';
					IF @result >= 0
						SELECT 1
					ELSE
						SELECT 0";
			}
		}
		elseif ($db instanceof Database_MySQL || $db instanceof Database_PDO_MySQL)
		{
			$query = 'SELECT RELEASE_LOCK(:lock_name)';
		}
		else
		{
			return FALSE;
		}

		return DB::query(Database::SELECT, $query)->parameters(array(':lock_name' => $lock_name))->execute()->get(0);
	}


	/**
	 * Aquires a lock using the file system
	 *
	 * @param string $lock_name - name of the lock
	 * @param boolean $wait - whether wait before the lock acuired by someone else gets relesed
	 * @return FALSE if failed of a file handle of the lock file
	 */
	public static function aquire($lock_name, $wait = TRUE)
	{
		$lock = @fopen(APPPATH.self::FS_LOCKS_PATH.DIRECTORY_SEPARATOR.$lock_name.self::FS_LOCKS_SUFFIX, 'w+');
		if ($lock && flock($lock, LOCK_EX, $wait))
		{
			return $lock;
		}
		else
		{
			return FALSE;
		}
	}


	/**
	 * Releases a lock aquired with AVO_Lock::aquire method
	 *
	 * @param Resource $lock_file - lock file
	 * @return boolean whether the lock has been released
	 */
	public static function release($lock_file)
	{
		if ($lock_file)
		{
			flock($lock_file, LOCK_UN);
			fclose($lock_file);
			return TRUE;
		}
		return FALSE;
	}

}

