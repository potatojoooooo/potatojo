<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $eventCategories = $this->eventMetrics();
        $eventCounts = $this->eventsOverTime();
        $durations = $this->eventDurationAnalysis();
        return view('analysis.index', compact('eventCategories', 'eventCounts', 'durations'));
    }

    // pie chart DONE
    public function eventMetrics()
    {
        $eventCategories = Event::join('categories', 'events.category_id', '=', 'categories.id')
            ->groupBy('categories.name')
            ->selectRaw('categories.name as category, COUNT(events.id) as count')
            ->pluck('count', 'category');

        return $eventCategories;
    }


    // line chart DONE
    public function eventsOverTime()
    {
        // Create an array of all months you want to include
        $allMonths = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December',
        ];

        // Get the current year to limit the months to the current year
        $currentYear = date('Y');

        // Initialize an empty array to store counts for each month
        $eventCounts = [];

        // Loop through each month and fetch the event count
        foreach ($allMonths as $month) {
            $monthYear = $month . ' ' . $currentYear;
            $count = Event::whereRaw("DATE_FORMAT(date, '%M %Y') = ?", [$monthYear])->count();
            $eventCounts[$monthYear] = $count;
        }

        return $eventCounts;
    }

    // bar chart for event duration
    public function eventDurationAnalysis()
    {
        // Select the event dates and their durations
        $durations = Event::select('date', DB::raw('SUM(TIMESTAMPDIFF(HOUR, start_time, end_time)) as duration_hours'))
            ->groupBy('date')
            ->get();

        return $durations;
    }
}
