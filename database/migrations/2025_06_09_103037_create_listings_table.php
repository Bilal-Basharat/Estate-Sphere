<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('beds')->default(0);
            $table->unsignedTinyInteger('baths')->default(0);
            $table->unsignedSmallInteger('area')->default(0);

            $table->tinyText('city')->default('');
            ;
            $table->tinyText('code')->default('');
            ;
            $table->tinyText('street')->default('');
            ;
            $table->tinyText('street_nr')->default('');
            ;

            $table->unsignedInteger('price')->default(0);
            ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('listings', [
            'beds',
            'baths',
            'area',
            'city',
            'code',
            'street',
            'street_nr',
            'price'
        ]);
    }
};
