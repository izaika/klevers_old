<?= View::factory('mobile/_common_links') ?>
<a href="#" id="to_top"><?= file_get_contents('img/to-top.svg') ?></a>
<main id="blog">
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
		?><div class="images">
<?php
		foreach ($a->images->cached()->find_all() as $index => $i) {
?>
			<div<?= HTML::attributes([
				'class' => $i->use_video ? 'image video' : 'image gallery-trigger',
				'data-emb-link'	=> $i->embedded_video_link,
				'data-index' => $index
			]) ?>>
<?php
			echo HTML::image($i->url($i::NORMAL_NAME), ['alt' => $i->title]);
?>
				<?= $i->use_video ? '<a href="#" class="play-button"></a>' : null ?>
			</div>
<?php
		}
?>
		</div>
<?php
		?><time>
			<span class="day"><?= date('d', $date_timestamp) ?></span>
			<span class="month"><?= strftime('%b', $date_timestamp) ?></span>
		</time><?php
	?></article>
<?php
	}
?>
</main>
<?= View::factory('mobile/_footer') ?>
