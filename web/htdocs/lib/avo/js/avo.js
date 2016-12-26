$(function() {
	// setup the ajax event handler for processing indicator
	$(document).ajaxStart(function (event) {
		$("#ajax_communication_indicator").show();
	}).ajaxStop(function (event) {
		$("#ajax_communication_indicator").hide();
	});

	// setup a zooming for the image previews
	$(document).on("click", "a.zoomed_preview", function (event) {
		event.preventDefault();
		event.stopPropagation();
		$(this).removeClass("zoomed_preview").fancybox({
			padding: 0,
		    helpers: {
	            title: null
	        }
		}).click();
	});

	// default settings for the date/time picker
	$.datepicker.setDefaults($.datepicker.regional["en-GB"]);
	$.datepicker.setDefaults({dateFormat: "dd.mm.yy"});
});

//usage: log('inside coolFunc',this,arguments);
//http://paulirish.com/2009/log-a-lightweight-wrapper-for-consolelog/
window.log = function () {
	log.history = log.history || [];   // store logs to an array for reference
	log.history.push(arguments);
	if (this.console) {
		console.log(Array.prototype.slice.call(arguments));
	}
};


/**********************************************************
 *
 * AVO
 * Framework base namespace
 *
 **********************************************************/
var AVO = {
	settings: {
		base_path: "/"
	}
};



/**********************************************************
 *
 * AVO.Tools
 * Different tools
 *
 **********************************************************/
AVO.Tools = {
	preloadImages: function (images, callback, pointer) {
		if (pointer === undefined) pointer = 0;
		if (images.length > pointer) {
			$("<img>").load(function() {
				AVO.preloadImages(images, pointer + 1, callback);
			}).attr("src", images[pointer]);
		} else {
			callback();
		}
	}
};



/**********************************************************
 *
 * AVO.HTML
 * Html helpers
 *
 **********************************************************/
AVO.HTML = {
	encode: function (val) {
		if (val === undefined || val === null) return "";
		return $("<div>").text(val).html().replace(/\n/g, "<br>");
	},

	decode: function (val) {
		return $("<div>").html(val).text();
	}
};

/**********************************************************
 *
 * AVO.Layout_Control
 *
 **********************************************************/
AVO.Layout_Control = function (commands) {
	this.commands = commands;
};

$.extend(AVO.Layout_Control.prototype, {
	commands: null,

	_parent: null,

	parent: function (parent) {
		if (parent !== undefined) this._parent = parent;
		return this._parent;
	},

	render: function () {
		return null;
	}
});



/**********************************************************
 *
 * AVO.Tabbed_Layout
 *
 **********************************************************/
AVO.Tabbed_Layout = function (properties) {
	$.extend(this, properties || {});
};
AVO.Tabbed_Layout.instance_count = 0;
$.extend(AVO.Tabbed_Layout.prototype, {
	// public
	id: null,
	fieldset: null,
	name: null,
	style: null,
	width: null,

	_sub_manager: null,

	_parent: null,
	_content: null,
	_div: null,
	_ul: null,
	_td: null,


	parent: function (parent) {
		if (parent) this._parent = parent;
		return this._parent;
	},


	start: function () {
		var container = $("<div>");
		this._ul = $("<ul class='nav nav-tabs'>").appendTo(container);
		this._div = $("<div class='tab-content'>").appendTo(container);

		if (this.width !== null) {
			container.css("width", this.width);
		}
		if (this.fieldset != null) {
			this._content = $("<fieldset>").append(
				$("<legend>", {text: this.fieldset})
			).append(container);
		} else {
			this._content = container;
		}
		if (this.style != null) this._content.css(this.style);
		if (this.id !== null) {
			this._content.attr("id", this.id);
		}
	},


	add: function (control, notitle) {
		if (this._sub_manager != null) {
			this._sub_manager.add(control);
		} else {
			switch (control.constructor) {
				case AVO.Layout_Control:
					for (var i = 0; i < control.commands.length; i++) {
						switch (control.commands[i]) {
							case "page":
								var id = "tl_page_" + AVO.Tabbed_Layout.instance_count++;
								this._td = $("<div>", {"class": "tab-pane clearfix", id: id});
								this._div.append(this._td);
								this._ul.append(
									$("<li>").append(
										$("<a>", {href: "#" + id, "data-toggle": "tab"}).append(
											$("<span>", {text: control.commands[++i]})
										)
									)
								);
								break;
							case "layout":
								this._sub_manager = control.commands[++i];
								this._sub_manager.parent(this);
								this._sub_manager.start();
								break;
							case "end_layout":
								var t = this;
								this.find_parent_form().addAfterRender(function () {
									$("a", t._ul).click(function (e) {
										e.preventDefault();
										$(this).tab('show');
									});
									$("a:first", t._ul).tab("show");
								});
								if (this._parent != null) {
									this._parent._sub_manager = null;
									this._parent._td.append(this.end());
									this._parent = null;
								}
								break;
						}
					}
					break;
				default:
					alert("cannot put a control into a tabbed layout. Only layouts are allowed");
					break;
			}
		}
	},


	find_parent_form: function () {
		var p = this.parent();
		while (p != null && p.constructor !== AVO.Data_Form) {
			p = p.parent();
		}
		return p;
	},


	getCellAlign: function () {
		return this._td.css("text-align");
	},


	end: function () {
		if (this._sub_manager != null) {
			this._sub_manager.parent(null);
			this._td.append(this._sub_manager.end());
			this._sub_manager = null;
		}
		return this._content;
	}
});



/**********************************************************
 *
 * AVO.Horizontal_Layout
 *
 **********************************************************/
AVO.Horizontal_Layout = function (properties) {
	$.extend(this, properties || {});
};

$.extend(AVO.Horizontal_Layout.prototype, {
	// public
	id: null,
	fieldset: null,
	padding: 0,
	spacing: 0,
	style: null,
	width: null,
	html_class: null,

	_sub_manager: null,
	_colspan: null,
	_align: null,
	_valign: null,
	_cell_style: null,
	_cell_class: null,
	_cell_width: null,
	_parent: null,
	_content: null,
	_body: null,
	_tr: null,
	_td: null,


	parent: function (parent) {
		if (parent !== undefined) this._parent = parent;
		return this._parent;
	},


	start: function () {
		var table = $("<TABLE>").css("border-spacing", this.spacing + "px").append(
			this._body = $("<TBODY>").append(
				this._tr = $("<TR>")
			)
		);
		if (this.html_class) table.addClass(this.html_class);
		if (this.width !== null) table.css("width", this.width);
		if (this.fieldset != null) {
			this._content = $("<FIELDSET>").append(
				$("<LEGEND>").text(this.fieldset)
			).append(table);
		} else {
			this._content = table;
		}
		if (this.style != null) this._content.css(this.style);
		if (this.id !== null) this._content.attr("id", this.id);
	},


	add: function (control, notitle) {
		if (this._sub_manager != null) {
			this._sub_manager.add(control);
		} else {
			switch (control.constructor) {
				case AVO.Layout_Control:
					for (var i = 0; i < control.commands.length; i++) {
						switch (control.commands[i]) {
							case "colspan":
								this._colspan = control.commands[++i];
								break;
							case "align":
								this._align = control.commands[++i];
								break;
							case "valign":
								this._valign = control.commands[++i];
								break;
							case "width":
								this._cell_width = control.commands[++i];
								break;
							case "style":
								this._cell_style = control.commands[++i];
								break;
							case "html_class":
								this._cell_class = control.commands[++i];
								break;
							case "layout":
								this._sub_manager = control.commands[++i];
								this._sub_manager.parent(this);
								this._tr.append(
									this._td = $("<TD class='clearfix'>")
								);
								this.setCellProperties();
								this._sub_manager.start();
								break;
							case "end_layout":
								if (this._parent != null && this._parent._sub_manager != null) {
									this._parent._sub_manager = null;
									this._parent._td.append(this.end());
									this._parent = null;
								}
								break;
						}
					}
					break;
				case AVO.Field:
					if (control.control_before_title) {
						this._tr.append(
							this._td = $("<TD class='clearfix'>").append(control.render())
						);
						this._td.css("text-align", control.align);
						this.setCellProperties();
						if (control.title != null && !notitle) {
							this._tr.append(
								this._td = $("<TD class='clearfix'>")
							);
							control.label(this._td.addClass("form_field_label"));
							this.setCellProperties();
							if (typeof control.title === "object" && control.title.constructor === AVO.Label) {
								this._td.append(control.title.render());
							} else {
								this._td.text(control.title ? control.title : "");
							}
						}
					} else {
						if (control.title != null && !notitle) {
							this._tr.append(
								this._td = $("<TD class='clearfix'>")
							);
							control.label(this._td.addClass("form_field_label"));
							this.setCellProperties();
							if (typeof control.title === "object" && control.title.constructor === AVO.Label) {
								this._td.append(control.title.render());
							} else {
								this._td.text(control.title ? control.title : "");
							}
						}
						this._tr.append(
							this._td = $("<TD class='clearfix'>").append(control.render())
						);
						this._td.css("text-align", control.align);
						this.setCellProperties();
					}
					break;
				case AVO.Button:
				case AVO.Link:
				case AVO.Label:
					this._tr.append(
						this._td = $("<TD class='clearfix'>").append(control.render())
					);
					this.setCellProperties();
					break;
			}
		}
	},


	setCellProperties: function () {
		if (this._colspan != null) {
			this._td.attr("colspan", this._colspan);
			this._colspan = null;
		}
		if (this._align != null) {
			this._td.css("text-align", this._align);
			this._align = null;
		}
		if (this._valign != null) {
			this._td.css("vertical-align", this._valign);
			this._valign = null;
		}
		if (this._cell_width != null) {
			this._td.css("width", this._cell_width);
			this._cell_width = null;
		}
		this._td.css("padding", this.padding);
		if (this._cell_style != null) {
			this._td.css(this._cell_style);
			this._cell_style = null;
		}
		if (this._cell_class != null) {
			this._td.addClass(this._cell_class);
			this._cell_class = null;
		}
	},


	getCellAlign: function () {
		return this._td.css("text-align");
	},


	end: function () {
		if (this._sub_manager != null) {
			this._sub_manager.parent(null);
			this._td.append(this._sub_manager.end());
			this._sub_manager = null;
		}
		// fix_table_alignment
		if (this._parent && this.fieldset === null && this._parent.getCellAlign) {
			this._content.css("float", this._parent.getCellAlign());
		}
		return this._content;
	}
});



/**********************************************************
 *
 * AVO.Grid_Layout
 *
 **********************************************************/
