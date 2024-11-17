@extends('layouts.app')

@section('title', $task->title)
@section('content')
<p class="flex text-lg">{{ $task->description }}</p>

@if ($task->long_description)
    <p>{{ $task->long_description }}</p>
@else
    <p>No long description</p>
@endif

<p>{{ $task->created_at }}</p>
<p>{{ $task->updated_at }}</p>
@endsection
