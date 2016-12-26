<?= View::factory('mobile/_common_links') ?>
<main id="search">
	<div class="additional-grid">
<?php
	for ($i = 1; $i <= 10; $i++) {
?>
		<div></div>
<?php
	}
?>
	</div>
<?php
	echo Form::open('ajax_søk', ['id' => 'search_form']);
		echo Form::input('search_str', '', ['type' => 'search', 'placeholder' => 'Søk']);
	echo Form::close();
?>
	<div id="results">
		<div class="loader">
			<svg viewBox="25 25 50 50">
				<circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
			</svg>
		</div>
	</div>
</main>