<?php defined('SYSPATH') OR die('No direct script access.');

class Kohana extends Kohana_Core {


	/**
	 * Provides simple file-based caching for strings and arrays:
	 *
	 *     // Set the "foo" cache
	 *     Kohana::cache('foo', 'hello, world');
	 *
	 *     // Get the "foo" cache
	 *     $foo = Kohana::cache('foo');
	 *
	 * All caches are stored as PHP code, generated with [var_export][ref-var].
	 * Caching objects may not work as expected. Storing references or an
	 * object or array that has recursion will cause an E_FATAL.
	 *
	 * The cache directory and default cache lifetime is set by [Kohana::init]
	 *
	 * [ref-var]: http://php.net/var_export
	 *
	 * @throws  Kohana_Exception
	 * @param   string  $name       name of the cache
	 * @param   mixed   $data       data to cache
	 * @param   integer $lifetime   number of seconds the cache is valid for
	 * @return  mixed    for getting
	 * @return  boolean  for setting
	 */
	public static function cache($name, $data = NULL, $lifetime = NULL)
	{
		// Cache file is a hash of the name
		$file = sha1($name).'.txt';

		// Cache directories are split by keys to prevent filesystem overload
		$dir = Kohana::$cache_dir.DIRECTORY_SEPARATOR.$file[0].$file[1].DIRECTORY_SEPARATOR;

		if ($lifetime === NULL)
		{
			// Use the default lifetime
			$lifetime = Kohana::$cache_life;
		}

		if ($data === NULL)
		{
			if (is_file($dir.$file))
			{
				if ((time() - filemtime($dir.$file)) < $lifetime)
				{
					// Return the cache
					try
					{
						$contents = file_get_contents($dir.$file);
						if ($contents == '') return NULL; // cache file disappeared in action
						return unserialize($contents);
					}
					catch (Exception $e)
					{
						// Cache is corrupt, let return happen normally.
					}
				}
				else
				{
					try
					{
						// Cache has expired
						unlink($dir.$file);
					}
					catch (Exception $e)
					{
						// Cache has mostly likely already been deleted,
						// let return happen normally.
					}
				}
			}

			// Cache not found
			return NULL;
		}

		if (!is_dir($dir))
		{
			// Create the cache directory
			@mkdir($dir, 0777, TRUE);

			// Set permissions (must be manually set to fix umask issues)
			@chmod($dir, 0777);
		}

		// Force the data to be a string
		$data = serialize($data);

		$tmpfile = $dir.$file.'.'.uniqid('', true);
		try
		{
			// Write the cache
			file_put_contents($tmpfile, $data);
			@unlink($dir.$file);
			rename($tmpfile, $dir.$file);
			return TRUE;
		}
		catch (Exception $e)
		{
			// Failed to write cache
		}
		@unlink($tmpfile);
		return FALSE;
	}

}