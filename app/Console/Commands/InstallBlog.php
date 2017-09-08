<?php

namespace App\Console\Commands;

use App\Permission;
use App\Role;
use Illuminate\Console\Command;

class InstallBlog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'if you first run this project you should execute this command ';

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
     * @return mixed
     */
    public function handle()
    {
        //
        $this->execShellWithPrettyPrint('php artisan key:generate');
        $this->execShellWithPrettyPrint('php artisan migrate');
        //角色权限初始化
        $this->InitEntrust();
    }

    public function execShellWithPrettyPrint($command)
    {
        $this->info('---');
        $this->info($command);
        $output = shell_exec($command);
        $this->info($output);
        $this->info('---');
    }

    public function InitEntrust()
    {
        $this->createRole();
    }

    public function createRole()
    {
        $admin = new Role();
        $admin->name = 'admin';
        $admin->save();

        $owner = new Role;
        $owner->name = 'owner';
        $owner->save();

        $owner = new Role;
        $owner->name = 'vip';
        $owner->save();

        $owner = new Role;
        $owner->name = 'ordinary';
        $owner->save();

    }
}
