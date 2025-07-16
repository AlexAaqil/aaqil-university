<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Courses\CourseRequest;
use Illuminate\Support\Str;
use App\Models\Courses\Course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function create()
    {
        return view('pages.courses.create');
    }

    public function store(CourseRequest $request)
    {
        $validated_data = $request->validated();

        $validated_data['created_by'] = Auth::id();

        if($request->hasFile('image')) {
            $image = $request->file('image');

            $slug = Str::slug($validated_data['title']);
            $date = now()->format('dmy');
            $random = Str::random(5);
            $extension = $image->getClientOriginalExtension();

            $image_name = "{$slug}-{$date}-{$random}.{$extension}";
            $image->storeAs('courses/images', $image_name, 'public');
            $validated_data['image'] = $image_name;
        }

        Course::create($validated_data);

        session()->flash('notify', ['type' => 'success', 'message' => 'Course added successfully']);

        return redirect()->route('courses.index');
    }
}
