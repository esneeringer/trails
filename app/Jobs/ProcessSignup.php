<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Email as Email;

class ProcessSignup implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $list;
    protected $referrer;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $list, $referrer)
    {
        //
        $this->email = $email;
        $this->list = $list;
        $this->referrer = $referrer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $email = new Email;

        $email->email = $this->email;
        $email->list = $this->list;
        $email->referrer = $this->referrer;

        $email->save();

    }
}
