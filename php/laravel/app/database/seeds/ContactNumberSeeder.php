<?php

class ContactNumberSeeder extends Seeder
{
	public function run()
	{
		$number = array(
			'cnd_ctn_id' => 1,
			'ctn_number' => '7411363836',
			'ctn_tag' => 'work'
		);
		DB::table('contact_number')->insert($number);

		$number = array(
			'cnd_ctn_id' => 1,
			'ctn_number' => '9790104896',
			'ctn_tag' => 'home'
		);
		DB::table('contact_number')->insert($number);

		$number = array(
			'cnd_ctn_id' => 2,
			'ctn_number' => '7777777777',
			'ctn_tag' => 'work'
		);
		DB::table('contact_number')->insert($number);
		
		$number = array(
			'cnd_ctn_id' => 3,
			'ctn_number' => '7466666866',
			'ctn_tag' => 'work'
		);
		DB::table('contact_number')->insert($number);
		
		$number = array(
			'cnd_ctn_id' => 4,
			'ctn_number' => '7411333838',
			'ctn_tag' => 'work'
		);
		DB::table('contact_number')->insert($number);
		
		$number = array(
			'cnd_ctn_id' => 5,
			'ctn_number' => '7411363838',
			'ctn_tag' => 'work'
		);
		DB::table('contact_number')->insert($number);
		


	}

}