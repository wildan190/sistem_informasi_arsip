@extends('cms.layouts.app')
@section('content')
<!-- show -->
 <div>
    <h1>{{ $arsip->title }}</h1>
    <p>{{ $arsip->content }}</p>
    <p>Dibuat pada {{ $arsip->created_at->format('d F Y') }}</p>
    @if ($arsip->attachment)
    <a href="{{ asset('storage/' . $arsip->attachment) }}" target="_blank">Download Attachment</a>
    @endif
</div>

@endsection
