<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->command->info(" create Aiticles loading ... ");
        DB::table('articles')->insert([
            ['pid' => 1,
            'name'=> '文章1',
            'title' => '文章1',
            'content' => '这里是文章内容'],
            ['pid' => 1,
                'name'=> '文章2',
                'title' => '文章2',
                'content' => '这里是文章内容'],
        ]);
    }
}
