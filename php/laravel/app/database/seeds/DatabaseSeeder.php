<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('CTagSeeder');
		$this->call('ContactsGroupSeeder');
		$this->call('ContactSeeder');
		$this->call('ContactNumberSeeder');
		$this->call('ContactEmailSeeder');
	}

}