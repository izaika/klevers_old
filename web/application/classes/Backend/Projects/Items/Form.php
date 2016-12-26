<?php

class Backend_Projects_Items_Form extends AVO_Data_Form
{

	public function __construct()
	{
		parent::__construct();

		$this->title_class = 'ico32 ico32-picture_dawn';
		$this->title = ['Add new project', 'Edit project'];
		$this->close_button_title = __('Back');
		$this->clear_cache = true;
		$this->new_record_flag = 'is_new';

		$this->controls = new AVO_Controls_List([
			new AVO_Field([
				'name'			=> 'id',
				'type'			=> AVO_Field::TYPE_INT,
				'key'			=> true,
				'hidden'		=> true,
			]),
			new AVO_Field(array(
				'name'				=> 'is_new',
				'type'				=> AVO_Field::TYPE_INT,
				'server_side_only'	=> true,
			)),
			new AVO_Layout_Control([
				'layout',	'new AVO.Tabbed_Layout()',
			]),
				new AVO_Layout_Control([
					'page',	'Main info',
					'valign', 'top',
					'layout', 'new AVO.Grid_Layout({})',
				]),
					new AVO_Field([
						'name'		=> 'is_online',
						'title'		=> new AVO_Label([
							'value'	=> 'Is online?',
							'hint'	=> 'If article is not online - it will be visible only when admin is logged in, otherwise 404 exception will be thrown',
						]),
						'type'		=> AVO_Field::TYPE_BOOL,
						'width'		=> 400,
						'validator'	=> new AVO_Validator_Not_Null,
					]),
					new AVO_Layout_Control([
						'colspan',	'2',
						'layout',	'new AVO.Grid_Layout({columns: 1})'
					]),
						new Backend_Image_Upload_Field_Set([
							'title'					=> 'Image',
							'model'					=> 'Model_Project',
							'upload_variable_name'	=> '_fu_project_image',
							'note'					=> '',
						]),
					AVO_Layout_Control::end_layout(),
					new AVO_Layout_Control([
						'colspan',	'2',
						'layout',	'new AVO.Grid_Layout({columns: 1})'
					]),
						new Backend_Image_Upload_Field_Set([
							'field_name'			=> 'preview_image',
							'title'					=> 'Additional Teaser Image',
							'model'					=> 'Model_Project_Preview',
							'upload_variable_name'	=> '_fu_project_preview_image',
							'note'					=> '',
							'is_upload_mandatory'	=> false,
						]),
					AVO_Layout_Control::end_layout(),
					new AVO_Field([
						'name'				=> 'use_video',
						'type'				=> AVO_Field::TYPE_BOOL,
						'width'				=> 400,
						'title'				=> 'Use video?',
					]),
					new AVO_Field([
						'name'				=> 'video_url',
						'type'				=> AVO_Field::TYPE_STRING,
						'width'				=> 400,
						'max_length'		=> 512,
						'title'				=> 'URL to video .mp4 file (seamless video)',
						'validator'			=> new AVO_Validator_Not_Null,
					]),
					new AVO_Field([
						'name'				=> 'embedded_video_link',
						'type'				=> AVO_Field::TYPE_STRING,
						'width'				=> 400,
						'max_length'		=> 256,
						'title'				=> 'Vimeo/Youtube link (embedded video)',
						'validator'			=> new AVO_Validator_Not_Null,
					]),
					new AVO_Field([
						'name'			=> 'heading',
						'title'			=> 'Heading',
						'type'			=> AVO_Field::TYPE_TEXT,
						'width'			=> 400,
						'max_length'	=> 256,
						'validator'		=> new AVO_Validator_Not_Null,
					]),
					new AVO_Field([
						'name'			=> 'name',
						'title'			=> 'Name',
						'type'			=> AVO_Field::TYPE_TEXT,
						'width'			=> 400,
						'max_length'	=> 256,
						'validator'		=> new AVO_Validator_Not_Null,
					]),
					new AVO_Field([
						'name'			=> 'location',
						'title'			=> 'Location',
						'type'			=> AVO_Field::TYPE_STRING,
						'width'			=> 400,
						'max_length'	=> 256,
					]),
					new AVO_Field([
						'name'			=> 'address',
						'title'			=> 'Address',
						'type'			=> AVO_Field::TYPE_STRING,
						'width'			=> 400,
						'max_length'	=> 256,
					]),
					new AVO_Field([
						'name'			=> 'ingress',
						'title'			=> 'Ingress',
						'type'			=> AVO_Field::TYPE_TEXT,
						'width'			=> 400,
						'max_length'	=> 512,
					]),
					new AVO_Label,
					new AVO_Button([
						'name'				=> 'btn_seofill',
						'icon'				=> 'page_go',
						'action'			=> 'seofill',
						'value'				=> 'auto-fill SEO info and URL title',
					]),
					new Backend_Field_SEO_Title(['name' => 'seo_title']),
					new Backend_Field_SEO_URL(['name' => 'url_title']),
					new Backend_Field_SEO_Description(['name' => 'seo_description']),
				AVO_Layout_Control::end_layout(), // end of main_info tab
				new AVO_Layout_Control([
					'page',	'Blocks',
					'valign', 'top',
					'layout', 'new AVO.Grid_Layout({})',
				]),
					new AVO_Link([
						'name'		=> 'link_blocks',
						'child'		=> new Backend_Projects_Items_Blocks_Grid,
						'params'	=> ['id' => 'project_id'],
					]),
				AVO_Layout_Control::end_layout(), // end of blocks tab
				new AVO_Layout_Control(array(
					'page',	'Tags',
					'valign', 'top',
					'layout', 'new AVO.Grid_Layout({columns: 1})',
				)),
					new AVO_Field(array(
						'name'			=> 'the_tags',
						'type'			=> AVO_Field::TYPE_STRING,
						'hidden'		=> true,
						'calculated'	=> true,
						'class_extension' => '{
							onChange: function() {
								setTimeout(render_tags, 1500);
							}
						}'
					)),
					new AVO_Label(array(
						'value'	=> __('Separate tags with commas'),
						'html_class' => 'note'
					)),
					new AVO_Layout_Control(array(
						'layout',	'new AVO.Horizontal_Layout({padding:4})'
					)),
						new AVO_Field(array(
							'name'			=> 'newtag',
							'type'			=> AVO_Field::TYPE_STRING,
							'title'			=> __('Tag'),
							'width'			=> 500,
							'max_length'	=> 256,
							'calculated'	=> true,
							'class_extension' => '{
								extractLast: function(term) {
									return this.splitTerms(term).pop();
								},
								splitTerms: function(val) {
									return val.split(/,\s*/);
								},
								afterRender: function() {
									var t = this;
									// dont navigate away from the field on tab when selecting an item
									this._page_control.on("keydown", function(event) {
										if (event.keyCode === $.ui.keyCode.TAB && $(this).data("autocomplete").menu.active) {
											event.preventDefault();
										}
									}).autocomplete({
										search: function() {
											// custom minLength
											var term = t.extractLast(this.value);
											if (term.length < 2) return false;
										},
										focus: function() {
											// prevent value inserted on focus
											return false;
										},
										select: function(event, ui) {
											var terms = t.splitTerms(this.value);
											// remove the current input
											terms.pop();
											// add the selected item
											terms.push(ui.item.value);
											// add placeholder to get the comma-and-space at the end
											terms.push("");
											this.value = terms.join(", ");
											return false;
										},
										source: function(request, response) {
											$.ajax({
												type: "POST",
												url: ' . json_encode(URL::site('admin/helper/article_tags')) . ',
												dataType: "json",
												data: {
													term: t.extractLast(request.term)
												},
												success: function(answer) {
													response(answer);
												}
											});
										}
									});
								}
							}'
						)),
						new AVO_Button(array(
								'name'			=> 'add_tag',
								'value'			=> __('Add'),
								'html_class'	=> 'btn btn-primary add-tags',
								'class_extension' => '{
									onClick: function(e){
										e.preventDefault();
										var tags = $( "input[name=the_tags]" ),
											newtag = $( "input[name=newtag]" ),
											text =  newtag.val(),
											tagsval, newtags;

										if ( "undefined" == typeof( text ) ) {
											return false;
										}
										tagsval = tags.val();
										newtags = tagsval ? tagsval + "," + text : text;
										newtags = clean_tags( newtags );
										newtags = array_unique_noempty( newtags.split( "," ) ).join( "," );
										tags.val( newtags );
										render_tags();
										newtag.val("").focus();
										return false;
									}
								}'
						)),
					AVO_Layout_Control::end_layout(),
					new AVO_Field(array(
							'name'			=> 'tags_list',
							'type'			=> AVO_Field::TYPE_STRING,
							'title'			=> __(''),
							'width'			=> 500,
							'max_length'	=> 256,
							'calculated'	=> true,
							'encoded'		=> true,
							'value'	=> '<div class="tagchecklist clearfix"></div>',
					)),
				AVO_Layout_Control::end_layout(), // end of tags tab
				new AVO_Layout_Control([
					'page',	'Categories',
					'valign', 'top',
					'layout', 'new AVO.Grid_Layout({})',
				]),
			]);
			$this->categories = Model_Category::factory()->find_all();
			foreach ($this->categories as $c) {
				$this->controls->append(
					new AVO_Field(array(
						'name'			=> 'category_' . $c->id,
						'calculated'	=> true,
						'type'			=> AVO_Field::TYPE_BOOL,
						'title'			=> $c->heading,
					))
				);
			}
			$this->controls->append(
				AVO_Layout_Control::end_layout(), // end of categories tab
			AVO_Layout_Control::end_layout(), // end of all tabs
			new AVO_Layout_Control([
				'align',	'right',
				'layout',	'new AVO.Horizontal_Layout({padding:4})'
			]),
				AVO_Button::standard(AVO_Button::STD_SAVE),
				new AVO_Layout_Control([
					'style', 'padding-left:30px',
				]),
				AVO_Button::standard(AVO_Button::STD_CANCEL),
			AVO_Layout_Control::end_layout()
		);

		$this->class_extension = '{
			layout: new AVO.Grid_Layout({columns: 1}),
		}';
	}

	public function on_validate(AVO_Data_Form_Action_Result $result)
	{
		if (!$this->controls->use_video->value()) {
			$this->controls->video_url->validator			= null;
			$this->controls->embedded_video_link->validator	= null;
		}
		return parent::on_validate($result);
	}

	public function action_seofill(AVO_Data_Form_Action_Result $result)
	{
		$clean_heading = Text::compress_spaces($this->controls->name->value());
		$seo_title = Text::limit_chars($clean_heading, 150, null, true);
		$this->controls->seo_title->value($seo_title);

		$url_title = $this->controls->url_title->value();
		if (empty($url_title)) {
			// find an url title by checking if it is already occupied and appending the incrementing counter
			$i = 0;
			$url_title = URL::title(Text::limit_chars(Text::compress_spaces($this->controls->name->value()), 128));
			while (true) {
				$url_title_occupied = DB::query(Database::SELECT, 'SELECT COUNT(*) FROM projects WHERE (:id IS NULL OR id <> :id) AND is_new = 0 AND url_title = :url_title')
					->param(':url_title', $url_title)
					->param(':id', $this->controls->id->value())
					->execute()
					->get(0);
				if (!$url_title_occupied) break;
				$url_title = URL::title(Text::limit_chars(Text::compress_spaces($this->controls->name->value()), 128 - strlen(strval(++$i))));
				$url_title .= $i;
			}
			$this->controls->url_title->value($url_title);
		}

		$seo_description = Text::limit_chars(Text::compress_spaces(strip_tags($this->controls->ingress->value())), 150, '…', true);
		$this->controls->seo_description->value($seo_description);

		$result->status = 0;
		$result->update_data = true;
		$result->get_data = true;
		$result->fields2update = [
			'url_title',
			'seo_title',
			'seo_description'
		];
		$result->processed = true;
	}


	public function on_calc()
	{
		$id = $this->controls->id->value();
		if ($id) {
			$tags = DB::query(Database::SELECT, 'SELECT t.title FROM projects_tags pt LEFT JOIN tags t ON (pt.tag_id = t.id) WHERE pt.project_id = :id')->param(':id', $id)->execute()->as_array();
			if (count($tags)) {
				$list_tag = array();
				foreach ($tags as $tag) {
					$list_tag[] = $tag['title'];
				}
				$this->controls->the_tags->value(implode (", ", $list_tag));
			}
		}

		foreach ($this->categories as $c) {
			$this->controls->{'category_' . $c->id}->value(
				DB::query(Database::SELECT, 'SELECT 1 FROM categories_projects WHERE project_id = :id AND category_id = :c_id')
				->parameters(array(':id' => $id, ':c_id' => $c->id))->execute()->get(0)
			);
		}
	}

	public function after_save(AVO_Data_Form_Action_Result $result) {
		parent::after_save($result);

		$tags = $this->controls->the_tags->value();
		$id = $result->id;
		$dtags = DB::query(Database::DELETE, 'DELETE from projects_tags WHERE project_id = :id')->param(':id', $id)->execute();

		if ($tags) {
			$tags_array = explode(',', $tags);
			foreach ($tags_array as $t) {
				$t = trim($t);
				$tag = Model_Tag::factory()->where('title', '=', $t)->find();
				if (!$tag->loaded()){
					$tag->title = $t;
					$tag->save();
				}
				$ptags = Model_Project_Tag::factory();
				$ptags->project_id = $id;
				$ptags->tag_id = $tag->id;
				$ptags->save();
			}
		}

		// delete all categories
		DB::delete('categories_projects')->where('project_id', '=', $result->id)->execute();

		// add all checked categories
		foreach ($this->categories as $c) {
			if ($this->controls->{'category_' . $c->id}->value()) {
				DB::query(Database::INSERT,
					'INSERT INTO categories_projects (project_id, category_id)
					VALUES (:project_id, :category_id)'
				)->parameters([':project_id' => $result->id, ':category_id' => $c->id])->execute();
			}
		}

		$project = Model_Project::factory()
			->where('id', '=', $this->controls->id->value())
			->find();
		if ($project->loaded() && $project->is_online == 1 && $project->is_new == 0) {
			Appsearch::add_document(AppSearch::open_index(AppSearch::INDEX_RELATED), $project, AppSearch::INDEX_RELATED);
			Appsearch::add_document(AppSearch::open_index(AppSearch::INDEX_GENERAL), $project, AppSearch::INDEX_GENERAL);
		}
	}
}
