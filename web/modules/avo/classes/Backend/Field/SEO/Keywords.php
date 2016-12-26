<?php defined('SYSPATH') or die('No direct access allowed.');

class Backend_Field_SEO_Keywords extends AVO_Field {

	public function __construct(array $array = array()) {
		$this->name = 'seo_keywords';
		$this->type = self::TYPE_STRING;
		$this->title = new AVO_Label(array(
			'value'	=> __('SEO keywords'),
			'hint'	=> __("Used in META keywords.\nLimited to 150 characters.\nStart typing in and select an item from the list of suggestions. Separate keywords with comma."),
		));

		$this->width = 400;
		$this->max_length = 150;
		$this->filter = array('Model_Keyword', 'filter_list');
		$this->validator = new AVO_Validator_Not_Null();
		$this->class_extension = '{
			extractLast: function(term) {
				return this.splitTerms(term).pop();
			},
			splitTerms: function(val) {
				return val.split(/,\s*/);
			},
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
							url: ' . json_encode(URL::site('admin/helper/tags')) . ',
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
		}';

		parent::__construct($array);
	}


	public function after_save(AVO_Data_Form_Action_Result $result) {
		parent::after_save($result);
		Model_Keyword::save_keywords($this->value());
	}

}