AVO.Grid_Layout = function (properties) {
	$.extend(this, properties || {});
};
$.extend(AVO.Grid_Layout.prototype, {
	id: null,
	fieldset: null,
	padding: 2,
	spacing: 0,
	columns: 2,
	width: "100%",
	layout_follows_title: false,
	style: null,
	html_class: null,

	_cur_column: 0,
	_sub_manager: null,
	_colspan: null,
	_align: null,
	_valign: null,
	_cell_width: null,
	_cell_style: null,
	_cell_class: null,
	_parent: null,
	_content: null,
	_body: null,
	_tr: null,
	_td: null,
	_row_id: null,
	_row_style: null,
	_row_class: null,
	_layout_follows_title: false,


	parent: function (parent) {
		if (parent) this._parent = parent;
		return this._parent;
	},


	start: function () {
		var table = $("<TABLE>").css("border-spacing", this.spacing + "px").append(
			this._body = $("<TBODY>").append(
				this._tr = $("<TR>")
			)
		);
		if (this.html_class) table.addClass(this.html_class);
		if (this.width != null) table.css("width", this.width);
		if (this.fieldset != null) {
			this._content = $("<FIELDSET>").append(
				$("<LEGEND>").text(this.fieldset)
			).append(table);
		} else {
			this._content = table;
		}
		if (this.style != null) this._content.css(this.style);
		if (this.id !== null) this._content.attr("id", this.id);
	},


	add: function (control, notitle) {
		if (this._sub_manager != null && this._layout_follows_title == false) {
			this._sub_manager.add(control);
		} else {
			switch (control.constructor) {
				case AVO.Layout_Control:
					for (var i = 0; i < control.commands.length; i++) {
						switch (control.commands[i]) {
							case "row_id":
								this._row_id = control.commands[++i];
								break;
							case "row_style":
								this._row_style = control.commands[++i];
								break;
							case "row_class":
								this._row_class = control.commands[++i];
								break;
							case "colspan":
								this._colspan = control.commands[++i];
								break;
							case "align":
								this._align = control.commands[++i];
								break;
							case "valign":
								this._valign = control.commands[++i];
								break;
							case "width":
								this._cell_width = control.commands[++i];
								break;
							case "style":
								this._cell_style = control.commands[++i];
								break;
							case "html_class":
								this._cell_class = control.commands[++i];
								break;
							case "layout_follows_title":
								this._layout_follows_title = true;
								break;
							case "layout":
								this._sub_manager = control.commands[++i];
								this._sub_manager.parent(this);
								if (!this._layout_follows_title) {
									this.new_cell();
									this._tr.append(
										this._td = $("<TD class='clearfix'>")
									);
									this.setCellProperties();
									this._sub_manager.start();
								}
								break;
							case "end_layout":
								if (this._parent != null && this._parent._sub_manager != null) {
									this._parent._sub_manager = null;
									this._parent._td.append(this.end());
									this._parent = null;
								}
								break;
						}
					}
					break;
				case AVO.Field:
					if (control.control_before_title) {
						this.new_cell();
						this._tr.append(
							this._td = $("<TD class='clearfix'>").append(control.render())
						);
						this._td.css("text-align", control.align);
						this.setCellProperties();
						if (control.title != null) {
							this.new_cell();
							this._tr.append(
								this._td = $("<TD class='clearfix'>")
							);
							control.label(this._td.addClass("form_field_label"));
							this.setCellProperties();
							if (typeof control.title === "object" && field.title.constructor === AVO.Label) {
								this._td.append(control.title.render());
							} else {
								this._td.text(control.title ? control.title : "");
							}
						}
					} else {
						if (control.title != null) {
							this.new_cell();
							this._tr.append(
								this._td = $("<TD class='clearfix'>")
							);
							control.label(this._td.addClass("form_field_label"));
							this.setCellProperties();
							if (typeof control.title === "object" && control.title.constructor === AVO.Label) {
								this._td.append(control.title.render());
							} else {
								this._td.text(control.title ? control.title : "");
							}
						}
						if (this._layout_follows_title) {
							this.new_cell();
							this._tr.append(
								this._td = $("<TD class='clearfix'>")
							);
							this.setCellProperties();
							this._sub_manager.start();
							this._sub_manager.add(control, true);
							this._layout_follows_title = false;
						} else {
							this.new_cell();
							this._tr.append(
								this._td = $("<TD class='clearfix'>").append(control.render())
							);
							this._td.css("text-align", control.align);
							this.setCellProperties();
						}
					}
					break;
				case AVO.Button:
				case AVO.Link:
				case AVO.Label:
					this.new_cell();
					this._tr.append(
						this._td = $("<TD class='clearfix'>").append(control.render())
					);
					this.setCellProperties();
					break;
			}
		}
	},


	setCellProperties: function () {
		if (this._colspan != null) {
			this._td.attr("colspan", this._colspan);
			this._cur_column += this._colspan - 1;
			this._colspan = null;
		}
		if (this._align != null) {
			this._td.css("text-align", this._align);
			this._align = null;
		}
		if (this._valign != null) {
			this._td.css("vertical-align", this._valign);
			this._valign = null;
		}
		if (this._cell_width != null) {
			this._td.css("width", this._cell_width);
			this._cell_width = null;
		}
		this._td.css("padding", this.padding);
		if (this._cell_style != null) {
			this._td.css(this._cell_style);
			this._cell_style = null;
		}
		if (this._cell_class != null) {
			this._td.addClass(this._cell_class);
			this._cell_class = null;
		}
	},


	new_cell: function () {
		if (++this._cur_column > this.columns) this._cur_column = 1;
		if (this._cur_column == 1) {
			this._body.append(
				this._tr = $("<TR>")
			);
			if (this._row_id != null) {
				AVO[this._row_id] = this._tr;
				this._tr.attr("id", this._row_id);
				this._row_id = null;
			}
			if (this._row_class) {
				this._tr.addClass(this._row_class);
				this._row_class = null;
			}
			if (this._row_style != null) {
				this._tr.css(this._row_style);
				this._row_style = null;
			}
		}
	},


	getCellAlign: function() {
		return this._td.css("text-align");
	},


	end: function () {
		if (this._sub_manager != null) {
			this._sub_manager.parent(null);
			this._td.append(this._sub_manager.end());
			this._sub_manager = null;
		}
		if (this._cur_column > 0) {
			while (this._cur_column < this.columns) {
				this._tr.append(
					this._td = $("<TD class='clearfix'>")
				);
				this.setCellProperties();
				this._cur_column++;
			}
			this._cur_column = 0;
		}
		// fix_table_alignment
		if (this._parent && this.fieldset === null && this._parent.getCellAlign) {
			this._content.css("float", this._parent.getCellAlign());
		}
		return this._content;
	}
});



/**********************************************************
 *
 * AVO.Label
 *
 **********************************************************/
AVO.Label = function (properties) {
	$.extend(this, properties || {});
};
$.extend(AVO.Label.prototype, {
	encoded: false,
	hint: null,
	html_class: null,
	value: null,
	afterRender: null,

	_parent: null,
	_page_control: null,


	parent: function (parent) {
		if (parent !== undefined) this._parent = parent;
		return this._parent;
	},


	pageControl: function () {
		return this._page_control;
	},


	render: function () {
		this._page_control = $("<span>");
		if (this.html_class !== null) {
			this._page_control.addClass(this.html_class);
		}
		if (this.encoded) {
			this._page_control.html(this.value ? this.value : "");
		} else {
			this._page_control.text(this.value ? this.value : "");
		}
		if (this.hint !== null) {
			this._page_control
				.addClass("tooltip_enabled")
				.tooltip({title: AVO.HTML.encode(this.hint), html: true, placement: "right"});
		}
		this.afterRender && this.afterRender();
		return this._page_control;
	},


	updatePageControlProperty: function (name) {
		if (name == "style") {
			this._page_control.css(this.style);
		}
	}
});


/**********************************************************
 *
 * AVO.Button
 *
 **********************************************************/
AVO.Button = function (properties) {
	$.extend(this, properties || {});
};
AVO.Button.TYPE_BUTTON = 0;
AVO.Button.TYPE_UPLOAD = 1;
$.extend(AVO.Button.prototype, {
	action: null,
	allowed_extensions: null,
	beforeRender: null,
	is_default: false,
	html_class: null,
	html_control: "button",
	icon: null,
	msg_invalid_file_type: "{file} has invalid extension. Only {extensions} are allowed.",
	name: null,
	onClick: null,
	onPrepareData: null,
	onUploadComplete: null,
	send_fields: null,
	type: AVO.Button.TYPE_BUTTON,
	value: null,
	style: null,

	_page_control: null,
	_parent: null,
	_upload_control: null,
	_upload_dialog: null,
	_upload_is_complete: false,
	_upload_is_cancelled: false,


	parent: function (parent) {
		if (parent !== undefined) this._parent = parent;
		return this._parent;
	},


	pageControl: function () {
		return this._page_control;
	},


	render: function (record) {
		if (this.beforeRender) {
			if (!this.beforeRender(record)) return null;
		}
		var content;
		if (this.type == AVO.Button.TYPE_UPLOAD) {
			content = $("<div class='upload_button btn-primary' />");
		} else {
			content = $("<" + this.html_control + ">");
			if (this.name != null) content.attr("name", this.name);
		}
		this._page_control = content;
		if (this.value) content.text(this.value);

		if (this.html_class != null) content.addClass(this.html_class);
		if (this.icon != null) {
			if (this.html_control == "button") {
				content.prepend(" ").prepend($('<span class="glyphicon glyphicon-' + this.icon + '"></span>')).addClass("btn");
			} else {
				content.addClass("ico16-" + this.icon);
			}
		}
		if (this.type == AVO.Button.TYPE_UPLOAD) {
			var url = this._parent.controller_url;
			url += (url.match(/\?/) ? "&" : "?") + "__avo_ajax_upload&__avo_ajax_action=" + ((this.action === null) ? this.name : this.action);
			var t = this;
			this._upload_control = new qq.FileUploaderBasic({
				button: this._page_control[0],
			    multiple: false,
			    allowedExtensions: (this.allowed_extensions ? this.allowed_extensions : []),
			    action: url,
			    messages: {
		            typeError: this.msg_invalid_file_type,
		            sizeError: "{file} is too large, maximum file size is {sizeLimit}.",
		            minSizeError: "{file} is too small, minimum file size is {minSizeLimit}.",
		            emptyError: "{file} is empty, please select files again without it.",
		            onLeave: "The files are being uploaded, if you leave now the upload will be cancelled."
		        },
		        showMessage: function (text) {
		        	t._parent.displayMessage(1, text);
		        },
				onSubmit: function (id, file) {
					var data = t._parent.getParamHash();
					if (t.send_fields !== null) {
						var parent = t._parent;
						if (t.send_fields === true) {
							for (var i = 0; i < form.controls.length; i++) {
								var ctl = form.controls[i];
								if (ctl.constructor === AVO.Field) {
									data[ctl.name] = ctl.formValue();
								}
							}
						} else {
							for (var i = 0; i < t.send_fields.length; i++) {
								var ctl = parent.control(t.send_fields[i]);
								if (ctl.constructor === AVO.Field) {
									data[ctl.name] = ctl.formValue();
								}
							}
						}
					}
					if (t.onPrepareData) data = t.onPrepareData(data);
					t._upload_control.setParams(data);

					// close the keep-alive connection for IE and Safari
					if (/AppleWebKit|MSIE/.test(navigator.userAgent)) {
						$.ajax({
							async: false,
							url: url + "&__avo_close_connection"
						});
					}

		        	// display a dialog with processing spinner and progress bar
					var is_progress_supported = qq.UploadHandlerXhr.isSupported();

					t._upload_dialog = $(
						"<div class='modal' id='upload' tabindex='-1' role='dialog' data-backdrop='static' aria-labelledby='uploadLabel' aria-hidden='true'>" +
							"<div class='modal-dialog'>" +
								"<div class='modal-content'>" +
									"<div class='modal-header'>" +
										"<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>" +
										"<h3 id='uploadLabel' class='modal-title'>file upload</h3>" +
									"</div>" +
									"<div class='modal-body'>" +
										"<p>" +
											"<span class='filename'></span><span class='progress-status'><br />" +
											"Progress: <span class='percent'>0.0</span>% of <span class='size'>?</span><br />" +
											"Status: <span class='status'>uploading…</span>" +
											"</span>" +
										"</p>" +
					        			"<div class='progress progress-striped active'>" +
					        				"<div class='bar' style='width:0'></div>" +
					        			"</div>" +
					        		"</div>" +
					        		"<div class='modal-footer'>" +
								    	"<button class='btn btn-default' data-dismiss='modal' aria-hidden='true'>abort</button>" +
								    "</div>" +
							    "</div>" +
							"</div>" +
					    "</div>"
					);

		        	if (!is_progress_supported) {
		        		$("div.progress .bar", t._upload_dialog).css("width", "100%");
		        		$(".progress-status", t._upload_dialog).remove();
		        	}
		        	$(".filename", t._upload_dialog).text(file);
		        	t._upload_is_complete = false;
		        	t._upload_dialog.on("hide", function () {
		        		if (!t._upload_is_complete) {
		        			console.log("cancel");
		        			t._upload_control._handler.cancelAll();
		        		}
		        	});
		        	t._upload_dialog.on("hidden", function () {
		        		// remove the dialog
		        		t._upload_dialog.remove();
		        		t._upload_dialog = undefined;
		        	});

		        	// show the dialog
		        	t._upload_dialog.appendTo("body").modal("show");
				},
				onComplete: function (id, file, response) {
					// restore the button class
					if (response.perform_action == "doc_reload") {
						window.location.reload();
						return;
					}
					t._parent.displayMessage(response.status, response.message);
					if (t.onUploadComplete) t.onUploadComplete(file, response);
					t._upload_is_complete = true;
		        	t._upload_dialog.modal("hide");
				},
		        onProgress: function(id, fileName, loaded, total) {
		        	var progress = loaded * 100 / (total ? total : 1);
		        	$("div.progress .bar", t._upload_dialog).css("width", parseInt(progress) + "%");
		        	$(".percent", t._upload_dialog).text(progress.toFixed(1));
		        	$(".size", t._upload_dialog).text(t._upload_control._formatSize(total));
		        	if (progress == 100) $(".status", t._upload_dialog).text("processing…");
		        }
			});
		} else {
			content.bind("click", {sender: this}, this.ehProcessClick);
		}
		return content;
	},


	unrender: function () {
		if (this._upload_control !== null) {
			this._upload_control.destroy();
		}
		this._page_control = null;
	},


	ehProcessClick: function (event) {
		var sender = event.data.sender;
		var result;
		if (sender.onClick == null) {
			result = true;
		} else {
			result = sender.onClick(event);
		}
		if (result && sender.action != null) {
			result = sender._parent.submit(sender.action);
		}

		return result;
	},


	updatePageControlProperty: function (name) {
		if (name == "style") {
			this._page_control.css(this.style);
		}
	}
});





