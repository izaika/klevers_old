<?php defined('SYSPATH') OR die('No direct script access.');

class Controller_Admin_Helper extends Controller_Admin_Abstract_Authenticated {

	/**
	 * Proposal for the tags in the keywords
	 *
	 */
	public function action_tags()
	{
		$this->auto_render = FALSE;

		$tags = array();
		// trim and lowercase the keyword
		$keyword = UTF8::strtolower(UTF8::trim((string) Request::current()->post('term')));
		// do we have any keyword typed and the last one is at least 2 chars long?
		if (UTF8::strlen($keyword) >= 2)
		{
			$ds = DB::query(Database::SELECT,
				'SELECT id, tag FROM keywords WHERE tag LIKE :keyword ORDER BY tag LIMIT 10'
			)->param(':keyword', $keyword . '%')->execute();
			foreach ($ds as $row)
			{
				$tags[] = array(
					'id' => $row['id'],
					'label' => $row['tag'],
					'value' => $row['tag'],
				);
			}
		}
		$this->response->json()->no_cache()->body(json_encode($tags));
	}


	public function action_article_tags()
	{
		$this->auto_render = FALSE;

		$tags = [];
		// trim and lowercase the keyword
		$keyword = UTF8::strtolower(UTF8::trim((string) Request::current()->post('term')));
		// do we have any keyword typed and the last one is at least 2 chars long?
		if (UTF8::strlen($keyword) >= 2)
		{
			$ds = DB::query(Database::SELECT, 'SELECT id, title FROM tags WHERE title LIKE :keyword ORDER BY title LIMIT 10')
				->param(':keyword', $keyword . '%')
				->execute();
			foreach ($ds as $row) {
				$tags[] = [
					'id' => $row['id'],
					'label' => $row['title'],
					'value' => $row['title'],
				];
			}
		}
		$this->response->json()->no_cache()->body(json_encode($tags));
	}



	/**
	 * Add video for the edit form
	 */
	private function _add_generic_video($model, $form_preview_name_name = 'FORM_PREVIEW_NAME', $form_preview_w_name = 'FORM_PREVIEW_W')
	{
		$this->auto_render = FALSE;
		$video_url = $this->request->post('url');
		$result = new stdClass();
		if (preg_match('|^https?://vimeo.com/\d+$|', $video_url))
		{
			$static_url = 'http://vimeo.com/api/oembed.json?url=';
			$video_width = $this->request->post('width');
			$curl = curl_init($static_url.rawurlencode($video_url) . '&width=' . $video_width);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_TIMEOUT, 15);
			$data_json = json_decode(curl_exec($curl));
			curl_close($curl);
			if ($data_json)
			{
				if (isset($data_json->thumbnail_url))
				{
					$upload_id = $this->request->post('upload_id');
					$tmp_image_file = tempnam(App::TEMP_UPLOAD_STORAGE, Session::instance()->id());
					$fp = fopen($tmp_image_file, 'w');
					$ch = curl_init($data_json->thumbnail_url);
					curl_setopt($ch, CURLOPT_FILE, $fp);
					curl_setopt($ch, CURLOPT_TIMEOUT, 15);
					curl_exec($ch);
					curl_close($ch);
					fclose($fp);
					$tmp_file_path_base = $model::get_temp_storage_base($upload_id);
					$ext = $model::create_resized_images($tmp_image_file, $tmp_file_path_base);
					$result->ext = $ext;
					$result->upload_id = $upload_id;
					$no_cache_suffix = '?nocache='.mt_rand();
					$storage_url_base = $model::get_temp_storage_base_url($upload_id);
					$result->html = HTML::anchor(
						$storage_url_base.$model::$ORIGINAL_NAME.'.'.$ext.$no_cache_suffix,
						HTML::image($storage_url_base.constant($model.'::'.$form_preview_name_name).'.'.$ext.$no_cache_suffix),
						array('class' => 'zoomed_preview')
					);
				}
				else
				{
					$result->html = $model::get_arbitrate_video($video_url, constant($model.'::'.$form_preview_w_name));
				}

				$result->title = (property_exists($data_json, 'title')) ? $data_json->title : '';
				$result->status = 0;
				$result->message = __('Video added');
			}
			else
			{
				$result->status = 1;
				$result->message = __('Incorrect video ID');
			}
		}
		elseif (preg_match("/youtube.com\/watch\?v=/", $video_url))
		{
			$youtube_id = substr($video_url, strpos($video_url, 'watch?v=')+8, strlen($video_url));
			$thumb_url = 'http://img.youtube.com/vi/'.$youtube_id.'/maxresdefault.jpg';

			$upload_id = $this->request->post('upload_id');
			$tmp_image_file = tempnam(App::TEMP_UPLOAD_STORAGE, Session::instance()->id());
			$fp = fopen($tmp_image_file, 'w');
			$ch = curl_init($thumb_url);
			curl_setopt($ch, CURLOPT_FILE, $fp);
			curl_setopt($ch, CURLOPT_TIMEOUT, 15);
			curl_exec($ch);
			curl_close($ch);
			fclose($fp);
			$tmp_file_path_base = $model::get_temp_storage_base($upload_id);
			$ext = $model::create_resized_images($tmp_image_file, $tmp_file_path_base);
			$result->ext = $ext;
			$result->upload_id = $upload_id;
			$no_cache_suffix = '?nocache=' . mt_rand();
			$storage_url_base = $model::get_temp_storage_base_url($upload_id);
			$result->html = HTML::anchor(
				$storage_url_base . $model::$ORIGINAL_NAME.'.'.$ext.$no_cache_suffix,
				HTML::image($storage_url_base . constant($model.'::'.$form_preview_name_name).'.'.$ext.$no_cache_suffix),
				array('class' => 'zoomed_preview')
			);


			$result->status = 0;
			$result->message = __('Video added: '.$youtube_id);
		} else {
			$result->status = 1;
			$result->message = __('Failed to fetch video image');
		}

		echo json_encode($result);
	}


	public function action_regenerate_images()
	{
		set_time_limit(0);
		$model_name = $this->request->query('model');
		$model_name::regenerate_all();
	}
}







