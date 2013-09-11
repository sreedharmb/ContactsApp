<?php

class ContactsGroupSeeder extends Seeder
{
	public function run(){
		$contactsGroup = array(
			'usr_ctg_id' => 1,
			'ctg_name' => 'family'
		);
		DB::table('contact_group')->insert($contactsGroup);

		$contactsGroup = array(
			'usr_ctg_id' => 1,
			'ctg_name' => 'friends'
		);
		DB::table('contact_group')->insert($contactsGroup);

		$contactsGroup = array(
			'usr_ctg_id' => 1,
			'ctg_name' => 'collegues'
		);
		DB::table('contact_group')->insert($contactsGroup);

		$contactsGroup = array(
			'usr_ctg_id' => 1,
			'ctg_name' => 'college buddies'
		);
		DB::table('contact_group')->insert($contactsGroup);
	}
}