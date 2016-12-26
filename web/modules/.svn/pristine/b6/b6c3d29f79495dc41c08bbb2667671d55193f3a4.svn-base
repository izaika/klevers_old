<?php defined('SYSPATH') OR die('No direct script access.');

class Response extends Kohana_Response {

    public function no_cache()
    {
        $this->headers('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0, max-age=0');
        $this->headers('Pragma', 'no-cache');
        return $this;
    }


    public function json()
    {
		$this->headers('Content-type', 'application/json');
        return $this;
    }

}
