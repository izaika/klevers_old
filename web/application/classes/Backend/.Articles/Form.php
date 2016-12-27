<?php

class Backend_Articles_Form extends AVO_Data_Form
{

	public function __construct()
	{
		parent::__construct();

		$this->title_class = 'ico32 ico32-picture_dawn';
		$this->title = ['Add new article', 'Edit article'];
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
						'name'			=> 'public_date',
						'type'			=> AVO_Field::TYPE_DATE,
						'title'			=> 'Date',
						'width'			=> 400,
						'function'		=> 'Text::sqldate2str',
						'max_length'	=> 32,
						'value'			=> date('d.m.Y'),
						'validator'		=> [new AVO_Validator_Not_Null, new AVO_Validator_Date],
					]),
					new AVO_Field([
						'name'			=> 'heading',
						'title'			=> 'Heading',
						'type'			=> AVO_Field::TYPE_TEXT,
						'width'			=> 400,
						'max_length'	=> 256,
						'validator'		=> new AVO_Validator_Not_Null,
					]),
					new Backend_Field_Body_Text,
				AVO_Layout_Control::end_layout(), // end of main_info tab
				new AVO_Layout_Control([
					'page',	'Images',
					'valign', 'top',
					'layout', 'new AVO.Grid_Layout({})',
				]),
					new AVO_Link([
						'name'		=> 'link_images',
						'child'		=> new Backend_Articles_Images_Grid,
						'params'	=> ['id' => 'article_id'],
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
			AVO_Layout_Control::end_layout(),
		]);

		$this->class_extension = '{
			layout: new AVO.Grid_Layout({columns: 1}),
		}';
	}


	public function on_calc()
	{
		$id = $this->controls->id->value();
		if ($id) {
			$tags = DB::query(Database::SELECT, 'SELECT t.title FROM articles_tags at LEFT JOIN tags t ON (at.tag_id = t.id) WHERE at.article_id = :id')->param(':id', $id)->execute()->as_array();
			if (count($tags)) {
				$list_tag = array();
				foreach ($tags as $tag) {
					$list_tag[] = $tag['title'];
				}
				$this->controls->the_tags->value(implode (", ", $list_tag));
			}
		}
	}


	public function after_save(AVO_Data_Form_Action_Result $result) {
		parent::after_save($result);

		$tags = $this->controls->the_tags->value();
		$id = $result->id;
		$dtags = DB::query(Database::DELETE, 'DELETE from articles_tags WHERE article_id = :id')->param(':id', $id)->execute();

		if ($tags) {
			$tags_array = explode(',', $tags);
			foreach ($tags_array as $t) {
				$t = trim($t);
				$tag = Model_Tag::factory()->where('title', '=', $t)->find();
				if (!$tag->loaded()){
					$tag->title = $t;
					$tag->save();
				}
				$ptags = Model_Article_Tag::factory();
				$ptags->article_id = $id;
				$ptags->tag_id = $tag->id;
				$ptags->save();
			}
		}

		$article = Model_Article::factory()
			->where('id', '=', $this->controls->id->value())
			->find();
		if ($article->loaded() && $article->is_new == 0) {
			Appsearch::add_document(AppSearch::open_index(AppSearch::INDEX_GENERAL), $article, AppSearch::INDEX_GENERAL);
		}
	}
}
