<?php
// echo $_SERVER['HTTP_USER_AGENT']; die;

	$html_class = 'no-js';
	$body_class = '';
	if (isset($no_footer) && $no_footer) {
		$body_class .= 'no-footer';
	}
	if (isset($is_search) && $is_search) {
		$html_class .= ' search-page';
	}
	if (isset($blue_bg) && $blue_bg) {
		$html_class .= ' blue-bg';
	}
	$body_attributes = [
		'data-base-url'	=> URL::site('/'),
		'class'			=> $body_class
	];
	$blue_bg = isset($blue_bg) && $blue_bg;
?><!DOCTYPE html>
<html<?= HTML::attributes(['class' => $html_class, 'lang' => 'no']) ?>>
<head>
	<meta charset="utf-8">
<?php
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
?>

	<link rel="apple-touch-icon" sizes="57x57" href="<?= URL::site('apple-icon-57x57.png') ?>">
	<link rel="apple-touch-icon" sizes="60x60" href="<?= URL::site('apple-icon-60x60.png') ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?= URL::site('apple-icon-72x72.png') ?>">
	<link rel="apple-touch-icon" sizes="76x76" href="<?= URL::site('apple-icon-76x76.png') ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?= URL::site('apple-icon-114x114.png') ?>">
	<link rel="apple-touch-icon" sizes="120x120" href="<?= URL::site('apple-icon-120x120.png') ?>">
	<link rel="apple-touch-icon" sizes="144x144" href="<?= URL::site('apple-icon-144x144.png') ?>">
	<link rel="apple-touch-icon" sizes="152x152" href="<?= URL::site('apple-icon-152x152.png') ?>">
	<link rel="apple-touch-icon" sizes="180x180" href="<?= URL::site('apple-icon-180x180.png') ?>">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?= URL::site('android-icon-192x192.png') ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= URL::site('favicon-32x32.png') ?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?= URL::site('favicon-96x96.png') ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= URL::site('favicon-16x16.png') ?>">
	<link rel="manifest" href="manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?= URL::site('ms-icon-144x144.png') ?>">
	<meta name="theme-color" content="#ffffff">

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
<?= View::factory('public/_grid') ?>
<?= $content ?>
<?= View::factory('public/_busy_overlay') ?>
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-5595467-1");
pageTracker._trackPageview();
</script>
</body>
</html>
