<?= View::factory('mobile/_common_links') ?>
<main<?= HTML::attributes(['id' => 'project_article', 'data-id' => $project->id]) ?>>
	<div class="scroller"><hr></div>
	<article><?php
		?><h1><?= nl2br(HTML::chars($project->heading)) ?></h1><?php
	if ($project->use_video) {
		?><div class="main-image video" data-index="0" data-emb-link="<?= $project->embedded_video_link ?>"><?php
		echo HTML::image($project->url($project::NORMAL_NAME), ['alt' => $project->title]).'<a href="#" class="play-button"></a>';
		?></div><?php
	} else {
		?><div class="main-image gallery-trigger" data-index="0"><?php
		echo HTML::image($project->url($project::NORMAL_NAME), ['alt' => $project->title]);
		?></div><?php
	}
		?><h2><?= nl2br(HTML::chars($project->name.($project->location ? ', '.$project->location : ''))) ?></h2><?php
		?><div class="ingress"><?= nl2br(HTML::chars($project->ingress)) ?></div><?php
		$project_images_count	= 1;
		foreach ($blocks as $i => $b) {
			switch ($b['type']) {
				case Model_Project_Block::TYPE_CREDITS:
					$b_class 	= 'credits';
					$b_content	= $b['body_text'];
					$b_emb_link	= null;
					$b_index	= null;
					break;
				case Model_Project_Block::TYPE_QUOTE:
					$b_class 	= 'quote';
					$b_content	= $b['body_text'];
					$b_index	= null;
					$b_emb_link	= null;
					break;
				case Model_Project_Block::TYPE_IMAGE:
					$orm_b		= Model_Project_Block::factory(null, $b['id']);
					$b_class	= 'image gallery-trigger';
					$b_index	= $project_images_count;
					$b_emb_link	= null;
					$b_content	= HTML::image($orm_b->url($orm_b::WIDE_NAME), ['alt' => $orm_b->title]);
					$project_images_count++;
					break;
				case Model_Project_Block::TYPE_VIDEO:
					$orm_b		= Model_Project_Block::factory(null, $b['id']);
					$b_class	= 'image video';
					$b_emb_link	= $orm_b->embedded_video_link;
					$b_index	= null;
					$b_content	= HTML::image($orm_b->url($orm_b::WIDE_NAME), ['alt' => $orm_b->title]).'<a href="#" class="play-button"></a>';
					$project_images_count++;
					break;
				default: // $b::TYPE_TEXT
					$b_class = 'text';
					$b_emb_link	= null;
					$b_index	= null;
					$b_content	= str_replace('<p>*split*</p>', '', $b['body_text']);
					break;
			}
			?><div<?= HTML::attributes([
				'class' => $b_class.' block',
				'data-index' => isset($b_index) ? $b_index : null,
				'data-emb-link' => isset($b_emb_link) ? $b_emb_link : null
			]) ?>><?php
				echo $b_content;
				if ($b_class == 'image gallery-trigger') {
					echo HTML::anchor('#', HTML::image('img/plus.svg', ['alt' => 'plus']), ['class' => 'gallery-btn']);
				}
			?></div><?php
		}
	?></article>
	<a<?= HTML::attributes([
		'id' 		=> 'pdf_link',
		'href'		=> URL::site('project_pdf/'.$project->id),
		'target'	=> '_blank',
	]) ?>><?php include DOCROOT.'img/pdf.svg' ?><span>Last ned PDF</span></a><?php

	if ($next_project_url && $next_project_link_title) {
		echo HTML::anchor($next_project_url, $next_project_link_title, ['class' => 'next-project transition']);
	}
	if (count($related_projects) || (isset($additional_related_projects) && count($additional_related_projects))) {
?>
	<div class="related-projects"><?php
		?><div class="title">Lignende prosjekter</div><?php
	foreach ($related_projects as $i => $p) {
		?><a<?= HTML::attributes(['href' => URL::site($p->url), 'data-id' => $p->project_id, 'class' => 'transition touchlink']) ?>>
			<?= HTML::image($p->img_src, ['alt' => $p->img_title]); ?>
			<div class="cover">
				<div class="table">
					<div class="table-cell">
						<h2><?= HTML::chars($p->heading) ?></h2>
						<h3><?= HTML::chars($p->name) ?> ></h3>
					</div>
				</div>
			</div>
		</a><?php
	}
	if (isset($additional_related_projects) && count($additional_related_projects)) {
		foreach ($additional_related_projects as $i => $p) {
			?><a<?= HTML::attributes(['href' => URL::site($p->get_url()), 'data-id' => $p->id, 'class' => 'transition touchlink']) ?>>
			<?= HTML::image($p->url($p::RELATED_PREVIEW_NAME), ['alt' => $p->title]); ?>
			<div class="cover">
				<div class="table">
					<div class="table-cell">
						<h2><?= HTML::chars($p->heading) ?></h2>
						<h3><?= HTML::chars($p->name) ?> ></h3>
					</div>
				</div>
			</div>
		</a><?php
	}
	}
	?></div>
<?php
	}
?>
</main>
<?= View::factory('mobile/_footer') ?>
