<?= View::factory('mobile/_common_links') ?>
<div id="one_pager_navigation">
	<a href="#top_slideshow"></a>
	<a href="#top_projects"></a>
	<a href="#section_about"></a>
	<a href="#section_contact"></a>
</div>
<a href="#" id="to_top"><?= file_get_contents('img/to-top.svg') ?></a>
<main id="home">
	<section id="top_slideshow">
		<div class="swiper-container">
			<div class="swiper-wrapper">
<?php
	foreach ($slides as $index => $s) {
		switch ($s->link_type) {
			case $s::LINK_TYPE_PROJECT:
				$project 	= Model_Project::factory(null, $s->project_id);
				if (!$project->is_online) continue(2);
				if ($project->preview_uid) {
					$preview_obj	= new Model_Project_Preview($project->id);
					$background_url = $preview_obj->url($preview_obj::FULLSCREEN_NAME);
				} else {
					$background_url = $project->url($project::FULLSCREEN_NAME);
				}


				$open_tag	= '<a'.HTML::attributes([
					'class' => 'swiper-slide transition',
					'style' => 'background-image: url('.URL::site($background_url).')',
					'href'	=> $project->get_url(true),
				]).'>';
				$close_tag	= '</a>';
				$heading = $project->heading;
				$subheading = $project->name.' >';
				break;
			case $s::LINK_TYPE_EXTERNAL:
				$open_tag	= '<a'.HTML::attributes([
					'class'		=> 'swiper-slide',
					'style'		=> 'background-image: url('.URL::site($s->url($s::NORMAL_NAME)).')',
					'href'		=> $s->url,
					'target'	=> $s->open_link_in_new_window ? '_blank' : '_self',
				]).'>';
				$close_tag	= '</a>';
				$heading = $s->heading;
				$subheading = $s->subheading.' >';
				break;
			default:
				$open_tag	= '<div'.HTML::attributes([
					'class'		=> 'swiper-slide',
					'style'		=> 'background-image: url('.URL::site($s->url($s::NORMAL_NAME)).')',
				]).'>';
				$close_tag	= '</div>';
				$heading = $s->heading;
				$subheading = $s->subheading;
				break;
		}
?>
				<?= $open_tag ?>
					<div class="additional-grid">
<?php
	for ($i = 1; $i <= 10; $i++) {
?>
						<div></div>
<?php
	}
?>
					</div>
					<div class="cover">
						<div class="table">
							<div class="table-cell">
<?php
	if ($index) {
?>
								<h2><?= nl2br(HTML::chars($heading)) ?></h2>
<?php
	} else {
?>
								<h1><?= nl2br(HTML::chars($heading)) ?></h1>
<?php
	}
?>
								<h3 class="subheading"><?= $subheading ?></h3>
							</div>
						</div>
					</div>
				<?= $close_tag ?>
<?php
	}
?>
			</div>
			<div class="swiper-pagination"></div>
		</div>
		<?= HTML::anchor('#', HTML::image('img/arrow-down.svg', ['alt' => 'arrow down']), ['class' => 'arrow-down']) ?>
	</section>


	<section id="top_projects">
<?php
	foreach ($recent_projects as $i => $p) {
		if ($p->preview_uid) {
			$preview_obj	= new Model_Project_Preview($p->id);
			$background_url = $preview_obj->url($preview_obj::HOMEPAGE_PREVIEW_NAME);
		} else {
			$background_url = $p->url($p::HOMEPAGE_PREVIEW_NAME);
		}
?>
		<a<?= HTML::attributes(['href' => $p->get_url(true), 'class' => 'project transition touchlink']) ?>>
			<?= HTML::image($background_url, ['alt' => $p->title]) ?>
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
		<div class="title">
			<div class="table">
				<div class="table-cell">
					<h3>Stolte<br>øyeblikk</h3>
				</div>
			</div>
			<?= HTML::image('img/triangle.svg', ['alt' => 'triangle']) ?>
		</div>
		<a<?= HTML::attributes(['href' => URL::site('/prosjekter'), 'class' => 'projects-link transition']) ?>>
			<div class="table">
				<div class="table-cell">
					<h3>VIS MEG alle<br>prosjekter ></h3>
				</div>
			</div>
		</a>
	</section>


	<section id="section_about">
		<div class="table">
			<div class="table-cell">
				<blockquote><?= nl2br(HTML::chars($quote)) ?></blockquote>
				<?= HTML::anchor('/om-oss', 'JEG VIL VITE MER OM NUNO >', ['class' => 'transition']) ?>
			</div>
		</div>
	</section>


	<section id="section_contact">
		<h2 class="title">Vil du starte et nytt og<br>spennende samarbeid?</h2>
		<?= HTML::anchor('/kontakt', 'Kontakt oss for en prat', ['class' => 'contact-link transition']) ?>
		<?= HTML::image('img/dots.svg', ['alt' => 'dots', 'class' => 'dots']) ?>
		<!-- <div class="texture"></div> -->
		<div class="phone-email">
			<div class="table">
				<div class="table-cell">
					<a href="<?= 'tel:'.str_replace(' ', '', HTML::chars($phone)) ?>" class="phone"><?= HTML::chars($phone) ?></a>
					<?= HTML::mailto($email) ?>
				</div>
			</div>
		</div>
		<a href="https://www.google.com.ua/maps/place/Akersbakken+12,+0172+Oslo,+Norge/@59.9252467,10.7490505,18z/data=!4m5!3m4!1s0x46416e6fc00cd2b7:0x9637a54c062a828d!8m2!3d59.9252731!4d10.749535?hl=no" class="g-maps" target="_blank">
			<div class="address">
				<div class="table">
					<div class="table-cell">
						<address>Akers-<br>bakken<br>0172 Oslo</address>
					</div>
				</div>
			</div>
			<span>12</span>
		</a>
	</section>
</main>
<?= View::factory('mobile/_footer') ?>
