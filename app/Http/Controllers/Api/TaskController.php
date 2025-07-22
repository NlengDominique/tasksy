<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
   public function store(Request $request){

       $data = $request->validate([
            'title'=>'string|required|min:5',
           'description'=>'string|min:5',
           'dateEcheance'=>'date',
           'priority'=>'string|in:faible,moyen,eleve',
           'status'=>'string|in:en attente,terminee',
       ]);

       $task = $request->user()->tasks()->create($data);

       return response()->json($task,status: 201);
   }

}
