<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Instagram extends Model {

	protected $_reload_on_wakeup = FALSE;

	/**
	 * @var Model_Instagram instance
	 */
	private static $_instance;

	private $_instagram;
	private $_instagram_auth;

	private $_client_id;
	private $_client_secret;

	private $_access_token;

	public function __construct() {
		$this->_client_id = Model_Variable::value_by_name('instagram_client_id');
		$this->_client_secret = Model_Variable::value_by_name('instagram_client_secret');
		$this->_access_token = Model_Variable::value_by_name('instagram_access_token');

		require_once(APPPATH . 'classes/instagram/_autoloader.php');

		$auth_config = array(
			'client_id'         => $this->_client_id,
 			'client_secret'     => $this->_client_secret,
			'redirect_uri'      => URL::site('/admin/helper/instagram', true),
// 			'scope'             => array( 'likes', 'comments', 'relationships' )
		);
		$this->_instagram_auth = new Instagram\Auth($auth_config);

		$this->_instagram = new Instagram\Instagram;
		if ($this->_access_token) $this->_instagram->setAccessToken($this->_access_token);

	}


	public function authorize() {
		$this->_instagram_auth->authorize();
		// $this->_instagram_auth->authorize() will issue redirect
	}


	public function process_call_back($param) {
		$this->_access_token = $this->_instagram_auth->getAccessToken( $param );
		Model_Variable::save_value_by_name('instagram_access_token', $this->_access_token);
	}


	public function loaded() {
		return (
			isset($this->_client_id) && !empty($this->_client_id) &&
			isset($this->_client_secret) && !empty($this->_client_secret) &&
			isset($this->_access_token) && !empty($this->_access_token)
		);
	}


	public function get_user_media($param, $items_per_page = 10, $max_id = null)
	{
		$key = "instagram_user_{$param}";
		$user = Kohana::cache($key);
		if (!$user) {
			$user = $this->_instagram->getUser($param);
			Kohana::cache($key, $user);
		}

		$key = "instagram_user_{$param}_media_{$max_id}";
		$media = Kohana::cache($key);
		if (!$media) {
			$media = $user->getMedia(array('count' => $items_per_page, 'max_id' => $max_id));
			Kohana::cache($key, $media);
		}

		return $media;
	}


	public function get_tag_media($tag_name, $items_per_page = 10, $max_tag_id = null) {
		$key = "instagram_tag_{$tag_name}";
		$tag = Kohana::cache($key);
		if (!$tag) {
			$tag = $this->_instagram->getTag($tag_name);
			Kohana::cache($key, $tag);
		}

		$key = "instagram_tag_{$tag_name}_{$items_per_page}_media_{$max_tag_id}";
		$media = Kohana::cache($key);
		if (!$media) {
			$media = $tag->getMedia(array('count' => $items_per_page, 'max_tag_id' => $max_tag_id));
			Kohana::cache($key, $media);
		}

		return $media;
	}


	public function search_user($param) {
		return $this->_instagram->searchUsers($param);
	}


	/**
	 * Create a new model instance.
	 *
	 *     $model = Model::factory($name);
	 *
	 * @param   string   model name
	 * @return  Model_Instagram
	 */
	public static function factory($name = NULL)
	{
		$_instagram = parent::factory('instagram');
		return $_instagram;
	}


	/**
	 * Singleton method, return or create Model_Instagram class instance
	 * @return Model_Store
	 */
	public static function instance() {
		if (!self::$_instance) self::$_instance = static::factory();
		return self::$_instance;
	}


}
