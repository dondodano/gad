<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SystemDeploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy:now';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Signify that the system is deployed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dirList = ['attachment', 'avatar', 'backups', 'backup-temp', 'images', 'media', 'temp'];
        $dirRoot = storage_path('app/public/');
        foreach($dirList as $dirItem)
        {
            if(!is_dir($dirRoot . $dirItem))
            {
                mkdir($dirRoot . $dirItem);
            }
        }

        $path = storage_path('framework/') . 'production';
        if(file_exists( $path))
        {
            unlink($path);
            writeFile($path,'true');

        }else{
            writeFile($path,'true');
        }

        $this->info('System deployed!');
    }
}
