<?php

class Contact extends Eloquent {
	protected $table = 'contact_detail';
	protected $primaryKey = 'cnd_id';
	public $timestamps = false;

	/**
	 * structure of model in db
	 * @var array
	 */
	public static $structure = array(
						'id' => 'cnd_id',
						'groupId' => 'ctg_cnd_id',
						'firstname' => 'cnd_firstname',
						'lastname' => 'cnd_lastname',
						'birthday' => 'cnd_birthday',
						'address' => 'cnd_address',
						'company' => 'cnd_company',
						'fbId' => 'cnd_fb_id',
						'twitterHandle' => 'cnd_twitter_handle',
						'linkedinId' => 'cnd_linkedIn_id',
						'skypeId' => 'cnd_skype_id',
						'website' => 'cnd_website',
						'isFavourite' => 'cnd_is_favourite',
						'isTrashed' => 'cnd_is_trashed',
						'image' => 'cnd_image'
						);

	/**
	 * Rules for the Contact model
	 * @var array
	 */
	public static $rules = array(
		
	);

	/**
	 * contact - cotact number relation
	 * @return array [of the phone number this contact has]
	 */
	public function numbers()
	{
		return $this->hasMany('ContactNumber', 'cnd_ctn_id');
	}

	/**
	 * contact - contact emails relation
	 * @return array [of the emails this contact has]
	 */
	public function emails()
	{
		return $this->hasMany('ContactEmail', 'cnd_cte_id');
	}

	/**
	 * contact - contact group relation
	 * @return ContactsGroup [to which this contact belongs to]
	 */
	public function group()
	{
		return $this->belongsTo('ContactsGroup', 'ctg_cnd_id');
	}

}