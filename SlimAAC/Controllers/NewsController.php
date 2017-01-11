<?php

namespace SlimAAC\Controllers;

class NewsController extends Controller {
	
	public function __invoke($request, $response, $args) {
		$news = [];
		
		if (is_dir(PUBLIC_HTML_PATH . '/news')) {
			foreach (glob(PUBLIC_HTML_PATH . '/news/*.md') as $filename) {
				$news[] = [
					'title' => basename($filename, '.md'),
					'date' => filectime($filename),
					'content' => file_get_contents($filename)
				];
			}
		}
		
		return $response->withJson($news);
	}
}
