<?php

class App
{
	const EH_ROOT = 'bo-i-bjorvika';
	const FONTELLO_VERSION	= 'fba47486';

	const TEMP_UPLOAD_STORAGE = 'assets/tmp/';
	const SITE_TITLE = 'Bjorvika';
	const MYSQL_DATE_FORMAT = 'Y-m-d H:i:s';
	const APP_FE_DATE_FORMAT = 'd.m.Y';

	const LANG_NO = 'no';
	const LANG_EN = 'en';

	public static $RESERVED_ROOT_URLS = array('/ecm');
	public static $lang = App::LANG_NO;
	public static $module = '';


	public static function another_locale()
	{
		return (self::$lang == self::LANG_NO) ? self::LANG_EN : self::LANG_NO;
	}


	public static function filter_locale($value)
	{
		return ($value == self::LANG_NO) ? self::LANG_NO : self::LANG_EN;
	}


	public static function belongs2path($url, $path)
	{
		return $url == $path || Text::starts_with($path, $url.'/');
	}

	public static function get_day($date)
	{
		return date('j', strtotime($date));
	}

	public static function get_month($date)
	{
		return strftime('%h', strtotime($date));
	}
	public static function get_full_month($date)
	{
		return strftime('%B', strtotime($date));
	}

	public static function format_date($date)
	{
		return strftime('%e. %B %Y', strtotime($date));
	}

	public static function url_prefix()
	{
		return self::$module.'/'.self::$lang;
	}
	
	public static function format_apt_price($val)
	{
		return Num::format($val, 0, false);
	}


	public static function ContentToTwoColumns($fullContent) {
		//Get character length of content
		$fullContentLength = strlen($fullContent);
		//Set the ratio of column size
		$column1Percent = .50;
		$column2Percent = .50;

		//Break the content into two columns using the ratios given.
		$columnsContent = array();
		$columnBreak = round($column1Percent * $fullContentLength);
		$columnsContent[0] = substr($fullContent, 0, $columnBreak);
		$columnsContent[1] = substr($fullContent, $columnBreak);

		//Check for unclosed tags in the first column by comparing
		//the number of open tags with closed tags.
		$numTags = self::countOpenClosedTags($columnsContent[0]);
		$numOpened = $numTags[0];
		$numClosed = $numTags[1];
		$unclosedTags = $numOpened - $numClosed;

		//echo '<p>Opened Tags: '.$numTags[0].'</p>';
		//echo '<p>Closed Tags: '.$numTags[1].'</p>';
		//echo '<p>Unclosed Tags: '.$unclosedTags.'</p>';

		//If there are unclosed tags recalculate the column break.
		if ($unclosedTags > 0) {

			//Return the identity of all open tags in the first column.
			preg_match_all("#<([a-z]+)( .*)?(?!/)>#iU", $columnsContent[0], $result);
			$openedTags = $result[1];

			//Return the identity of all closed tags in the first column.
			preg_match_all("#</([a-z]+)>#iU", $columnsContent[0], $result);
			$closedTags = $result[1];

			//Reverse array of open tags so they can be matched against the closed tags.
			$openedTags = array_reverse($openedTags);

			//Loop through open/closed tags to identify first unclosed tag
			//in first column on content.
			for( $i = 0; $i < $numOpened; $i++ ){
			  if ( !in_array ( $openedTags[$i], $closedTags ) ){
				$firstOpenTag = $openedTags[$i];
				//echo '<p>Open Tag: &lt;'.$firstOpenTag.'&gt;</p>';
			  } else {
				unset ( $closedTags[array_search ( $openedTags[$i], $closedTags)] );
			  }
			}

			//Get name of first open tag and create a closed version.
			//$firstOpenTag = $openedTags[$tagNum][0];
			$firstOpenTagClosed = '</'.$firstOpenTag.'>';

			//Calculate the tag length of the closed version.
			$tagLength = strlen($firstOpenTagClosed);

			//Locate the position of the first closed tag in the second column
			//content that matches the first opened tag in the first column
			$positionCloseTag = strpos($columnsContent[1], $firstOpenTagClosed);

			//Calculate the position of the new column break using the
			//position of and length the final closing tag.
			$columnBreak = $columnBreak + $positionCloseTag + $tagLength;

			//echo '<p>Final Closing Tag: &lt;/'.$firstOpenTag.'&gt;</p>';
			//echo '<p>Column Break Point: '.$columnBreak.'</p>';

			// Break the content into two columns using the new break point. 
			$columnsContent[0] = substr($fullContent, 0, $columnBreak);
			$columnsContent[1] = substr($fullContent, $columnBreak);
		}

		// Return the two columns as an array
		return $columnsContent;
	}

	public static function countOpenClosedTags($html){
	  //Return the identity and position of all open tags in the HTML.
	  preg_match_all("#<([a-z]+)( .*)?(?!/)>#iU", $html, $result, PREG_OFFSET_CAPTURE);

	  //Check that the returned result array isn't empty.
	  if (!isset($result[1])){
		$numOpened = 0;
	  } else {
		//If the result array isn't empty get the number of open tags.
		$openedTags = $result[1];
		$numOpened = (!$openedTags) ? 0 : count($openedTags);
	  }

	  //Return the identity and position of all close tags in the HTML.
	  preg_match_all("#</([a-z]+)>#iU", $html, $result, PREG_OFFSET_CAPTURE);

	  //Check that the returned result array isn't empty.
	  if (!isset($result[1])){
		$numClosed = 0;
	  } else {
		//If the result array isn't empty get the number of close tags.
		$closedTags = $result[1];
		$numClosed = (!$closedTags) ? 0 : count($closedTags);
	  }

	  //Create an array to return the open and close counts.
	  $numTags = array($numOpened, $numClosed);
	  return $numTags;
	}
}
