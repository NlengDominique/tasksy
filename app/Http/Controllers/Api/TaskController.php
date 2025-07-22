<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{

   public function index(Request $request){

       $tasks = $request->user()->tasks()->get();

       return response()->json($tasks,200);
   }

    public function store(Request $request){

        $data = $request->validate([
            'title'=>'string|required|min:5',
            'description'=>'sometimes|string|min:5',
            'dateEcheance'=>'date|required',
            'priority'=>'sometimes|string|in:faible,moyen,eleve',
            'status'=>'sometimes|string|in:en attente,terminee',
        ]);

        $task = $request->user()->tasks()->create($data);

        return response()->json($task,status: 201);
    }

   public function show(Request $request, $id)
   {
        $task = $request->user()->tasks()->find($id);

        if(!$task){
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json($task, 200);
   }

   public function update(Request $request, $id)
   {

       $task = $request->user()->tasks()->find($id);

       if(!$task){
           return response()->json(['message' => 'Task not found'], 404);
       }

       Gate::authorize('update-task', $task);

       $data = $request->validate([
           'title'=>'string|required|min:5',
           'description'=>'sometimes|string|min:5',
           'dateEcheance'=>'date|required',
           'priority'=>'sometimes|string|in:faible,moyen,eleve',
           'status'=>'sometimes|string|in:en attente,terminee',
       ]);

       $task->update($data);

       return response()->json($task, 200);

   }

   public function destroy(Request $request, $id){
       $task = $request->user()->tasks()->find($id);
       if(!$task){
           return response()->json(['message' => 'Task not found'], 404);
       }

       Gate::authorize('delete-task', $task);

       $task->delete();
       return response()->json(['message' => 'Task deleted successfully'], 200);
   }

}