/**********************************************************
 *
 * AVO.Field
 *
 **********************************************************/
AVO.Field = function (properties) {
	$.extend(this, properties || {});
	this._links = {};
	if (this.title != null && typeof this.title === "object") {
		this.title.parent(this);
	}
	if (this.err_title != null && typeof this.err_title === "object") {
		this.err_title.parent(this);
	}
};

AVO.Field.TYPE_STRING = 0;
AVO.Field.TYPE_INT = 1;
AVO.Field.TYPE_TEXT = 2;
AVO.Field.TYPE_BOOL = 3;
AVO.Field.TYPE_LOOKUP = 4;
AVO.Field.TYPE_DATE = 5;
AVO.Field.TYPE_DATETIME = 6;
AVO.Field.TYPE_TIME = 7;
AVO.Field.TYPE_VARIANT =  8;
AVO.Field.TYPE_MONEYINT = 9;

$.extend(AVO.Field.prototype, {
	afterRender: null,
	default_focus: false,
	dragable: false,
	encoded: false,
	hidden: false,
	html_class: null,
	html_class_row_hover: null,
	html_editor: false,
	key: false,
	lookup_multiline: false,
	lookup_values: null,
	max_length: null,
	name: null,
	onBlur: null,
	onChange: null,
	on_change_track_keyup: false,
	onFocus: null,
	read_only: false,
	searchable: false,
	size: null,
	sortable: true,
	tinymce_options: null,
	title: null,
	type: null,
	value: null,
	width: null,

	_links: null,
	_page_control: null,
	_parent: null,
	_label: null,


	parent: function (parent) {
		if (parent !== undefined) this._parent = parent;
		return this._parent;
	},


	label: function (label) {
		if (label !== undefined) this._label = label;
		return this._label;
	},


	setError: function () {
		this._label && this._label.addClass("ico16-bullet_error");
	},


	resetError: function () {
		this._label && this._label.removeClass("ico16-bullet_error");
	},


	render: function () {
		var content = null;
		if (this.encoded) {
			this._page_control = content = $("<DIV>");
			if (this.html_class != null) content.addClass(this.html_class);
			if (this.style != null) content.css(this.style);
			if (this.width != null) content.css("width", this.width);
			if (this.height != null) content.css("height", this.height);
		} else {
			switch (this.type) {
				case AVO.Field.TYPE_STRING:
				case AVO.Field.TYPE_INT:
				case AVO.Field.TYPE_DATE:
				case AVO.Field.TYPE_DATETIME:
				case AVO.Field.TYPE_TIME:
				case AVO.Field.TYPE_MONEYINT:
					content = $("<INPUT>")
						.attr("type", this.hidden ? "hidden" : (this.password ? "password" : "text"))
						.addClass("text form-control").attr("name", this.name);
					if (this.on_change_track_keyup) {
						content.bind("keyup", {sender: this}, this.ehProcessChange);
					} else {
						content.bind("change", {sender: this}, this.ehProcessChange);
					}
					if (this.read_only) content.attr("readonly", true);
					if (this.max_length != null) content.attr("maxlength", this.max_length);
					content.bind("focus", {sender: this}, this.ehProcessFocus);
					content.bind("blur", {sender: this}, this.ehProcessBlur);
					if (this.html_class != null) content.addClass(this.html_class);
					if (this.style != null) content.css(this.style);
					if (this.width != null) content.css("width", this.width);
					if (this.height != null) content.css("height", this.height);
					if (this.type == AVO.Field.TYPE_DATE) {
						content.datepicker();
					} else if (this.type == AVO.Field.TYPE_DATETIME) {
						content.datetimepicker();
					} else if (this.type == AVO.Field.TYPE_TIME) {
						content.timepicker();
					}
					this._page_control = content;
					break;
				case AVO.Field.TYPE_BOOL:
					content = $("<INPUT>").attr("type", (this.hidden ? "hidden" : "checkbox"))
						.addClass("checkbox").attr("name", this.name);
					if (this.on_change_track_keyup) {
						content.bind("keyup", {sender: this}, this.ehProcessChange);
					} else {
						content.bind("change", {sender: this}, this.ehProcessChange);
					}
					if (this.read_only) content.bind("click", false);
					content.bind("focus", {sender: this}, this.ehProcessFocus);
					content.bind("blur", {sender: this}, this.ehProcessBlur);
					if (this.html_class != null) content.addClass(this.html_class);
					if (this.style != null) content.css(this.style);
					this._page_control = content;
					break;
				case AVO.Field.TYPE_TEXT:
					content = $("<TEXTAREA>").addClass("text form-control").attr("name", this.name);
					if (this.on_change_track_keyup) {
						content.bind("keyup", {sender: this}, this.ehProcessChange);
					} else {
						content.bind("change", {sender: this}, this.ehProcessChange);
					}
					if (this.read_only) content.attr("readonly", true);
					content.bind("focus", {sender: this}, this.ehProcessFocus);
					content.bind("blur", {sender: this}, this.ehProcessBlur);
					if (this.html_class != null) content.addClass(this.html_class);
					if (this.style != null) content.css(this.style);
					if (this.width != null) content.css("width", this.width);
					if (this.height != null) content.css("height", this.height);
					if (this.html_editor) {

						var options = {
							relative_urls: false,
							remove_script_host: true,
							document_base_url: AVO.settings.base_path,
							width: this.width,
							height: this.height,
							entity_encoding: "raw",
							element_format: "html",
							plugins: "advlist autolink lists link preview code table contextmenu paste textcolor",
//							valid_elements: ""
//								+ "table[style],tbody,tr,td,"
//								+ "a[href|target|title],"
//								+ "ul,ol,li,"
//								+ "br,"
//								+ "strong/b,"
//								+ "em/i,"
//								+ "span[style<text-decoration: underline; ],"
//								+ "u",
							menubar: false,
							toolbar: "cut copy paste | undo redo | bold italic underline | styleselect | removeformat | alignleft aligncenter alignright alignjustify | bullist numlist | hr link | table | code preview",

							file_browser_callback: undefined
						};
						$.extend(options, this.tinymce_options || {});
						this._parent.addAfterRender(function() {
							content.tinymce(options);
						});
					} else {
						// control the number of chars in the field
						if (this.max_length) {
							content.bind("keyup", {sender: this}, this.ehLimitTextareaContentLength)
								.bind("blur", {sender: this}, this.ehLimitTextareaContentLength);
						}
					}
					this._page_control = content;
					break;
				case AVO.Field.TYPE_LOOKUP:
					content = $("<SELECT>").addClass("text form-control").attr("name", this.name);
					if (this.lookup_multiline) content.attr("size", 2);
					if (this.read_only) content.attr("disabled", true);
					content.bind("change", {sender: this}, this.ehProcessChange);
					content.bind("focus", {sender: this}, this.ehProcessFocus);
					content.bind("blur", {sender: this}, this.ehProcessBlur);
					if (this.html_class != null) content.addClass(this.html_class);
					if (this.style != null) content.css(this.style);
					if (this.width != null) content.css("width", this.width);
					if (this.height != null) content.css("height", this.height);
					if (this.size != null) content.attr("size", this.size);
					this._page_control = content;
					break;
			}
		}

		this.afterRender && this.afterRender();

		return this._page_control;
	},


	updatePageControlValue: function () {
		if (arguments.length) this.value = arguments[0];
		if (this.encoded) {
			this._page_control.html(this.value !== null ? this.value : "");
		} else if (this.type == AVO.Field.TYPE_BOOL) {
			if (this.hidden) {
				this._page_control.val(this.value ? 1 : 0);
			} else {
				this._page_control.get(0).checked = !!this.value;
			}
		} else if (this.type == AVO.Field.TYPE_LOOKUP) {
			this._page_control.empty();
			var vals = this.lookup_values;
			var l = vals.length;
			for (var i = 0; i < l; i++) {
				var pair = vals[i];
				this._page_control.append($("<OPTION>").val(pair[0]).text(String(pair[1]) == "" ? "" : pair[1]));
			}
			this._page_control.val((this.value != undefined) ? this.value : "");
		} else {
			try {
				this._page_control.val((this.value == undefined) ? "" : this.value);
			} catch (e) {
				// prevents the tinyMCE from crashing the fields updating loop
			}
			if (this.html_editor) {
				try {
					this._page_control.tinymce().undoManager.clear();
				} catch (e) {
					// not initialized yet. skipping undo clear
				}
			}
		}
		// update linked objects
		this.updateLinks();
		if (this.onChange != null) return this.onChange(false);
	},


	formValue: function () {
		if (this.type == AVO.Field.TYPE_BOOL) {
			if (this.hidden) {
				var val = this._page_control.val();
				return (val && val != "0") ? 1 : 0;
			} else {
				return this._page_control.get(0).checked ? 1 : 0;
			}
		} else {
			try {
				return this._page_control.val();
			} catch (e) {
				return "";
			}
		}
	},


	pageControl: function () {
		return this._page_control;
	},


	ehProcessFocus: function (event) {
		var owner = event.data.sender;
		if (owner.onFocus) return owner.onFocus();
	},


	ehProcessBlur: function (event) {
		var owner = event.data.sender;
		if (owner.onBlur) return owner.onBlur();
	},


	ehProcessChange: function (event) {
		var owner = event.data.sender;
		if (owner.on_change_track_keyup) {
			var kc = event.keyCode;
			if (kc == Event.KEY_TAB || kc == Event.KEY_RETURN || kc == Event.KEY_ESC || kc == Event.KEY_LEFT
					|| kc == Event.KEY_RIGHT || kc == Event.KEY_UP || kc == Event.KEY_DOWN || kc == Event.KEY_HOME
					|| kc == Event.KEY_END || kc == Event.KEY_PAGEUP || kc == Event.KEY_PAGEDOWN) {
				return;
			}
		}
		owner.updateLinks();
		if (owner.onChange) return owner.onChange(true);
	},


	ehLimitTextareaContentLength: function (event) {
		var owner = event.data.sender;
		var text = owner.formValue();
		if (text.length > owner.max_length) {
			owner.updatePageControlValue(text.substring(0, owner.max_length));
		}
	},


	updateLinks: function () {
		for (var key in this._links) {
			var link = this._links[key];
			link.update(this.name, this.formValue());
		}
	},


	setLink: function (name, obj) {
		this._links[name] = obj;
	},


	updatePageControlProperty: function (name) {
		if (name == "style") {
			this._page_control.css(this.style);
		}
	}
});


