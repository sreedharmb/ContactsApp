<?php

class UtilController{
	
	public $cStruct; 
	public $gStruct;
	public $nStruct;
	public $eStruct;
	public $upStruct;

	private static $instance; 

	private function __construct()
	{
		$this->init();	
	}
	
	protected function init()
	{
		$this->cStruct = Contact::$structure;
		$this->gStruct = ContactsGroup::$structure;
		$this->nStruct = ContactNumber::$structure;
		$this->eStruct = ContactEmail::$structure;
		$this->upStruct = UserPreference::$structure;
	}
	
	public static function getInstance() {
        if(self::$instance === null) {
            self::$instance = new UtilController();
        }
        return self::$instance;
    }

	public function prepareForResponse($contactsGroups, $isArray = false)
	{

		if($isArray)
		{	
			$response = array();
			foreach ($contactsGroups as $contactsGroup) {
				$contacts = $contactsGroup->contacts;
				foreach ($contacts as $contact) {
					$response[] = $this->contactResponse($contact);
				}
				
			}

		}
		else{
			
			$response = $this->contactResponse($contactsGroups);
		}
		return $response;
	}

	protected function contactResponse($contact)
	{
		
		$responseArr = array();
		
		foreach ($this->cStruct as $key => $value) {
			if ($contact->$value !== null) {
				$responseArr[$key] = $contact->$value;
			}
		}
		$numbers = $contact->numbers;
		// $responseArr['numbers'] = array();
		foreach ($numbers as $number) {
			$numbersArr = array();
			foreach ($this->nStruct as $key => $value) {
				if($key !== 'contactId')
				{
					$numbersArr[$key] = $number->$value;
				}
			}
			$responseArr['numbers'][] = $numbersArr ;
		}
		$emails = $contact->emails;
		// $responseArr['emails'] = array();
		foreach ($emails as $email) {
			$emailsArr = array();
			foreach ($this->eStruct as $key => $value) {
				if($key !== 'contactId')
				{
					$emailsArr[$key] = $email->$value;
				}
			}
			$responseArr['emails'][] = $emailsArr;
		}
		
		return $responseArr;

	}
}