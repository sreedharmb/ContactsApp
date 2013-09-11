<?php

class MiscController extends BaseController
{
	public function category($id)
	{
		$userId = Auth::user()->usr_id;
		
		$utils = UtilController::getInstance();
		
		$contactStructure = $utils->cStruct;
		$groupStructure = $utils->gStruct;


		$contactsGroups = ContactsGroup::with(array('contacts' => function($contact) use($contactStructure){
								$contact->where($contactStructure['isTrashed'], '=', 0);
								}, 'contacts.numbers', 'contacts.emails'))
								->where($groupStructure['userId'], '=', $userId)
								->where($groupStructure['id'], '=', $id)
								->get();


		
		$responseArr['contacts'] = $utils->prepareForResponse($contactsGroups, true);

		return Response::json($responseArr);
		return Response::json($results);
	}

	//To populate the notes that are trashed
	public function trashed()
	{
		$userId = Auth::user()->usr_id;
		
		$utils = UtilController::getInstance();
		
		$contactStructure = $utils->cStruct;
		$groupStructure = $utils->gStruct;


		$contactsGroups = ContactsGroup::with(array('contacts' => function($contact) use($contactStructure){
								$contact->where($contactStructure['isTrashed'], '=', 1);
								}, 'contacts.numbers', 'contacts.emails'))
								->where($groupStructure['userId'], '=', $userId)
								->get();


		$responseArr['contacts'] = $utils->prepareForResponse($contactsGroups, true);

		return Response::json($responseArr);
	}


	public function emptyTrashed()
	{
		
		//tbd
		return Response::json(responseMsg(200,'success'));
	}

	//To populate the notes that are starred
	public function favourites()
	{
		$userId = Auth::user()->usr_id;
		
		$utils = UtilController::getInstance();
		
		$contactStructure = $utils->cStruct;
		$groupStructure = $utils->gStruct;


		$contactsGroups = ContactsGroup::with(array('contacts' => function($contact) use($contactStructure){
								$contact->where($contactStructure['isTrashed'], '=', 0)
										->where($contactStructure['isFavourite'], '=', 1);
								}, 'contacts.numbers', 'contacts.emails'))
								->where($groupStructure['userId'], '=', $userId)
								->get();


		
		$responseArr['contacts'] = $utils->prepareForResponse($contactsGroups, true);

		return Response::json($responseArr);

	}

	//optional 
	public function updateFavourite($id)
	{
		$userId = Auth::user()->user_id;
		$data = Input::json()->all();

		$utils = UtilController::getInstance();
		$contactStructure = $utils->cStruct;
		$groupStructure = $utils->gStruct;

		$editContact = Contact::find($id);
		if($editContact == null){
			return Response::make('error', 500);
		}
		if($editContact->group->$groupStructure['userId'] == $userId){
			$editContact->$contactStructure['isFavourite'] = 1;
			$editContact->save();
			return Response::make("success");
		}
		else
		{
			return Response::make('error', 500);
		}
	}

}