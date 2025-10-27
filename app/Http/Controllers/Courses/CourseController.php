<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Courses\CourseRequest;
use Illuminate\Support\Str;
use App\Models\Courses\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function create()
    {
        return view('pages.courses.courses.create');
    }

    public function store(CourseRequest $request)
    {
        $validated_data = $request->validated();

        $validated_data['user_id'] = Auth::id();

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

        return redirect()->route('admin.courses.index');
    }

    public function edit(Course $course)
    {
        return view('pages.courses.courses.edit', compact('course'));
    }

    public function update(CourseRequest $request, Course $course)
    {
        $validated_data = $request->validated();

        $old_slug = Str::slug($course->title);
        $new_slug = Str::slug($validated_data['title']);
        $date = now()->format('dmy');
        $random = Str::random(5);

        // Check if image is being replaced
        if ($request->hasFile('image')) {
            // Delete old image
            if ($course->image && Storage::disk('public')->exists('courses/courses/'.$course->getRawOriginal('image'))) {
                Storage::disk('public')->delete('courses/courses/'.$course->getRawOriginal('image'));
            }

            // Generate new image name with updated slug
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $image_name = "{$new_slug}-{$date}-{$random}.{$extension}";
            $image->storeAs('courses/images', $image_name, 'public');
            $validated_data['image'] = $image_name;
        } elseif ($old_slug !== $new_slug && $course->image) {
            // If title changed and no new image was uploaded, rename existing image
            $old_image_name = $course->getRawOriginal('image');
            $extension = pathinfo($old_image_name, PATHINFO_EXTENSION);
            $new_image_name = "{$new_slug}-{$date}-{$random}.{$extension}";

            $old_path = "courses/courses/{$old_image_name}";
            $new_path = "courses/courses/{$new_image_name}";

            if (Storage::disk('public')->exists($old_path)) {
                Storage::disk('public')->move($old_path, $new_path);
                $validated_data['image'] = $new_image_name;
            }
        }

        $course->update($validated_data);

        session()->flash('notify', ['type' => 'success', 'message' => 'course updated successfully']);

        return redirect()->route('admin.courses.index');
    }
}