/**********************************************************
 *
 * AVO.Link
 *
 **********************************************************/
AVO.Link = function (properties) {
	$.extend(this, properties || {});
	this.child.parent(this);
};
$.extend(AVO.Link.prototype, {
	child: null,
	name: null,
	params: null,

	_dirty_params: null,
	_page_control: null,
	_parent: null,
	_ready_params: null,
	_updates_enabled: true,


	parent: function (parent) {
		if (parent !== undefined) this._parent = parent;
		return this._parent;
	},


	setLinkDirty: function () {
		this._dirty_params = {};
		for (var name in this.params) {
			this._dirty_params[name] = true;
		}
		this._ready_params = {};
	},


	render: function () {
		for (var name in this.params) {
			this._parent.control(name).setLink(this.name, this);
		}
		this.setLinkDirty();

		this._page_control = $("<div>");
		this.child.render(null);
		return this._page_control;
	},


	placeholder: function () {
		return this._page_control;
	},


	hide: function () {
		this._parent.hide();
	},


	show: function () {
		this._parent.show();
	},


	update: function (name, value) {
		delete this._dirty_params[name];
		this._ready_params[this.params[name]] = value;
		var params_are_dirty = false;
		for (var name in this._dirty_params) {
			if (this._dirty_params.hasOwnProperty(name)) {
				params_are_dirty = true;
				break;
			}
		}
		if (!params_are_dirty && this._updates_enabled) {
			// add to ready parameters also all properties holded by the parent
			this.updateChild();
		}
	},


	areUpdatesEnabled: function () {
		return this._updates_enabled;
	},


	disableUpdates: function () {
		this._updates_enabled = false;
	},


	enableUpdates: function () {
		this._updates_enabled = true;
	},


	updateChild: function () {
		var link_parameters = this._parent.getParamHash();
		$.extend(link_parameters, this._ready_params);
		this.child.update(null, link_parameters, false);
	}
});


/**********************************************************
 *
 * AVO.Data_Form
 *
 **********************************************************/
AVO.Data_Form = function (properties) {
	$.extend(this, properties || {});
	// find key field
	for (var i = 0; i < this.controls.length; i++) {
		if (this.controls[i].key) {
			this._key_field_no = i;
		}
		this.controls[i].parent(this);
	}
	if (this.forms != null) {
		var form_name;
		for (form_name in this.forms) {
			this.forms[form_name].parent(this);
		}
	}
	if (!this.layout) this.layout = new AVO.Grid_Layout();
	this.layout.parent(this);
	this.onInit && this.onInit();
};
$.extend(AVO.Data_Form.prototype, {
	afterUpdate: null,
	beforeSubmit: null,
	beforeUpdate: null,
	close_button_title: null,
	controller_url: null,
	controls: null,
	forms: null,
	html_class: 'wide_sheet',
	height: 200,
	layout: null,
	name: null,
	onInit: null,
	onEscalateControl: null,
	onSubmit: null,
	parameters: null,
	title: null,
	title_class: null,
	width: null,

	_after_render: undefined,
	_controls_hash: null,
	_delay_escalate_action: null,
	_delay_escalate_control: false,
	_form: null,
	_is_rendered: false,
	_is_render_in_progress: false,
	_key_field_no: null,
	_parent: null,
	_title_container: null,



	keyFieldName: function () {
		return this.controls[this._key_field_no].name;
	},


	parent: function (parent) {
		if (parent !== undefined) this._parent = parent;
		return this._parent;
	},


	placeholder: function () {
		return $("#" + this.name);
	},


	hide: function () {
		AVO.MessageBox.hideError();
		this.placeholder().hide();
		this.hideDescendants();
	},


	hideDescendants: function () {
		if (this.forms !== null) {
			for (var name in this.forms) {
				this.forms[name].hide();
			}
		}
		for (var i = 0; i < this.controls.length; i++) {
			var ctl = this.controls[i];
			if (ctl.constructor === AVO.Link) {
				ctl.child.hide(false);
			}
		}
	},


	show: function () {
		this.hideDescendants();
		this._parent && this._parent.hide();
		this.render();
		this.placeholder().show();
	},


	addAfterRender: function (handler) {
		if (!this._after_render) this._after_render = [];
		this._after_render.push(handler);
	},


	isRendered: function () {
		return this._is_rendered;
	},


	render: function (data) {
		if (this.isRendered()) return;

		// check the render lock. Rendering can be postponed until the document is ready
		if (this._is_render_in_progress) return;
		this._is_render_in_progress = true;

		if (!this.parent()) {
			document.write("<TABLE id='" + this.name + "'></TABLE>");
		}
		$($.proxy(function () {
			// if parent exists append the rendered content to it. Othervise - append to the already rendered placeholder
			if (this.parent()) {
				var container = this.parent().placeholder();
				var p = this.parent().parent();
				if (p) {
					if (p.constructor === AVO.Link) {
						container = p.parent().placeholder();
					} else if (p.constructor === AVO.Data_Form) {
						container = p.placeholder();
					}
				}
				container.after(this.renderObject());
			} else {
				this.renderObject();
			}

			// at this point the rendered content is in the DOM
			if (this._after_render) {
				for (var i = 0; i < this._after_render.length; i++) {
					this._after_render[i]();
				}
			}
			this._is_rendered = true;
			this._is_render_in_progress = false;
			if (data !== undefined) this.onUpdateSuccess(data);
		}, this));
	},


	renderObject: function () {
		var content;
		if (this._parent) {
			content = $("<table>").attr("id", this.name);
		} else {
			content = $("#" + this.name);
		}
		content.addClass(this.html_class);
		if (this.width != null) content.css("width", this.width);

		var body = $("<tbody>").appendTo(content);

		this._title_container = $("<tr class='nodisplay title'><td><h2></h2></td></tr>").appendTo(body);
		if (this.close_button_title !== null) {
			var btn = new AVO.Button({
				name: "__avo_btn_close_form",
				icon: "arrow-left",
				value: this.close_button_title,
				onClick: function() {
					this._parent.escalateControl();
					return false;
				}
			});
			btn.parent(this);
			this._title_container.append(
				$("<td>").css("text-align", "right").append(
					btn.render()
				)
			);
		}

		var tr, td;
		tr = $("<tr>").appendTo(body);
		td = $("<td>").appendTo(tr);
		if (this.close_button_title) td.attr("colspan", 2);

		var t = this;
		td.append(
			this._form = $("<FORM>").attr("method", "POST").submit(function() {
				return t.submit();
			})
		);

		var ft = $("<TABLE>").css("width", "100%").append(
			body = $("<TBODY>")
		);
		this._form.append(ft);
		body.append(
			tr = $("<TR>").append(
				td = $("<TD class='clearfix'>")
			)
		);

		this.layout.start();
		for (var i = 0; i < this.controls.length; i++) {
			if (this.controls[i].hidden) {
				ft.before(this.controls[i].render());
			} else {
				this.layout.add(this.controls[i]);
			}
		}
		td.append(this.layout.end());

		return content;
	},


	submit: function (action) {
		if (this.beforeSubmit) {
			if (!this.beforeSubmit()) return false;
		}
		if (this.onSubmit) {
			return this.onSubmit();
		} else {
			var ajax_submit = false;
			if (action && typeof action == "string") {
				ajax_submit = true;
			} else {
				// !!!!! ie workarrownd
				// find the default button
				for (var i = 0; i < this.controls.length; i++) {
					var ctl = this.controls[i];
					if (ctl.constructor === AVO.Button && ctl.is_default) {
						action = ctl.action;
						ajax_submit = true;
					}
				}

			}
			if (ajax_submit) {
				var options = {};
				for (var i = 0; i < this.controls.length; i++) {
					var ctl = this.controls[i];
					if (ctl.constructor === AVO.Field) {
						var val = ctl.formValue();
						options[ctl.name] = (val === null) ? "" : val;
					}
				}
				this.update(action, options);
				return false;
			}
		}
		return true;
	},


	getParamHash: function () {
		if (this.parameters == null) return {};

		var result = {};
		for (var i = 0; i < this.parameters.length; i++) {
			var param = this.parameters[i];
			result[param.name] = (param.value === null) ? "" : param.value;
		}
		return result;
	},


	param: function (name, value) {
		if (value !== undefined) {
			// set the parameter
			for (var i = 0; i < this.parameters.length; i++) {
				if (this.parameters[i].name == name) {
					this.parameters[i].value = value;
					return value;
				}
			}
			// parameter is not found. adding a new one
			if (this.parameters == null) this.parameters = new Array();
			this.parameters.push({
				name: name,
				value: value
			});
			return value;
		} else if (this.parameters == null) {
			return null;
		} else {
			for (var i = 0; i < this.parameters.length; i++) {
				if (this.parameters[i].name == name) {
					return this.parameters[i].value;
				}
			}
			return null;
		}
	},


	control: function (name) {
		if (this._controls_hash == null) this._controls_hash = {};
		for (var i = 0; i < this.controls.length; i++) {
			this._controls_hash[this.controls[i].name] = this.controls[i];
		}
		return this._controls_hash[name];
	},


	resetLinks: function () {
		for (var i = 0; i < this.controls.length; i++) {
			var ctl = this.controls[i];
			if (ctl.constructor === AVO.Link) {
				ctl.setLinkDirty();
			}
		}
	},


	focusDefaultControl: function () {
		for (var i = 0; i < this.controls.length; i++) {
			var ctl = this.controls[i];
			if (ctl.default_focus) {
				ctl.pageControl().focus();
				break;
			}
		}
	},


	update: function (action, options, callback) {
		var url = this.controller_url;
		if (action != undefined) {
			url += (url.match(/\?/) ? "&" : "?") + "__avo_ajax_action=" + action;
		}
		var request_options = this.getParamHash();
		$.extend(request_options, options || {});
		$.ajax({
			type: "POST",
			dataType: "json",
			url: url,
			data: request_options,
			success: $.proxy(function(data) {
				this.show();
				this.onUpdateSuccess(data);
				callback && callback();
			}, this),
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				log("XMLHttpRequest: ", XMLHttpRequest, "\ntextStatus: ", textStatus, "\nerrorThrown:", errorThrown);
			}
		});
	},


	onUpdateSuccess: function (data) {
		switch (data.perform_action) {
			case "doc_reload":
				window.location.reload();
				return;
			case "navigate":
				if (data.data.target == null) {
					document.location.href = data.data.url;
				} else {
					window.open(data.data.url, data.data.target, "");
				}
				return;
		}
		this.beforeUpdate && this.beforeUpdate(data);
		if (data.escalate_control) {
			// send message to the parent or display instead of the form
			if (this.onEscalateControl) {
				if (!this.onEscalateControl(data.status, data.message, data.escalate_action)) return;
			} else if (data.status == 1) {
				this.show();
				this.displayMessage(data.status, data.message);
				return;
			}
			if (data.delay_escalate_control) {
			} else {
				this._delay_escalate_action = data.escalate_action;
				this._delay_escalate_control = true;
				this.resetLinks();
			}
		}

		var name, ctl, val;

		// initialize the fields with the values passed from the server
		if (data.data != undefined) {
			for (name in data.data) {
				ctl = this.control(name);
				if (ctl != undefined) {
					val = data.data[name];
					if (ctl.constructor === AVO.Field && ctl.type == AVO.Field.TYPE_LOOKUP && val.constructor == Array) {
						ctl.value = val[0];
						ctl.lookup_values = val[1];
					} else {
						ctl.value = val;
					}
				}
			}
		}
		// initialize the control properties with the values from the server
		if (data.properties != undefined) {
			for (name in data.properties) {
				ctl = this.control(name);
				if (ctl) $.extend(ctl, data.properties[name] || {});
			}
		}

		if (data.parameters != undefined) {
			for (var i = 0; i < this.parameters.length; i++) {
				this.parameters[i].value = (data.parameters[i] === null) ? "" : data.parameters[i];
			}
		}

		this.show();
		this.focusDefaultControl();
		this.displayMessage(data.status, data.message); // bootstrap

		if (data.title != undefined) {
			this.title = data.title;
		}
		this.updateTitle();

		if (data.properties != undefined) {
			var field_names = new Array();
			for (var key in data.properties) {
				field_names.push(key);
			}
			for (var i = 0; i < this.controls.length; i++) {
				var ctl = this.controls[i];
				if ($.inArray(ctl.name, field_names) != -1) {
					for (var key in data.properties[ctl.name]) {
						ctl.updatePageControlProperty(key);
					}
				}
			}
		}
		if (data.data != undefined) {
			this.resetLinks();
			// update controls values
			var data_keys = new Array();
			for (var key in data.data) {
				data_keys.push(key);
			}
			for (var i = 0; i < this.controls.length; i++) {
				var ctl = this.controls[i];
				if (ctl.constructor === AVO.Field) {
					if (!data.update || $.inArray(ctl.name, data_keys) != -1) {
						ctl.updatePageControlValue();
					}
				}
			}
		}

		this.afterUpdate && this.afterUpdate(data);
	},


	updateTitle: function () {
		if (this.title == null) {
			this._title_container.hide();
			$("H2", this._title_container).empty();
		} else {
			this._title_container.show();
			$("H2", this._title_container).text(this.title).addClass(this.title_class);
		}
	},


	displayMessage: function (status, message) {
		AVO.MessageBox.hide();

		// reset error state for fields
		for (var i = 0; i < this.controls.length; i++) {
			var ctl = this.controls[i];
			if (ctl.constructor === AVO.Field) {
				ctl.resetError();
			}
		}
		if (message) {
			var first_failed_is_focused = false;
			if (typeof message == "object" && message.constructor == Array) {
				var result = new Array();
				for (var i = 0; i < message.length; i++) {
					var msg_item = message[i];
					if (typeof msg_item == "object" && msg_item.constructor == Array) {
						var line = "";
						var ctl = this.control(msg_item[0]);
						if (ctl) {
							ctl.setError();
							if (!first_failed_is_focused) {
								ctl.pageControl().focus();
								first_failed_is_focused = true;
							}
							var title = (ctl.err_title != null) ? ctl.err_title : ctl.title;
							if (title !== null) {
								if (typeof title == "object" && title.constructor === AVO.Label) {
									line = "<strong>" + title.render().html() + "</strong>: ";
								} else {
									line = "<strong>" + AVO.HTML.encode(title) + "</strong>: ";
								}
							}
						}
						// is encoded ?
						if (msg_item[2]) {
							line += msg_item[1];
						} else {
							line += AVO.HTML.encode(msg_item[1]);
						}
						result.push(line);
					} else {
						result.push(AVO.HTML.encode(msg_item));
					}
				}
				result = result.join("<br>");
			} else {
				result = AVO.HTML.encode(message);
			}
			if (status == 1) {
				AVO.MessageBox.error(result);
			} else {
				AVO.MessageBox.info(result);
			}
		}
	},

	escalateControl: function () {
		if (this._delay_escalate_control && this.onEscalateControl) {
			this._delay_escalate_control = false;
			this.onEscalateControl(0, "", this._delay_escalate_action);
		} else {
			if (this._parent) {
				this.hide();
				this._parent.show();
			}
		}
	}
});




