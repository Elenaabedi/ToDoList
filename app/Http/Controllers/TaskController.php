<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\Inertia;

use App\Models\Task;

class TaskController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

   /*  Route::get('/dashboard', [TaskController::class, 'list'])->name('dashboard.list');
    Route::post('/dashboard/store', [TaskController::class, 'store'])->name('dashboard.store');
    Route::get('/dashboard/edit/{id}', [TaskController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard/update/{id}', [TaskController::class, 'update'])->name('dashboard.update');
    Route::delete('/dashboard/delete/{id}', [TaskController::class, 'delete'])->name('dashboard.delete');  */

    public function list()
    {
   
        $idUser = auth()->user()->id;

        $tasks = Task::where('user_id', $idUser)->get();
     
        return Inertia::render('Dashboard', [
            'tasks' => $tasks,
        ]);
    }

    public function store(Request $request){

        
        $task = new Task;
        $task->description = $request->description;
        $task->user_id = auth()->user()->id;

        $task->save();

        return redirect()->route('dashboard');

    }

    public function edit(Request $request, int $id){

        $task = Task::find($id);
        $task->description = $request->val;
        $task->user_id = auth()->user()->id;

        $task->save();

        return redirect()->route('dashboard');

    }

    public function delete(int $id){

        $task = Task::find($id);
        $task->delete();

        return redirect()->route('dashboard');

    }

    
}
