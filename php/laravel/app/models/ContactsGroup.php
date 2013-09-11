<?php

class ContactsGroup extends Eloquent{
	protected $table = 'contact_group';
	protected $primaryKey = 'ctg_id';
	public $timestamps = false;
	
	/**
	 * structure of this table
	 * @var array
	 */
	public static $structure = array(
								'id' => 'ctg_id', 
								'userId' => 'usr_ctg_id',
								'name' => 'ctg_name'
								);
	/**
	 * rules for the model
	 * @var array
	 */
	public static $rules = array(
		
	);

	/**
	 * contacts group - user relation 
	 * @return User [to which this contact group belongs to]
	 */
	public function user()
	{
		return $this->belongsTo('User', 'usr_ctg_id');
	}

	/**
	 * contact groups - contacts relation
	 * @return array [of contacts]
	 */
	public function contacts()
	{
		return $this->hasMany('Contact', 'ctg_cnd_id');
	}

}