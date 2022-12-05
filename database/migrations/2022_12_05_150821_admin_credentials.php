<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert(
            array(
                'id'=> '1',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'scope' => 'admin',
                'user_status_id' => '1',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            )
            );
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
};
