<?php

namespace Database\Seeders;

use App\Models\Info;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $info = Info::all()->first();
        if (!$info) {
            Info::create([
                'skills'          => 'HTML / CSS / basic JS / MySQL / PHP / Bootstrap / Git / Elasticsearch / GraphQL / Docker',
                'libraries'       => 'PHP, Laravel, basic knowledge in JS, start knowledge in Python,',
                'tools'           => 'PHPStrom, VSC, DockerDesctop, OpenServer',
                'systems'         => 'Windows, Linux',
                'education'       => 'Kharkiv Aviation Engineering School, Communications Engineer, Specialist. Organization of digital communication equipment operation.',
                'additional_edc'  => '“Step” IT Academy":  "WebDevelopment  (HTML/CSS/Bootstrap/JS/JQuery/MySQL/PHP/Lavarel/Vue.js/AWS)","Self-education":  "Java/WebDriver (2016-2017, 5 months) "',
                'languages'       => [
                    'English' => 'pre-intermediate',
                    'Ukraine' => 'native'
                ],
                'phone_a'         => '+380995259112',
                'phone_b'         => '+40742309624',
            ]);
        }
    }
}
