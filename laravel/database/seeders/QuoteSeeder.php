<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Schema:
            $table->id();
            $table->integer('customer_id');
            $table->integer('associate_id');
            $table->enum('status', ["unfinalized", "finalized", "sanctioned", "processed"])->default('unfinalized');
            $table->string('customer_name');
            $table->decimal('discount_amount', 9, 2)->default(0.0);
            $table->decimal('discount_percent', 2, 0)->default(0.0);
            $table->decimal('total_amount', 9, 2)->default(0.0);
            $table->decimal('commission_percent', 2, 0)->default(0.0);
            $table->timestamps();
            $table->foreign('associate_id')->references('id')->on('users');
        */
        $data = [
            [
                'customer_id' => 6,
                'associate_id' => 2,
                'status' => 'sanctioned',
                'customer_name' => 'Bell South',
                'customer_email' => 'bookkeeper@bellsouth.net',
                'discount_amount' => 0.0,
                'discount_percent' => 05,
                'total_amount' => 123.45,
                'created_at' => \Carbon\Carbon::now()->subtract(5,'day'),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'customer_id' => 21,
                'associate_id' => 2,
                'status' => 'finalized',
                'customer_name' => 'Excelsior Mutants',
                'customer_email' => 'van@celsius.net',
                'discount_amount' => 25.00,
                'discount_percent' => 0,
                'total_amount' => 234.56,
                'created_at' => \Carbon\Carbon::now()->subtract(3,'day'),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'customer_id' => 18,
                'associate_id' => 2,
                'status' => 'unfinalized',
                'customer_name' => 'South by Southwest',
                'customer_email' => 'bookkeeper@sxsw.com',
                'discount_amount' => 0.0,
                'discount_percent' => 0,
                'total_amount' => 0.0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
        ];
        \App\Models\Quote::insert($data);
    }
}
