<?php 

namespace Zeeshan\Inspector;	

class Profile
{	
	/**
	 * social networks name and photo url 
	 * @var array
	 */
	protected $photos = [];

	/**
	 * websites url and user full name 
	 * @var array
	 */
	protected $contactInfo = [];

	/**
	 * firms in which user worked or currently working 
	 * @var array
	 */
	protected $organizations = [];

	/**
	 * where user live
	 * @var array
	 */
	protected $demographics = [];

	/**
	 * social networks url
	 * @var array
	 */
	protected $socialProfiles = [];

	/**
	 * user interest
	 * @var array
	 */
	protected $interests = [];

	/**
	 * user email address
	 * @var string
	 */
	protected $email;

	/**
	 * Constructor
	 * 
	 * @param string $email User email address
	 * @param array $dataFromService person information
	 */
	public function __construct($email, $dataFromService)
	{
		$this->email = $email;
		$this->populateDetail($dataFromService);
	}

	/**
	 * Distribute data from $dataFromService into different information
	 * 
	 * @param  array $dataFromService person information
	 * @return bool
	 */
	public function populateDetail($dataFromService)
	{
		if (array_key_exists("photos", $dataFromService)) {
			foreach ($dataFromService["photos"] as $photo) {
				$this->photos[] = array_diff_key($photo, array_flip(["type", "typeId", "isPrimary"]));
			}
		}

		if (array_key_exists("contactInfo", $dataFromService)) {
			$this->contactInfo[] = array_diff_key($dataFromService["contactInfo"], array_flip(["familyName", "givenName"]));
		}

		if (array_key_exists("organizations", $dataFromService)) {
			foreach ($dataFromService["organizations"] as $organization) {
				$this->organizations[] = array_diff_key($organization, array_flip(["isPrimary"]));
			}
		}

		if (array_key_exists("demographics", $dataFromService)) {
			$this->demographics[] = $dataFromService["demographics"] ;
		}

		if (array_key_exists("socialProfiles", $dataFromService)) {
			foreach ($dataFromService["socialProfiles"] as $socialProfile) {
				$this->socialProfiles[] = array_diff_key($socialProfile, array_flip(["followers", "following", "type", "typeId", "id"]));
			}	
		}

		if (array_key_exists("digitalFootprint", $dataFromService)) {
			$dataFromService["digitalFootprint"] = array_diff_key($dataFromService["digitalFootprint"], array_flip(["scores"]));

			foreach ($dataFromService["digitalFootprint"] as $interest) {
				foreach ($interest as $key) {
					$this->interests[] = $key["value"];
				}
			}	
		}

		return true;
	}

	/**
	 * return photos variable
	 * @return array
	 */
	public function getPhotos()
	{
		return $this->photos;
	}

	/**
	 * return contactInfo variable
	 * @return array
	 */
	public function getContactInfo()
	{
		return $this->contactInfo;
	}

	/**
	 * return organizations variable
	 * @return array 
	 */
	public function getOrganizations()
	{
		return $this->organizations;
	}

	/**
	 * return demographics variable
	 * @return array 
	 */
	public function getDemographics()
	{
		return $this->demographics;
	}

	/**
	 * return socialProfiles variable
	 * @return array 
	 */
	public function getSocialProfiles()
	{
		return $this->socialProfiles;
	}

	/**
	 * return interest variable
	 * @return array 
	 */
	public function getInterests()
	{
		return $this->interest;
	}

	/**
	 * return user email address
	 * @return string 
	 */
	public function getEmail()
	{
		return $this->email;
	}
}