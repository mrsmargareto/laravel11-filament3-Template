<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

/**
 * Author: Margaret Ossman
 * Additional Considerations for Production:
 * .env file should be updated to APP_ENV=production
 * .env file should be updated to APP_DEBUG=false
 * .env file should be updated to APP_URL=https://yourdomain.com
 *
 */

class OptimizeApplication extends Command
{
    protected $signature = 'optimize:all';
    protected $description = 'Optimize application for production';

    public function handle()
    {
        $this->info('Installing composer dependencies without dev packages...');
        exec('composer install --no-dev', $output, $returnVar);
        if ($returnVar !== 0) {
            $this->error('Composer install --no-dev failed');
            return 1;
        }

        $this->info('Optimizing the application...');
        Artisan::call('optimize');
        
        //This command will cache the Filament components and additionally the Blade icons
        $this->info('Caching Filament components...');
        Artisan::call('filament:optimize');

        //This needs to run in a new PowerShell Termainal
        /*
        $this->info('Building production assets...');
        exec('npm run build', $output, $returnVar);
        if ($returnVar !== 0) {
            $this->error('npm run build failed');
            return 1;
        }
        */
        
        $this->info('Optimization script completed.');
        return 0;
    }
}
