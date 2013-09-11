<?php

class ContactsGroupController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$userId = Auth::user()->usr_id;
		
		$utils = UtilController::getInstance();
		$groupStructure = $utils->gStruct;

		$groups = ContactsGroup::where($groupStructure['userId'], $userId)->get();

		$responseArr = array();
		$index = 0;
		foreach ($groups as $group) {
			$responseArr[$index]['id'] = $group->$groupStructure['id'];
			$responseArr[$index]['name'] = $group->$groupStructure['name'];
			$index++;
		}

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
		$userId = Auth::user()->usr_id;
		$data = Input::json();

		$utils = UtilController::getInstance();
		$groupStructure = $utils->gStruct;

		$newGroup = new ContactsGroup;
		$newGroup->$groupStructure['userId'] = $userId;
		foreach ($data as $key => $value) {
			$newGroup->$groupStructure[$key] = $value;
		}

		$newGroup->save();
		if ($newGroup) {
			return Response::json($newGroup) ;
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
		//
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
		$groupStructure = $utils->gStruct;

		$editGroup = ContactsGroup::find($id);
		foreach ($data as $key => $value) {
			$editGroup->$groupStructure[$key] = $value;
		}

		$editGroup->save();
		if ($editGroup) {
			return Response::json($editGroup) ;
		}else
		{
			return Response::make("error", 500);
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
		$groupStructure = $utils->gStruct;

		$group = ContactsGroup::find($id);
	
		if ($group == null) {
			return Response::make('group doesnot exist', 400);
		}
		if ($group->$groupStructure['userId'] != $userId){
			return Response::make("Do not have access", 400);
		}
		ContactsGroup::destroy($id);
		return Response::make('success');
	}

}