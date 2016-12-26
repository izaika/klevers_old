<?php defined('SYSPATH') OR die('No direct script access.');

use ZendSearch\Lucene;

class AVO_Search_ZendSearch {

	/**
	 * Returns an instance of the search
	 *
	 * @param string $name
	 * @return AVO_Search_ZendSearch
	 */
	public static function instance($name = 'default')
	{
		return new self($name);
	}


	protected function __construct($name)
	{
		$this->instance = $name;
	}


	public function search($model_name, $query, $limit = 5, $use_cache = FALSE, $result_as_array = FALSE)
	{
		if ($use_cache)
		{
			$cache_key = 'zend search:'.$query;
			$cache = Kohana::cache($cache_key);
		}
		if ($use_cache && $cache !== NULL)
		{
			$search_result = $cache;
		}
		else
		{
			$index = self::get_index($model_name);

			Lucene\Lucene::setResultSetLimit($limit);

			$search_result = $index->find($query);
			$fields_map = $model_name::index_map();

			if ($result_as_array)
			{
				$result_array = array();
				foreach ($search_result as $hit)
				{
					$document = $hit->getDocument();
					$document_array = array();
					foreach ($fields_map as $field)
					{
						if ($field['type'] !== 'unStored')
						{
							$document_array[$field['name']] = $document->$field['name'];
						}
					}
					$result_array[] = $document;
				}
				$search_result = $result_array;
			}

			if ($use_cache)
			{
				Kohana::cache($cache_key, $search_result);
			}
		}

		return $search_result;
	}


	public function get_index($model_name, $recreate_index = FALSE)
	{
		$index_path = APPPATH.'assets/search_indexes/'.$model_name.'/';
		if (is_dir($index_path) && !$recreate_index) {
			$index = Lucene\Lucene::open($index_path);
		} else {
			$saved_mask = umask(0002);
			$index = Lucene\Lucene::create($index_path);
			umask($saved_mask);
		}
		return $index;
	}


	public function delete($model_name, $id)
	{
		$index = self::get_index($model_name);

		$hits_to_delete = $index->find('id:'.$id);
		foreach ($hits_to_delete as $hit)
		{
			$index->delete($hit->id);
		}
	}


	public function index($model_name, $id = NULL)
	{
		// check if model is set up propertly
		if( ! in_array('AVO_Search_Searchable', class_implements($model_name)))
		{
			throw new Exception($model_name.' must implement "AVO_Search_Searchable"');
		};

		// if we need to index whole table
		// we need to set marker for recreation of index in order to remove existing
		$recreate_index = (bool) !$id;

		$index = self::get_index($model_name, $recreate_index);

		// set analyzer
		ZendSearch\Lucene\Analysis\Analyzer\Analyzer::setDefault(new ZendSearch\Lucene\Analysis\Analyzer\Common\Utf8Num\CaseInsensitive());

		// getting all rows of table if no id sent (reindexing whole table)
		// or if that's an update and we have and id than
		// remove outdated document first and get needed doc to index

		$rows = $model_name::factory();

		if ($recreate_index)
		{
			foreach ($model_name::index_filters() as $filter)
			{
				$rows->where($filter['field_name'], $filter['condition'], $filter['value']);
			}
		}
		else
		{
			self::delete($model_name, $id);
			$rows->where('id', '=', $id);;
		}

		$rows = $rows->find_all();


		// index new documents
		foreach ($rows as $row)
		{
			$doc = new Lucene\Document;
			foreach ($model_name::index_map() as $field)
			{
				if (array_key_exists('method', $field))
				{
					$search_field = Lucene\Document\Field::$field['type']($field['name'], $row->$field['method']());
				}
				elseif ($field['name'] == 'article_url')
				{
					$search_field = Lucene\Document\Field::text('article_url', $row->url());
				}
				else
				{
					$search_field = Lucene\Document\Field::$field['type']($field['name'], $row->$field['name']);
				}
				if (isset($field['boost'])) $search_field->boost = $field['boost'];
				$doc->addField($search_field);
			}
			$index->addDocument($doc);
		}
	}
}