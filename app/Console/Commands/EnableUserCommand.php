<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class EnableUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:enable {email} {role}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enable users';

    /**
     * User model.
     *
     * @var User
     */
    private $user;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = $this->user->where('email', $this->argument('email'))->first();
        $user->role = $this->argument('role');
        $user->save();

        $this->info("O usuário ".$user->name.", foi ativado com sucesso!");
    }
}
