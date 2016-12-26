<?php
	$html_class = 'no-js';
	$body_class = '';
	$body_attributes = [
		'data-base-url'	=> URL::site('/'),
		'class'			=> $body_class
	];
?><!DOCTYPE html>
<html<?= HTML::attributes(['class' => $html_class, 'lang' => 'no']) ?>>
<head>
	<meta charset="utf-8">
<?php
/*
switch ($device) {
	case 'mobile':
		?><meta name="viewport" content="width=640" /><?php
		break;
	case 'tablet':
		?><meta name="viewport" content="width=device-width, initial-scale=1"><?php
		break;
	default:
		?><meta name="viewport" content="width=device-width, initial-scale=1"><?php
		break;
}
*/
?>

	<title><?= HTML::chars($seo_title) ?></title>
	<meta<?= HTML::attributes(['name' => 'description', 'content' => HTML::chars($seo_description)]) ?>>
	<meta<?= HTML::attributes(['name' => 'keywords', 'content' => HTML::chars($seo_keywords)]) ?>>
<?php
	if (isset($og_title) && $og_title)
	{
?>
	<meta<?= HTML::attributes(['property' => 'og:title', 'content' => $og_title]) ?>>
<?php
	}
	if (isset($og_url) && $og_url)
	{
?>
	<meta<?= HTML::attributes(['property' => 'og:url', 'content' => $og_url]) ?>>
<?php
	}
	if (isset($og_description) && $og_description)
	{
?>
	<meta<?= HTML::attributes(['property' => 'og:description', 'content' => $og_description]) ?>>
<?php
	}
	if (isset($og_image) && $og_image)
	{
?>
	<meta<?= HTML::attributes(['property' => 'og:image', 'content' => $og_image]) ?>>
<?php
	}
	if (isset($og_type) && $og_type)
	{
?>
	<meta<?= HTML::attributes(['property' => 'og:type', 'content' => $og_type]) ?>>
<?php
	}
	if (isset($fb_app_id) && $fb_app_id)
	{
?>
	<meta<?= HTML::attributes(['property' => 'fb:app_id', 'content' => $fb_app_id]) ?>>
<?php
	}
	// add page styles
	foreach ($styles as $item) {
		if (is_array($item))
		{
			$url = $item['url'];
			$attributes = $item;
			unset($attributes['url']);
		}
		else
		{
			$url = $style;
			$attributes = NULL;
		}
		echo HTML::style($url, $attributes);
	}
	foreach ($scripts as $script) {
		if (is_array($script)) {
			$url = $script['url'];
			if (isset($script['if'])) {
				echo "<!--[if {$script['if']}]>";
			}
			echo HTML::script($url);
			if (isset($script['if'])) {
				echo '<![endif]-->';
			}
		} else {
			echo HTML::script($script);
		}
	}
	echo HTML::script('js/public/lib/require.js', ['data-main' => URL::site('js/public/main'.((Kohana::$environment == Kohana::PRODUCTION) ? '-built' : '').'.'.$serial_number)]);
	// echo HTML::script('js/public/lib/require.js', ['data-main' => URL::site('js/public/main-built').'.'.$serial_number]);
?>
	<script>
		window.onunload = function(){};
		window.onpageshow = function(event) {
		    if (event.persisted) {
		        window.location.reload();
		    }
		};
	</script>
</head>
<body<?= HTML::attributes($body_attributes) ?> onunload="">
<div id="container">
<?= $content ?>
</div>
</body>
</html>
