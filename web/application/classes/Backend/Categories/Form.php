<?php

class Backend_Categories_Form extends AVO_Data_Form
{

	public function __construct()
	{
		parent::__construct();

		$this->title_class = 'ico32 ico32-picture_dawn';
		$this->title = ['Add new category', 'Edit category'];
		$this->close_button_title = __('Back');
		$this->clear_cache = true;
		$this->width 	= 1200;
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
			new AVO_Field([
				'name'			=> 'heading',
				'title'			=> 'Heading',
				'type'			=> AVO_Field::TYPE_STRING,
				'width'			=> 400,
				'max_length'	=> 256,
				'validator'		=> new AVO_Validator_Not_Null,
			]),
			new AVO_Field([
				'name'			=> 'description',
				'title'			=> 'Short description',
				'type'			=> AVO_Field::TYPE_TEXT,
				'width'			=> 400,
				'height'		=> 150,
				'max_length'	=> 256,
				'validator'		=> new AVO_Validator_Not_Null,
			]),
			new AVO_Label,
			new AVO_Button([
				'name'			=> 'btn_seofill',
				'icon'			=> 'page_go',
				'action'		=> 'seofill',
				'value'			=> 'generate URL title from heading',
			]),
			new Backend_Field_SEO_URL(['name' => 'url_title']),
			new AVO_Label,
			new AVO_Layout_Control([
				'page',	'Subcategories',
				'valign', 'top',
				'layout', 'new AVO.Grid_Layout({columns: 1, fieldset: "Subcategories"})',
			]),
				new AVO_Link([
					'name'		=> 'link_subcategories',
					'child'		=> new Backend_Categories_Subcategories_Grid,
					'params'	=> ['id' => 'category_id'],
				]),
			AVO_Layout_Control::end_layout(), // end of subcategories section
			new AVO_Label,
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
			layout: new AVO.Grid_Layout({columns: 2}),
		}';
	}


	public function action_seofill(AVO_Data_Form_Action_Result $result)
	{
		$url_title = $this->controls->url_title->value();
		if (empty($url_title)) {
			// find an url title by checking if it is already occupied and appending the incrementing counter
			$i = 0;
			$url_title = URL::title(Text::limit_chars(Text::compress_spaces($this->controls->heading->value()), 128));
			while (true) {
				$url_title_occupied = DB::query(Database::SELECT, 'SELECT COUNT(*) FROM categories WHERE (:id IS NULL OR id <> :id) AND url_title = :url_title AND is_new = 0')
					->param(':url_title', $url_title)
					->param(':id', $this->controls->id->value())
					->execute()
					->get(0);
				if (!$url_title_occupied) break;
				$url_title = URL::title(Text::limit_chars(Text::compress_spaces($this->controls->heading->value()), 128 - strlen(strval(++$i))));
				$url_title .= $i;
			}
			$this->controls->url_title->value($url_title);
		}

		$result->status			= 0;
		$result->update_data	= true;
		$result->get_data		= true;
		$result->fields2update	= ['url_title'];
		$result->processed		= true;
	}
}
