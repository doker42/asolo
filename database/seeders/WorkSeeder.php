<?php

namespace Database\Seeders;

use App\Models\Work;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $works = Work::all();

        if (count($works)) {
            return;
        }

        DB::table('Works')->insert([
             [
                "id" => 1,
                "position"     => "full-stack web developer",
                "company_name" => "managerigs","company_link"=>"http://managerigs.com/",
                "resp"         => "Creation and customization of the site on php. Processing statistics the work of mining farms and visualising on the front-end. Creating programs for testing video adapters using Python.",
                "stack"        => "HTML, PHP, JS, Python",
                "start_date"   => "2018-05-01",
                "finish_date"  => "2018-12-01",
                "active"       => 1,
             ],
             [
                "id"           => 2 ,
                "position"     => "full-stack web developer",
                "company_name" => "mementia",
                "company_link" => "https:://mementia.com/",
                "resp"         => "Customization  and update Symphony, Magento, Odoo  projects",
                "stack"        => "PHP, JS, HTML, Python, Symphony, Magento2, Odoo",
                "start_date"   => "2018-12-01",
                "finish_date"  => "2020-11-01",
                "active"       => 1,
            ],
            [
                "id"           => 3,
                "position"     => "web developer",
                "company_name" => "leaditteam",
                "company_link" => "https://leaditteam.com/",
                "resp"         => "Customization of the Laravel project API. Integration with mobile applications. Optimization of query processing. Creation solutions on the front-end of the project on VueJS.",
                "stack"        => "PHP, Laravel, JS, Vue, Elasticsearch",
                "start_date"   => "2020-11-01",
                "finish_date"  => "2022-02-01",
                "active"       => 1,
            ],
            [
                "id"           => 4,
                "position"     => "back-end web developer",
                "company_name" => "sreda",
                "company_link" => "https://sereda.ai/",
                "resp"         => "Creation of API for the project from scratch on Laravel.Integration of the project with third-party services and CRM. Creation of a telegram bot for the project. Processing of statistical data.",
                "stack"        => "PHP, Laravel, API, Zoho CRM, Telegram bot",
                "start_date"   => "2022-03-01",
                "finish_date"  => "2024-05-01",
                "active"       => 1,
           ],
           [
                "id"           => 5,
                "position"     => "web developer",
                "company_name" => "freelance",
                "company_link" => null,
                "resp"         => "Performing tasks for the backend and frontend of Laravel projects. Code execution optimization. Bug fixing.",
                "stack"        => "PHP, Laravel, Bootstrap, JS",
                "start_date"   => "2024-05-01",
                "finish_date"  => null,
                "active"       => 1,
           ],
       ]);
    }
}
