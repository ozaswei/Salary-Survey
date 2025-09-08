<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalarySurveyController extends Controller
{
    public function salarySurveyFrontPage()
    {
        return view('salarySurvey.salarySurvey', [
            'results'  => false,
            'noJob'    => false,
            'job'      => old('job', ''),       // <— default
            'location' => old('location', ''),  // <— default
            'highest'  => null,
            'lowest'   => null,
            'average'  => null,
            'topJobs'  => [],
        ]);
    }
}
