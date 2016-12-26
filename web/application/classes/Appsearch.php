<?php

use ZendSearch\Lucene;

class Appsearch
{
	const INDEX_RELATED = 'related';
	const INDEX_GENERAL = 'general';

	public static function open_index($name, $recreate = false)
	{
		// set analyzer
		ZendSearch\Lucene\Analysis\Analyzer\Analyzer::setDefault(new ZendSearch\Lucene\Analysis\Analyzer\Common\Utf8Num\CaseInsensitive());

		$index_path = APPPATH . 'assets/search_indexes/'.$name.'/';

		if (is_dir($index_path) && !$recreate) {
			$index = Lucene\Lucene::open($index_path);
		} else {
			$saved_mask = umask(0002);
			$index = Lucene\Lucene::create($index_path);
			umask($saved_mask);
		}
		return $index;
	}


	public static function document_id(ORM $document)
	{
		return get_class($document) . '_' . $document->id;
	}


	public static function delete_document($index, ORM $document, $custom_id = null)
	{
		$document_id = $custom_id ? $custom_id : self::document_id($document);
		$hits_to_delete = $index->find('__id:' . $document_id);
		foreach ($hits_to_delete as $hit) {
			$index->delete($hit->id);
		}
	}


	public static function add_document($index, ORM $document, $type, $index_data = null, $custom_id = null)
	{
		self::delete_document($index, $document, $custom_id);

		$index_document = new Lucene\Document;
		$fields = $index_data ? $index_data : $document->get_index_data($type);
		if (!$fields) return;

		foreach ($fields as $field) {
			// $field = [
			//		'boost'	=> 1 ... 0.01
			//		'value'	=> 1 ... 0.01
			//		'type'	=> keyword, unIndexed, binary, text, unStored
			//		'name'	=> name
			//		'value'	=> name
			// ]
			$type = $field['type'];
			$name = $field['name'];
			$value = $field['value'];
			$boost = isset($field['boost']) ? $field['boost'] : 1;

			$document_field = Lucene\Document\Field::$type($name, $value);
			$document_field->boost = $boost;

			$index_document->addField($document_field);
		}

		$document_id = $custom_id ? $custom_id : self::document_id($document);
		$document_field = Lucene\Document\Field::text('__id', $document_id);
		$index_document->addField($document_field);

		$index->addDocument($index_document);
	}


	public function query()
	{

	}
}
