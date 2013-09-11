<?php

class UserPreference extends Eloquent{
	protected $table = 'user_preference';
	protected $primaryKey = 'upref_id';
	public $timestamps = false;

	/**
	 * structure of this model
	 * @var array
	 */
	public static $structure = array(
								'id' => 'upref_id',
								'userId' => 'usr_pref_id',
								'language' => 'upref_language',
								'country' => 'upref_country',
								'displayStyle' => 'upref_display_style',
								'selfContactId' => 'upref_personal_ctd_id',
								'displayName' => 'upref_display_name'
								);
	/**
	 * rules for this model
	 * @var array
	 */
	public static $rules = array(
		
	);
}