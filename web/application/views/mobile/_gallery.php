<div id="gallery">
	<div class="additional-grid">
<?php
	for ($i = 1; $i <= 12; $i++) {
?>
		<div></div>
<?php
	}
?>
	</div>
	<div class="swiper-container">
		<div class="swiper-wrapper">
<?php
	foreach ($images as $i) {
		$is_video = $i['type'] == 'video';
?>
			<div<?= HTML::attributes(['class' => $is_video ? 'swiper-slide video-slide' : 'swiper-slide', 'style' => 'background-image: url('.URL::site($i['src']).')']) ?>>
<?php
	if ($is_video) {
?>
			<video loop muted>
				<source<?= HTML::attributes(['src' => $i['video_url'], 'type' => 'video/mp4']) ?>></source>
			</video>
<?php
	}
?>
			</div>
<?php
	}
?>
		</div>
	</div>
	<div class="arrow-prev arrow"><?= HTML::image('img/arrow-prev.svg', ['alt' => 'prev']) ?></div>
	<div class="arrow-next arrow"><?= HTML::image('img/arrow-next.svg', ['alt' => 'next']) ?></div>
	<hr>
	<?= HTML::image('img/close.svg', ['alt' => 'close', 'id' => 'close_gallery']) ?> 
</div>