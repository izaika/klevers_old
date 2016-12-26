<?php

class Backend_Field_Body_Text extends AVO_Field {

	public function __construct(array $array = []) {

		$this->name = 'body_text';
		$this->type = self::TYPE_TEXT;
		$this->title = 'Body text';
		$this->width = 398;
		$this->height = 200;
		$this->max_length = 65535;
		$this->html_editor = true;
		$this->validator = new AVO_Validator_Not_Null;
		$this->class_extension = '{
			"tinymce_options": {
				"plugins": "fullscreen paste charmap hr advlist autolink lists link preview code contextmenu paste",
				plugin_preview_width : 412,
				paste_as_text: true,
				relative_urls:false,
				"content_css": AVO.settings.base_path + "css/public/editor_styles.css",
				"toolbar": "undo redo | underline bold italic strikethrough | link unlink | removeformat | code",
				"valid_elements": "iframe[src],object,"
					+ "-span,-a,-ul,-strong,-em,-u,hr,sub,sup,"
					+ "a[href|target|title],blockquote,"
					+ "img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],"
					+ "ul[style],ol[style],li[style],"
					+ "br,"
					+ "strong/b,"
					+ "em/i,"
					+ "h2,"
					+ "span[style|class],"
					+ "div[style|class],"
					+ "p[style|class],"
					+ "u",
			}
		}';

		parent::__construct($array);
	}

}
