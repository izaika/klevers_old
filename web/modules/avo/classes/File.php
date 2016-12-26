<?php defined('SYSPATH') OR die('No direct script access.');

class File extends Kohana_File {

	/**
	 * Removes a directory on the file system recursively
	 * @param string $path
	 */
	public static function rm_dir($path, $remove_starting_directory = TRUE)
	{
		if ($current_dir = @opendir($path))
		{
			while ($entryname = readdir($current_dir))
			{
				if ($entryname != '.' AND $entryname != '..' AND $entryname != '.svn')
				{
					$fpath = $path.DIRECTORY_SEPARATOR.$entryname;
					if (is_dir($fpath))
					{
						self::rm_dir($fpath);
					}
					else
					{
						@unlink($fpath);
					}
				}
			}
			@closedir($current_dir);
		}
		if ($remove_starting_directory) @rmdir($path);
	}


	/**
	 * Clears the Kohana file cache
	 */
	public static function clear_cache()
	{
		self::rm_dir(Kohana::$cache_dir, FALSE);
	}

	
	/**
	 * Return the mime type of an extension.
	 *
	 *     $mime = File::mime_by_ext('png'); // "image/png"
	 *
	 * @param   string  $extension  php, pdf, txt, etc
	 * @return  string  mime type on success
	 * @return  FALSE   on failure
	 */
	public static function mime_by_ext($extension)
	{
		// Load all of the mime types
		$mimes = Kohana::$config->load('mimes');
	
		return isset($mimes[$extension]) ? $mimes[$extension][count($mimes[$extension]) - 1] : false;
	}
	
	
}
