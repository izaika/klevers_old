<?php

abstract class AVO_Controller extends Controller_Template
{
	const RESOURCE_SERIAL = 0;

	/**
	 * HMVC module name
	 * @var string
	 */
	public $module;
	/**
	 * A shortcut for the value of URL::base() since it is used pretty extensively
	 * @var string
	 */
	public $base_url;
	/**
	 * View path which then is replaced with the view object
	 * If no path is provided it is calculated basing on the name of the controller and method called
	 * @var String/View
	 */
	public $view;
	/**
	 * Session instance
	 * @var Session
	 */
	public $session;
	/**
	 * Assign an view automatically basing on the module/controller/action names
	 * @var boolean
	 */
	public $auto_view = true;

	protected $_ajax_controllers = array();

	public function before()
	{
		// find the template
		$template_exists = $this->auto_render = ($this->module != '');
		if ($template_exists) {
			$this->template = $this->module.'/layout';
		} else {
			$this->template = null;
		}

		// disable the templates for the ajax requests by the AVO controls
		if ($this->request->is_avo_ajax()) {
			if ($this->request->is_avo_ajax_upload()) {
				if ($this->request->query('__avo_close_connection') !== null) {
					header('connection: close', true);
					exit;
				} else {
					$this->response->headers('Content-type', 'text/plain');
					$this->auto_render = false;
				}
			} elseif (!$this->request->is_avo_ajax_content()) {
				$this->response->json();
				$this->auto_render = false;
			}
		}

		// call the parent for template initialization
		parent::before();

		// shortcut for quick access the application base url
		$this->base_url = URL::base();
		try {
			$action_method = new ReflectionMethod($this, 'action_'.$this->request->action());
			$action_comments = $action_method->getDocComment();
		} catch (Exception $e) {
			$action_comments = '';
		}

		if ($this->auto_render) {
			// set up the view
			// @noview in action method comment prevents from creating a view
			if (!preg_match('/^\s*\*\s*@noview\b/m', $action_comments) || !$this->auto_view)
			{
				// calculate the view to use in the layout if not provided
				if (!$this->view) {
					$view_path = $this->module.DIRECTORY_SEPARATOR.str_replace('_', DIRECTORY_SEPARATOR, strtolower($this->request->controller())).DIRECTORY_SEPARATOR.$this->request->action();
					if (Kohana::find_file('views', $view_path)) $this->view = $view_path;
				}
				// attach the view to the layout
				if ($this->view) $this->view = View::factory($this->view);
			}

			if ($this->view) {
				// ajax requests for content do not include the layout. Only the view
				if ($this->request->is_avo_ajax_content()) {
					$this->template = $this->view;
				} else {
					$this->template->content = $this->view;
				}
			} else {
				$this->template->content = '';
			}

			// basic variables for the template
			$this->template->styles = array();
			$this->template->scripts = array();
			$this->template->head_addons = array();
			$this->template->title = '';
			$this->template->seo_title = '';
			$this->template->seo_keywords = '';
			$this->template->seo_description = '';
			$this->template->base_url = $this->base_url;
		}

		// run initialization queries
		$avo_config = Kohana::$config->load('avo');
		foreach ($avo_config->get('db_initialization_queries', array()) as $query) {
			AVO_DB_Query::build(Database::UPDATE, $query)->bind()->execute();
		}

		// set up the session
		// @nosession in action method comment prevents from creating a session
		if (!preg_match('/^\s*\*\s*@nosession\b/m', $action_comments) && $this->session !== false) {
 			$this->session = Session::instance();
		};

		// run the garbage collector
		$gc_probability = Kohana::$config->load('session.database.gc');
		if (mt_rand(1, $gc_probability) == $gc_probability) self::collect_garbage();
	}


	public function after()
	{
		$this->dispatch_ajax_controller_request();
		parent::after();
	}


