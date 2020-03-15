<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['status' => true , 'message' => Task::orderBy('id','DESC')->get(),'count'=>Task::count(),'code'=> 200]);
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\TaskStoreRequest $request , Task $task)
    {
        $request->validated();
        try{
            Task::create([
                'task_title' => $request->task_title
            ]);
             return response()->json(['status' => true, 'message' => "Task Added","code" => 201,'count'=>Task::count()]);
           }
           catch(\Exception $ex){
            return response()->json(['status' => false, "code" => 422,'message' => $ex->getMessage()]);
           }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\TaskUpdateRequest $request, $id)
    {
        $request->validated();
        try{
            Task::findOrFail($id);
            Task::find($id)->update(['task_title' => $request->task_title]);
             return response()->json(['status' => true, 'message' => "Task Updated","code" => 200,'count'=>Task::count()]);
        }
        catch(\Exception $ex){
            return response()->json(['status'=> false, 'message' => 'Task id not found' ,'code' => 404]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Task::findOrFail($id);
            Task::find($id)->delete();
             return response()->json(['status' => true, 'message' => "Task Deleted","code" => 204,'count'=>Task::count()]);
        }
        catch(\Exception $ex){
            return response()->json(['status'=> false, 'message' => 'Task id not found' ,'code' => 404]);
        }
    }
}
