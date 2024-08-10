<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
/**
 * Author: Margaret Ossman
 * Additional Considerations for Development:
 * .env file should be updated to APP_ENV=local
 * .env file should be updated to APP_DEBUG=true
 * .env file should be updated to APP_URL=
 *  pest tests should be run
 */
class ClearOptimization extends Command
{
    protected $signature = 'optimize:clear-all';
    protected $description = 'Clear various caches and start development server';

    public function handle()
    {

        $this->info('Clearing Filament cached components...');
        Artisan::call('filament:optimize-clear');

        $this->info('Installing composer dependencies...');
        exec('composer install', $output, $returnVar);
        if ($returnVar !== 0) {
            $this->error('Composer install failed');
            return 1;
        }

        $this->info('Clearing application cache...');
        Artisan::call('optimize:clear');

        //This needs to run in a new PowerShell Termainal
    /*
        $this->info('Starting npm development server...');
        exec('npm run dev', $output, $returnVar);
        if ($returnVar !== 0) {
            $this->error('npm run dev failed');
            return 1;
        }
    */
        $this->info('Clear optimization script completed.');
        return 0;
    }
}
