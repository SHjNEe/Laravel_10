<?php

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/





Route::get('/', function () {
    return redirect()->route('tasks.index');
})->name('home');

Route::get('/tasks', function () {
    return view('tasks.index', [
        'tasks' => Task::latest()->paginate(10)
    ]);
})->name('tasks.index');

// Route::get('/tasks/{id}', function ($id) use ($tasks) {
//     foreach ($tasks as $task) {
//         if ($task->id === (int)$id) {
//             $foundTask = $task;
//             return view('show', [
//                 'task' => $foundTask
//             ]);
//         }
//     }
//     // If the task with the given ID was not found, return a 404 error
//     abort(404, 'Task not found');
// })->name('tasks.show');
Route::get('/tasks/create', function () {
    return view('tasks.create');
})->name('tasks.create');

Route::post('/tasks', function (TaskRequest $request) {
    // dd($request->all());
    // $data = $request->validated();

    // $task = new Task;
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();
    $task = Task::create($request->validated());
    return redirect()->route('tasks.show', $task)->with('success', 'Task created successfully !!');
})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    // $task = Task::findOrFail($id);
    // $data = $request->validated();
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();
    $task->update($request->validated());
    return redirect()->route('tasks.show', $task)
        ->with('success', 'Task updated successfully!');
})->name('tasks.update');

Route::put('tasks/{task}/toggle-complete', function (Task $task) {
    $task->toggleComplete();

    return redirect()->back()->with('success', 'Task updated successfully!');
})->name('tasks.toggle-complete');

Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();
    return redirect()->route('tasks.index')
        ->with('success', 'Task deleted successfully!');
})->name('tasks.destroy');


Route::get('/tasks/{task}', function (Task $task) {
    // $task = collect($tasks)->firstWhere('id', $id);
    return view('tasks.show', [
        'task' => $task
    ]);
})->name('tasks.show');

Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('tasks.edit', [
        'task' => $task
    ]);
})->name('tasks.edit');
