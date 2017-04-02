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
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Reece',
            'email' => 'admin@merrett.io',
            'password' => Hash::make('admin'),
        ]);

        $admin->roles()->attach(Role::all()->get(0)->id);
        $admin->roles()->attach(Role::all()->get(1)->id);

        $editor = User::create([
            'first_name' => 'Editor',
            'last_name' => 'Mary',
            'email' => 'editor@merrett.io',
            'password' => Hash::make('editor'),
        ]);

        $editor->roles()->attach(Role::all()->get(0)->id);

        User::create([
            'first_name' => 'User',
            'last_name' => 'John',
            'email' => 'user@merrett.io',
            'password' => Hash::make('user'),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        User::whereIn('email', ['admin@merrett.io', 'editor@merrett.io', 'user@merrett.io'])->forceDelete();
    }
}
