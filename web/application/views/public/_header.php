<header>
	<nav class="container-12">
		<div class="grid-12">
			<div class="wrap">
				<?= HTML::anchor('/', file_get_contents(DOCROOT.'img/logo.svg'), ['id' => 'logo']) ?>
				<ul><?php
					?><li><?= HTML::anchor('/',			'Главная',	['class' => $active_page == 'index'		? 'active' : null]) ?></li><?php
					?><li><?= HTML::anchor('/статьи',	'Статьи',	['class' => $active_page == 'articles'	? 'active' : null]) ?></li><?php
					?><li><?= HTML::anchor('/товары',	'Товары',	['class' => $active_page == 'products'	? 'active' : null]) ?></li><?php
					?><li><?= HTML::anchor('/о-нас',	'О нас',	['class' => $active_page == 'about'		? 'active' : null]) ?></li><?php
					?><li><?= HTML::anchor('/контакты',	'Контакты',	['class' => $active_page == 'contacts'	? 'active' : null]) ?></li><?php
				?></ul>
			</div>
		</div>
	</nav>
</header>
