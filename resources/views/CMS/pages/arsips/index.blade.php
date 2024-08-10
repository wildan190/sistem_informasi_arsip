@extends('cms.layouts.app')

@section('content')
<!-- Container fluid for the content -->
<div class="container-fluid my-4">
    <!-- Row for the table -->
    <div class="row">
        <!-- Column for the table -->
        <div class="col-12">
            <!-- Card component for table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Arsip List</h4>
                    <!-- Create button (if needed) -->
                    @if (auth()->user()->hasPermissionTo('Create'))
                    <a href="{{ route('arsips.create') }}" class="btn btn-success">Add New Arsip</a>
                    @endif
                </div>
                <div class="card-body">
                    <!-- Responsive table -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Category</th>
                                    <th>Attachment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($arsips as $arsip)
                                <tr>
                                    <td>{{ $arsip->title }}</td>
                                    <td>{{ $arsip->content }}</td>
                                    <td>{{ $arsip->category->name }}</td>
                                    <td>
                                        @if ($arsip->attachment)
                                        <a href="{{ route('arsips.download', $arsip->id) }}" target="_blank" class="btn btn-info btn-sm">Download</a>
                                        @else
                                        No attachment
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Show link -->
                                        <a href="{{ route('arsips.show', $arsip->id) }}" class="btn btn-secondary btn-sm">Show</a>
                                        <!-- Edit link -->
                                        @if (auth()->user()->hasPermissionTo('Edit'))
                                        <a href="{{ route('arsips.edit', $arsip->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        @endif
                                        <!-- Delete form -->
                                        @if (auth()->user()->hasPermissionTo('Delete'))
                                        <form action="{{ route('arsips.destroy', $arsip->id) }}" method="post" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                        @endif
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
</div>
@endsection