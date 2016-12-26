<?php

class Backend_Settings_Seo_Form extends AVO_Data_Form {

	public function __construct()
	{
		parent::__construct();

		$this->send_data_back_on_save = true;
		$this->title_class = 'ico32 ico32-tools';
		$this->title = __('Seo');
		$this->datasource = Model_Variable::get_datasource(
			'global_title',
			'global_keywords',
			'global_description',
			'projects_title',
			'projects_keywords',
			'projects_description',
			'about_title',
			'about_keywords',
			'about_description',
			'blog_title',
			'blog_keywords',
			'blog_description',
			'contact_title',
			'contact_keywords',
			'contact_description',
			'search_title',
			'search_keywords',
			'search_description'
		);
		$this->clear_cache = true;

		$this->controls = new AVO_Controls_List([
			new AVO_Field([
				'name'			=> 'id',
				'type'			=> AVO_Field::TYPE_INT,
				'hidden'		=> true,
				'key'			=> true,
				'fixed_value'	=> 1,
			]),

			new AVO_Layout_Control([
				'layout',	'new AVO.Tabbed_Layout()',
			]),
				new AVO_Layout_Control([
					'page',	'Home',
					'valign', 'top',
					'layout', 'new AVO.Grid_Layout({})',
				]),
					new Backend_Field_SEO_Title([		'name' => 'global_title']),
					new Backend_Field_SEO_Keywords([	'name' => 'global_keywords']),
					new Backend_Field_SEO_Description([	'name' => 'global_description']),
				AVO_Layout_Control::end_layout(),
				new AVO_Layout_Control([
					'page',	'Projects',
					'valign', 'top',
					'layout', 'new AVO.Grid_Layout({})',
				]),
					new Backend_Field_SEO_Title([		'name' => 'projects_title']),
					new Backend_Field_SEO_Keywords([	'name' => 'projects_keywords']),
					new Backend_Field_SEO_Description([	'name' => 'projects_description']),
				AVO_Layout_Control::end_layout(),
				new AVO_Layout_Control([
					'page',	'About',
					'valign', 'top',
					'layout', 'new AVO.Grid_Layout({})',
				]),
					new Backend_Field_SEO_Title([		'name' => 'about_title']),
					new Backend_Field_SEO_Keywords([	'name' => 'about_keywords']),
					new Backend_Field_SEO_Description([	'name' => 'about_description']),
				AVO_Layout_Control::end_layout(),
				new AVO_Layout_Control([
					'page',	'Blog',
					'valign', 'top',
					'layout', 'new AVO.Grid_Layout({})',
				]),
					new Backend_Field_SEO_Title([		'name' => 'blog_title']),
					new Backend_Field_SEO_Keywords([	'name' => 'blog_keywords']),
					new Backend_Field_SEO_Description([	'name' => 'blog_description']),
				AVO_Layout_Control::end_layout(),
				new AVO_Layout_Control([
					'page',	'Contact',
					'valign', 'top',
					'layout', 'new AVO.Grid_Layout({})',
				]),
					new Backend_Field_SEO_Title([		'name' => 'contact_title']),
					new Backend_Field_SEO_Keywords([	'name' => 'contact_keywords']),
					new Backend_Field_SEO_Description([	'name' => 'contact_description']),
				AVO_Layout_Control::end_layout(),
				new AVO_Layout_Control([
					'page',	'Search',
					'valign', 'top',
					'layout', 'new AVO.Grid_Layout({})',
				]),
					new Backend_Field_SEO_Title([		'name' => 'search_title']),
					new Backend_Field_SEO_Keywords([	'name' => 'search_keywords']),
					new Backend_Field_SEO_Description([	'name' => 'search_description']),
				AVO_Layout_Control::end_layout(),
			AVO_Layout_Control::end_layout(),
			new AVO_Label(),
			new AVO_Layout_Control(['align', 'right']),
			AVO_Button::standard(AVO_Button::STD_SAVE),
		]);
	}
}
































