<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Admin;
use Illuminate\Support\Facades\Hash;

class AddAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $admin = [

            'name' => 'Rahim Ahmed',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(12345),
            'phone' => '12345',
            'email_verified_at' => now()
        ];

        Admin::create($admin);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
