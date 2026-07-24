<?php

namespace Database\Seeders;

use App\Models\OrderStage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stages = [
            ['name' => 'Ready to Deliver', 'sort_order' => 1],
            ['name' => 'In Transit', 'sort_order' => 2],
            ['name' => 'Order Complete', 'sort_order' => 3],
        ];

        foreach ($stages as $stage) {
            OrderStage::updateOrCreate(['name' => $stage['name']], ['sort_order' => $stage['sort_order']]);
        }
    }
}
