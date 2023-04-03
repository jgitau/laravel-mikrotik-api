<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
  public function run()
  {
    $datas = [
      [
        'name' => 'Full Administrator',
      ],
      [
        'name' => 'Operator',
      ]
    ];

    foreach ($datas as $data) {
      $data = new Group();
      $data->name = $data['name'];
      $data->save();
    }
  }
}
