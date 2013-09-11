<?php

class ContactEmail extends Eloquent {
	protected $table = 'contact_email';
	protected $primaryKey = 'cte_id';
	public $timestamps = false;
	
	/**
	 * structure of the model in DB
	 * @var array
	 */
	public static $structure = array(
								'id' => 'cte_id',
								'contactId' => 'cnd_cte_id',
								'emailId' => 'cte_email_id',
								'tag' => 'cte_tag'
								);

	/**
	 * rules for the current model
	 * @var array
	 */
	public static $rules = array(
		
	);

	/**
	 * contact email - contact relation
	 * @return Contact [to which this email belongs to]
	 */
	public function contact()
	{
		return $this->belongsTo('Contact', 'cnd_cte_id');
	}

}