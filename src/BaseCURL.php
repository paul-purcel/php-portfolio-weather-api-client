<?php

namespace Paul;

/**
 * Base CURL class
 * @author Paul P. <paul@paul-resume.com>
 * @TODO : implemet the rest of the HTTP verbs
 */
abstract class BaseCURL {

	protected $curl;
	protected $error;
	protected $status;
	protected $result;

	/**
	 * @var string - GET Request type
	 */
	const REQUEST_TYPE_GET = 'GET';

	/**
	 * @var string - POST Request type
	 */
	const REQUEST_TYPE_POST = 'POST';

	/**
	 * @var string - PUT Request type
	 */
	const REQUEST_TYPE_PUT = 'PUT';

	/**
	 * @var string - DELETE Request type
	 */
	const REQUEST_TYPE_DELETE = 'DELETE'; 

	/**
	 * The constructor
	 * @throws Paul\CURLException
	 */
	public function __construct(){
		if(!function_exists('curl_init')){
			throw new CURLException("CURL does not appear to be installed !", 500);
		}
	}

	/**
	 * Make a request 
	 * @param $endpoint - The API endpoint
	 * @param $method - The HTTP verb to be used
	 * @param $args - Otional parameters to be sent 
	 */
	public function curlRequest($endpoint, $method = self::REQUEST_TYPE_GET, $args = array()){
		$this->curl = curl_init();

		if($method == self::REQUEST_TYPE_GET){
			curl_setopt_array($this->curl, [
				CURLOPT_URL => $endpoint,
				CURLOPT_RETURNTRANSFER => TRUE,
				CURLOPT_FOLLOWREDIRECT => TRUE,
			]);

			$this->result = curl_exec($this->curl);
			$this->status = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
			$this->error = curl_error($this->curl);
		}

		curl_close($this->curl);
	}

	/**
	 * Get the HTTP status code of the current request
	 * @return integer
	 */
	public function getStatus(){
		return $this->status;
	}

	/**
	 * Get the result
	 * @return string
	 */
	public function getResult(){
		return $this->result;
	}

	/**
	 * Get the error
	 * @return string
	 */
	public function getError(){
		return $this->error;
	}
}