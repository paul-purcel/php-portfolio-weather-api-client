<?php

namespace Paul;
/**
 * Curl client class
 * @author Paul P. <paul@paul-resume.com>
 * @TODO : implemet the rest of the HTTP calls
 */
class Client extends BaseCURL {

	/**
	 * API Endpoint
	 * @var string
	 */
	protected $endpoint = 'http://localhost:3000/weather/';

	/**
	 * GET Resource
	 * @param string $location - The location to pull the weather for
	 * @return string
	 * @throws Paul\CURLException
	 */
	public function get($location){
		$this->curlRequest($this->endpoint.urlencode($location));

		if(!$this->getStatus() == 200){
			throw new CURLException($this->getError());
		} else {
			return $this->getResult();
		}
	}
}