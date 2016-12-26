<?= View::factory('mobile/_common_links') ?>
<a href="#" id="to_top"><?= file_get_contents('img/to-top.svg') ?></a>
<main id="about">
	<div class="heading">
		<div class="additional-grid">
<?php
	for ($i = 1; $i <= 10; $i++) {
?>
			<div></div>
<?php
	}
?>
		</div>
		<div class="cover">
			<div class="table">
				<div class="table-cell">
					<h1><?= nl2br(HTML::chars($main_quote)); ?></h1>
				</div>
			</div>
		</div>
	</div><!-- .heading -->
	<div id="blocks">
<?php
	$image_index = 0;
	foreach ($blocks as $b) {
		if ($b->type == $b::TYPE_IMAGE || $b->type == $b::TYPE_IMAGE_AND_TEXT) {
			$image_url	= URL::site($b->url($b::NORMAL_NAME));
			$image_text_class = $b->type == $b::TYPE_IMAGE_AND_TEXT ? 'image-text' : '';
			$open_tag	= "<a
				id='block_$b->id'
				href='#'
				class='gallery-trigger about-block $image_text_class'
				data-id='$b->id'
				data-index='$image_index'
				style='background-image: url($image_url)'
			>";
			$close_tag	= '</a>';
			$image_index++;
		} else {
			$open_tag	= "<div id='block_$b->id' class='about-block'>";
			$close_tag	= '</div>';
		}
		echo $open_tag;
		if ($b->type == $b::TYPE_TEXT || $b->type == $b::TYPE_IMAGE_AND_TEXT) {
?>
		<div<?= HTML::attributes(['class' => $b->type == $b::TYPE_TEXT ? 'cover' : 'cover visible-on-hover']) ?>>
			<div class="additional-grid">
<?php
		for ($i = 1; $i <= 10; $i++) {
?>
				<div></div>
<?php
		}
?>
			</div>
			<div class=table>
				<div class=table-cell>
					<h2><?= nl2br(HTML::chars($b->heading)) ?></h2>
					<div class="text"><?= nl2br(HTML::chars($b->body_text)) ?></div>
				</div>
			</div>
		</div>
<?php
		}
		echo $close_tag;
	}
?>
	</div><!-- #blocks -->
	<div id="competence">
		<h3>Kompetanse</h3>
		<div class="text"><?= $competence_text ?></div>
<?php
	if ($general_file->pdf_uid) {
?>
		<a<?= HTML::attributes([
			'href' 		=> $general_file->download_url(),
			'class' 	=> 'download-all-pdf hoverable',
			'target'	=> '_blank'
			]) ?>><?= file_get_contents(DOCROOT.'img/pdf.svg') ?><span>Last ned alle<br>kompetansebevis</span></a>
<?php
	}
?>
		<ul>
<?php
	foreach ($categories as $i => $c) {
?>
			<li<?= HTML::attributes([
				'class'			=> $c->animation_property == $c::ANIMATE_STROKE ? 'category-gallery-trigger hoverable animate-stroke' : 'category-gallery-trigger hoverable animate-fill',
				'data-index' 	=> $i
			]) ?>>
				<?= file_get_contents($c->file_storage()) ?>
				<h2><?= HTML::chars($c->heading) ?></h2>
			</li>
<?php
	}
?>
		</ul>
	</div><!-- #competence -->
	<div id="cp"><?php
		?><h3>Hvordan</h3><?php
		?><div class="additional-grid">
<?php
	for ($i = 1; $i <= 10; $i++) {
?>
			<div></div>
<?php
	}
?>
		</div>
<?php
	foreach ($cp_items as $item) {
?>
		<div<?= HTML::attributes(['id' => "cp_$item->id", 'class' => 'item']) ?>>
			<div class="num"><?= $item->num ?></div>
			<h2><?= $item->heading ?></h2>
			<div class="text">
				<div class="table">
					<div class="table-cell"><?= $item->short_text ?></div>
				</div>
			</div>
		</div>
<?php
	}
?>

	?></div><!-- #cp -->
	<div id="employees">
		<h3>Ansatte</h3>
<?php
	foreach ($employees as $i => $e) {
		if ($i % 2) {
?>
		<div<?= HTML::attributes(['id' => "employee_$e->id"]) ?>><?=
			HTML::image($e->url($e::NORMAL_NAME), ['alt' => $e->title])
			?><div class="text">
				<h2><?= str_replace(' ', '<br>', HTML::chars($e->name)) ?></h2>
				<div class="info"><?= $e->info ?></div>
			</div><?php
		?></div>
<?php
		} else {
?>
		<div<?= HTML::attributes(['id' => "employee_$e->id"]) ?>><?php
			?><div class="text">
				<h2><?= str_replace(' ', '<br>', HTML::chars($e->name)) ?></h2>
				<div class="info"><?= $e->info ?></div>
			</div><?=
			HTML::image($e->url($e::NORMAL_NAME), ['alt' => $e->title])
		?></div>
<?php
		}
	}
?>
	</div><!-- #employees -->
	<div id="bottom_block">
		<h3><?= nl2br(HTML::chars($bottom_heading)) ?></h3>
		<div class="text"><?= $bottom_text ?></div>
	</div><!-- #bottom_block -->
</main>
<?= View::factory('mobile/_footer') ?>
