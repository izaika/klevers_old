<?php defined('SYSPATH') or die('No direct access allowed.');

class Backend_Field_Instagram_Userid extends AVO_Field {

	public function __construct(array $array = array()) {
		$this->name = 'instagram_userid';
		$this->type = self::TYPE_STRING;
		$this->title = new AVO_Label(array(
			'value'	=> __('instagram user ID'),
			'hint'	=> __('You can enter username instead of id and wait for autocomplete to pop up with search results'),
		));
		$this->max_length = 128;
		$this->width = 400;
		$this->validator = array(
			new AVO_Validator_Not_Negative(),
		);

		$this->class_extension = '{
			afterRender: function() {
				var t = this;
				// dont navigate away from the field on tab when selecting an item
				this._page_control.bind("keydown", function(event) {
					if (event.keyCode === $.ui.keyCode.TAB && $(this).data("autocomplete").menu.active) {
						event.preventDefault();
					}
				}).autocomplete({
					search: function() {
						// custom minLength
						if (this.value.length < 2) return false;
					},
					focus: function() {
						// prevent value inserted on focus
						return false;
					},
					select: function(event, ui) {
						// replace with the selected item
						this.value = ui.item.value;
						return false;
					},
					source: function(request, response) {
						$.ajax({
							type: "POST",
							url: ' . json_encode(URL::site('admin/helper/instagram_lookup')) . ',
							dataType: "json",
							data: {
								term: request.term
							},
							success: function(answer) {
								response(answer);
							}
						});
					}
				}).data("ui-autocomplete")._renderItem = function (ul, item) {
        			return $("<li />")
            			.data("item.autocomplete", item)
            			.append("<a><img width=\'50\' height=\'50\' src=\'" + item.avatar + "\' />" + item.label + "</a>")
            			.appendTo(ul);
    			};
			}
		}';

		parent::__construct($array);
	}


	public function after_save(AVO_Data_Form_Action_Result $result) {
		parent::after_save($result);
		Model_Keyword::save_keywords($this->value());
	}

}