	/**
	 * collects a gargbage produced by the application
	 *
	 */
	public static function collect_garbage($force_collect = false)
	{
		$avo_config = Kohana::$config->load('avo');

		// garbage is collected once per day
		if (!DB::query(Database::SELECT, $avo_config['gc_check_query'])->cached(3600)->execute()->count()) {
			// doublecheck it, we need to be sure that variable doesn't exist before inserting it
			if (!DB::query(Database::SELECT, $avo_config['gc_check_query'])->execute()->count()) {
				// Houston we need to insert:
				DB::query(Database::INSERT, $avo_config['gc_init_query'])->execute();
			}
		}
		if (!$force_collect && !DB::query(Database::SELECT, $avo_config['gc_run_query'])->cached(3600)->execute()->get(0)) return;

		$lock = AVO_Lock::db_aquire($avo_config['cookie_salt'].'_gc');
		if ($lock === false) return;

		try {
			$cur_time = time();
			$interrupt_at = $cur_time + 10; // maximum time for garbage collection

			// remove temp media files older than 2 days
			$base_dir = DOCROOT.'assets/tmp';
			$dh = @opendir($base_dir);
			if ($dh) {
				while (($filename = @readdir($dh)) !== false) {
					if ($filename == '.' || $filename == '..' || $filename == '.svn') continue;
					$file_path = $base_dir.'/'.$filename;
					if (is_file($file_path)) {
						$file_stat = stat($file_path);
						if ($force_collect || $file_stat['mtime'] + 2 * 24 * 60 * 60 <= $cur_time) {
							@unlink($file_path);
						}
						if (!$force_collect && time() >= $interrupt_at) throw new Exception('gc timeout');
					}
				}
				@closedir($dh);
			}

			// delete the database resources which are no longer needed
			foreach ($avo_config->get('lost_reference_delete_queries', array()) as $query) {
				AVO_DB_Query::build(Database::DELETE, $query)->bind()->execute();
			}

			// delete orphan files
			$file_creation_delta = $force_collect ? 0 : 60 * 60; // 1 hour
			foreach ($avo_config->get('orphan_models') as $model) {
				// TODO: implement orphans cleaning for models with more that one directory, by processing array(), returned by $model::get_storage_path()
				$base_dir = method_exists($model, 'get_storage_base')
					? $model::get_storage_base()
					: null;
				if ($base_dir === null) continue;

				// collect all directories present
				$dh = @opendir($base_dir);
				if (!$dh) continue;
				$files = array();
				while (($filename = @readdir($dh)) !== false) {
					if (!ctype_digit($filename)) continue;
					$file_stat = stat($base_dir.'/'.$filename);
					if ($force_collect || $file_stat['mtime'] + $file_creation_delta <= $cur_time) {
						$files[] = (int) $filename;
					}
				}
				@closedir($dh);
				if (!count($files)) continue;

				// check which of them are in the database
				$present = array();
				foreach ($model::factory()->where('id', 'IN', DB::expr('('.implode(',', $files).')'))->find_all() as $row) {
					$present[] = $row->id;
				}
				$orphans = array_diff($files, $present);
				foreach ($orphans as $id) {
					$file_path = $base_dir.$id;
					@unlink($file_path);
					File::rm_dir($file_path);
					if (!$force_collect && time() >= $interrupt_at) throw new Exception('gc timeout');
				}
			}

			// the garbage collection is over
			DB::query(Database::UPDATE, $avo_config['gc_done_query'])->execute();
		} catch (Exception $e) {
			// do nothing. We just interrupted the garbage collection to prevent the script failure with the timeout
		}

		// release the lock
		AVO_Lock::db_release($lock);
	}


	public function dispatch_ajax_controller_request()
	{
		// controllers are always queries with POST method
		// object name and action must be specified
		if ($this->request->is_post() || $this->request->is_put()) {
			$controller_name = $this->request->query('__avo_ajax_controller');
			if ($controller_name !== null) {
				foreach ($this->_ajax_controllers as $controller) {
					if ($controller->name == $controller_name) {
						$this->response->body($controller->handle_action($this->request->query('__avo_ajax_action')));
						return;
					}
				}
			}
		}
	}


	public function register_ajax_controller($control)
	{
		$this->_ajax_controllers[] = $control;
		if (method_exists($control, 'on_register_controller')) $control->on_register_controller($this);

		// register the linked grids
		if ($control instanceof AVO_Data_Form && $control->controls !== null) {
			foreach ($control->controls as $field) {
				if ($field instanceof AVO_Link) $this->register_ajax_controller($field->child);
			}
		}

		// register also the child forms
		if (is_array($control->forms)) {
			foreach ($control->forms as $form) {
				$this->register_ajax_controller($form);
			}
		}
	}


	/**
	 * sets the view for the template
	 * @param string $view_path
	 */
	public function set_view($view_path)
	{
		$this->view = View::factory($view_path);
		if (is_object($this->template)) $this->template->content = $this->view;
	}


	protected function add_js_script($script)
	{
		// scripts must be prepended before the main application script
		$last_script = $this->template->scripts ? array_pop($this->template->scripts) : null;
		$this->template->scripts[] = $script;
		if ($last_script) {
			$this->template->scripts[] = $last_script;
		}
	}


	protected function add_stylesheet($stylesheet)
	{
		// styles must be prepended before the main application stylesheet so it is able to override the library definitions
		$last_stylesheet = $this->template->styles ? array_pop($this->template->styles) : null;
		$this->template->styles[] = is_string($stylesheet) ? array('url' => $stylesheet) : $stylesheet;
		if ($last_stylesheet) {
			$this->template->styles[] = $last_stylesheet;
		}
	}


