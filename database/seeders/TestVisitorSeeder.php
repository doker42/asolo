<?php

namespace Database\Seeders;

use Database\Factories\VisitorFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestVisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $factory = new VisitorFactory();
        $factory->count(50)->create();
    }
}
