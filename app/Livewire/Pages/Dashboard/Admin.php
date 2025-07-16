<?php

namespace App\Livewire\Pages\Dashboard;

use Livewire\Component;
use App\Models\User;
use App\Models\ContactMessage;
use App\Models\Courses\Course;
use App\Enums\USER_ROLES;
use Carbon\Carbon;

class Admin extends Component
{
    public function render()
    {
        $count_super_admins = User::where('role', USER_ROLES::SUPER_ADMIN)->count();
        $count_admins = User::where('role', USER_ROLES::ADMIN)->count();
        $count_users = User::where('role', '!=', USER_ROLES::SUPER_ADMIN)->count();

        $count_messages = ContactMessage::count();
        $count_unread_messages = ContactMessage::where('is_read', false)->count();

        $count_courses = Course::count();

        return view('livewire.pages.dashboard.admin', compact(
            'count_super_admins',
            'count_admins',
            'count_users',

            'count_messages',
            'count_unread_messages',

            'count_courses',
        ));
    }
}
