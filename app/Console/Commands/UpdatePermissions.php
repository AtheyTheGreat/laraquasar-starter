<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class UpdatePermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        app()['cache']->forget('spatie.permission.cache');
        $routes = Route::getRoutes();
        foreach ($routes as $route) {
            if ($route->getName() == null) continue;
            $name = $route->getName();
            Permission::findOrCreate($name);
        }
        $this->info("Permission list updated");
    }
}
