<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Setup Twitter json Responder Class
 */
class Tweets_JSON_Responder {


	public function __construct() {
		$this->settings = array(
		    'oauth_access_token' => get_option( "twitter_json_access_token", null ),
		    'oauth_access_token_secret' => get_option( "twitter_json_token_secret", null ),
		    'consumer_key' => get_option( "twitter_json_consumer_key", null ),
		    'consumer_secret' => get_option( "twitter_json_consumer_secret", null )
		);
	}

	/**
	 * Parses path, retrieves results and then exits the JSON
	 * @param  string $path 
	 * @return exit
	 */
	public function serve_request($path = null){
		$error = null;
		if($path === null || $path == "/")
			$error = isset($error) ? $error : "Twitter JSON Error: No paths set.";
		
		$path = explode("/", $path);
		$parameters = http_build_query($_GET, "", "|");

		if( !isset($path[1]) || $path[1] == "" ):
			$error = isset($error) ? $error : "Twitter JSON Error: No collection passed.";
		elseif( !isset($path[2]) || $path[2] == "" ):
			$error =isset($error) ? $error : "Twitter JSON Error: No endpoint passed.";
		elseif(!isset($parameters) || $parameters == ""):
			$error =isset($error) ? $error : "Twitter JSON Error: No options sent to query.";
		endif;
		
		//Set Collection
		//supported collections
		$collection_endpoints = array(
			"statuses"
		);
		if( isset($path[1]) && in_array($path[1], $collection_endpoints, true) ):
			$collection = $path[1];
		else:
			$error = isset($error) ? $error : "Twitter JSON Error: Invalid Collection: '".htmlspecialchars($path[1])."'";
		endif;

		//Set Endpoint
		//supported endpoints
		$statuses_endpoints = array(
			"user_timeline",
			"show"
		);
		if( isset($path[2]) && in_array($path[2], $statuses_endpoints, true) ):
			$endpoint = $path[2].".json";
		else:
			$error = isset($error) ? $error : "Twitter JSON Error: Invalid Endpoint: '".htmlspecialchars($path[2])."'";
		endif;


		if( isset($error) && $error !== null ):
			$this->handle_error($error);
		endif;

		$json_results = $this->query_twitter($collection, $endpoint, $parameters);

		exit($json_results);
	}

	/**
	 * Builds query and uses twitter api exchange to return results
	 * @param string $collection 
	 * @param string $endpoint 
	 * @param string $params 
	 * @return JSON Object
	 */
	private function query_twitter($collection = null, $endpoint = null, $params = null){
		$url = 'https://api.twitter.com/1.1/'.$collection.'/'.$endpoint;
		$requestMethod = 'GET';
		$twitter = new TwitterAPIExchange($this->settings);
		$tweets = $twitter->setGetfield('?'.$params)
		    ->buildOauth($url, $requestMethod)
		    ->performRequest();
		return $tweets;
		//return $app_list;
	}

	/**
	 * Exits 404 error and spits out json response
	 * @param string $error 
	 * @return exit
	 */
	private function handle_error($error){
		header('HTTP/1.0 400 Bad error');
		$response_array['status'] = 'error'; /* match error string in jquery if/else */ 
    	$response_array['message'] = $error;   /* add custom message */ 
		$json_results =  json_encode($response_array);
		exit($json_results);
	}

}
?>