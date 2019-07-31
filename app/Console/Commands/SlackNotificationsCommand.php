<?php

namespace App\Console\Commands;

use App\Models\Job;
use Illuminate\Console\Command;

class SlackNotificationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slack:notify {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify users on slack';

    /**
     * Job.
     *
     * @var Job
     */
    private $job;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Job $job)
    {
        $this->job = $job;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $type = $this->argument('type');

        if ($type == 'company') {
            $this->company();
        }
    }

    /**
     * Company
     *
     * @return mixed
     */
    public function company()
    {
        $jobs = $this->job->with('user')->whereHas('proposals', function($query) {
            $query->where('status', 'accepted');
        })->get();


        foreach($jobs as $job) {
            try {
                \Slack::to('@'.$job->user->slack_user)->send($job->user->name.", o seu trabalho \"<".url("/user/proposal/job/{$job->id}"."|".$job->title.">")."\" tem atividades recentes de freelancers.");
                $this->info("O usuário ".$job->user->name.", foi notificado com sucesso!");
            } catch(\Exception $ex) {

            }
        }
    }
}
