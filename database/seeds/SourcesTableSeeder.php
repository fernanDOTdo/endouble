<?php

use Illuminate\Database\Seeder;
use App\Repositories\SourceRepository;

class SourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sources = new SourceRepository;
        $sources->refresh();
    }
}
