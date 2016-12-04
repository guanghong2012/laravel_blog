<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //命令行提示语
        $this->command->info(" create Admins loading ... ");
        //插入数据
        DB::table('admins')->insert([
            [
                'adm_name' => 'admin',
                'adm_password' => Hash::make("a1b2c3"),//哈希加密
            ]
        ]);

    }
}
