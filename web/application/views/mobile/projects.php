<?= View::factory('mobile/_common_links') ?>
<aside id="projects_aside">
	<div class="scroller">
<?php
	$active_category_name = 'Vis meg: alle';
	echo Form::open('#', ['id' => 'filters_form']);
		$all_filters = [];
		foreach ($categories as $i => $c) {
			$is_checked = ($cat_id == $c->id);
			if ($is_checked) {
				$active_category_name = $c->heading;
			}
			echo Form::radio('category', 'cat-'.$c->id, $is_checked, ['id' => 'cat_'.$c->id, 'data-filter' => '.cat-'.$c->id]);
			echo Form::label('cat_'.$c->id, $c->heading, ['class' => $i ? 'hoverable' : 'first hoverable']);
			$all_filters[] = '.cat-'.$c->id;
		}
		echo Form::radio('category', 'cat-all', ($cat_id == 0), ['id' => 'cat_all', 'data-filter' => '.isotope-item']);
		echo Form::label('cat_all', 'ALLE PROSJEKTER', ['class' => 'hoverable']);
	echo Form::close();
	echo HTML::anchor('søk', 'Søk', ['class' => 'search-link transition hoverable']);
?>
	</div>
</aside>
<a href="#" class="selected-filter hoverable"><span><?= $active_category_name ?></span><?php include DOCROOT.'img/simple-arrow-down.svg' ?></a>
<main id="projects">
	<div<?= HTML::attributes([
		'class' 		=> 'isotope-container',
		'data-cat-id'	=> $cat_id
	]) ?>>
		<div class="isotope-grid"><?php
	foreach ($projects as $p) {
		$p_class = 'isotope-item transition touchlink';
		foreach ($p->categories->cached()->find_all() as $c) {
			$p_class .= ' cat-'.$c->id;
		}
		if ($p->preview_uid) {
			$preview_obj	= new Model_Project_Preview($p->id);
			$background_url = $preview_obj->url($preview_obj::HOMEPAGE_PREVIEW_NAME);
		} else {
			$background_url = $p->url($p::HOMEPAGE_PREVIEW_NAME);
		}
			?><a<?= HTML::attributes(['href' => URL::site($p->get_url()), 'class' => $p_class]) ?>>
				<?= HTML::image($background_url, ['alt' => $p->title]) ?>
				<div class="cover">
					<div class="table">
						<div class="table-cell">
							<h2><?= HTML::chars($p->heading) ?></h2>
							<h3><?= HTML::chars($p->name) ?> ></h3>
						</div>
					</div>
				</div>
			</a><?php
	}
		?></div><!-- .isotope-grid -->
	</div><!-- .isotope-container -->
</main>
