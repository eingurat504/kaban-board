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
     * Show Category
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($taskId){

        $task = Task::find($taskId);

        if(!$task) {
            return response()->json(['error' => 'Unknown task']);
        }

        return response()->json($task);
    }


    /**
     * Store category
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required',
            'user_id' => 'required',
            'category_id' => 'required',
            'order' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages()->toArray(),422);
        }

        $task_info = [
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'order' => $request->order
        ];

        $task = Task::create($task_info);

        return response()->json($task);
    }

    /**
     * Update Category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $taskId)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'nullable',
            'description' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages()->toArray(),422);
        }

        $task = Task::where('id', $taskId)
        ->update([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'order' => $request->order,
            'description' => $request->description,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return response()->json($task);
    }

}
