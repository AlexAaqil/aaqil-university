<x-app-layout>
    <div class="Course CourseSpecialization">
        <div class="custom_form">
            <div class="header">
                <a href="{{ route('admin.course.specializations.index', $course->slug) }}">
                    <x-svgs.arrow-left class="w-5 h-5" />
                </a>
                <h1>Update {{ $course->title }} Specialization</h1>
            </div>

            <form action="{{ route('admin.course.specializations.update', [$course->slug, $specialization->slug]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <input type="hidden" name="course_id" value="{{ $course->id }}">

                <div class="inputs">
                    <label for="title">Specialization Title</label>
                    <input type="text" name="title" id="title" placeholder="e.g. Advanced Web Development"
                           value="{{ old('title', $specialization->title) }}" required>
                    <x-form-input-error field="title" />
                </div>

                <div class="inputs">
                    <label for="description">Description (optional)</label>
                    <textarea name="description" id="description" rows="4" placeholder="Briefly describe this specialization...">{{ old('description', $specialization->description) }}</textarea>
                    <x-form-input-error field="description" />
                </div>

                <div class="inputs">
                    <label for="image">Image (optional)</label>                  
                    @if($specialization->image)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-2">Current Image:</p>
                            <div class="flex items-center space-x-4">
                                <div class="image w-[100px] h-[100px]">
                                    <img src="{{ asset('storage/courses/specializations/' . $specialization->image) }}" 
                                         alt="{{ $specialization->title }}" 
                                         class="border">
                                </div>
                                <div>
                                    <label class="flex items-center space-x-2 text-sm text-red-600 cursor-pointer">
                                        <input type="checkbox" name="remove_image" value="1">
                                        <span>Remove current image</span>
                                    </label>
                                    <p class="text-xs text-gray-500 mt-1">Check this to remove the current image</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div>
                        <p class="text-sm text-gray-600 mb-2">
                            {{ $specialization->image ? 'Upload new image (replaces current):' : 'Upload image:' }}
                        </p>
                        <input type="file" name="image" id="image" accept="image/*" 
                               onchange="previewImage(this)">
                        <x-form-input-error field="image" />
                    </div>

                    <div id="imagePreview" class="mt-3 hidden">
                        <p class="text-sm text-gray-600 mb-2">New image preview:</p>
                        <div class="image w-[100px] h-[100px]">
                            <img id="preview" class="border">
                        </div>
                    </div>
                </div>

                <div class="inputs">
                    <label for="sort_order">Sort Order (optional)</label>
                    <input type="number" name="sort_order" id="sort_order" min="1" value="{{ old('sort_order', $specialization->sort_order) }}">
                    <x-form-input-error field="sort_order" />
                </div>

                <div class="inputs">
                    <input type="hidden" name="is_published" value="0">
                    <label for="is_published" class="flex items-center space-x-2">
                        <input type="checkbox" name="is_published" id="is_published" value="1" 
                               {{ old('is_published', $specialization->is_published) ? 'checked' : '' }}>
                        <span>Publish</span>
                    </label>
                    <x-form-input-error field="is_published" />
                </div>

                <div class="mt-6">
                    <button type="submit" class="btn btn-primary">
                        Update Specialization
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                previewContainer.classList.add('hidden');
            }
        }

        // Handle remove image checkbox
        document.querySelector('input[name="remove_image"]')?.addEventListener('change', function() {
            const fileInput = document.getElementById('image');
            const previewContainer = document.getElementById('imagePreview');
            
            if (this.checked) {
                fileInput.disabled = true;
                previewContainer.classList.add('hidden');
            } else {
                fileInput.disabled = false;
            }
        });
    </script>
</x-app-layout>