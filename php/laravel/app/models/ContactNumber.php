<?php

class ContactNumber extends Eloquent {
	protected $table = 'contact_number';
	protected $primaryKey = 'ctn_id';
	public $timestamps = false;


	/**
	 * structure of this model
	 * @var array
	 */
	public static $structure = array(
								'id' => 'ctn_id',
								'contactId' => 'cnd_ctn_id',
								'number' => 'ctn_number',
								'tag' => 'ctn_tag'
								);

	/**
	 * Rules for the model
	 * @var array
	 */
	public static $rules = array(
		
	);

	/**
	 * contact numbers - contact relation
	 * @return Contact [to which this number belongs to]
	 */
	public function contact()
	{
		return $this->belongsTo('Contact', 'cnd_ctn_id');
	}


}