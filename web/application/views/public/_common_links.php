<nav id="menu_overlay">
	<div class="table">
		<div class="table-cell">
			<ul>
				<li><?= HTML::anchor('/hjem',		'Hjem',			['class' => 'transition']) ?></li>
				<li><?= HTML::anchor('/prosjekter',	'Prosjekter',	['class' => 'transition']) ?></li>
				<li><?= HTML::anchor('/om-oss',		'Om oss',		['class' => 'transition']) ?></li>
				<li><?= HTML::anchor('/blogg',		'Blogg',		['class' => 'transition to-blog']) ?></li>
				<li><?= HTML::anchor('/kontakt',	'Kontakt',		['class' => 'transition']) ?></li>
				<li><?= HTML::anchor('/søk',		'Søk',			['class' => 'transition']) ?></li>
			</ul>
		</div>
	</div>
</nav>
<a<?= HTML::attributes(['href' => URL::site('/hjem'), 'id' => 'logo', 'class' => 'transition']) ?>>
	<?php include DOCROOT.'img/logo.svg' ?>
	<?php include DOCROOT.'img/logo-hover.svg' ?>
</a>

<a<?= HTML::attributes(['href' => URL::site('/søk'), 'id' => 'search_link', 'class' => 'transition']) ?>>
	<?php include DOCROOT.'img/search.svg' ?>
</a>

<a href="#" id="menu_btn">
	<hr>
</a>

<a<?= HTML::attributes(['href' => $facebook_url,	'id' => 'facebook_link',	'target' => '_blank']) ?>><?php include DOCROOT.'img/fb.svg' ?></a>
<a<?= HTML::attributes(['href' => $instagram_url,	'id' => 'instagram_link',	'target' => '_blank']) ?>><?php include DOCROOT.'img/instagram.svg' ?></a>
<a<?= HTML::attributes(['href' => $linkedin_url, 	'id' => 'linkedin_link',	'target' => '_blank']) ?>><?php include DOCROOT.'img/linkedin.svg' ?></a>
