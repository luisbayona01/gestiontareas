<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use  DB;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {   $userId = Auth::user()->id; 
        $tasks = DB::table('tasks')
             ->where('user_id', $userId)
            ->join('users', 'tasks.user_id', '=', 'users.id')
            ->select('tasks.*', 'users.name as user_name')
            ->get();

  
        return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $task = new Task();

        return view('task.create', compact('task'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $taskRequest = new TaskRequest();

     //dd($request->all());
        $validator = \Validator::make($request->all(), $taskRequest->rules());

        if ($validator->fails()) {
           
            return response()->json(['ok' => false, 'message' => $validator->errors()], 422);
        }

        try {
           
            $task = Task::create($request->all());

        
            return response()->json(['ok' => true, 'message' => 'tarea creada exitosa mente'], 201);
        } catch (\Exception $e) {
          
            return response()->json(['ok' => false, 'message' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
      
        $tasks= DB::table('tasks')
        ->join('users', 'tasks.user_id', '=', 'users.id')
        ->select('tasks.*', 'users.name as user_name', 'users.email as user_email')
        ->where('tasks.id', $id)
        ->get();
       $task=$tasks[0];
        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $task = Task::find($id);

        return view('task.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {    $taskRequest = new TaskRequest();

       
           $validator = \Validator::make($request->all(), $taskRequest->rules());
   
           if ($validator->fails()) {
              
               return response()->json(['ok' => false, 'message' => $validator->errors()], 422);
           }
         
       

        try {
           
            $task->update($request->all());

        
            return response()->json(['ok' => true, 'message' => 'tarea modificada exitosa mente'], 201);
        } catch (\Exception $e) {
          
            return response()->json(['ok' => false, 'message' => $e->getMessage()], 400);
        }
        //return Redirect::route('tasks.index')
           // ->with('success', 'Task updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Task::find($id)->delete();

        return Redirect::route('tasks.index')
            ->with('success', 'Task deleted successfully');
    }

    public function taskStatusCounts()
    { 
        $userId = Auth::user()->id; 
        //dd($userId);
        $counts = DB::table('tasks')
            ->where('user_id', $userId) 
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

        
        $data = [
            'pendiente' => $counts->get('pendiente', 0),
            'en progreso' => $counts->get('en progreso', 0),
            'completada' => $counts->get('completada', 0),
        ];

        return response()->json($data);
       
    }
}
