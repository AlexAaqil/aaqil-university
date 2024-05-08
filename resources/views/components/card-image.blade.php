@props(['subject', 'field', 'assets_folder'])

<div class="thumbnail">
    @if($subject->$field != NULL)
        <img src="{{ asset('') . $assets_folder . '/'  . $subject->$field  }}" alt="{{ $subject->title . ' Image' }}">
    @else
        <img src="{{ asset('assets/images/default_image.jpg') }}" alt="Default Image">
    @endif
</div>