/**********************************************************
 *
 * AVO.Data_Grid
 *
 **********************************************************/
AVO.Data_Grid = function (properties) {
	this.name = undefined;
	this.fields = undefined;
	this.width = "100%";
	this.controller_url = undefined;
	this.use_pager = true;
	this.parameters = undefined;
	this.forms = undefined;
	this.after_delete_confirmed = undefined;
	this.allow_insert = true;
	this.allow_update = true;
	this.allow_delete = true;
	this.display_rows_selector = undefined; // undefined - auto, false - no, true - yes

	this.afterUpdate = undefined;

	this.action_column_title = "action";
	this.no_data_text = "list is empty",
	this.add_new_title = '<span class="glyphicon glyphicon-plus"></span> new';
	this.delete_selected_title = '<span class="glyphicon glyphicon-trash"></span> delete selected';
	this.confirm_delete_many_items = "{n} items will be deleted. Are you sure?";
	this.no_items_selected = "No items selected";
	this.confirm_delete_text = "Are you sure you want to delete?";
	this.edit_button_text = "edit";
	this.pager_info_text = "displaying {from} to {to} of {total} items";
	this.pager_page_text = "page";
	this.pager_of_text = "of";
	this.pager_page_size_text = "page size";

	this.msg_conn_error = "Connection Error";
	this.title = undefined;
	this.afterRowRender = undefined;

	this._after_render = undefined;
	this._drag_handle = undefined;
	this._key_field_no = 0;
	this._parent = undefined;
	// rendering locks
	this._is_rendered = false;
	this._is_render_in_progress = false;

	this.pager_info = undefined;

	var i, form_name;

	$.extend(this, properties || {});
	// find key field
	for (i = 0; i < this.fields.length; i++) {
		if (this.fields[i].key) this._key_field_no = i;
		if (this.fields[i].dragable) this._drag_handle = this.fields[i].html_class;
		this.fields[i].parent(this);
	}
	if (this.forms) {
		for (form_name in this.forms) {
			this.forms[form_name].parent(this);
		}
	}
};
AVO.Data_Grid.prototype = {

	/**
	 * getter/setter for the parent
	 *
	 */
	parent: function (parent) {
		if (arguments.length) this._parent = parent;
		return this._parent;
	},


	/**
	 * returns a placeholder object for the grid
	 *
	 */
	placeholder: function () {
		return $("#" + this.name);
	},


	/**
	 * returns an array of the top buttons
	 * can be overriden to define additional ones
	 *
	 */
	getTopButtons: function () {
		return [];
	},


	/**
	 * hides the grid
	 *
	 */
	hide: function (hide_parent) {
		if (this.parent()) {
			if (hide_parent || !arguments.length) {
				// the grid is a widget on a form. Hide the form instead
				this.parent().hide();
			}
		} else {
			this.placeholder().hide();
		}
		this.hideDescendants();
	},


	/**
	 * shows the grid
	 *
	 */
	show: function () {
		this.hideDescendants();
		if (this.parent()) {
			// the grid is a widget on a form. Show the form instead
			this.parent().show();
		} else {
			this.placeholder().show();
		}
	},


	/**
	 * hides all descendants of the grid
	 *
	 */
	hideDescendants: function () {
		for (var name in this.forms) {
			this.forms[name].hide();
		}
	},


	/**
	 * returns a hash of parameters
	 *
	 */
	getParamHash: function () {
		if (!this.parameters) return {};

		var result = {};
		for (var i = 0; i < this.parameters.length; i++) {
			var param = this.parameters[i];
			result[param.name] = (param.value === null) ? "" : param.value;
		}
		return result;
	},


	/**
	 * handles the row deletion
	 *
	 */
	onDelete: function (event) {
		event.preventDefault();
		if (confirm(this.confirm_delete_text)) {
			var proceed = true;
			// additional confirmation
			if (this.after_delete_confirmed) proceed = this.after_delete_confirmed();
			if (proceed) {
				var sender = $(event.currentTarget);
				var id = sender.closest("tr").data("id");
				var params = {};
				params[this.fields[this._key_field_no].name] = id;
				this.update("delete", params);
			}
		}
	},


	/**
	 * handles the row editing
	 *
	 */
	onEdit: function (event) {
		event && event.preventDefault();
		if (this.forms) {
			var edit_form = this.forms["edit_form"];
			if (edit_form) {
				var params = this.getParamHash();
				var sender = event && $(event.currentTarget);
				var tr;
				if (sender) {
					tr = sender.closest("tr");
					params[edit_form.keyFieldName()] = tr.data("id");
				} else {
					params[edit_form.keyFieldName()] = "";
				}
				var t = this;
				edit_form.onEscalateControl = function(status, message, action_name) {
					t.onFormEscalateControl(this, status, message, action_name);
				};
				edit_form.update("get_data", params);
			}
		}
	},


	/**
	 * control escalation handling
	 */
	onFormEscalateControl: function (sender, status, message, action_name) {
		sender.hide();
		this.show();
		if (message) this.displayMessage(status, message);
		if (action_name) this.update(action_name, true);
	},


	/**
	 * displays a message
	 *
	 */
	displayMessage: function (status, message) {
		if (status == 1) {
			AVO.MessageBox.error(message);
		} else {
			AVO.MessageBox.info(message);
		}
	},


	/**
	 * render
	 *
	 */
	render: function (data) {
		// check locks
		if (this._is_rendered || this._is_render_in_progress) return;
		this._is_render_in_progress = true;

		var placeholder;
		if (this.parent()) {
			placeholder = $("<table id='" + this.name + "' style='display:none' class='data_grid table table-striped'><thead></thead><tbody></tbody><tfoot></tfoot></table>").hide();
			this.parent().placeholder().append(placeholder);
		} else {
			placeholder = undefined;
			document.write("<table id='" + this.name + "' style='display:none' class='data_grid table table-striped'><thead></thead><tbody></tbody><tfoot></tfoot></table>");
		}
		this.renderObject(data, placeholder);
	},


	/**
	 * renders an object
	 *
	 */
	renderObject: function(data, placeholder) {
		$($.proxy(function () {
			if (!placeholder) placeholder = this.placeholder();

			if (this.width != "100%") placeholder.css("width", this.width);

			var i, field, cell, columns_count = 0;

			// render the header
			var head_row = $("<tr class='header'>").appendTo($(">thead", placeholder));

			// add the selection column
			if (this.allow_delete && this.display_rows_selector === undefined || this.display_rows_selector) {
				var all_rows_selector = $("<input type='checkbox' />").change(function () {
					$('>tbody >tr >td:first-child>input[type=checkbox]', placeholder).attr("checked", $(this).is(":checked"));
				});
				head_row.append($("<td class='selector'>").append(all_rows_selector));
				columns_count++;
			}

			// add data columns
			for (i in this.fields) {
				field = this.fields[i];
				if (field.hidden) continue;
				cell = $("<td>").appendTo(head_row).data("id", field.name);
				if ($.type(field.title) == "object" && field.title.constructor === AVO.Label) {
					cell.append(field.title.render());
				} else {
					cell.text(field.title ? field.title : "");
				}
				if (field.align != "left") cell.css("text-align", field.align);
				if (field.sortable) {
					cell.addClass("sortable");
					cell.click($.proxy(this.onColumnTitleClick, this));
				}
				if (field.width) cell.css("width", field.width);
				columns_count++;
			}

			// add the action column
			if (this.allow_update || this.allow_delete) {
				var w = 0;
				if (this.allow_update) w += 55;
				if (this.allow_delete) w += 55;
				head_row.append($("<td>", {"class": "c", text: this.action_column_title, style: "width:" + w + "px"}));
				columns_count++;
			}

			// render the toolbar
			// collect the toolbar buttons
			var toolbar_buttons = [];
			if (this.allow_insert) {
				toolbar_buttons.push({
					name: this.add_new_title,
					bclass: "btn btn-primary add-new",
					onpress: $.proxy(this.onEdit, this)
				});
			}
			if (this.allow_delete && (this.display_rows_selector === undefined || this.display_rows_selector)) {
				toolbar_buttons.push({
					name: this.delete_selected_title,
					bclass: "btn btn-danger delete-selected",
					onpress: $.proxy(function (event) {
						event.preventDefault();
						var items = $('>tbody >tr >td:first-child>input[type=checkbox]:checked', placeholder);
						if (items.length) {
							var proceed = false;
							if (items.length == 1) {
								proceed = confirm(this.confirm_delete_text);
							} else {
								proceed = confirm(this.confirm_delete_many_items.replace("{n}", items.length));
							}
							if (proceed) {
								if (this.after_delete_confirmed) proceed = this.after_delete_confirmed();
								if (proceed) {
									var ids = [];
									items.each(function () {
										ids.push($(this).closest("tr").data("id"));
									});
									this.update("delete", {id: ids.join(",")});
								}
							}
						} else {
							alert(this.no_items_selected);
						}
					}, this)
				});
			}

			var additional_top_buttons = this.getTopButtons();
			for (i in additional_top_buttons) {
				toolbar_buttons.push(additional_top_buttons[i]);
			}

			// render the buttons
			if (toolbar_buttons.length) {
				var toolbar_row = $("<tr class='toolbar'>").insertBefore(head_row);
				var toolbar_cell = $("<td colspan='" + columns_count + "'>").appendTo(toolbar_row);
				for (i in toolbar_buttons) {
					var btn = toolbar_buttons[i];
					$("<a></a>", {"class": btn.bclass, html: btn.name, href: "#"}).appendTo(toolbar_cell).click(btn.onpress);
				}
			}

			// render the footer
			if (this.use_pager) {
				var footer_row = $("<tr>").appendTo($(">tfoot", placeholder));
				var footer_cell = $("<td colspan='" + columns_count + "'>").appendTo(footer_row);
				// add pager
				var footer = $("<table><tbody><tr><td class='pagers'></td><td class='info'></td></tr></tbody><table>").appendTo(footer_cell);
				this.pager_info = $("td.info", footer);
				this.pager = $("td.pagers", footer);
				$(
					'<div class="form-inline">' +
						'<div class="input-group input-group-sm pager-page">' +
							'<span class="page input-group-addon"></span><input maxlenght="5" type="text" class="form-control"><span class="input-group-addon"><span class="of"></span> <span class="total"></span></span>' +
						'</div> ' +
						"<div class='btn-group btn-group-sm'>" +
							'<button type="button" class="btn btn-default start" href="#"><span class="glyphicon glyphicon-fast-backward"></span></button> ' +
							'<button type="button" class="btn btn-default prev" href="#"><span class="glyphicon glyphicon-backward"></span></button> ' +
							'<button type="button" class="btn btn-default next" href="#"><span class="glyphicon glyphicon-forward"></span></button> ' +
							'<button type="button" class="btn btn-default end" href="#"><span class="glyphicon glyphicon-fast-forward"></span></button> ' +
							'<button type="button" class="btn btn-default refresh" href="#"><span class="glyphicon glyphicon-refresh"></span></button>' +
						"</div> " +
						'<div class="input-group input-group-sm pager-per-page">' +
							"<span class='items_per_page input-group-addon'></span> " +
							"<select class='form-control'>" +
								"<option value='10'>10</option>" +
								"<option value='25'>25</option>" +
								"<option value='50'>50</option>" +
								"<option value='100'>100</option>" +
								"<option value='250'>250</option>" +
							"</select>" +
						'</div>' +
					'</div>'
				).appendTo(this.pager);
				$("button", this.pager).click($.proxy(this.onPagerNavigate, this));
				$(".page", this.pager).text(this.pager_page_text ? this.pager_page_text : "");
				$(".of", this.pager).text(this.pager_of_text ? this.pager_of_text : "");
				$("input", this.pager).keypress($.proxy(this.onPagerNavigate, this)).focus(function () { $(this).val(""); }).blur(function () { $(this).val($(this).data("page")); });
				$(".items_per_page", this.pager).text(this.pager_page_size_text ? this.pager_page_size_text : "");
				$("select", this.pager).change($.proxy(this.onPagerNavigate, this));
			}

			placeholder.show();
			if (data) {
				this.setData(data);
			} else {
				// set the empty data message
				this.setData(false, placeholder);
			}

			// process the after-render stuff
			if (this._after_render) {
				for (var i = 0; i < this._after_render.length; i++) {
					this._after_render[i]();
				}
			}

			// drop locks
			this._is_rendered = true;
			this._is_render_in_progress = false;
		}, this));
	},


	onColumnTitleClick: function (event) {
		var td = $(event.currentTarget);

		if (td.hasClass("sorted")) {
			td.parent().toggleClass("asc desc");
		} else {
			td.siblings().removeClass("sorted");
			td.addClass("sorted");
		}

		this.update();
	},


	onPagerNavigate: function (event) {
		var target = $(event.currentTarget);
		var new_page = 0;
		var page_input = $("input", this.pager);
		var cur_page = parseInt(page_input.data("page"));

		if (target[0] == page_input[0]) {
			if (event.which != 13) return;
			new_page = parseInt(page_input.val(), 10);
		} else {
			if (target.hasClass("start")) {
				new_page = 1;
			} else if (target.hasClass("prev")) {
				new_page = Math.max(cur_page - 1, 1);
			} else if (target.hasClass("next")) {
				new_page = cur_page + 1;
			} else if (target.hasClass("end")) {
				new_page = parseInt($("span.total", this.pager).text()) + 1;
			} else if (target.hasClass("refresh")) {
				new_page = cur_page;
			} else if (target.prop("nodeName").toUpperCase() == "SELECT") {
				// here we need to recalculate the page number so the top record should appear in view after refresh
				var original_page_size = parseInt(target.data("page_size"));
				var new_page_size = parseInt(target.val());
				var top_item_position = (cur_page - 1) * original_page_size;
				new_page = Math.ceil(top_item_position / new_page_size);
			}
			event.preventDefault();
		}

		page_input.val(new_page);
		this.update();
	},


	/**
	 * sets the data for the grid
	 *
	 */
	setData: function (data, placeholder) {
		var row, cell;

		if (!placeholder) placeholder = this.placeholder();

		var container = $(">tbody", placeholder);

		if (!data || (data._rows && !data._rows.length)) {
			// remove all data rows
			container.empty();

			row = $("<tr class='data'>").appendTo(container);
			cell = $("<td class='no_data' colspan='" + $(">thead>tr.header>td", placeholder).size() + "'>").appendTo(row).text(this.no_data_text ? this.no_data_text : "");
			if (this.use_pager) {
				$("input", this.pager).val(0).data("page", 0);
				$("span.total", this.pager).text(0);
				this.pager_info.text("");
			}
		} else if (data._rows) {
			// remove all data rows
			container.empty();

			for (var i in data._rows) {
				var d = data._rows[i];
				row = $("<tr>").appendTo(container);

				if (this.allow_delete && this.display_rows_selector === undefined || this.display_rows_selector) {
					cell = $("<td class='c'>").appendTo(row);
					$("<input type='checkbox' />").appendTo(cell).click(function () {
						if (!$(this).is(":checked")) {
							$(">thead>tr.header>td:first-child>input[type=checkbox]", placeholder).removeAttr("checked");
						} else if ($('>tbody>tr>td:first-child>input[type=checkbox]:not(:checked)', placeholder).size() == 0) {
							$(">thead>tr.header>td:first-child>input[type=checkbox]", placeholder).attr("checked", true);
						}
					});
				}

				row.data({id: d[this._key_field_no]});
				for (var j in this.fields) {
					var field = this.fields[j];
					var val = d[j];
					row.data(field.name, val);
					if (field.hidden) continue;
					cell = $("<td>").appendTo(row);
					if (field.align != "left") cell.css("text-align", field.align);
					if (field.html_class) cell.addClass(field.html_class);

					if (field.type == AVO.Field.TYPE_BOOL && !field.encoded) {
						$("<input type='checkbox' />").attr("checked", val ? "checked" : false).appendTo(cell)
							.click(field.onChange ? $.proxy(field.onChange, field) : false);
					} else {
						if (val !== null) {
							if (field.encoded) {
								cell.html(val);
							} else {
								cell.text(val);
							}
						}
					}
				}

				// add the action cell
				if (this.allow_update || this.allow_delete) {
					cell = $("<td class='c'>").appendTo(row);
					if (this.allow_update) {
						$("<a>", {"class": "btn btn-xs btn-success", href: "#", text: this.edit_button_text}).click($.proxy(this.onEdit, this)).appendTo(cell);
					}
					if (this.allow_delete) {
						$("<a>", {"class": "btn btn-xs btn-danger delete-item", href: "#", html: '<span class="glyphicon glyphicon-trash"></span>'}).click($.proxy(this.onDelete, this)).appendTo(cell);
					}

				}



				// after row is rendered event handler
				this.afterRowRender && this.afterRowRender(row);
			}

			if (this.use_pager) {
				// update the pager
				$("input", this.pager).val(data.page).data("page", data.page);
				$("select", this.pager).val(data.page_size).data("page_size", data.page_size);
				$("span.total", this.pager).text(Math.ceil(data.total / data.page_size));

				// update the information
				var from = (data.page - 1) * data.page_size + 1;
				this.pager_info.text(this.pager_info_text.replace('{from}', from).replace('{to}', from + data._rows.length - 1).replace('{total}', data.total));
			}

			// update the sorting controls
			if (data.sort_direction) {
				$(">thead>tr.header", placeholder).addClass(data.sort_direction);
			} else {
				$(">thead>tr.header", placeholder).removeClass("asc desc");
			}
			$(">thead>tr.header>td", placeholder).removeClass("sorted");
			if (data.sort_field) {
				$(">thead>tr.header>td", placeholder).filter(function () { return ($(this).data("id") == data.sort_field); }).addClass("sorted");
			}

			// initialize the row dragging
			if (this._drag_handle) {
				$(">tbody", placeholder).sortable({
					axis: "y",
					handle: "." + this._drag_handle,
				    helper: function(e, ui) {
				    	ui.children().each(function() {
				    		$(this).width($(this).width());
				    	});
				    	return ui;
					},
					start: function (event, ui) {
						ui.placeholder.html(ui.helper.html());
					},
					forcePlaceholderSize:true,
					update: $.proxy(function (e, ui) {
						var row = $(ui.item);
						var id = row.data("id");
						var prev_row = row.prev();
						var next_row = row.next();
						if (prev_row.length) {
							this.onRowDragEnd(id, 'after', prev_row.data("id"));
						} else if (next_row.length) {
							this.onRowDragEnd(id, 'before', next_row.data('id'));
						}
					}, this)
				});
			}
		}

		// update parameters
		if (this.parameters && data && data.parameters) {
			for (i in this.parameters) {
				var p = this.parameters[i];
				if (p.type == AVO.Field.TYPE_BOOL) {
					p.value = data.parameters[i] ? 1 : 0;
				} else {
					p.value = (data.parameters[i] === null) ? "" : data.parameters[i];
				}
			}
		}

		// display message if applicable
		if (data.message) this.displayMessage(data.status, data.message);
	},


	onRowDragEnd: function(id, postion, ref_id) {
		this.update("move", {
			__avo_src_id: id,
			__avo_postion: postion,
			__avo_ref_id: ref_id
		});
	},


	/**
	 * returns a grid toolbar
	 *
	 */
	getToolbar: function () {
		return $("tr.toolbar", this.placeholder());
	},


	/**
	 * shows the grid toolbar
	 *
	 */
	showToolbar: function (speed) {
		this.getToolbar().show();
	},


	/**
	 * hides the grid toolbar
	 *
	 */
	hideToolbar: function () {
		this.getToolbar().hide();
	},


	update: function (action, options, callback) {
		var opts;

		if (this._is_rendered) {
			if ($.isArray(options)) {
				opts = options;
			} else {
				opts = [];
				for (var name in options) {
					opts.push({name: name, value: options[name]});
				}
			}
			// make the request and fill the grid with data
			var head_row = $(">thead>tr.header", this.placeholder());
			var data = {
				__avo_page: $("input", this.pager).val(),
				__avo_rp: $("select", this.pager).val(),
				__avo_sortname: $(">td.sorted", head_row).data("id"),
				__avo_sortorder: head_row.hasClass("asc") ? "asc" : (head_row.hasClass("desc") ? "desc" : "")
			};
			$.extend(data, this.getParamHash());
			for (var o in options) {
				data[o] = options[o];
			}
			var url = this.controller_url;
			if (!action) action = "get_data";
			url += (url.match(/\?/) ? "&" : "?") + '__avo_ajax_action=' + action;
			$.post(url, data, $.proxy(function (data) {
				if (data.perform_action == "doc_reload") {
					window.location.reload();
					return;
				}
				callback && callback(data);
				this.setData(data);
				this.afterUpdate && this.afterUpdate(data);
			}, this), "json").error($.proxy(function (data) {
				this.displayMessage(1, "<strong>Unhandled system error</strong>" + AVO.HTML.encode(data.responseText));
			}, this));
			this.show();
			// reset the selector
			$(">td.selector input", head_row).removeAttr("checked");
		} else {
			// not rendered yet. Postpone the update
			$($.proxy(function () {
				this.update(action, options, callback);
			}, this));
		}
	}
};


