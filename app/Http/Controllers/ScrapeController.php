<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SerpScraper;

class ScrapeController extends Controller
{
    protected $scraper;

    public function __construct(SerpScraper $scraper)
    {
        $this->scraper = $scraper;
    }

    private function convertToAnnualCAD($salaryString)
    {
        $salaryString = strtolower(str_replace(',', '', $salaryString));

        if (str_contains($salaryString, '/hr') || str_contains($salaryString, 'hour')) {
            preg_match_all('/\d+(?:\.\d+)?/', $salaryString, $matches);
            $hourly = array_map('floatval', $matches[0]);
            $average = count($hourly) === 2 ? array_sum($hourly) / 2 : $hourly[0] ?? 0;
            return round($average * 40 * 52); // 40 hours/week, 52 weeks
        }

        preg_match_all('/\d+(?:\.\d+)?k|\d+(?:,\d+)?(?:\.\d+)?/', $salaryString, $matches);
        $salariesRaw = $matches[0];

        $cleaned = array_map(function ($s) {
            $s = str_replace(',', '', strtolower($s));
            return str_contains($s, 'k') ? floatval($s) * 1000 : floatval($s);
        }, $salariesRaw);

        $average = count($cleaned) === 2 ? array_sum($cleaned) / 2 : $cleaned[0] ?? 0;
        return round($average);
    }

    public function scrape(Request $request)
    {
        $request->validate([
            'job' => 'required|string',
            'location' => 'required|string',
        ]);

        $job = $request->input('job');
        $location = $request->input('location');

        $googleResults = $this->scraper->getGoogleJobs($job, $location);

        $salaries = [];

        if (!empty($googleResults['jobs_results'])) {
            foreach ($googleResults['jobs_results'] as $jobResult) {
                $salaryString = $jobResult['detected_extensions']['salary'] ?? $jobResult['description'] ?? null;
                if ($salaryString) {
                    $annualSalary = $this->convertToAnnualCAD($salaryString);
                    if ($annualSalary > 5000 && $annualSalary < 500000) {
                        $salaries[] = $annualSalary;
                    }
                }
            }
        }

        $highest = count($salaries) ? max($salaries) : null;
        $lowest  = count($salaries) ? min($salaries) : null;
        $average = count($salaries) ? round(array_sum($salaries) / count($salaries)) : null;
        //if no jobs
        $noJob = empty($googleResults['jobs_results']);

        //finding the top 5 jobs 
        $topJobs = [];

        if (!empty($googleResults['jobs_results'])) {
            foreach (array_slice($googleResults['jobs_results'], 0, 5) as $jobResult) {
                $topJobs[] = [
                    'title' => $jobResult['title'] ?? 'N/A',
                    'company' => $jobResult['company_name'] ?? 'Unknown',
                    'link' => $jobResult['share_link'] ?? '#',
                ];
            }
        }
        $results = true;

        return view('salarySurvey.salarySurvey', compact(
            'job',
            'location',
            'results',
            'highest',
            'lowest',
            'average',
            'googleResults',
            'noJob',
            'topJobs'
        ));
    }
}
