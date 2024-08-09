@extends('cms.layouts.app')

@section('content')
<!-- Container fluid for the content -->
<div class="container-fluid my-4">
    <!-- Row for the form -->
    <div class="row justify-content-center">
        <!-- Column for the form -->
        <div class="col-lg-8 col-md-10 col-sm-12">
            <!-- Card component for form -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Arsip</h4>
                </div>
                <div class="card-body">
                    <!-- Error messages -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <!-- Form start -->
                    <form action="{{ route('arsips.update', $arsip->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Form Group for Category -->
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $arsip->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Form Group for Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $arsip->title) }}" placeholder="ex: My Title" required>
                        </div>
                        <!-- Form Group for Content -->
                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea name="content" id="content" class="form-control" rows="4">{{ old('content', $arsip->content) }}</textarea>
                        </div>
                        <!-- Form Group for Attachment -->
                        <div class="mb-3">
                            <label for="attachment" class="form-label">Attachment</label>
                            @if ($arsip->attachment)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/' . $arsip->attachment) }}" target="_blank" class="btn btn-info btn-sm">View Current Attachment</a>
                                </div>
                            @endif
                            <input type="file" name="attachment" id="attachment" class="form-control">
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
