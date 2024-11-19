<?php

use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Task;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()->paginate(5),
    ]);
})->name('tasks.index');

Route::view('tasks/create', 'create')->name('tasks.create');

// Edit a single route;
Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', ['task' => $task]);
})->name('tasks.edit');

// Get a single route;
Route::get('/tasks/{task}', function (Task $task) {
    return view(
        'show',
        ['task' => $task]
        // ['task' => Task::findOrFail($id)]
    );
})->name('tasks.show');

// PATCH ROUTE
Route::put('/tasks/{task}', function (TaskRequest $request, Task $task) {
    // validated data from TaskRequest;
    // $data = $request -> validated();

    // // findOrFail By ID;

    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();
    $task->update($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])->with('success', 'Task updated!');
})->name('tasks.update');

Route::post('/tasks', function (TaskRequest $request) {
    // $data = $request->validated();

    // $task = new Task();
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();

    $task = Task::create($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])->with('success', 'Task created!');
})->name('tasks.store');

Route::delete('/tasks/{task}', function (Task $task) {
    // (Task $task) is route model binding;
    $task->delete();

    return redirect()->route('tasks.index')->with('success', "Task deleted!");
})->name('tasks.destroy');

Route::put('tasks/{task}/toggle-complete', function(Task $task) {
    $task->toggleComplete();

    return redirect()->back()->with('success', 'Task completed!');
})->name('tasks.toggle-complete');

// Route::get('/profile', function () {
//     return 'Profile page';
// })->name('profile');

// Route::get('/hallo', function () {
//     return redirect()->route('profile');
// });

// // Defining fallback routes;
// Route::fallback(function () {
//     return '404';
// });
