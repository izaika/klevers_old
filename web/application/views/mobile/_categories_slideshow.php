<div id="categories_slideshow">
	<div class="additional-grid">
<?php
	for ($i = 1; $i <= 12; $i++) {
?>
		<div></div>
<?php
	}
?>
	</div>
	<div class="swiper-container">
		<div class="swiper-wrapper">
<?php
	foreach ($categories as $c) {
?>
			<div class="swiper-slide"><?php
				?><div class="featured-project">
<?php
		$featured_projects = DB::query(Database::SELECT, '
			SELECT p.*
			FROM projects p
			JOIN categories_projects cp ON (category_id = :category_id AND project_id = p.id)
			WHERE cp.is_featured = 1
			AND p.is_online = 1
			AND p.is_new = 0
			ORDER BY p.ord ASC
			LIMIT 1
		')
		->param(':category_id', $c->id)
		->as_object('Model_Project')
		->cached()
		->execute();

		foreach ($featured_projects as $p) {
			if ($p->preview_uid) {
				$preview_obj	= new Model_Project_Preview($p->id);
				$background_url = $preview_obj->url($preview_obj::RELATED_PREVIEW_NAME);
			} else {
				$background_url = $p->url($p::RELATED_PREVIEW_NAME);
			}

?>
					<a<?= HTML::attributes([
						'href'	=> $p->get_url(true),
						'style'	=> 'background-image: url('.$background_url.')',
						'class'	=> 'transition'
					]) ?>>
						<div class="cover">
							<div class="table">
								<div class="table-cell">
									<h2><?= HTML::chars($p->heading) ?></h2>
									<h3><?= HTML::chars($p->name) ?> ></h3>
								</div>
							</div>
						</div>
					</a>
<?php
		}
?>
				</div><?php
				?><div class="category-info">
					<h2><?= HTML::chars($c->heading) ?></h2>
					<div class="description"><?= nl2br(HTML::chars($c->description)) ?></div>
					<h4>Referanser</h4>
					<ul class="category-projects">
<?php
		$category_projects = DB::query(Database::SELECT, '
			SELECT p.*
			FROM projects p
			JOIN categories_projects cp ON (category_id = :category_id AND project_id = p.id)
			WHERE p.is_online = 1
			AND p.is_new = 0
			ORDER BY p.ord ASC
		')
		->param(':category_id', $c->id)
		->as_object('Model_Project')
		->cached()
		->execute();
		foreach ($category_projects as $p) {
?>
						<li><?= HTML::anchor($p->get_url(), $p->name.' >') ?></li>
<?php
		}
?>
					</ul><!-- .category-projects -->
<?php
	if ($c->pdf_uid) {
?>
					<a<?= HTML::attributes([
						'href' 		=> $c->download_url(),
						'class' 	=> 'download-pdf',
						'target'	=> '_blank'
						]) ?>><?= file_get_contents(DOCROOT.'img/pdf.svg') ?><span>Last ned<br>kompetansebevis</span></a>
<?php
	}
?>
				</div><?php
			?></div><!-- .swiper-slide -->
<?php
	}
?>
		</div><!-- .swiper-wrapper -->
	</div><!-- .swiper-container -->
	<div class="arrow-prev arrow"><?= HTML::image('img/categories-arrow-prev.svg', ['alt' => 'arrow']) ?></div>
	<div class="arrow-next arrow"><?= HTML::image('img/categories-arrow-next.svg', ['alt' => 'arrow']) ?></div>
	<hr>
	<?= HTML::image('img/close.svg', ['alt' => 'close', 'id' => 'close_gallery']) ?>
</div>
