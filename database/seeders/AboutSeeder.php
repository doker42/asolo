<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $about = About::all()->first();
        if (!$about) {
            About::create([
                    "about"     => "Hello! My name is Vitalii Chebotnikov, I have been doing web development for over 6 years. I mainly work on the backend, but sometimes I can perform simple tasks on the frontend using HTML, JavaScript, React, Vues. My main specialization is creating APIs for Laravel projects, integrating with third-party services, CRM systems, and mobile applications. I have experience writing applications from scratch, as well as supporting, customizing, and optimizing existing projects. I often had to deal with non-trivial
                tasks or solving atypical and non-standard problems. Contact us together we will solve any your problems. My current location is Bucharest (Romania)",
                    "email"     => "vit@gmail.com",
                    "git"       => "https://github.com",
                    "linkdin"   => "https://www.linkedin.com",
                    "telegram"  => "vit",
                    "letter_id" => null,
                    "image_id"  => null,
            ]);
        }
    }
}
