<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LineItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Schema:
        Schema::create('line_items', function (Blueprint $table) {
            $table->id();
            $table->integer('quote_id');
            $table->string('description');
            $table->integer('quantity');
            $table->timestamps();
        });
        */
        DB::table('line_items')->insert([
            [
                'quote_id' => 1,
                'description' => 'Cellular tower repair',
                'price' => 30000.00,
                'quantity' => 1
            ],
            [
                'quote_id' => 1,
                'description' => 'Phone line respooling',
                'price' => 1234.56,
                'quantity' => 1
            ],
            [
                'quote_id' => 1,
                'description' => 'Switchboard cleaning',
                'price' => 666.66,
                'quantity' => 1
            ],
            [
                'quote_id' => 2,
                'description' => 'Toxic sludge removal',
                'price' => 1,
                'quantity' => 1
            ],
            [
                'quote_id' => 2,
                'description' => 'Excess body part disposal',
                'price' => 50,
                'quantity' => 30
            ],
            [
                'quote_id' => 2,
                'description' => 'Nuclear reactor refueling',
                'price' => 750000.00,
                'quantity' => 2
            ],
            [
                'quote_id' => 3,
                'description' => 'Arts and crafts cleanup',
                'price' => 30,
                'quantity' => 5
            ],
            [
                'quote_id' => 3,
                'description' => 'Musical instruments repair',
                'price' => 100,
                'quantity' => 100
            ],
            [
                'quote_id' => 3,
                'description' => 'Fairgrounds trash removal',
                'price' => 3500,
                'quantity' => 7
            ],
        ]);
    }
}
