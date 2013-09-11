<?php

class ContactSeeder extends Seeder
{
	public function run()
	{
		$contact = array(
			'ctg_cnd_id' => 2,
			'cnd_firstname' => 'sreedhar',
			'cnd_lastname' =>	'badrinath',
			'cnd_birthday' => '1990-01-01',
			'cnd_address' => 'indiranagar, bangalore',
			'cnd_company' => 'knolskape',
			'cnd_fb_id' => 'sreedhar.mb',
			'cnd_twitter_handle' => '@sreedharmb',
			'cnd_linkedIn_id' => 'sreedharmb',
			'cnd_skype_id' => 'sreedharmb',
			'cnd_website' => 'sreedharmb.blogspot.in',
			'cnd_is_favourite' => 1

		);
		DB::table('contact_detail')->insert($contact);

		$contact = array(
			'ctg_cnd_id' => 3,
			'cnd_firstname' => 'arun',
			'cnd_lastname' =>	'kumar',
			'cnd_birthday' => '1991-11-29',
			'cnd_address' => 'indiranagar, bangalore',
			'cnd_company' => 'knolskape',
			'cnd_is_favourite' => 1

		);

		DB::table('contact_detail')->insert($contact);
		$contact = array(
			'ctg_cnd_id' => 4,
			'cnd_firstname' => 'varuni',
			'cnd_lastname' =>	'ganeshan',
			'cnd_address' => 'domulur, bangalore',
			'cnd_company' => 'knolskape',
			
		);

		DB::table('contact_detail')->insert($contact);
		$contact = array(
			'ctg_cnd_id' => 5,
			'cnd_firstname' => 'sandeep',
			'cnd_lastname' =>	'bvnr',
			'cnd_birthday' => '01/01/1990',
			'cnd_address' => 'indiranagar, bangalore',
			'cnd_company' => 'knolskape',

		);

		DB::table('contact_detail')->insert($contact);
		$contact = array(
			'ctg_cnd_id' => 2,
			'cnd_firstname' => 'sreedhar',
			'cnd_lastname' =>	'mb',
			'cnd_birthday' => '1990-01-01',
			'cnd_address' => 'indiranagar, bangalore',
			'cnd_company' => 'knolskape',
			'cnd_fb_id' => 'sreedhar.mb',
			'cnd_twitter_handle' => '@sreedharmb',
			'cnd_linkedIn_id' => 'sreedharmb',
			'cnd_skype_id' => 'sreedharmb',
			'cnd_website' => 'sreedharmb.blogspot.in',
			'cnd_is_favourite' => 0

		);
		DB::table('contact_detail')->insert($contact);

	}

}