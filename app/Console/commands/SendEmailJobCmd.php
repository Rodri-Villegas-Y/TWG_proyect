<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\JobsEmail;
use App\Mail\LogCreate;
use Mail;

class SendEmailJobCmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:emailjob';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Triggers Emails Jobs';

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
    	echo "send:emailjob->begin".PHP_EOL;

        $jobs = JobsEmail::orderBy('queue', 'desc')->orderBy('id', 'asc')->get();

        foreach ($jobs as $job) {

            $payload = json_decode($job->payload, true);

            Mail::to($payload['email'])
                ->send(new logCreate($payload['data']));

            echo "send:emailjob->".$payload['email'].PHP_EOL;

            $job->delete();
        }
    
        echo "send:emailjob->end".PHP_EOL;
    }

}