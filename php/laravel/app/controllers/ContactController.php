<?php

class ContactController extends BaseController {

	// protected $contacts;

	/**
	 * constructor
	 */
	public function __construct()
	{
		$creds = array(
			'usr_email' => 'sreedhar@gmail.com', 
			'password' => 'sreedhar' );

		if (Auth::attempt($creds)) {
		}
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$userId = Auth::user()->usr_id;
		
		$utils = UtilController::getInstance();
		
		$contactStructure = $utils->cStruct;
		$groupStructure = $utils->gStruct;


		$contactsGroups = ContactsGroup::with(array('contacts' => function($contact) use($contactStructure){
								$contact->where($contactStructure['isTrashed'], '=', 0);
								}, 'contacts.numbers', 'contacts.emails'))
								->where($groupStructure['userId'], '=', $userId)
								->get();


		
		$responseArr['contacts'] = $utils->prepareForResponse($contactsGroups, true);

		return Response::json($responseArr);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::json();

		$utils = UtilController::getInstance();
		$contactStructure = $utils->cStruct;

		$numbers = array();
		$emails = array();
		$newContact = new Contact;
		foreach ($data as $key => $value) {
			if($key !== 'numbers' && $key !== "emails")
			{
				$newContact->$contactStructure[$key] = $value;
			}	
			if($key === 'numbers')
			{
				$numbers = $value;
			}	
			if($key === 'emails')
			{
				$emails = $value;
			}
		}

		$newContact->save();

		
		foreach ($numbers as $number) {
			$this->numberStore( $number , $newContact->$contactStructure['id'] );
			// $newContact->numbers()->sync($number);
		}
		
		foreach ($emails as $email) {
			$this->emailStore( $email , $newContact->$contactStructure['id'] );
			// $newContact->emails()->sync($email);	
		}

		if ($newContact) {
			$responseArr = $utils->prepareForResponse($newContact);
			return Response::json($responseArr) ;
		}else
		{
			return Response::make("error", 500);
		}
			
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$userId = Auth::user()->usr_id;
		
		$utils = UtilController::getInstance();
		
		$contactStructure = $utils->cStruct;

		$contact = Contact::with('numbers', 'emails')->where($contactStructure['id'], $id)->first();
		
		$responseArr = $utils->prepareForResponse($contact);

		return Response::json($responseArr);
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$userId = Auth::user()->usr_id;
		$data = Input::json()->all();

		$utils = UtilController::getInstance();
		$contactStructure = $utils->cStruct;
		$groupStructure = $utils->gStruct;
		$numberStructure = $utils->nStruct;
		$emailStructure = $utils->eStruct;


		$numbers = array();
		$emails = array();
		$editContact = Contact::with('numbers', 'emails')->where($contactStructure['id'], $id)->first();
		if ($editContact == null) {
			return Response::make('Contact doesnot exits', 400);
		}
		
		if ($editContact->group->$groupStructure['userId'] == $userId) {
			foreach ($data as $key => $value) {
				if($key !== 'numbers' && $key !== "emails")
				{
					$editContact->$contactStructure[$key] = $value;
				}	
				if($key === 'numbers')
				{
					$numbers = $value;
				}	
				if($key === 'emails')
				{
					$emails = $value;
				}
			}
			$editContact->save();

			$prevNumbers = $editContact->numbers;
			foreach ($prevNumbers as $prevNumber) {
				$flag = 0;
				foreach ($numbers as $number) {
					
					if($prevNumber->$numberStructure['id'] === $number['id'])
					{
						$flag = 1;
						break;
					}
				}
				if($flag === 0)
				{
					ContactNumber::destroy($prevNumber->$numberStructure['id']);
				}
			}
			foreach ($numbers as $number) {
				$this->numberStore( $number , $id );
				// $editContact->numbers()->sync($number);
			}
			

			$prevEmails = $editContact->emails;
			foreach ($prevEmails as $prevEmail) {
				$flag = 0;
				foreach ($emails as $email) {
					
					if($prevEmail->$emailStructure['id'] === $email['id'])
					{
						$flag = 1;
						break;
					}
				}
				if($flag === 0)
				{
					ContactEmail::destroy($prevEmail->$emailStructure['id']);
				}
			}
			foreach ($emails as $email) {
				$this->emailStore( $email , $id );
				// $editContact->emails()->sync($email);	
			}

			$editContact = Contact::with('numbers', 'emails')->where($contactStructure['id'], $id)->first();
			$responseArr = $utils->prepareForResponse($editContact);
			return Response::json($responseArr);
		}
		else
		{
			return Response::make('Does not have access to the note', 400);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$userId = Auth::user()->usr_id;

		$utils = UtilController::getInstance();
		$contactStructure = $utils->cStruct;
		$groupStructure = $utils->gStruct;

		$contact = Contact::find($id);
	
		if ($contact == null) {
			return Response::make('contact doesnot exist', 400);
		}
		if ($contact->group->$groupStructure['userId'] == $userId){
			$contact->$contactStructure['isTrashed'] = 1;
			$contact->save();
			return Response::make('success', 204);
		}
		else{
			return Response::make("Do not have access", 400);
		}
		
	}



	public function numberStore($data, $id)
	{
		$utils = UtilController::getInstance();
		$numberStructure = $utils->nStruct;
		$newNumber = new ContactNumber;

		if(array_key_exists('id', $data)){
			$tempNumber = ContactNumber::find($data['id']);
			return Response::json($tempNumber) ;
		}
		
		$newNumber->$numberStructure['contactId'] = $id;
		foreach ($data as $key => $value) {
			$newNumber->$numberStructure[$key] = $value;
		}

		$newNumber->save();
		if ($newNumber) {
			return Response::json($newNumber) ;
		}else
		{
			return Response::make("error", 500);
		}
	}


	public function emailStore($data, $id)
	{
		$utils = UtilController::getInstance();
		$emailStructure = $utils->eStruct;

		$newEmail = new ContactEmail;
		if(array_key_exists('id', $data)){
			$tempEmail = ContactEmail::find($data['id']);
			return Response::json($tempEmail) ;
		}

		$newEmail->$emailStructure['contactId'] = $id;
		foreach ($data as $key => $value) {
			$newEmail->$emailStructure[$key] = $value;
		}

		$newEmail->save();
		if ($newEmail) {
			return Response::json($newEmail) ;
		}else
		{
			return Response::make("error", 500);
		}
	}


}