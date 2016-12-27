<main id="products" class="container-12">
	<div id="categories" class="grid-3">
		<ul>
<?php
	foreach ($categories as $category) {
?>
			<li>
<?php
		echo HTML::anchor($category->get_url(), $category->heading);
		if ($category->categories->cached()->count_all()) {
?>
				<button><i class="icon-angle-right"></i></button>
				<ul style="display: none;">
<?php
			foreach ($category->categories->cached()->find_all() as $subcategory) {
?>
					<li>
<?php
				echo HTML::anchor($subcategory->get_url(), $subcategory->heading);
?>
					</li>
<?php
			}
?>
				</ul>
<?php
		}
?>
			</li>
<?php
	}
?>
		</ul>
	</div>
</main>
