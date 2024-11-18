    @extends('layouts.app')

    @section('title', 'This is the title')

    @section('content')
        <!-- @if (count($tasks)) -->
        @forelse($tasks as $task)
            <div>
                <a href="{{ route('tasks.show', ['task' => $task->id]) }}">
                    {{ $task->title }}
                </a>
            </div>
        @empty
            <div>There are no tasks!</div>
        @endforelse

        @if ($task->count())
            <nav>
                {{ $tasks->links() }}
            </nav>
        @endif
        <!-- @endif -->

    @endsection
