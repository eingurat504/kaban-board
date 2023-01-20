<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

          /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
        $tasks = Task::query()
        ->select([
            'id',
            'name',
            'description',
            'created_at',
            'updated_at',
        ])
        ->take($request->input('limit', 1000))
        ->get();

    return response()->json(['tasks' => $tasks]);
    }


        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages()->toArray(),422);
        }

        $task_info = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        $task = Task::create($task_info);

        return response()->json($task);
    }



}
