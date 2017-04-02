<?php

use App\Models\BehaviourCategory;
use Illuminate\Database\Seeder;
use App\Models\Behaviour;

class BehaviourTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        BehaviourCategory::create([
            'description' => 'Good Manners',
        ]);
        BehaviourCategory::create([
            'description' => 'Teamwork',
        ]);
        BehaviourCategory::create([
            'description' => 'Compassion',
        ]);

        Behaviour::create([
            'description' => 'Politeness',
            'behaviour_category_id' => 1,
        ]);
        Behaviour::create([
            'description' => 'Picked up rubbish',
            'behaviour_category_id' => 1,
        ]);
        Behaviour::create([
            'description' => 'Working together to solve a problem',
            'behaviour_category_id' => 2,
        ]);
    }
}
