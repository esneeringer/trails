<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\TrailService as TrailService;
use App\Trail as Trail;

class TrailUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $name;

    protected $status;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name, $status)
    {
        $this->name = $name;
        $this->status = $status;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Trail::where('name', $this->name)
            ->update(['status' => $this->status]);
    }
}
