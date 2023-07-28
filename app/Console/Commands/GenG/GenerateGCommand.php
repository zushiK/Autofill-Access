<?php

namespace App\Console\Commands\GenG;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Command;

class GenerateGCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:gen {model : model includes path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Controller & Service & Repository & Model (php artisan make:gen Admin/Test)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $m = $this->argument("model");
        $split = explode("/", $m);
        $model = $split[count($split) - 1];
        echo "Model Name : " . $model;

        Artisan::call('make:custom-controller', ['name' => $m . "Controller", '--model' => $model]);
        echo Artisan::output();
        // $this->error(str_replace(array("\r\n", "\r", "\n"), '', Artisan::output()));

        Artisan::call('make:service', ['name' => $m . "Service", '--model' => $model]);
        echo Artisan::output();
        // $this->error(str_replace(array("\r\n", "\r", "\n"), '', Artisan::output()));

        Artisan::call('make:repository', ['name' => $m . "Repository", '--model' => $model]);
        echo Artisan::output();
        // $this->error(str_replace(array("\r\n", "\r", "\n"), '', Artisan::output()));

        Artisan::call('make:custom-model', ['name' => $m]);
        echo Artisan::output();
        // $this->error(str_replace(array("\r\n", "\r", "\n"), '', Artisan::output()));

        Artisan::call('make:request', ['name' => $m . "Request"]);
        echo Artisan::output();
        // $this->error(str_replace(array("\r\n", "\r", "\n"), '', Artisan::output()));

        Artisan::call('make:resource', ['name' => $m . "Resource"]);
        echo Artisan::output();
        // $this->error(str_replace(array("\r\n", "\r", "\n"), '', Artisan::output()));

        $this->info("Genarate Successfully!");
    }
}
