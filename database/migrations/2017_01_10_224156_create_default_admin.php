<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Migrations\Migration;

class CreateDefaultAdmin extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $user = User::create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ]);

        $user->roles()->attach(Role::all()->get(0)->id);
        $user->roles()->attach(Role::all()->get(1)->id);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        User::where('first_name', '=', 'admin')->forceDelete();
    }
}
