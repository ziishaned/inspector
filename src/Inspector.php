<?php 

namespace Zeeshan\Inspector;
 
use Zeeshan\Inspector\Exceptions\ValidationException;
use Exception;


/**
 * Inspector
 *
 * Inspector is PHP wrapper to search people profiles 
 * on different social networks e.g facebook, twitter, google+ etc. 
 *
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 * @license http://www.opensource.org/licenses/MIT
 * @version v0.0.1
 */
class Inspector
{	
	/**
	 * API URL through which the person information retrive.
	 * 
	 * @var string
	 */
	private $serviceUrl = "https://api.fullcontact.com/v2/person.json?";

	/**
	 * Contains profile information against provided email address.
	 * 
	 * @var array
	 */
	private $serviceResults;

	/**
	 * Constructor
	 * 
	 * @param string $key FullContact API Key
	 */
	public function __construct($key)
	{
		if (empty($key)) {
			throw new ValidationException("Please provide API key. You can get API Key by signing up on https://portal.fullcontact.com/signup");
		}

		$this->serviceUrl = $this->serviceUrl . "apiKey=e0a5c0bfd84a458e";
	}

	/**
	 * Returns $serviceUrl
	 * 
	 * @return string 
	 */
	public function getServiceUrl()
	{
		return $this->serviceUrl;
	}

	/**
	 * Sends request to FullContact API URL and fetches the buddy details and returns them
	 * 
	 * @param  string $email
	 * @return Exception|object Exception if something went wrong otherwise the buddy detail 
	 */
	public function getProfile($email)
	{
		if ($this->validateEmail($email)) {
		
			$url = $this->getServiceUrl() . "&email=" . $email;
			
			$serviceResults = $this->curlService($url);

	        if ($serviceResults && $serviceResults["status"] === 200) {
	            $this->serviceResults = $serviceResults;
	            return new Profile($email, $this->serviceResults);
	        }

		    throw new Exception("Something wrong happened.");
		
		}

        throw new Exception("Something wrong happened.");
	}

	/**
	 * Verify email address.
	 * 
	 * @param  string $email User email
	 * @return bool|Exception If email address is valid email address then true will return otherwise exception thrown.
	 */
	public function validateEmail($email)
	{
		if (empty($email)) {
			throw new ValidationException("Email is required to get Buddy information.");
		}

		if(!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
			throw new ValidationException("Please provide a valid email address.");
	    }

	    return true;
	}

	/**
	 * Send request to url and retrieves the user information against provided email address. 
	 * 
	 * @param  string $url API URL through which the person information retrive.
	 * @return array person information
	 */
	public function curlService($url)
	{
		$ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $serviceResults = json_decode(curl_exec($ch), true);

        curl_close($ch);

        return $serviceResults;
	}
}