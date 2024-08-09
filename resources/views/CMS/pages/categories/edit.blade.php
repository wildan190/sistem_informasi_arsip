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
                    <h4 class="card-title">Edit Category</h4>
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
                    <form action="{{ route('categories.update', $category->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <!-- Form Group for Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
                        </div>
                        <!-- Form Group for Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" name="description" id="description" class="form-control" value="{{ $category->description }}">
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
