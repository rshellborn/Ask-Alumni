<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->createAlumniUsers();
        $this->createStudentUsers();

    }

    public function createAlumniUsers() {
        DB::table('users')->insert([
            "name" => "Rachel Shellborn",
            "email" => "rachel@shellborn.com",
            "role" => "admin",
            "permissions" => "admin",
            "active" => true,
            "password" => \Hash::make("rshellborn"),
            "bio" => "Currently in my second year at BCIT in the CST program, expected to graduate in June 2017.",
            'type' => "Alumni",
            'highSchool' => "Terry Fox Secondary School",
            'fields' => "Computer Science",
            'degrees' => "Diploma",
            'schools' => "British Columbia Institute of Technology",
            "inSchool" => true,
            "allowMessage" => true
        ]);

        DB::table('users')->insert([
            "name" => "Albert Robot",
            "email" => "arobot@askalumni.com",
            "role" => "admin",
            "permissions" => "user",
            "active" => true,
            "password" => \Hash::make("arobot"),
            "bio" => "Graduated from UBC with a Bachelors degree in Psychology and History, I also have my masters in Psych.",
            'type' => "Alumni",
            'highSchool' => "Gleneagle Secondary School",
            'fields' => "Psychology,Business,History",
            'degrees' => "Bachelors,Masters",
            'schools' => "Simon Fraser University,University of British Columbia",
            "inSchool" => false,
            "allowMessage" => true
        ]);

        DB::table('users')->insert([
            "name" => "Lindsey Smith",
            "email" => "lsmith@askalumni.com",
            "role" => "admin",
            "permissions" => "user",
            "active" => true,
            "password" => \Hash::make("lsmith"),
            "bio" => "In my first year at SFU studying medicine.",
            'type' => "Alumni",
            'highSchool' => "Riverside Secondary School",
            'fields' => "Medicine and Health Sciences",
            'degrees' => "Bachelors",
            'schools' => "Simon Fraser University",
            "inSchool" => true,
            "allowMessage" => true
        ]);

        DB::table('users')->insert([
            "name" => "Owen Martin",
            "email" => "omartin@askalumni.com",
            "role" => "admin",
            "permissions" => "user",
            "active" => true,
            "password" => \Hash::make("omartin"),
            "bio" => "Took a year off before starting post-secondary, but currently at Douglas studying sciences.",
            'type' => "Alumni",
            'highSchool' => "Pinetree Secondary School",
            'fields' => "Applied Sciences,Sciences,Physics",
            'degrees' => "Bachelors",
            'schools' => "Douglas College",
            "inSchool" => true,
            "allowMessage" => true
        ]);

        DB::table('users')->insert([
            "name" => "Suzanne Rose",
            "email" => "srose@askalumni.com",
            "role" => "admin",
            "permissions" => "user",
            "active" => true,
            "password" => \Hash::make("srose"),
            "bio" => "Switched my major a couple times because I keep changing my mind.",
            'type' => "Alumni",
            'highSchool' => "Heritage Woods Secondary School",
            'fields' => "Law,Arts,Philosophy,Humanities,Geography",
            'degrees' => "Bachelors",
            'schools' => "University of Victoria,Langara College,Douglas College",
            "inSchool" => true,
            "allowMessage" => true
        ]);
    }

    public function createStudentUsers() {
        DB::table('users')->insert([
            "name" => "Amy Evans",
            "email" => "aevans@askalumni.com",
            "role" => "admin",
            "permissions" => "user",
            "active" => true,
            "password" => \Hash::make("aevans"),
            'type' => "Student",
            'highSchool' => "Terry Fox Secondary School",
            'fields' => "Computer Science,Law,Psychology,Applied Sciences",
            'schools' => "British Columbia Institute of Technology,University of British Columbia,Kwantlen Polytechnic University,University of Victoria"
        ]);

        DB::table('users')->insert([
            "name" => "Daniel Simmons",
            "email" => "dsimmons@askalumni.com",
            "role" => "admin",
            "permissions" => "user",
            "active" => true,
            "password" => \Hash::make("dsimmons"),
            'type' => "Student",
            'highSchool' => "Port Moody Secondary School",
            'fields' => "Biology,Physics,Earth and Space Sciences,Sciences",
            'schools' => "University of the Fraser Valley,University of British Columbia,Douglas College,University of Victoria"
        ]);

        DB::table('users')->insert([
            "name" => "Christina Baker",
            "email" => "cbaker@askalumni.com",
            "role" => "admin",
            "permissions" => "user",
            "active" => true,
            "password" => \Hash::make("cbaker"),
            'type' => "Student",
            'highSchool' => "Centennial Secondary School",
            'fields' => "Arts,Languages and Literature,Performing Arts,Visual Arts",
            'schools' => "Langara College,Douglas College,Emily Carr University of Art and Design,University of Victoria"
        ]);

        DB::table('users')->insert([
            "name" => "Thomas Wood",
            "email" => "twood@askalumni.com",
            "role" => "admin",
            "permissions" => "user",
            "active" => true,
            "password" => \Hash::make("twood"),
            'type' => "Student",
            'highSchool' => "Terry Fox Secondary School",
            'fields' => "Sociology,Psychology,Philosophy",
            'schools' => "University of British Columbia,Douglas College,Simon Fraser University,University of Victoria"
        ]);
    }
}
