<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use App\Models\Course;

class DashboardController extends Controller
{
    public function index()
    {
        $user_level = Auth()->user()->user_level;
        
        if($user_level == 1)
        {
            return redirect()->route('dashboard');
        }
        else if($user_level == 2)
        {
            return redirect()->route('admin.dashboard');
        }
        else
        {
            return redirect()->back();
        }
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function admin_dashboard()
    {
        $count_users = User::where('user_level', 1)->count();
        $count_admins = User::where('user_level', 2)->count();
        $count_comments = Comment::count();
        $count_visible_courses = Course::where('visibility', 1)->count();
        $count_courses = Course::count();

        return view('admin.dashboard', compact(
            'count_users',
            'count_admins',
            'count_comments',
            'count_visible_courses',
            'count_courses',
        ));
    }
}
