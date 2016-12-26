<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<style>
			@page {
				margin: 0;
				padding: 0;
			}
			html {
				margin: 36px 36px 80px;
				padding: 0;
			}
			body {
				margin: 0;
				padding: 0;
				color: #000;
				font-family: replica;
			}
			.credits {
				color: gray;
			}
			#main_image {
				width: 100%;
				height: auto;
				display: block;
			}
			#article {
				width: 704px;
				font-size: 8pt;
				line-height: 1.2;
				margin-top: 1em;
			}
			#article p {
				margin: 0;
				margin-top: 1em;
			}
			.column {
				display: inline-block;
				vertical-align: top;
			}
			.column-1 {
				margin-right: 23px;
				width: 329px;
			}
			.column-2 {
				margin-left: 22px;
				width: 329px;
			}
			#image_container {
				position: relative;
			}
			#transparent_logo {
				display: block;
				position: absolute;
				top: 15px;
				left: -1px;
				width: 90px;
				height: 27px;
			}
			#footer {
				position: fixed;
				bottom: 0;
				left: 0;
				right: 0;
				font-size: 8pt;
				padding-top: 33px;
				color: #000;
				border-top: 1px solid #808080;
				line-height: 12px;
			}
			#footer > img {
				margin-left: 28px;
				line-height: 12px;
			}
			#footer > img:first-child {
				margin-left: 0;
				margin-right: 28px;
			}
			.phone, .pin {
				margin-right: 5px;
			}
			h1 {
				font-size: 30pt;
				font-weight: normal;
				margin: 0;
				margin-top: 20px;
			}
			h2 {
				font-size: 14;
				font-weight: lighter;
				margin: 0;
				/*margin-top: 5px;*/
			}
		</style>
	</head>
	<body>
		<div id="image_container">
			<img<?= HTML::attributes([
				'id'	=> 'transparent_logo',
				'src'	=> 'img/transparent-logo.png'
			]) ?>>
			<img<?= HTML::attributes([
				'id'	=> 'main_image',
				'src' 	=> $project->url4pdf()
			]) ?>>
		</div>
		<h1><?= HTML::chars($project->name) ?></h1>
<?php
	if ($project->address && $project->location) {
?>
		<h2><?= HTML::chars($project->address).' - '.HTML::chars($project->location) ?></h2>
<?php
	} elseif ($project->location) {
?>
		<h2><?= HTML::chars($project->location) ?></h2>
<?php
	} elseif ($project->address) {
?>
		<h2><?= HTML::chars($project->address) ?></h2>
<?php
	}
?>
		<div id="article"><?php
		$text_blocks = $project->blocks
			->where('type', '=', Model_Project_Block::TYPE_TEXT)
			->and_where('use_in_pdf', '=', 1)
			->cached()
			->find_all();
		$credits_blocks = $project->blocks
			->where('type', '=', Model_Project_Block::TYPE_CREDITS)
			->and_where('use_in_pdf', '=', 1)
			->cached()
			->find_all();
		$credits_text = '<div class="credits">';
		foreach ($credits_blocks as $b) {
			$credits_text .= $b->body_text;
		}
		$credits_text .= '</div>';

		foreach ($text_blocks as $i => $b) {
			$columns = explode('<p>*split*</p>', $b->body_text);
			?><div class="column column-1"><?= $columns[0] ?></div><?php
			?><div class="column column-2"><?= ($i + 1) == count($text_blocks) ? $columns[1].$credits_text : $columns[1] ?></div><?php
			?><br><?php
		}
		?></div>
		<div id="footer" class="page">
			<img<?= HTML::attributes([
				'src'	=> 'img/pdf-footer-logo.png',
				'width'	=> 42
			]) ?>>
			<span>&copy;<?= date('Y') ?> Nuno arkitektur AS</span>

			<img<?= HTML::attributes([
				'src'	=> 'img/pdf-footer-map-pin.png',
				'class'	=> 'pin',
				'width'	=> 8
			]) ?>>
			<span>Akersbakken 12, 0172 Oslo</span>

			<img<?= HTML::attributes([
				'src'	=> 'img/pdf-at.png',
				'class'	=> 'phone',
				'width'	=> 12
			]) ?>>
			<span><?= HTML::chars($email) ?></span>

			<img<?= HTML::attributes([
				'src'	=> 'img/pdf-phone.png',
				'class'	=> 'phone',
				'width'	=> 12
			]) ?>>
			<span><?= str_replace(' ', '&nbsp;', $phone) ?></span>
		</div>
	</body>
</html>
