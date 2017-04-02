<?php

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(Student::class, 800)->create();
    }

}