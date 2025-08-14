<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;


class fetchDashboardCount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $url;
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $response = Http::get($this->url);
        // Optionally, handle the response, log it, or store it in the database
        if ($response->successful()) {
            $data = $response->json();
            Cache::put('dashboard_data', $data, now()->addMinutes(5));

            // Log or process the successful response
            \Log::info('User count data fetched successfully.', ['data' => $response->json()]);
        } else {
            // Handle the failure (e.g., log an error)
            \Log::error('Failed to fetch user count data.', ['status' => $response->status()]);
        }
    }
}
