<header>
	<nav class="container-12">
		<?= HTML::anchor('/', file_get_contents(DOCROOT.'img/logo.svg'), ['id' => 'logo']) ?>
		<ul>
			<li><?= HTML::anchor('/', 'Главная') ?></li>
			<li><?= HTML::anchor('/products', 'Товары') ?></li>
			<li><?= HTML::anchor('/about', 'О нас') ?></li>
			<li><?= HTML::anchor('/contacts', 'Контакты') ?></li>
		</ul>
	</nav>
</header>
