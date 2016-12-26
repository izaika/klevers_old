<?= View::factory('public/_common_links') ?>
<a<?= HTML::attributes([
	'id' 		=> 'pdf_link',
	'href'		=> URL::site('project_pdf/'.$project->id),
	'target'	=> '_blank',
]) ?>><?php include DOCROOT.'img/pdf.svg' ?></a>
<main<?= HTML::attributes(['id' => 'project_article', 'data-id' => $project->id]) ?>>
	<div class="scroller"><hr></div>
	<article><?php
		?><h1><?= nl2br(HTML::chars($project->heading)) ?></h1><?php
		?><div<?= HTML::attributes([
			'class' => $project->video_url ? 'main-image gallery-trigger video' : 'main-image gallery-trigger',
			'data-emb-link'	=> $project->video_url ? $project->embedded_video_link : null,
			'data-index' => 0
		]) ?>><?php
			echo HTML::image($project->url($project::NORMAL_NAME), ['alt' => $project->title]);
			if ($project->use_video) {
?>
			<video autoplay loop muted>
				<source<?= HTML::attributes(['src' => $project->video_url, 'type' => 'video/mp4']) ?>></source>
			</video>
<?php
			}
		?></div><?php
		?><h2><?= nl2br(HTML::chars($project->name.($project->location ? ', '.$project->location : ''))) ?></h2><?php
		?><div class="ingress"><?= nl2br(HTML::chars($project->ingress)) ?></div><?php
		$project_images_count	= 1;
		$is_column_opened		= false;
		foreach ($blocks as $i => $b) {
			if (!$is_column_opened) {
				?><div<?= HTML::attributes(['class' => $b['size'] == Model_Project_Block::SIZE_FULL_WIDTH ? 'column wide' : 'column narrow']) ?>><?php
				$is_column_opened = true;
				$column_images_count = 0;
			}
			switch ($b['type']) {
				case Model_Project_Block::TYPE_CREDITS:
					$b_class 	= 'credits';
					$b_content	= $b['body_text'];
					break;
				case Model_Project_Block::TYPE_QUOTE:
					$b_class 	= 'quote';
					$b_content	= $b['body_text'];
					break;
				case Model_Project_Block::TYPE_IMAGE:
					$orm_b = Model_Project_Block::factory(null, $b['id']);
					$b_class = !$column_images_count && $orm_b->size == $orm_b::SIZE_HALF_WIDTH ? 'image rounded-cornder' : 'image';
					$b_content	=
						$orm_b::SIZE_FULL_WIDTH
						?
						HTML::image($orm_b->url($orm_b::WIDE_NAME), ['alt' => $orm_b->title, 'class' => 'gallery-trigger', 'data-index' => $project_images_count])
						:
						HTML::image($orm_b->url($orm_b::NARROW_NAME), ['alt' => $orm_b->title, 'class' => 'gallery-trigger', 'data-index' => $project_images_count]);
					$column_images_count++;
					$project_images_count++;
					break;
				case Model_Project_Block::TYPE_VIDEO:
					$orm_b = Model_Project_Block::factory(null, $b['id']);
					$b_class = !$column_images_count && $orm_b->size == $orm_b::SIZE_HALF_WIDTH ? 'image video rounded-cornder gallery-trigger' : 'image video gallery-trigger';
					$b_index = $project_images_count;
					$b_emb_link = $orm_b->embedded_video_link;
					$b_content	=
						$orm_b::SIZE_FULL_WIDTH
						?
						HTML::image($orm_b->url($orm_b::WIDE_NAME), ['alt' => $orm_b->title, 'class' => 'block-image'])
						:
						HTML::image($orm_b->url($orm_b::NARROW_NAME), ['alt' => $orm_b->title, 'class' => 'block-image']);
					$b_content .=
						'<video autoplay loop muted>
							<source src="'.$orm_b->video_url.'" type="video/mp4"></source>
						</video>';
					$column_images_count++;
					$project_images_count++;
					break;
				default: // $b::TYPE_TEXT
					$b_class = 'text';
					$b_content	= str_replace('<p>*split*</p>', '', $b['body_text']);
					break;
			}
			?><div<?= HTML::attributes([
				'class'			=> $b_class,
				'data-index'	=> isset($b_index) ? $b_index : null,
				'data-emb-link'	=> isset($b_emb_link) ? $b_emb_link : null,
			]) ?>><?php
				echo $b_content;
				if (strpos($b_class, 'image') !== false) {
					echo HTML::anchor('#', HTML::image('img/plus.svg', ['alt' => 'plus']), ['class' => 'gallery-btn']);
				}
			?></div><?php
			if ($i + 1 === count($blocks) || $blocks[$i + 1]['size'] !== $b['size'] || $blocks[$i + 1]['side'] !== $b['side']) {
				?></div><?php
				$is_column_opened = false;
			}
		}
	?></article>
<?php
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
<?= View::factory('public/_footer') ?>
