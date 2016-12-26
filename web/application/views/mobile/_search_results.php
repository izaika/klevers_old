<?php
	$results_count = 0;
	$displayed_results = [];
	foreach ($results as $i => $r) {
		if ($r->is_online && $results_count < 7) {
			$displayed_results[] = HTML::anchor($r->url, $r->name.HTML::image('img/go-to.svg', ['alt' => 'arrow-right']), ['class' => 'hoverable']);
			$results_count++;
		}
	}
	if (count($displayed_results)) {
?>
<ul>
<?php
		foreach ($displayed_results as $i => $r) {
?>
	<li><?= $r ?></li>
<?php
				$results_count++;
		}
?>
</ul>
<?php
	} else {
?>
<div class="no-results">Ditt søk ga ingen treff</div>
<?php
	}
?>