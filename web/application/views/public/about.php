<?= View::factory('public/_common_links') ?>
<a href="#" id="to_top"><?= file_get_contents('img/to-top.svg') ?></a>
<main id="about">
	<div class="heading">
		<div class="additional-grid">
<?php
	for ($i = 1; $i <= 12; $i++) {
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
		<?= HTML::anchor('#', HTML::image('img/arrow-down.svg', ['alt' => 'arrow down']), ['class' => 'arrow-down']) ?>
	</div><!-- .heading -->
	<div id="blocks">
<?php
	$image_index = 0;
	foreach ($blocks as $b) {
		if ($b->type == $b::TYPE_IMAGE || $b->type == $b::TYPE_IMAGE_AND_TEXT) {
			$image_url		= URL::site($b->url($b::NORMAL_NAME));
			$video_class	= $b->video_url ? ' video' : '';
			$open_tag		= "<a
				id='block_$b->id'
				href='#'
				class='gallery-trigger about-block$video_class'
				data-id='$b->id'
				data-index='$image_index'
				style='background-image: url($image_url)'
			>";
			if ($b->video_url) {
				$open_tag .=
				'<video autoplay loop muted>
					<source src="'.$b->video_url.'" type="video/mp4"></source>
				</video>';
			}
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
		for ($i = 1; $i <= 6; $i++) {
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
	<div id="competence"><?php
		?><div class="additional-grid">
<?php
	for ($i = 1; $i <= 12; $i++) {
?>
			<div></div>
<?php
	}
?>
		</div><?php
		?><div class="left-column">
			<h3>Kompetanse</h3>
			<div class="text"><?= $competence_text ?></div>
<?php
	if ($general_file->pdf_uid) {
?>
			<a<?= HTML::attributes([
				'href' 		=> $general_file->download_url(),
				'class' 	=> 'download-all-pdf',
				'target'	=> '_blank'
				]) ?>><?= file_get_contents(DOCROOT.'img/pdf.svg') ?><span>Last ned alle<br>kompetansebevis</span></a>
<?php
	}
?>
		</div><?php
		?><div class="right-column">
			<ul>
<?php
	foreach ($categories as $i => $c) {
?>
				<li<?= HTML::attributes([
					'class'			=> $c->animation_property == $c::ANIMATE_STROKE ? 'category-gallery-trigger animate-stroke' : 'category-gallery-trigger animate-fill',
					'data-index'	=> $i,
				]) ?>>
					<?= file_get_contents($c->file_storage()) ?>
					<h2><?= HTML::chars($c->heading) ?></h2>
				</li>
<?php
	}
?>
			</ul>
		</div><?php
	?></div><!-- #competence -->
	<div id="cp"><?php
		?><h3>Hvordan</h3><?php
		?><div class="additional-grid">
<?php
	for ($i = 1; $i <= 12; $i++) {
?>
			<div></div>
<?php
	}
?>
		</div><?php
	$reversed_cp_items = array_reverse($cp_items);
	list($cp_column2, $cp_column1) = array_chunk($reversed_cp_items, ceil(count($cp_items) / 2));
	$cp_column1 = array_reverse($cp_column1);
	$cp_column2 = array_reverse($cp_column2);
		?><div class="column1 column">
<?php
	foreach ($cp_column1 as $item) {
?>
			<div<?= HTML::attributes(['id' => "cp_$item->id", 'class' => 'item']) ?>>
				<div class="num scroll-parallax"><?= $item->num ?></div>
				<h2 class="scroll-parallax"><?= $item->heading ?></h2>
				<div class="text scroll-parallax" data-parallax-range="50">
					<div class="table">
						<div class="table-cell"><?= $item->short_text ?></div>
					</div>
				</div>
			</div>
<?php
	}
?>
		</div><?php
		?><div class="column2 column">
<?php
	foreach ($cp_column2 as $item) {
?>
			<div<?= HTML::attributes(['id' => "cp_$item->id", 'class' => 'item']) ?>>
				<div class="num scroll-parallax"><?= $item->num ?></div>
				<h2 class="scroll-parallax"><?= $item->heading ?></h2>
				<div class="text scroll-parallax" data-parallax-range="50">
					<div class="table">
						<div class="table-cell"><?= $item->short_text ?></div>
					</div>
				</div>
			</div>
<?php
	}
?>
		</div><?php
	?></div><!-- #cp -->
	<div id="employees"><?php
	foreach ($employees as $i => $e) {
		switch ($i % 5) {
			case 0:
				$parallax_range = 30;
				break;
			case 1:
				$parallax_range = 20;
				break;
			case 2:
				$parallax_range = 10;
				break;
			case 3:
				$parallax_range = 40;
				break;
			case 4:
				$parallax_range = 50;
				break;
		}
		?><div<?= HTML::attributes(['id' => "employee_$e->id", 'class' => 'scroll-parallax', 'data-parallax-range' => $parallax_range]) ?>><?php
			?><div class="text">
				<h2><?= str_replace(' ', '<br>', HTML::chars($e->name)) ?></h2>
				<div class="info"><?= $e->info ?></div>
			</div><?=
			HTML::image($e->url($e::NORMAL_NAME), ['alt' => $e->title])
		?></div><?php
	}
	?></div><!-- #employees -->
	<div id="bottom_block"><?php
		?><div class="left-column">
			<h3><?= nl2br(HTML::chars($bottom_heading)) ?></h3>
			<div class="text"><?= $bottom_text ?></div>
		</div><?php
	?></div><!-- #bottom_block -->
</main>
<?= View::factory('public/_footer') ?>
