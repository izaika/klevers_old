<?= View::factory('public/_common_links') ?>
<a href="#" id="to_top"><?= file_get_contents('img/to-top.svg') ?></a>
<main id="blog">
	<div class="scroller"><hr></div>
	<h1>Blogg</h1>
<?php
	foreach ($articles as $a) {
		$date_timestamp = strtotime($a->public_date);
?>
	<article<?= HTML::attributes(['id' => "article_$a->id", 'data-id' => $a->id]) ?>><?php
		?><div class="texts">
			<h2><?= nl2br(HTML::chars($a->heading)) ?></h2>
			<div class="body-text"><?= $a->body_text ?></div>
		</div><?php
		?><div class="images"><?php
		foreach ($a->images->cached()->find_all() as $index => $i) {
			$gallery_trigger_class = ' gallery-trigger';
			$emb_only = '';
			if ($i->use_video && !$i->video_url) {
				$gallery_trigger_class = '';
				$emb_only = ' emb-only';
			}
			?><div<?= HTML::attributes([
				'class'			=> $i->use_video ? 'image video'.$gallery_trigger_class.$emb_only : 'image gallery-trigger'.$gallery_trigger_class.$emb_only,
				'data-id'		=> $i->id,
				'data-emb-link'	=> $i->embedded_video_link,
				'data-index'	=> $index
			]) ?>><?php
			echo HTML::image($i->url($i::NORMAL_NAME), ['alt' => $i->title]);
			if ($i->use_video) {
				if ($i->video_url) {
?>
					<video autoplay loop muted>
						<source<?= HTML::attributes(['src' => $i->video_url, 'type' => 'video/mp4']) ?>></source>
					</video>
<?php
				} else {
					echo HTML::anchor('#', '', ['class' => 'play-button']);
				}
			}
			?></div><?php
		}
		?></div><?php
		?><time>
			<span class="day"><?= date('d', $date_timestamp) ?></span>
			<span class="month"><?= strftime('%b', $date_timestamp) ?></span>
		</time><?php
	?></article>
<?php
	}
?>
</main>
<?= View::factory('public/_footer') ?>
