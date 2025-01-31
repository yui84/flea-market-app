<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            [
                'user_id' => '1',
                'state_id' => '1',
                'image' => 'storage/ItemImages/Clock.jpg',
                'name' => '腕時計',
                'detail' => 'スタイリッシュなデザインのメンズ腕時計',
                'price' => '15000'
            ],
            [
                'user_id' => '1',
                'state_id' => '2',
                'image' => 'storage/ItemImages/Disk.jpg',
                'name' => 'HDD',
                'detail' => '高速で信頼性の高いハードディスク',
                'price' => '5000'
            ],
            [
                'user_id' => '1',
                'state_id' => '3',
                'image' => 'storage/ItemImages/Onion.jpg',
                'name' => '玉ねぎ3束',
                'detail' => '新鮮な玉ねぎ3束のセット',
                'price' => '300'
            ],
            [
                'user_id' => '1',
                'state_id' => '4',
                'image' => 'storage/ItemImages/Shoes.jpg',
                'name' => '革靴',
                'detail' => 'クラシックなデザインの革靴',
                'price' => '4000'
            ],
            [
                'user_id' => '1',
                'state_id' => '1',
                'image' => 'storage/ItemImages/Computer.jpg',
                'name' => 'ノートPC',
                'detail' => '高性能なノートパソコン',
                'price' => '45000'
            ],
            [
                'user_id' => '1',
                'state_id' => '2',
                'image' => 'storage/ItemImages/Microphone.jpg',
                'name' => 'マイク',
                'detail' => '高温性のレコーディング用マイク',
                'price' => '8000'
            ],
            [
                'user_id' => '1',
                'state_id' => '3',
                'image' => 'storage/ItemImages/Bag.jpg',
                'name' => 'ショルダーバッグ',
                'detail' => 'おしゃれなショルダーバッグ',
                'price' => '3500'
            ],
            [
                'user_id' => '1',
                'state_id' => '4',
                'image' => 'storage/ItemImages/Tumbler.jpg',
                'name' => 'タンブラー',
                'detail' => '使いやすいタンブラー',
                'price' => '500'
            ],
            [
                'user_id' => '1',
                'state_id' => '1',
                'image' => 'storage/ItemImages/Coffeemill.jpg',
                'name' => 'コーヒーミル',
                'detail' => '手動のコーヒーミル',
                'price' => '4000'
            ],
            [
                'user_id' => '1',
                'state_id' => '2',
                'image' => 'storage/ItemImages/Cosmetics.jpg',
                'name' => 'メイクセット',
                'detail' => '便利なメイクアップセット',
                'price' => '2500'
            ]
        ]);
    }
}
