<?php


class Model_File extends Model_Category
{
	protected $_table_name = 'files';
	public static $FILE_STORAGE_PATH = 'assets/f_pdfs/';

	public static $file_uid_field_name 	= 'pdf_uid';
	public static $file_name_field_name = 'pdf_filename';
	public static $file_size_field_name = 'pdf_filesize';

	const DOWLOAD_CONTROLLER_PATH = 'file/';


	/**
	 * Returns a storage path to the file
	 *
	 * @return string
	 */
	public function file_storage()
	{
		return DOCROOT.static::$FILE_STORAGE_PATH.$this->id.'/'.$this->{self::$file_uid_field_name};
	}


	/**
	 * Returns a public download url for the file
	 *
	 * @return mixed
	 */
	public function file_url()
	{
		if ($this->{self::$file_uid_field_name}) {
			return self::$FILE_STORAGE_PATH.$this->id.'-'.$this->{self::$file_uid_field_name}.'/'.rawurlencode($this->{self::$file_name_field_name});
		} else {
			return null;
		}
	}


	/**
	 * Returns a public download url for the file
	 *
	 * @return mixed
	 */
	public function download_url()
	{
		if ($this->{self::$file_uid_field_name}) {
			return self::DOWLOAD_CONTROLLER_PATH.$this->id.'/'.$this->{self::$file_uid_field_name}.'/'.rawurlencode($this->{self::$file_name_field_name});
		} else {
			return null;
		}
	}


	public static function get_temp_storage($file_id)
	{
		return DOCROOT.App::TEMP_UPLOAD_STORAGE.Session::instance()->id().'_'.$file_id;
	}


	/**
	 * Returns a download url for the temporary uploaded file
	 *
	 * @return mixed
	 */
	public static function download_temp_url($file_id, $file_name)
	{
		return self::DOWLOAD_CONTROLLER_PATH.'0/'.Session::instance()->id().'_'.$file_id.'/'.$file_name;
	}


	public static function serve_file_download($id, $uid, $file_name)
	{
		if ($id == '0') {
			$storage_path = realpath(DOCROOT.App::TEMP_UPLOAD_STORAGE).'/';
			$filename = trim($file_name);
			$path = $storage_path.$uid;
			if (!is_file($path) || $file_name == '') throw new HTTP_Exception_404();
		} else {
			$file = new self($id);
			if (!$file->loaded() || $file->{self::$file_uid_field_name} != $uid) throw new HTTP_Exception_404();
			$filename = $file->{self::$file_name_field_name};
			$path = $file->file_storage();
		}
		Response::factory()->send_file($path, $filename);
	}
}
