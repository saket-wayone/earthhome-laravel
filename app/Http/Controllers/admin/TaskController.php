<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\SourceModel;
use App\Models\TaskModel;
use App\Models\TaskPhotos;
use Illuminate\Http\Request;
use Validator;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $data['leadid'] = $request->id;
          $data['alltask'] =  TaskModel::with(['categories' => function ($query) {
            return $query->select('id', 'source')->get();
        },'before','after'])->where('lead_id', $request->id)->orderBy('id', 'desc')->get();

        return view('admin.task.list', $data);
    }

    public function create(Request $request)
    {
        $data['categories'] = SourceModel::get();
        $data['leadid'] =  $request->id;
        return view('admin.task.create', $data);
    }
    public function store(TaskRequest $request)
    {
        // Validate and store task details
        $data['description'] = $request->post('description');
        $data['task_date'] = $request->post('task_date');
        $data['category'] = $request->post('category');
        $data['lead_id'] = $request->post('lead_id');
        $data['created_at'] = now();
        // Handle before images upload


        // Store task in database
        $task = TaskModel::insertGetId($data);

        if ($request->hasFile('before')) {

            foreach ($request->file('before') as $file) {

                $imageName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('uploads/task/before'), $imageName);
                $url = 'uploads/task/before/' . $imageName;
                TaskPhotos::insert(['task_id' => $task, 'title' => 'before', 'created_at' => now(), 'image' => $url]);
            }
        }

        // Handle after images upload
        if ($request->hasFile('after')) {
            foreach ($request->file('after') as $file) {
                $imageName = time() . '-' . $file->getClientOriginalName();
                $url = 'uploads/task/after/' . $imageName;

                $file->move(public_path('uploads/task/after'), $imageName);
                TaskPhotos::insert(['task_id' => $task, 'title' => 'after', 'created_at' => now(), 'image' => $url]);
            }
        }

        return response()->json(['message' => 'Task Uploaded successfully', 'task' => $task, 'code' => 200], 201);
    }

    public  function delete(Request $request)
    {
        $type = $request->type;
        if ($type == 'activate') {
            return  TaskModel::where('id', $request->id)->update(['flag' => 1]);
        }
       
        if ($type == 'deactivate') {
            return  TaskModel::where('id', $request->id)->update(['flag' => 0]);
        }


       
      

        if ($type == 'remove') {
            

            return  TaskModel::where('id', $request->id)->delete();
        }
    }

}
