<main id="index" class="container-12">
	<div id="slideshow" class="grid-12 swiper-container">
		<div class="swiper-wrapper">
<?php
	foreach ($slides as $slide) {
?>
			<div class="swiper-slide">
				<?= HTML::image($slide->url($slide::NORMAL_NAME), ['alt' => $slide->title]) ?>
			</div>
<?php
	}
?>
		</div>
	</div>
	<div class="intro">
		<h1 class="grid-12">Condimentum Inceptos!</h1>
		<div class="ingress grid-12">Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Curabitur blandit tempus porttitor. Donec id elit non mi porta gravida at eget metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam porta sem malesuada magna mollis euismod.</div>
	</div>
</main>
