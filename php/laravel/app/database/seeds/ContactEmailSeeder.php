<?php

class ContactEmailSeeder extends Seeder
{
	public function run()
	{
		$email = array(
			'cnd_cte_id' => 1,
			'cte_email_id' => 'sreedhar.badim@gmail.com',
			'cte_tag' => 'home'
		);
		DB::table('contact_email')->insert($email);

		$email = array(
			'cnd_cte_id' => 1,
			'cte_email_id' => 'sreedhar.badrinath@knolskape.com',
			'cte_tag' => 'work'
		);
		DB::table('contact_email')->insert($email);

		$email = array(
			'cnd_cte_id' => 2,
			'cte_email_id' => 'arun.kumar@knolskape.com',
			'cte_tag' => 'work'
		);
		DB::table('contact_email')->insert($email);
	}
}