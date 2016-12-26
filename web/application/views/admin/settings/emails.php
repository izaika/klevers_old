<?php defined('SYSPATH') OR die('No direct script access.') ?>
<h2><?php echo HTML::__('Email templates') ?></h2>

<table id="emails_layout">
	<tr>
		<td class="tree">
			<div id="tree_emails"></div>
		</td>
		<td class="content">
			<div id="form_container">
				<?php echo $form->render_object('direct') ?>
			</div>
		</td>
	</tr>
</table>
<script type="text/javascript">
$(function() {
	$("#tree_emails").jstree({
		plugins: ["themes", "json_data", "ui", "types"],

		themes: {
			theme: "apple",
			dots: true,
			icons: false
		},

		json_data: {
			data: <?php echo json_encode($tree_data) ?>
		},

		types: {
			types: {
				root: {
					select_node: false
				}
			}
		}
	}).bind("loaded.jstree", function (event, data) {
		// open the first item
		$('>ul>li:first>ul>li:first>a', this).click();
	}).bind("select_node.jstree", function (event, data) {
		var tree = $.jstree._reference(this);
		tree.lock();
		AVO.Backend_Settings_Message_Template_Form.update('get_data', {'id': data.rslt.obj.data("id")}, function() {
			$('#form_container').show();
			tree.unlock();
		});
	});
});
</script>