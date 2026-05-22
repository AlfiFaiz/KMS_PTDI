<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::with('user');

        // search
        if ($request->search) {
            $query->where('description', 'like', '%' . $request->search . '%');
        }

        // filter user
        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        // filter date
        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }

        $activities = $query
            ->latest()
            ->paginate(15);

        $users = User::orderBy('name')->get();

        return view('activity-logs.index', compact(
            'activities',
            'users'
        ));
    }
}