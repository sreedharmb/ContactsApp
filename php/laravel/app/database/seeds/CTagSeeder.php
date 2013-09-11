<?php

class CTagSeeder extends Seeder
{
	public function run()
	{
		$ctag = array(
			'ctag_name' => 'home'
		);
		DB::table('contact_def_tag')->insert($ctag);

		$ctag = array(
			'ctag_name' => 'work'
		);
		DB::table('contact_def_tag')->insert($ctag);

		$ctag = array(
			'ctag_name' => 'mobile'
		);
		DB::table('contact_def_tag')->insert($ctag);

	}
}