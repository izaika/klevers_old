<footer>
	<div class="table">
		<div class="table-cell">
			&copy; <?= date('Y') ?> Nuno arkitektur AS <?= HTML::image('img/footer-map-pin.svg', ['alt' => 'pin', 'class' => 'pin']) ?> Akersbakken 12, 0172 Oslo<br>
			@ <?= HTML::mailto($email) ?> <?= HTML::image('img/phone.svg', ['alt' => 'phone', 'class' => 'phone']).' '.$phone ?>
			<a<?= HTML::attributes(['href' => $linkedin_url, 'class' => 'linkedin', 'target' => '_blank']) ?>><?php include DOCROOT.'img/linkedin.svg' ?></a>
			<a<?= HTML::attributes(['href' => $instagram_url, 'class' => 'instagram', 'target' => '_blank']) ?>><?php include DOCROOT.'img/instagram.svg' ?></a>
			<a<?= HTML::attributes(['href' => $facebook_url, 'class' => 'facebook', 'target' => '_blank']) ?>><?php include DOCROOT.'img/fb.svg' ?></a>
		</div>
	</div>
</footer>
