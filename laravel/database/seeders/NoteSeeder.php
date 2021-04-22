<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        $data = [
            [
                'quote_id' => 1,
                'secret' => false,
                'text' => 'Order should have a 5% discount',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'quote_id' => 1,
                'secret' => true,
                'text' => 'Their book keeper really annoys me! They have been sending me to voicemail.',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'quote_id' => 1,
                'secret' => false,
                'text' => 'This is a rush order',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'quote_id' => 2,
                'secret' => true,
                'text' => 'Order will have a $25 discount after finalized',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'quote_id' => 2,
                'secret' => false,
                'text' => 'Contact name is Hubert Farnsworth',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'quote_id' => 2,
                'secret' => true,
                'text' => 'OMG THESE GUYS ARE ACTUALLY MUTANTS',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'quote_id' => 3,
                'secret' => true,
                'text' => 'I wish we could charge extra for puke cleanup',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'quote_id' => 3,
                'secret' => false,
                'text' => 'Event runs March 16 through March 20',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'quote_id' => 3,
                'secret' => true,
                'text' => 'Diplo will be there this year!!',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
        ];
        \App\Models\Note::insert($data);
    }
}
