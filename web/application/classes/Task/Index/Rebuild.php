<?php

/**
 * Rebuilds the search index
 *
 */
class Task_Index_Rebuild extends Minion_Task
{
	protected function _execute(array $params)
	{
		$index_related = Appsearch::open_index(Appsearch::INDEX_RELATED, true);
		$index_general = Appsearch::open_index(Appsearch::INDEX_GENERAL, true);

		foreach (Model_Project::factory()->where('is_new', '=', 0)->and_where('is_online', '=', 1)->find_all() as $p) {
			Appsearch::add_document($index_related, $p, Appsearch::INDEX_RELATED);
			Appsearch::add_document($index_general, $p, Appsearch::INDEX_GENERAL);
		}
		foreach (Model_Article::factory()->where('is_new', '=', 0)->find_all() as $a) {
			Appsearch::add_document($index_general, $a, Appsearch::INDEX_GENERAL);
		}
		foreach (Model_Employee::factory()->find_all() as $e) {
			Appsearch::add_document($index_general, $e, Appsearch::INDEX_GENERAL);
		}
		foreach (Model_Cp_Item::factory()->find_all() as $cp) {
			Appsearch::add_document($index_general, $cp, Appsearch::INDEX_GENERAL);
		}
		foreach (Model_About_Block::factory()->find_all() as $b) {
			Appsearch::add_document($index_general, $b, Appsearch::INDEX_GENERAL);
		}
		Appsearch::add_document($index_general, Model_Homeslide::factory(null, 0), Appsearch::INDEX_GENERAL, [
			['name'	=> 'name',			'type' => 'unIndexed',	'value' => 'Om oss'										],
			['name'	=> 'text_value',	'type' => 'unStored',	'value' => Model_Variable::value_by_name('about_quote')	],
			['name'	=> 'url',			'type' => 'unIndexed',	'value' => '/om-oss'									],
			['name'	=> 'is_online',		'type' => 'unIndexed',	'value' => 1											],
		], 'about_quote');
		Appsearch::add_document($index_general, Model_Homeslide::factory(null, 0), Appsearch::INDEX_GENERAL, [
			['name'	=> 'name',			'type' => 'unIndexed',	'value' => 'Kompetanse'				],
			['name'	=> 'text_value',	'type' => 'unStored',	'value' => 'Kompetanse'			],
			['name'	=> 'url',			'type' => 'unIndexed',	'value' => '/om-oss#competence'	],
			['name'	=> 'is_online',		'type' => 'unIndexed',	'value' => 1					],
		], 'about_competence');
		Appsearch::add_document($index_general, Model_Homeslide::factory(null, 0), Appsearch::INDEX_GENERAL, [
			['name'	=> 'name',			'type' => 'unIndexed',	'value' => 'Kompetanse'												],
			['name'	=> 'text_value',	'type' => 'unStored',	'value' => Model_Variable::value_by_name('about_competence_text')	],
			['name'	=> 'url',			'type' => 'unIndexed',	'value' => '/om-oss#competence'										],
			['name'	=> 'is_online',		'type' => 'unIndexed',	'value' => 1														],
		], 'about_competence_text');
		Appsearch::add_document($index_general, Model_Homeslide::factory(null, 0), Appsearch::INDEX_GENERAL, [
			['name'	=> 'name',			'type' => 'unIndexed',	'value' => 'Hvordan'	],
			['name'	=> 'text_value',	'type' => 'unStored',	'value' => 'Hvordan'	],
			['name'	=> 'url',			'type' => 'unIndexed',	'value' => '/om-oss#cp'		],
			['name'	=> 'is_online',		'type' => 'unIndexed',	'value' => 1				],
		], 'about_cp');
		Appsearch::add_document($index_general, Model_Homeslide::factory(null, 0), Appsearch::INDEX_GENERAL, [
			['name'	=> 'name',			'type' => 'unIndexed',	'value' => 'Ansatte'			],
			['name'	=> 'text_value',	'type' => 'unStored',	'value' => 'Ansatte'			],
			['name'	=> 'url',			'type' => 'unIndexed',	'value' => '/om-oss#employees'	],
			['name'	=> 'is_online',		'type' => 'unIndexed',	'value' => 1					],
		], 'about_employees');
		Appsearch::add_document($index_general, Model_Homeslide::factory(null, 0), Appsearch::INDEX_GENERAL, [
			['name'	=> 'name',			'type' => 'unIndexed',	'value' => Model_Variable::value_by_name('about_bottom_heading')],
			['name'	=> 'text_value',	'type' => 'unStored',	'value' => Model_Variable::value_by_name('about_bottom_heading')],
			['name'	=> 'url',			'type' => 'unIndexed',	'value' => '/om-oss#bottom_block'								],
			['name'	=> 'is_online',		'type' => 'unIndexed',	'value' => 1													],
		], 'about_bottom_heading');
		Appsearch::add_document($index_general, Model_Homeslide::factory(null, 0), Appsearch::INDEX_GENERAL, [
			['name'	=> 'name',			'type' => 'unIndexed',	'value' => Model_Variable::value_by_name('about_bottom_heading')],
			['name'	=> 'text_value',	'type' => 'unStored',	'value' => Model_Variable::value_by_name('about_bottom_text')	],
			['name'	=> 'url',			'type' => 'unIndexed',	'value' => '/om-oss#bottom_block'								],
			['name'	=> 'is_online',		'type' => 'unIndexed',	'value' => 1													],
		], 'about_bottom_text');

		$index_related->optimize();
	}
}
