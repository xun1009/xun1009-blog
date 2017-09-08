<?php

namespace App\Console\Commands;

use App\Role;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:admin';

    /**
     * The console command description.
     *
     * @var string
     *
     */
    protected $description = 'create or delete a admin  ,if this project has not a admin this admin will be the owner';

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
        $name = $this->ask('name');
        $password = $this->ask('password');
        $data = [
            'name' => $name,
            'password' => $password,
        ];
        $validator = Validator::make($data, [
            'name' => 'required|max:255|unique:users',
            'password' => 'required|min:6',
        ]);

        if (!$validator->passes()) {
            throw new \RuntimeException($validator->errors()->first());
        }

        $user = $this->createAdmin($data);

        if(User::all()->count() == 1){
            $owner = Role::where('name','owner')->first();
            $user->attachRole($owner);
        }else{
            $admin = Role::where('name','admin')->first();
            $user->attachRole($admin);
        }
    }

    public function createAdmin($data)
    {
        return User::create([
            'name' => $data['name'],
            'password' => bcrypt($data['password']),
            'is_active' => 1,
            'avatar' => config('xun.avatar'),
            'api_token' => str_random(60),
        ]);
    }
}