	public function use_client_library($name)
	{
		if (!is_object($this->template)) return;
		$is_development_mode = (Kohana::$environment == Kohana::DEVELOPMENT);
		$suffix = $is_development_mode ? '' : '.min';

		foreach (func_get_args() as $name) {
			switch ($name) {
				case 'avo':
					$this->add_js_script('lib/avo/js/avo.'.static::RESOURCE_SERIAL.'.js');
					$this->add_stylesheet(array('url' => 'lib/avo/css/style.'.static::RESOURCE_SERIAL.'.css'));
					break;

				case 'bootstrap':
					$version = '3.3.6';
					$this->add_js_script('lib/bootstrap-'.$version.'/js/bootstrap'.$suffix.'.js');
					$this->add_stylesheet(array('url' => 'lib/bootstrap-'.$version.'/css/bootstrap'.$suffix.'.css'));
					break;

				case 'bootstrap-maxlength':
					$this->add_js_script('lib/bootstrap-maxlength-1.5.0/bootstrap-maxlength'.$suffix.'.js');
					break;

				case 'fancybox':
					$fb_suffix = ($is_development_mode ? '' : '.min') ? '.pack' : '';
					$this->add_js_script('lib/fancyapps-fancyBox-v2.1.5/source/jquery.fancybox'.$fb_suffix.'.js');
					$this->add_stylesheet(array('url' => '/lib/fancyapps-fancyBox-v2.1.5/source/jquery.fancybox.css'));
					break;

				case 'filedrop':
					$this->add_js_script('lib/filedrop-20140313-custom1/jquery.filedrop.js');
					break;

				case 'jcrop':
					$version = '0.9.12';
					$this->add_stylesheet(array('url' => 'lib/jcrop-'.$version.'/css/jquery.Jcrop'.$suffix.'.css'));
					$this->add_js_script('lib/jcrop-'.$version.'/js/jquery.Jcrop'.$suffix.'.js');
					break;

				case 'jquery':
					$version = '2.2.1';
					$this->add_js_script('lib/jquery/jquery-'.$version.'.min.js');
					break;

				case 'jquery-dataSelector':
					$this->add_js_script('lib/jquery-dataSelector/jquery.dataSelector.js');
					break;

				case 'jquery-ui':
					$version = '1.10.4';
					$this->add_js_script('lib/jquery-ui-'.$version.'/js/jquery-ui-'.$version.'.custom'.$suffix.'.js');
					$this->add_stylesheet(array('url' => 'lib/jquery-ui-'.$version.'/css/no-theme/jquery-ui-'.$version.'.custom'.$suffix.'.css'));
					break;

				case 'jquery-ui-timepicker':
					$this->add_js_script('lib/jquery-ui-timepicker-addon-1.3/jquery-ui-timepicker-addon.js');
					break;

				case 'modernizr':
					$version = '2.7.1';
					$this->add_js_script('lib/modernizr/modernizr'.$suffix.'-'.$version.'.js');
					break;

				case 'select2':
					$version = '3.4.4';
					$this->add_stylesheet(array('url' => 'lib/select2-'.$version.'/select2.css'));
					$this->add_js_script('lib/select2-'.$version.'/select2'.$suffix.'.js');
					break;

				case 'summernote':
					$version = '0.6';
					$this->add_js_script('lib/summernote-'.$version.'/summernote'.$suffix.'.js');
					$this->add_stylesheet(array('url' => 'lib/summernote-'.$version.'/summernote.css'));
					$this->add_stylesheet(array('url' => 'lib/summernote-'.$version.'/summernote-bs3.css'));
					$this->add_stylesheet(array('url' => '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'));
					break;

				case 'tinymce':
					$version = '4.3.8';
					$this->add_js_script('lib/tinymce-'.$version.'/jquery.tinymce.min.js');
					$this->add_js_script('lib/tinymce-'.$version.'/tinymce.min.js');
					break;

				case 'underscore':
					$version = '1.7.0';
					$u_suffix = $is_development_mode ? '' : '-min';
					$this->add_js_script('lib/underscore-'.$version.'/underscore'.$u_suffix.'.js');
					break;

				case 'fileuploader':
					$this->add_js_script('lib/valums-file-uploader/fileuploader.js');
					$this->add_stylesheet(array('url' => 'lib/valums-file-uploader/fileuploader.css'));
					break;

				default:
					throw new Exception(__('Client library ":library" is not found', array(':library' => $name)));
			}
		}
	}
}
