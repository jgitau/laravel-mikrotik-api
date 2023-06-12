<?php

namespace App\Jobs;

use App\Services\MikrotikApi\MikrotikApiService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchMikrotikDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ip;
    protected $username;
    protected $password;

    /**
     * Create a new job instance.
     * @return void
     */
    public function __construct($ip, $username, $password)
    {
        $this->ip = $ip;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Execute the job.
     * @return void
     */
    public function handle(MikrotikApiService $mikrotikApiService)
    {
        $result = $mikrotikApiService->getMikrotikUserActive($this->ip, $this->username, $this->password);

        // Save data to session
        session(['mikrotik_data' => $result]);
    }
}
