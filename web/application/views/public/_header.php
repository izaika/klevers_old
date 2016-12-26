<header>
	<nav class="container-12">
		<div class="grid-12">
			<div class="wrap">
				<?= HTML::anchor('/', file_get_contents(DOCROOT.'img/logo.svg'), ['id' => 'logo']) ?>
				<ul><?php
					?><li><?= HTML::anchor('/', 'Главная') ?></li><?php
					?><li><?= HTML::anchor('/products', 'Товары') ?></li><?php
					?><li><?= HTML::anchor('/about', 'О нас') ?></li><?php
					?><li><?= HTML::anchor('/contacts', 'Контакты') ?></li><?php
				?></ul>
			</div>
		</div>
	</nav>
</header>
