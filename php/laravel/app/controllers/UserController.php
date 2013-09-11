<?php
class UserController extends BaseController
{
	public function storeUser()
	{
		$data = Input::json()->all();

		$utils = UtilController::getInstance();
		
		$userPrefStruct = $utils->upStruct;

		// User::create(array(
		// 	'usr_email' => $data['email'],
		// 	'usr_password' => Hash::make($data['password'])
		// 	));
		
		$user = new User;
		$user->usr_email = $data['email'];
		$user->usr_password = Hash::make($data['password']);

		$user->save();
		if($user)
		{
			$userPreference = new UserPreference;
			$userPreference->$userPrefStruct['userId'] = $user->usr_id;
			$userPreference->$userPrefStruct['displayName'] = $data['email'];
			$userPreference->save();
		}

		return $user;
	}

	public function updateUserPreference()
	{
		$userId = Auth::user()->usr_id;
		$data = Input::json()->all();
		$utils = UtilController::getInstance();
		
		$userPrefStruct = $utils->upStruct;
		$userPref = UserPreference::where($userPrefStruct['userId'], '=', $userId)->first();
		
		foreach ($data as $key => $value) {
			$userPref->$userPrefStruct[$key] = $value;
		}
		
		$userPref->save();
		return Response::json($userPref);
		
	}

	public function showUserPreference()
	{
		$userId = Auth::user()->usr_id;
		
		$utils = UtilController::getInstance();
		
		$userPrefStruct = $utils->upStruct;
		$userPref = UserPreference::where($userPrefStruct['userId'], '=', $userId)->first();

		foreach ($userPrefStruct as $key => $value) {
			if ($userPref->$value !== null) {
				$responseArr[$key] = $userPref->$value;
			}
		}

		return Response::json($responseArr);
	}

	public function deleteUser($id)
	{
		$userId = Auth::user()->user_id;
		if ($id != $userId) {
			return Response::make('User not authenticated', 400);
		}

		try {
			User::destroy($id);
		} catch (Exception $e) {
			return Response::make($e->getMessage(), 400);
		}

		return Response::make('success');
	}
}