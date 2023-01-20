<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:sanctum');
    }

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
        $categories = Category::query()
        ->select([
            'id',
            'name',
            'description',
            'created_at',
            'updated_at',
        ])
        ->take($request->input('limit', 1000))
        ->get();

        return response()->json(['categories' => $categories]);
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

        $category = Category::create($task_info);

        return response()->json($category);
    }

    /**
     * Tasks per Category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function tasks($categoryId)
    {
        //
        $category = Category::find($categoryId);

        $tasks = $category->tasks()->orderBy('order')->get();

        return response()->json([ 'tasks' => $tasks ]);
    }
}
