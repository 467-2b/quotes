<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Schema:
        
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->integer('quote_id');
            $table->boolean('secret');
            $table->text('text');
            $table->timestamps();
            $table->foreign('quote_id')->references('id')->on('quotes');
        });
        */
        DB::table('notes')->insert([
            [
                'quote_id' => 1,
                'secret' => false,
                'text' => 'Order should have a 5% discount',
            ],
            [
                'quote_id' => 1,
                'secret' => true,
                'text' => 'Their book keeper really annoys me! They have been sending me to voicemail.',
            ],
            [
                'quote_id' => 1,
                'secret' => false,
                'text' => 'This is a rush order',
            ],
            [
                'quote_id' => 2,
                'secret' => true,
                'text' => 'Order will have a $25 discount after finalized',
            ],
            [
                'quote_id' => 2,
                'secret' => false,
                'text' => 'Contact name is Hubert Farnsworth',
            ],
            [
                'quote_id' => 2,
                'secret' => true,
                'text' => 'OMG THESE GUYS ARE ACTUALLY MUTANTS',
            ],
            [
                'quote_id' => 3,
                'secret' => true,
                'text' => 'I wish we could charge extra for puke cleanup',
            ],
            [
                'quote_id' => 3,
                'secret' => false,
                'text' => 'Event runs March 16 through March 20',
            ],
            [
                'quote_id' => 3,
                'secret' => true,
                'text' => 'Diplo will be there this year!!',
            ],
        ]);
    }
}
