<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Task;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()->where('completed', !true)->get(),
    ]);
})->name('tasks.index');

Route::view('tasks/create', 'create')->name('task-create');

// Edit a single route;
Route::get('/tasks/{id}/edit', function ($id) {
    return view('edit', ['task' => Task::findOrFail($id)]);
})->name('tasks.edit');

// Get a single route;
Route::get('/tasks/{id}', function ($id) {
    return view('show', ['task' => Task::findOrFail($id)]);
})->name('tasks.show');

// PATCH ROUTE
Route::put('/tasks/{id}', function (Request $request, $id) {
    // validate the data;
    $data = $request->validate([
        'title' => 'required | max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);

    // findOrFail By ID;
    $task = Task::findOrFail($id);
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();

    return redirect()->route('tasks.show', ['id'=> $task->id])->with('success', 'Task updated!');
})->name('tasks.update');

Route::post('/tasks', function (Request $request) {
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);

    $task = new Task();
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();

    return redirect()->route('tasks.show', ['id' => $task->id])->with('success', 'Task created!');
})->name('tasks.store');


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
