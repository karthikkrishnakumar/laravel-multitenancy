<?php

namespace App\Console\Commands;

use App\Models\CustomTenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     */
    public function handle()
    {
        if (CustomTenant::count() == 0) {
            for ($i = 0; $i <= 10; $i++) {
                $tenant = new CustomTenant();
                $tenant->name = 'tenant_' . $i;
                $tenant->domain = 'tenant_' . $i;
                $tenant->database = 'tenant_' . $i;
                $tenant->save();
            }
        }
        $tenants = CustomTenant::all();
        foreach ($tenants as $tenant) {
            Log::info($tenant->database);
            DB::statement("CREATE DATABASE `$tenant->database`");
        }
    }
}
