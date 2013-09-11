<?php

class CTag extends Eloquent{
	protected $table = 'contact_def_tag';
	protected $primaryKey = 'ctag_id';
	public $timestamps = false;

	/**
	 * structurre of this model
	 * @var array
	 */
	public static $structure = array(
								'id' => 'ctag_id',
								'name' => 'ctag_name'
								);
	/**
	 * rules for this model
	 * @var array
	 */
	public static $rules = array(
		
	);
}