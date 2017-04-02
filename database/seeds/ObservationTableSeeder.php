<?php

use App\Models\Behaviour;
use App\Models\Observation;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class ObservationTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $students = Student::all();
        $users = User::all();
        $behaviour = Behaviour::all();
        $faker = \Faker\Factory::create();

        foreach (range(0, 10) as $number) {
            Observation::create([
                'student_id' => $students[rand(0, count($students) - 1)]->id,
                'user_id' => $users[rand(0, count($users) - 1)]->id,
                'behaviour_id' => $behaviour[rand(0, count($behaviour) - 1)]->id,
                'notes' => $faker->sentences(2, true)
            ]);
        }
    }
}