/**********************************************************
 *
 * AVO.MessageBox
 *
 **********************************************************/
AVO.MessageBox = {

	error_box: undefined,
	info_box: undefined,

	error_box_is_hiding: false,
	info_box_is_hiding: false,

	info_hide_timeout: undefined,
	error_hide_timeout: undefined,

	hide_timeout: 5000,

	error: function (data) {
		if (!this.error_box) {
			this.error_box = $("<div class='info_box error ui-corner-bottom message_box ui-state-error'><div></div><a class='ui-icon ui-icon-circle-close' href='#'></a></div>").appendTo($("body"));
			$("a", this.error_box).click($.proxy(this.hideError, this));
		}
		this.hide();
		$(">div", this.error_box).html(data);
		this.error_box.slideDown("fast", $.proxy(function () {
			this.error_hide_timeout = setTimeout($.proxy(this.jamError, this), this.hide_timeout);
		}, this));
	},


	info: function (data) {
		clearTimeout(this.info_hide_timeout);
		if (!this.info_box) {
			this.info_box = $("<div class='info_box info ui-corner-bottom message_box ui-state-highlight'><div></div></div>").appendTo($("body"));
			this.info_box.hover($.proxy(this.hideInfo, this));
		}
		this.hide();
		$(">div", this.info_box).html(data);
		this.info_box.slideDown("fast", $.proxy(function () {
			this.info_hide_timeout = setTimeout($.proxy(this.hideInfo, this), this.hide_timeout);
		}, this));
	},


	hide: function () {
		this.hideInfo();
		this.hideError();
	},


	hideInfo: function (e) {
		e && (typeof(e) == 'object') && e.preventDefault();
		clearTimeout(this.info_hide_timeout);
		if (!this.info_box) return;
		if (this.info_box_is_hiding) return;
		this.info_box_is_hiding = true;
		this.info_box.slideUp("fast", $.proxy(function () {
			this.info_box_is_hiding = false;
		}, this));
	},


	hideError: function (e) {
		e && (typeof(e) == 'object') && e.preventDefault();
		clearTimeout(this.error_hide_timeout);
		if (!this.error_box) return;
		if (this.error_box_is_hiding) return;
		this.error_box_is_hiding = true;
		this.unjamError();
		this.error_box.slideUp("fast", $.proxy(function () {
			this.error_box.css("top", 0);
			this.error_box_is_hiding = false;
		}, this));
	},


	jamError: function () {
		if (this.error_box_is_hiding) return;
		this.error_box.animate({top: (- this.error_box.height() - 6) + "px"}, "fast");
		this.error_box.bind("mouseenter", $.proxy(this.unjamError, this));
	},


	unjamError: function () {
		this.error_box.unbind("mouseenter");
		if (!this.error_box_is_hiding) {
			this.error_box.animate({top: 0}, "fast");
			this.error_hide_timeout = setTimeout($.proxy(this.jamError, this), this.hide_timeout);
		}
	}
};


