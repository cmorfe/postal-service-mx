<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LoadPostServiceData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post-service-data:load';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load post service data from file';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
      $this->info('hola');
    }
}
