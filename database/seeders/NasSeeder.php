<?php

namespace Database\Seeders;

use App\Models\Nas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nas = [
            [
                'nasname' => '0.0.0.0/0',
                'shortname' => 'megalos',
                'type' => 'other',
                'ports' => 1700,
                'secret' => '1K614K9N',
                'server' => NULL,
                'community' => NULL,
                'description' => "RADIUS Client",
            ],
        ];

        foreach ($nas as $row) {
            $nas = new Nas();
            $nas->nasname = $row['nasname'];
            $nas->shortname = $row['shortname'];
            $nas->type = $row['type'];
            $nas->ports = $row['ports'];
            $nas->secret = $row['secret'];
            $nas->server = $row['server'];
            $nas->community = $row['community'];
            $nas->description = $row['description'];

            $nas->save();
        }
    }
}