/**********************************************************
 *
 * AVO.Media_Browser
 *
 **********************************************************/
AVO.Media_Browser = function (properties) {
	var i, form_name;

	$.extend(this, properties || {});
	// find key field
	for (i = 0; i < this.fields.length; i++) {
		if (this.fields[i].key) {
			this._key_field_no = i;
		}
		if (this.fields[i].dragable) {
			this._drag_handle = this.fields[i].html_class;
		}
		this.fields[i].parent(this);
	}
	if (this.forms != null) {
		for (form_name in this.forms) {
			this.forms[form_name].parent(this);
		}
	}
	if (this.custom_buttons != null) {
		for (i = 0; i < this.custom_buttons.length; i++) {
			this.custom_buttons[i].parent(this);
		}
	}
};
$.extend(AVO.Media_Browser.prototype, {
	custom_buttons: null,
	name: null,
	width: 300,
	height: 300,
	html_class: null,
	fields: null,
	controller_url: null,
	parameters: null,
	forms: null,
	allow_update: true,
	allow_delete: true,
	allowed_extensions: ["png", "jpg", "jpeg", "gif"],
	msg_confirm_delete: "Are you sure you want to delete?",
	msg_delete: "delete",
	msg_download: "download",
	msg_invalid_file_type: "invalid file type",
	msg_zoom_in: "zoom in",
	onDelete: null,
	onUploadComplete: null,
	thumb_field_name: "thumb",
	full_field_name: "full",
	resource_field_name: "resource",

	_after_render: null,
	_controls_hash: null,
	_drag_handle: null,
	_key_field_no: 0,
	_toolbar_lock: false,
	_parent: null,
	// rendering locks
	_is_rendered: false,
	_is_render_in_progress: false,


	/**
	 * setter/getter for parent
	 *
	 */
	parent: function (parent) {
		if (parent !== undfined) this._parent = parent;
		return this._parent;
	},


	/**
	 * returns a main placeholder for the grid
	 *
	 */
	placeholder: function () {
		return $("#" + this.name);
	},


	/**
	 * returns a specified control
	 *
	 */
	control: function (name) {
		// init the control hash
		if (!this._controls_hash) {
			this._controls_hash = {};
			for (var i = 0; i < this.fields.length; i++) {
				this._controls_hash[this.fields[i].name] = this.fields[i];
			}
		}
		return this._controls_hash[name];
	},


	/**
	 * hides the grid
	 *
	 */
	hide: function (hide_parent) {
		if (this.parent()) {
			if (hide_parent === undefined || hide_parent) {
				// the browsers is a widget on a form. Hide the form instead
				this.parent().hide();
			}
		} else {
			// just hide it if we have no parent
			this.placeholder().hide();
		}
		this.hideDescendants();
	},


	show: function () {
		this.hideDescendants();
		if (this._parent == null) {
			this.placeholder().show();
		} else {
			// the browser is a widget on a form. Show the form instead
			this._parent.show();
		}
	},


	hideDescendants: function () {
		if (this.forms !== null) {
			for (var name in this.forms) {
				this.forms[name].hide();
			}
		}
	},


	getParamHash: function () {
		if (this.parameters == null) return {};

		var result = {};
		for (var i = 0; i < this.parameters.length; i++) {
			var param = this.parameters[i];
			result[param.name] = (param.value === null) ? "" : param.value;
		}
		return result;
	},


	onFormEscalateControl: function (sender, status, message, action_name) {
		sender.hide();
		this.show();
		if (message != "") this.displayMessage(status, message);
		if (action_name != undefined && action_name != "") {
			this.update(action_name, true);
		}
	},


	displayMessage: function (status, message) {
		this._parent && this._parent.parent().displayMessage(status, message);
	},


	render: function (data) {
		// check locks
		if (this._is_rendered || this._is_render_in_progress) return;
		this._is_render_in_progress = true;

		// define a placeholder
		var placeholder;
		if (this._parent) {
			placeholder = $("<div id='" + this.name + "' style='display:none'></div>");
			this._parent.placeholder().append(placeholder);
		} else {
			document.write("<div id='" + this.name + "' style='display:none'></div>");
			placeholder = undefined;
		}

		$($.proxy(function () {
			// render the data
			this.renderObject(data, placeholder);

			// run the after-render stuff
			if (this._after_render) {
				for (var i = 0; i < this._after_render.length; i++) {
					this._after_render[i]();
				}
			}

			// remove locks
			this._is_rendered = true;
			this._is_render_in_progress = false;
			if (data !== null) {
				if (data === undefined) {
					this.update("get_data");
				} else {
					this.populate(data.records);
				}
			}
		}, this));
	},


	renderObject: function (data, placeholder) {
		var t = this;
		$(function() {
			if (!placeholder) {
				placeholder = t.placeholder();
			}
			placeholder.addClass("media_browser").css("width", t.width).css("height", t.height).show();
			if (t.html_class !== null) {
				placeholder.addClass(t.html_class);
			}
			placeholder.sortable({
				placeholder: "sorthelper",
				delay: 50,
				opacity: 0.5,
				update: function(event, ui) {
					var what_id = ui.item.data("id");
					var prev_id = ui.item.prev().data("id");
					if (prev_id === undefined) {
						var next_id = ui.item.next().data("id");
						if (next_id !== undefined) {
							t.update("move", {
								__avo_src_id: what_id,
								__avo_postion: "before",
								__avo_ref_id: next_id
							});
						}
					} else {
						t.update("move", {
							__avo_src_id: what_id,
							__avo_postion: "after",
							__avo_ref_id: prev_id
						});
					}
				}
			});
			placeholder.disableSelection();
		});
	},


	populate: function (records) {
		var key_field_name = this.fields[this._key_field_no].name;
		for (var i = 0; i < records.length; i++) {
			var record = records[i];
			this.addItem({
				id: record[key_field_name],
				thumb: record[this.thumb_field_name],
				full: record[this.full_field_name],
				resource: record[this.resource_field_name],
				record:record
			});
		}
	},


	addItem: function (data) {
		var id = data.id;
		var t = this;
		var item = $("<div class='item'>");
		item.data("id", id).append(
			$("<img class='thumb'>").attr("src", data.thumb)
		).mouseenter(function () {
			if (t._toolbar_lock) return;
			$("div.controls", t.placeholder).trigger("mouseleave");
			var controls = $("<div class='controls'>");
			$(this).append(controls);
			if (t.allow_delete) {
				controls.append($("<a>", {href: "#", "class": "ico16-cancel", title: t.msg_delete}).click(function() {
					var go_on = true;
					if (t.onDelete) {
						go_on = t.onDelete(item, data);
					}
					if (go_on && confirm(t.msg_confirm_delete)) {
						var options = {};
						options[t.fields[t._key_field_no].name] = id;
						t.update("delete", options);
						item.remove();
					}
				}));
			}
			if (data.resource != null) {
				controls.append(
					$("<a>", {"class": "ico16-disk", "title": t.msg_download, "href": data.resource})
				);
			}
			if (data.full != null) {
				controls.append(
					$("<a>", {"class": "ico16-zoom_in", "title": t.msg_zoom_in, "href": data.full}).click(function() {
						return hs.expand(this);
					})
				);
			}
			if (t.custom_buttons !== null) {
				for (var i = t.custom_buttons.length - 1; i >= 0 ; i--) {
					var button = t.custom_buttons[i];
					var control = button.render(data);
					if (control !== null) {
						controls.append(control);
					}
				}
			}
		}).mouseleave(function () {
			if (t._toolbar_lock) return;
			if (t.custom_buttons !== null) {
				for (var i = 0; i < t.custom_buttons.length; i++) {
					t.custom_buttons[i].unrender();
				}
			}
			$("div.controls", this).remove();
		});
		this.placeholder().append(item);
	},


	update: function (action, options, callback) {
		var url = this.controller_url;
		if (action != undefined) {
			url += (url.match(/\?/) ? "&" : "?") + "__avo_ajax_action=" + action;
		}
		var request_options = this.getParamHash();
		$.extend(request_options, options || {});
		var t = this;
		$.ajax({
			type: "POST",
			dataType: "json",
			url: url,
			data: request_options,
			success: function(data) {
				t.onUpdateSuccess(data);
				if (callback) callback(data);
			},
			error: function (data) { }
		});

	},

	onUpdateSuccess: function (response) {
		if (response.perform_action == "doc_reload") {
			window.location.reload();
			return;
		}
		// update parameters
		if (this.parameters !== null && response.parameters !== undefined) {
			for (var i = 0; i < this.parameters.length; i++) {
				this.parameters[i].value = (response.parameters[i] === null) ? "" : response.parameters[i];
			}
		}
		if (response.records) {
			this.placeholder().empty();
			this.populate(response.records);
		}
	}
});






