<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SportEventController extends Controller
{
    public function index()
    {
        $events = DB::table('sport_events')->get();
        return response()->json($events);
    }
}
