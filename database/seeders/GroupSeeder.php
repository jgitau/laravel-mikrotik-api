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
        'id' => 1,
        'name' => 'Full Administrator',
      ],
      [
        'id' => 2,
        'name' => 'Operator',
      ]
    ];

    foreach ($datas as $data) {
      $group = new Group();
      $group->id = $data['id'];
      $group->name = $data['name'];
      $group->save();
    }
  }
}