/**********************************************************
 *
 * AVO.Tree
 *
 **********************************************************/
AVO.Tree = function (options) {
	this.options = options;
	this.init();
};
$.extend(AVO.Tree.prototype, {

	init: function (container) {
		this.container = $("<div class='avo_tree well'>").appendTo(this.options.container);
		this.is_sorting_initialized = false;

		var tree = this.renderLevel(this.options.structure, false, true).appendTo(this.container);

		if (this.options.main_title) {
			var header = $("<li class='nav-header'>").text(this.options.main_title).prependTo(tree);
			if (this.options.allow_create_in_root) header.append($("<i class='icon-plus-sign'>"));
		}

		tree.click($.proxy(this.onClick, this));
	},


	getItem: function (id) {
		if (id !== undefined && id !== null && id !== "") {
			return $("li:data(id=" + id + ")", this.container);
		} else {
			return this.container;
		}
	},


	setItemTitle: function (id, title) {
		this.getItem(id).find(">a >span").text(title);
	},


	appendItem: function (parent_id, node_data) {
		var parent = this.getItem(parent_id);
		if (!parent.size()) return false;

		var sublist = (parent == this.container) ? parent : parent.next();
		if (sublist.hasClass("well")) {
			// append to the list of existing children
			var group = $(">ul", sublist)
				.append(this.renderRow(node_data, sublist.hasClass("even")));
			if (this.options.reorder_handler_url) {
				group.find(">li").removeClass("no_drag").end();
				if (group.find(">li:not(.well)").size() == 2) { // we've just added a 2nd item.
					// init the sorting
					this.initSorting(group);
				}
			}
		} else {
			// create new sub-tree of children
			var is_even_level = parent.parent().parent().hasClass("even");
			var subgroup = this.renderLevel([node_data], !is_even_level);
			sublist = $("<li class='well'>").append(subgroup).data("parent-id", parent_id);
			if (!is_even_level) sublist.addClass("even");
			sublist.insertAfter(parent);
		}
		return true;
	},


	deleteItem: function (id) {
		var item = this.getItem(id);
		if (!item.size()) return false;

		var parent = item.parent(); // ul.nav

		// remove children
		item.next(".well").remove();

		// remove the item
		item.remove();
		var siblings = parent.find(">li");
		if (!siblings.size()) {
			// no siblings? remove the parent container
			parent.parent().remove();
		} else if (siblings.size() == 1) {
			// one sibling left? disable the ordering
			siblings.addClass("no_drag");
			this.removeSorting(parent);
		}

		// find the last active element
		var a = $(".active:last >a", this.container);
		if (!a.length) {
			a = $("li>a:eq(0)", this.container);
		}
		if (a.length) {
			a.click();
		}

		return true;
	},


	setCurrentItem: function (id) {
		this.getItem(id).find(">a").click();
	},


	onClick: function (event) {
		var target = $(event.target);

		switch (target.prop("tagName")) {
			case "I": // iconed controls
				event.preventDefault();
				event.stopPropagation();
				this.options.onAdd(target.closest("li").data("id"));
				break;

			case "SPAN": // text on links
				target = target.parent();
				if (target.prop("tagName") != "A") break;
			case "A": // links
				event.preventDefault();
				event.stopPropagation();
				this.container.find("li").removeClass("active current");
				target.parent().addClass("current active");
				var el = target;
				do {
					el = el.closest("li");
					if (el.hasClass("well")) {
						el.prev().addClass("active");
					}
					el = el.parent();
				} while (!el.parent().is(this.container));
				this.options.onChange(target.parent().data("id"));
				break;

			default:
				// ignore
				break;
		}
	},


	renderRow: function (leaf, is_even_level) {
		var row = $("<li>").data("id", leaf.id);
		var link = $("<a href='#'>").appendTo(row);
		link
			.append($("<i class='icon-resize-vertical'>"))
			.append($("<span>").text(leaf.title))
			;
		// if the item can have children append an "add" control
		if (leaf.can_have_children) {
			link.append($("<i class='icon-plus-sign'>"));
		}
		var subgroup = this.renderLevel(leaf.children, !is_even_level);
		if (subgroup.size()) {
			var sublist = $("<li class='well'>").append(subgroup).data("parent-id", leaf.id);
			if (!is_even_level) sublist.addClass("even");
			row = row.add(sublist);
		}

		return row;
	},


	renderLevel: function (structure, is_even_level, render_if_empty) {
		var i = 0;
		var items = 0;
		var group = $("<ul class='nav nav-list'>");
		for (i in structure) {
			items++;
			group.append(this.renderRow(structure[i], is_even_level));
		}
		// if there are no items to reorder or reordering is disabled - remove the drag handle
		if (items < 2 || !this.options.reorder_handler_url) {
			$(">li", group).addClass("no_drag");
			if (!items && !render_if_empty) group = $();
		} else {
			this.initSorting(group);
		}
		return group;
	},


	removeSorting: function (container) {
		if (this.is_sorting_initialized) {
			$(container).sortable("destroy");
			this.is_sorting_initialized = false;
		}
	},


	initSorting: function (container) {
		// tree reordering
		this.is_sorting_initialized = true;
		container.sortable({
			items: ">li:not(.nav-header)",
			axis: "y",
			handle: ".icon-resize-vertical",
		    helper: function (e, ui) {
		    	ui.children().each(function () {
		    		$(this).width($(this).width());
		    	});
		    	return ui;
			},
			start: function (event, ui) {
				// hide subtree
				$(this).addClass("reordering");
				ui.placeholder.html(ui.helper.html());
			},
			stop: function (event, ui) {
				// show subtree
				$(this).removeClass("reordering");
				// reorder the subtree
				$(">li:data(id)", container).each(function () {
					$(">li:data(parent-id=" + $(this).data("id") + ")", container).insertAfter(this);
				});
			},
			forcePlaceholderSize: true,
			update: $.proxy(function (e, ui) {
				var row = $(ui.item);
				var id = row.data("id");
				var prev_row = row.prev(":not(.well,.nav-header)");
				if (!prev_row.size()) prev_row = row.prev().prev(":not(.well,.nav-header)");
				var next_row = row.next(":not(.well)");
				if (!next_row.size()) next_row = row.next().next(":not(.well)");
				var rel = "", ref = "";
				if (next_row.size()) {
					rel = "before";
					ref = next_row.data("id");
				} else if (prev_row.size()) {
					rel = "after";
					ref = prev_row.data("id");
				}
				if (rel) {
					$.post(
						this.options.reorder_handler_url,
						{
							id: id,
							rel: rel,
							ref: ref
						}
					);
				}
			}, this)
		});
	}

});
