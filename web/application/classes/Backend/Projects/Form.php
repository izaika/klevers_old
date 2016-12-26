<?php

class Backend_Projects_Form extends AVO_Data_Form {

	public function __construct()
	{
		parent::__construct();

		$this->send_data_back_on_save = true;
		$this->title_class = 'ico32 ico32-tools';
		$this->title = 'Projects';
		$this->datasource = AVO_Data_Source_Array::dummy();
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
				'align',	'left',
				'layout',	'new AVO.Horizontal_Layout({padding:2})'
			]),
				new AVO_Field([
					'name'				=> 'is_online',
					'type'				=> AVO_Field::TYPE_LOOKUP,
					'title'				=> 'Is online?',
					'calculated'		=> true,
					'lookup_datasource'	=> new AVO_Data_Source_Array([
						'dataset'	=> [
							['id' => 1, 'name' => 'Yes'],
							['id' => 0, 'name' => 'No']
						],
					]),
					'lookup_offer_null' => false,
				]),
			AVO_Layout_Control::end_layout(),
			new AVO_Label,
			new AVO_Link([
				'name'		=> 'link_items',
				'child'		=> new Backend_Projects_Items_Grid,
				'params'	=> [
					'id'		=> 'dummy_id',
					'is_online'	=> 'online_filter'
				],
			]),
		]);
	}
}
