<?php

class Task
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public ?string $long_description,
        public bool $completed,
        public string $create_at,
        public string $updated_at,
    ) {}
}

$tasks = [
    new Task(
        1,
        'Buy groceries',
        'Task 1 description',
        'Task 1 long description',
        false,
        '2023-03-01 12:00:00',
        '2023-03-01 12:00:00'
    ),
    new Task(
        2,
        'Sell old stuff',
        'Task 2 description',
        null,
        false,
        '2023-03-02 12:00:00',
        '2023-03-02 12:00:00'
      ),
      new Task(
        3,
        'Learn programming',
        'Task 3 description',
        'Task 3 long description',
        true,
        '2023-03-03 12:00:00',
        '2023-03-03 12:00:00'
      ),
      new Task(
        4,
        'Take dogs for a walk',
        'Task 4 description',
        null,
        false,
        '2023-03-04 12:00:00',
        '2023-03-04 12:00:00'
      ),
];

use Illuminate\Support\Facades\Route;

Route::get('/', function () use ($tasks) {
    return view('index', [
        'tasks' => $tasks,
    ]);
})->name('tasks.index');

// Get a single route;
Route::get('/{id}', function($id) {
    return 'This is a single taks';
})->name('tasks.show');


Route::get('/profile', function () {
    return 'Profile page';
})->name('profile');

Route::get('/hallo', function () {
    return redirect()->route('profile');
});

// Defining fallback routes;
Route::fallback(function () {
    return '404';
});
