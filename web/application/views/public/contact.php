<?= View::factory('public/_common_links') ?>
<main id="contact">
	<div class="texture parallax" data-parallax-range="60" data-parallax-invert="1"></div>
	<?= HTML::image('img/dots.svg', ['alt' => 'dots', 'class' => 'dots parallax', 'data-parallax-range' => 150]) ?>
	<div id="map_container" class="parallax" data-parallax-range="70">
		<div id="map"></div>
	</div>
	<a href="https://www.google.com.ua/maps/place/Akersbakken+12,+0172+Oslo,+Norge/@59.9252467,10.7490505,18z/data=!4m5!3m4!1s0x46416e6fc00cd2b7:0x9637a54c062a828d!8m2!3d59.9252731!4d10.749535?hl=no" class="g-maps" target="_blank">
		<div class="address parallax" data-parallax-range="90">
			<div class="table">
				<div class="table-cell">
					<address>Akers-<br>bakken<br>0172 Oslo</address>
				</div>
			</div>
		</div>
		<span class="parallax" data-parallax-range="280">12</span>
	</a>
	<h1 class="parallax" data-parallax-range="200">Kontakt</h1>
	<div class="phone-email parallax" data-parallax-range="50">
		<div class="table">
			<div class="table-cell">
				<a href="<?= 'tel:'.str_replace(' ', '', HTML::chars($phone)) ?>" class="phone"><?= HTML::chars($phone) ?></a>
				<?= HTML::mailto($email) ?>
			</div>
		</div>
	</div>
</main>
