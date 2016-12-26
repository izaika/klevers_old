<?= View::factory('mobile/_common_links') ?>
<main id="exception404">
	<div class="container">
		<h1>404</h1>
		<h2>Finner ikke siden</h2>
		<?= HTML::anchor('/hjem', 'TILBAKE TIL STARTSIDEN', ['class' => 'hoverable']); ?>
	</div>
	<div class="icons">
		<?= HTML::image('img/404.png', ['alt' => '404']) ?>
	</div>
</main>