<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertSouthAmericanCurrencies extends Migration
{
    public function up() {
        DB::table('currencies')->insert([
            [
                'name' => 'Brazilian Real',
                'code' => 'BRL',
                'symbol' => 'R$'
            ]
        ]);
    }

    public function down() {
        //
    }
}
