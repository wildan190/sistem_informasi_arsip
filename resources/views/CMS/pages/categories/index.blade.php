@extends('cms.layouts.app')

@section('content')
<!-- Container for the content -->
<div class="container my-4">
    <!-- Row for the table and the create button -->
    <div class="row">
        <!-- Column for the table -->
        <div class="col-12">
            <!-- Card component for table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Categories</h4>
                    <!-- Create button -->
                    <a href="{{ route('categories.create') }}" class="btn btn-success">Create New Category</a>
                </div>
                <div class="card-body">
                    <!-- Table component -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>
                                        <!-- Edit link -->
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <!-- Delete form -->
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="post" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
