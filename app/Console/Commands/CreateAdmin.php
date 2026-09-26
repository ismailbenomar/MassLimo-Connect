<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

#[Signature('app:create-admin {--name=} {--email=} {--password=}')]
#[Description('Create an administrator account')]
class CreateAdmin extends Command
{
    public function handle(): int
    {
        $name = $this->option('name') ?: $this->ask('Name');
        $email = $this->option('email') ?: $this->ask('Email');
        $password = $this->option('password') ?: $this->secret('Password');
        $user = User::updateOrCreate(['email' => $email], ['name' => $name, 'password' => Hash::make($password)]);
        $this->info("Administrator {$user->email} is ready.");

        return self::SUCCESS;
    }
}
