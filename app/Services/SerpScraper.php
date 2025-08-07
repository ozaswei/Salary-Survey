<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SerpScraper
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.serpapi.key');
    }

    public function getGoogleJobs($jobTitle, $location)
    {
        $response = Http::get('https://serpapi.com/search', [
            'engine' => 'google_jobs',
            'q' => $jobTitle,
            'location' => $location,
            'api_key' => $this->apiKey,
        ]);

        if ($response->ok()) {
            return $response->json();
        }

        return ['error' => $response->body()];
    }

    public function getLinkedInJobs($jobTitle, $location)
    {
        $response = Http::get('https://serpapi.com/search', [
            'engine' => 'linkedin_jobs',
            'q' => $jobTitle,
            'location' => $location,
            'api_key' => $this->apiKey,
        ]);

        if ($response->ok()) {
            return $response->json();
        }

        return ['error' => $response->body()];
    }
}
