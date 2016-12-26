<?php

use Dompdf\Dompdf;

class Controller_Public extends Controller_Abstract_Public
{

	public function before()
	{
		parent::before();
	}

// SPLASH
	public function action_index()
	{
		$this->session->set('cat_id', 0);
		$this->set_view($this->module.'/index');

		$this->template->seo_title			= Model_Variable::value_by_name('global_title', true);
		$this->template->seo_keywords		= Model_Variable::value_by_name('global_keywords', true);
		$this->template->seo_description	= Model_Variable::value_by_name('global_description', true);
	}


// HOME
	public function action_hjem()
	{
		$this->session->set('cat_id', 0);
		$this->template->seo_title			= Model_Variable::value_by_name('global_title', true);
		$this->template->seo_keywords		= Model_Variable::value_by_name('global_keywords', true);
		$this->template->seo_description	= Model_Variable::value_by_name('global_description', true);

		$this->set_view($this->module.'/home');
		$this->view->quote 				= Model_Variable::value_by_name('homepage_quote', true);
		$this->view->slides 			= Model_Homeslide::factory()->cached()->find_all();

		$projects = DB::query(Database::SELECT, '
			SELECT p.*
			FROM projects p
			JOIN homeprojects hp ON (p.id = hp.project_id)
			WHERE p.is_new = 0
			AND p.is_online = 1
			ORDER BY hp.ord ASC
			LIMIT 3
		')
		->cached()
		->as_object('Model_Project')
		->execute();

		$projects_arr = [];
		foreach ($projects as $p) {
			$projects_arr[] = $p;
		}
		$this->view->recent_projects 	= array_reverse($projects_arr);
	}


	public function action_prosjekter()
	{
		$project_url	= $this->request->param('second_param');
		$cat_id			= $this->session->get('cat_id') ? $this->session->get('cat_id') : 0;
		if ($project_url) {
// PROJECT ARTICLE
			$project = Model_Project::factory()->where('url_title', '=', $project_url)->and_where('is_new', '=', 0)->cached()->find();
			if ($project->loaded()) {
				if (!$project->is_online && !$this->session->get('admin:user_id')) {
					throw new HTTP_Exception_404;
				}
				$tags = '';
				$keywords = '';
				foreach ($project->tags->cached()->find_all() as $i => $t) {
					$tags .= $i ? ' '.$t->title : $t->title;
					$keywords .= $i ? ','.$t->title : $t->title;
				}
				$this->template->seo_title 			= $project->seo_title;
				$this->template->seo_keywords 		= $keywords;
				$this->template->seo_description	= $project->seo_description;
				$this->set_view($this->module.'/project_article');
				$this->view->project 				= $project;
				if ($cat_id != 0) {
					$category = new Model_Category($cat_id);
					if ($category->loaded()) {
						$next_project = DB::query(Database::SELECT,
							'SELECT p.*
							FROM projects p
							JOIN categories_projects cp ON(cp.project_id = p.id AND cp.category_id = :cat_id)
							WHERE p.ord >= :project_ord
							AND p.is_new = 0
							AND p.is_online = 1
							AND p.id <> :project_id
							ORDER BY p.ord ASC, p.id DESC
							LIMIT 1
						')
						->parameters([
							':project_ord'	=> $project->ord,
							':cat_id'		=> $cat_id,
							':project_id'	=> $project->id
						])
						->as_object('Model_Project')
						->cached()
						->execute()
						->current();
						if ($next_project && $next_project->loaded()) {
							$this->view->next_project_url			= $next_project->get_url();
							$this->view->next_project_link_title	= 'NESTE PROSJEKT<hr>';
						} else {
							$next_project = DB::query(Database::SELECT,
								'SELECT p.*
								FROM projects p
								JOIN categories_projects cp ON(cp.project_id = p.id AND cp.category_id = :cat_id)
								AND p.is_new = 0
								AND p.is_online = 1
								AND p.id <> :project_id
								ORDER BY p.ord ASC, p.id DESC
								LIMIT 1
							')
							->parameters([
								':cat_id'		=> $cat_id,
								':project_id'	=> $project->id
							])
							->as_object('Model_Project')
							->cached()
							->execute()
							->current();
							if ($next_project && $next_project->loaded()) {
								$this->view->next_project_url			= $next_project->get_url();
								$this->view->next_project_link_title	= 'SE FØRSTE PROSJEKT<hr>';
							} else {
								$this->view->next_project_url			= false;
								$this->view->next_project_link_title	= false;
							}
						}
					} else {
						throw new HTTP_Exception_404;
					}
				} else {
					$next_project = Model_Project::factory()
						->where('ord', '>=', $project->ord)
						->and_where('is_new', '=', 0)
						->and_where('is_online', '=', 1)
						->and_where('id', '<>', $project->id)
						->order_by('ord', 'ASC')
						->order_by('id', 'DESC')
						->cached()
						->find();
					if ($next_project->loaded()) {
						$this->view->next_project_url			= $next_project->get_url();
						$this->view->next_project_link_title	= 'NESTE PROSJEKT<hr>';
					} else {
						$next_project = Model_Project::factory()
							->where('is_new', '=', 0)
							->and_where('is_online', '=', 1)
							->and_where('id', '<>', $project->id)
							->order_by('ord', 'ASC')
							->order_by('id', 'DESC')
							->cached()
							->find();
						if ($next_project->loaded()) {
							$this->view->next_project_url			= $next_project->get_url();
							$this->view->next_project_link_title	= 'SE FØRSTE PROSJEKT<hr>';
						} else {
							$this->view->next_project_url			= false;
							$this->view->next_project_link_title	= false;
						}
					}
				}
				$this->view->blocks = DB::query(Database::SELECT, 'SELECT * FROM project_blocks WHERE project_id = :project_id ORDER BY ord')
					->param(':project_id', $project->id)
					->cached()
					->execute()
					->as_array();


				$related_projects = [];
				$index = Appsearch::open_index(Appsearch::INDEX_RELATED);
				ZendSearch\Lucene\Lucene::setResultSetLimit(50);
				$results = $index->find($tags);

				$categories = $project->categories->cached()->find_all();
				$categories_ids = [];
				foreach ($categories as $c) {
					$categories_ids[] = $c->id;
				}

				$this->view->related_projects = [];
				$count_related_articles 	= 0;
				$related_articles_limit 	= $this->module == 'mobile' ? 2 : 3;
				$related_articles_ids_arr	= [];
				foreach ($results as $r) {
					if (!$r->is_online) continue;
					$r_categories_ids = explode(',', $r->categories);
					if ($r->project_id !== $project->id) {
						if (!empty(array_intersect($categories_ids, $r_categories_ids))) {
							$this->view->related_projects[] = $r;
							$related_articles_ids_arr[]		= $r->project_id;
							$count_related_articles++;
						}
					}
					if ($count_related_articles == $related_articles_limit) break;
				}
				$additional_related_articles_limit = $related_articles_limit - $count_related_articles;
				if ($additional_related_articles_limit) {
					// echo 11; die;
					if ($cat_id != 0) {
						// echo 1; die;
						$this->view->additional_related_projects = DB::query(Database::SELECT,
								'SELECT DISTINCT p.*
								FROM projects p
								JOIN categories_projects cp ON(cp.project_id = p.id AND cp.category_id = :cat_id)
								WHERE p.is_new = 0
								AND p.is_online = 1
								'.($related_articles_ids_arr ? 'AND p.id NOT IN :related_articles_ids' : null).'
								AND p.id <> :project_id
								ORDER BY p.ord ASC, p.id DESC
								LIMIT :limit_value
							')
							->parameters([
								':project_ord'			=> $project->ord,
								':cat_id'				=> $cat_id,
								':project_id'			=> $project->id,
								':limit_value'			=> $additional_related_articles_limit,
								':related_articles_ids'	=> $related_articles_ids_arr
							])
							->as_object('Model_Project')
							->cached()
							->execute();
					} else {
						if (count($categories_ids)) {
							// echo 2; die;
							$this->view->additional_related_projects = DB::query(Database::SELECT,
								'SELECT DISTINCT p.*
								FROM projects p
								JOIN categories_projects cp ON(cp.project_id = p.id AND cp.category_id IN :cat_ids)
								WHERE p.is_new = 0
								AND p.is_online = 1
								'.($related_articles_ids_arr ? 'AND p.id NOT IN :related_articles_ids' : null).'
								AND p.id <> :project_id
								ORDER BY p.ord ASC, p.id DESC
								LIMIT :limit_value
								')
								->parameters([
									':project_ord'			=> $project->ord,
									':cat_ids'				=> $categories_ids,
									':project_id'			=> $project->id,
									':limit_value'			=> $additional_related_articles_limit,
									':related_articles_ids'	=> $related_articles_ids_arr
								])
								->as_object('Model_Project')
								->cached()
								->execute();
						} else {
							// echo 3; die;
							$this->view->additional_related_projects = DB::query(Database::SELECT,
								'SELECT DISTINCT p.*
								FROM projects p
								WHERE p.is_new = 0
								AND p.is_online = 1
								'.($related_articles_ids_arr ? 'AND p.id NOT IN :related_articles_ids' : null).'
								AND p.id <> :project_id
								ORDER BY p.ord ASC, p.id DESC
								LIMIT :limit_value
								')
								->parameters([
									':project_ord'			=> $project->ord,
									':project_id'			=> $project->id,
									':limit_value'			=> $additional_related_articles_limit,
									':related_articles_ids'	=> $related_articles_ids_arr
								])
								->as_object('Model_Project')
								->cached()
								->execute();
						}
					}
				} else {
					// echo 22; die;
				}
				// if ($next_project && $next_project->loaded()) {
				// 	$this->view->next_project_url = $next_project->get_url();
				// } else {
				// 	$this->view->next_project_url = false;
				// }
			} else {
				throw new HTTP_Exception_404;
			}
		} else {
// PROJECTS OVERVIEW
			$this->set_view($this->module.'/projects');
			$this->view->projects 				= Model_Project::factory()->where('is_new', '=', 0)->and_where('is_online', '=', 1)->cached()->find_all();
			$this->view->categories 			= Model_Category::factory()->cached()->find_all();
			$this->view->cat_id					= $cat_id;
			$this->template->no_footer			= true;
			$this->template->no_grid			= true;
			$this->template->seo_title			= Model_Variable::value_by_name('projects_title', true);
			$this->template->seo_keywords		= Model_Variable::value_by_name('projects_keywords', true);
			$this->template->seo_description	= Model_Variable::value_by_name('projects_description', true);
		}
	}


// CONTACT
	public function action_kontakt()
	{
		$this->session->set('cat_id', 0);
		$this->template->seo_title			= Model_Variable::value_by_name('contact_title', true);
		$this->template->seo_keywords		= Model_Variable::value_by_name('contact_keywords', true);
		$this->template->seo_description	= Model_Variable::value_by_name('contact_description', true);

		$this->set_view($this->module.'/contact');
	}


	public function action_project_pdf()
	{
		$id = $this->request->param('second_param');
		$project = Model_Project::factory(null, $id);
		if ($project->loaded()) {
			$html = View::factory($this->module.'/project_pdf', ['project' => $project]);
			$dompdf = new Dompdf;
			$dompdf->set_option('defaultFont', 'replica');
			$dompdf->loadHtml($html);
			$dompdf->setBasePath(DOCROOT);
			$dompdf->setPaper('A4', 'portrait');
			$dompdf->render();
			$this->response->headers('Content-type', 'application/pdf');
			$dompdf->stream($project->name);
		}
	}

// BLOG
	public function action_blogg()
	{
		$this->session->set('cat_id', 0);
		$this->set_view($this->module.'/blog');
		$this->view->articles = Model_Article::factory()->where('is_new', '=', 0)->order_by('public_date', 'DESC')->cached()->find_all();
		$this->template->blue_bg = true;
		$this->template->seo_title			= Model_Variable::value_by_name('blog_title', true);
		$this->template->seo_keywords		= Model_Variable::value_by_name('blog_keywords', true);
		$this->template->seo_description	= Model_Variable::value_by_name('blog_description', true);
	}

// ABOUT
	public function action_about()
	{
		$this->session->set('cat_id', 0);
		$this->template->seo_title			= Model_Variable::value_by_name('about_title', true);
		$this->template->seo_keywords		= Model_Variable::value_by_name('about_keywords', true);
		$this->template->seo_description	= Model_Variable::value_by_name('about_description', true);
		$this->set_view($this->module.'/about');
		$this->view->main_quote			= Model_Variable::value_by_name('about_quote', true);
		$this->view->blocks 			= Model_About_Block::factory()->cached()->find_all();
		$this->view->competence_text	= Model_Variable::value_by_name('about_competence_text', true);
		$this->view->categories 		= Model_Category::factory()->cached()->find_all();
		$this->view->cp_items 			= Model_Cp_Item::factory()->cached()->find_all()->as_array();
		$this->view->employees 			= Model_Employee::factory()->cached()->find_all();
		$this->view->bottom_heading		= Model_Variable::value_by_name('about_bottom_heading', true);
		$this->view->bottom_text		= Model_Variable::value_by_name('about_bottom_text', true);
		$this->view->general_file		= new Model_File(1);
	}

// SEARCH
	public function action_søk()
	{
		$this->session->set('cat_id', 0);
		$this->set_view($this->module.'/search');
		$this->template->seo_title			= Model_Variable::value_by_name('search_title', true);
		$this->template->seo_keywords		= Model_Variable::value_by_name('search_keywords', true);
		$this->template->seo_description	= Model_Variable::value_by_name('search_description', true);
		View::set_global('is_search', true);
	}


	public function action_set_category_id()
	{
		if (!$this->is_ajax) return;
		try {
			$id = (int) str_replace('cat_', '', $this->request->post('id'));
			$this->session->set('cat_id', $id);


			$this->result->status 	= 0;
			$this->result->cat_id 	= $this->session->get('cat_id');
		} catch (Exception $e) {
			$this->result->status 			= 1;
			$this->result->error_message 	= $e->getMessage();
		}
	}


	public function action_get_category_id()
	{
		if (!$this->is_ajax) return;
		try {
			$this->result->status 			= 0;
			$this->result->cat_id 			= (int) $this->session->get('cat_id');
		} catch (Exception $e) {
			$this->result->status 			= 1;
			$this->result->error_message 	= $e->getMessage();
		}
	}


	public function action_get_search_results()
	{
		if (!$this->is_ajax) return;
		try {
			$q_string = (string) $this->request->post('q_string');

			$index = Appsearch::open_index(Appsearch::INDEX_GENERAL);
			ZendSearch\Lucene\Lucene::setResultSetLimit(50);
			$results = $index->find('"'.$q_string.'"');
			if (!count($results)) {
				$results = $index->find('"'.$q_string.'"');
			}

			$this->result->status 	= 0;
			$this->result->html 	= View::factory($this->module.'/'.'_search_results', ['results' => $results])->render();
		} catch (Exception $e) {
			$this->result->status 			= 1;
			$this->result->error_message 	= $e->getMessage();
		}
	}


	public function action_get_all_categories_pdfs()
	{
		if (!$this->is_ajax) return;
		$pdf_urls = [];
		try {
			foreach (Model_Category_Pdf::factory()->cached()->find_all() as $c) {
				$pdf_urls[] = $c->download_url();
			}
			$this->result->status = 0;
			$this->result->pdf_urls = $pdf_urls;
		} catch (Exception $e) {
			$this->result->status = 1;
			$this->result->error_message = $e->getMessage();
		}
	}


	public function action_get_all_categories()
	{
		if (!$this->is_ajax) return;
		try {
			$categories = Model_Category_Pdf::factory()->cached()->find_all();
			$this->result->status 	= 0;
			$this->result->html 	= View::factory($this->module.'/'.'_categories_slideshow', ['categories' => $categories])->render();
		} catch (Exception $e) {
			$this->result->status 			= 1;
			$this->result->error_message 	= $e->getMessage();
		}
	}


	public function action_get_gallery_images()
	{
		if (!$this->is_ajax) return;
		$is_touch	= $this->request->post('is_touch');
		$project_id	= (int) $this->request->post('project_id');
		$project 	= Model_Project::factory(null, $project_id);
		$images 	= [];
		if ($project->loaded()) {
			try {
				$images[] = [
					'src'		=> $project->url($project::FULLSCREEN_NAME),
					'video_url'	=> $project->video_url,
					'type'		=> $project->video_url && !$is_touch ? 'video' : 'image',
				];
				foreach ($project->blocks->where('type', 'IN', [Model_Project_Block::TYPE_IMAGE, Model_Project_Block::TYPE_VIDEO])->cached()->find_all() as $b) {
					$images[] = [
						'src'		=> $b->url($b::FULLSCREEN_NAME),
						'video_url'	=> $b->video_url,
						'type'		=> $b->type == Model_Project_Block::TYPE_VIDEO && !$is_touch ? 'video' : 'image'
					];
				}
				$this->result->status	= 0;
				$this->result->html 	= View::factory($this->module.'/_gallery', ['images' => $images])->render();
			} catch (Exception $e) {
				$this->result->status 			= 1;
				$this->result->error_message 	= $e->getMessage();
			}
		} else {
			$this->result->status 			= 1;
			$this->result->error_message 	= 'Project was not found';
		}
	}


	public function action_get_blog_gallery_images()
	{
		if (!$this->is_ajax) return;
		$is_touch	= $this->request->post('is_touch');
		$article_id	= (int) $this->request->post('article_id');
		$article 	= Model_Article::factory(null, $article_id);
		$images 	= [];
		if ($article->loaded()) {
			try {
				foreach ($article->images->cached()->find_all() as $b) {
					$images[] = [
						'src'		=> $b->url($b::FULLSCREEN_NAME),
						'video_url'	=> $b->video_url,
						'type'		=> $b->video_url && !$is_touch ? 'video' : 'image'
					];
				}
				$this->result->status	= 0;
				$this->result->html 	= View::factory($this->module.'/_gallery', ['images' => $images])->render();
			} catch (Exception $e) {
				$this->result->status 			= 1;
				$this->result->error_message 	= $e->getMessage();
			}
		} else {
			$this->result->status 			= 1;
			$this->result->error_message 	= 'Article was not found';
		}
	}


	public function action_get_about_gallery_images()
	{
		if (!$this->is_ajax) return;
		$images 	= [];
		try {
			$blocks_with_images = Model_About_Block::factory()
				->where('type', 'IN', [Model_About_Block::TYPE_IMAGE, Model_About_Block::TYPE_IMAGE_AND_TEXT])
				->cached()
				->find_all();
			foreach ($blocks_with_images as $b) {
				$images[] = [
					'src'		=> $b->url($b::FULLSCREEN_NAME),
					'video_url'	=> $b->video_url,
					'type'		=> $b->video_url ? 'video' : 'image'
				];
			}
			$this->result->status	= 0;
			$this->result->html 	= View::factory($this->module.'/_gallery', ['images' => $images])->render();
		} catch (Exception $e) {
			$this->result->status 			= 1;
			$this->result->error_message 	= $e->getMessage();
		}
	}


	public function action_caticonfile()
	{
		Model_Category::serve_file_download(
			(int) $this->request->param('id'),
			(string) $this->request->param('uid'),
			(string) $this->request->param('filename'));
	}


	public function action_catpdffile()
	{
		Model_Category_Pdf::serve_file_download(
			(int) $this->request->param('id'),
			(string) $this->request->param('uid'),
			(string) $this->request->param('filename'));
	}


	public function action_file()
	{
		Model_File::serve_file_download(
			(int) $this->request->param('id'),
			(string) $this->request->param('uid'),
			(string) $this->request->param('filename'));
	}


	/**
	 * @nosession
	 */
	public function action_http404()
	{
		$this->set_view($this->module.'/404');
	}
}
