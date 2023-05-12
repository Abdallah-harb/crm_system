<?php

namespace App\Http\Controllers\tasks;
use App\Http\Controllers\Controller;

use App\Http\Requests\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      $tasks = Task::all();
      $users = User::all();
      $prjects = Project::all();

      return view('Dashboard.tasks.index',compact('tasks','users','prjects'));

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(TaskRequest $request)

  {
      try {

          $project = Task::create($request->except('_token'));
          $project->save();

          toastr()->success("data added successfully", ['timeOut' => 5000]);

          return redirect()->route('task.index');

      } catch (\Exception $ex) {
          toastr()->error('there are error on data', ['timeOut' => 8000]);

          return redirect()->route('task.index');
      }

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(TaskRequest $request)
  {
      try{

          $tasks = Task::findOrFail($request->id);

          if(!$tasks) {
              toastr()->error('there are error on data', ['timeOut' => 8000]);
              return redirect()->route('task.index');
          }

          $tasks->update($request->except('_token','id'));
          $tasks -> save();

          toastr()->success("data updated successfully", ['timeOut' => 5000]);

          return redirect()->route('task.index');


      } catch (\Exception $ex) {

          toastr()->error('there are error on data', ['timeOut' => 8000]);
          return redirect()->back()->with(['error'=>$ex]);
      }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request)
  {

      try{

          $task = Task::find($request->id)->delete();
          toastr()->warning('You Are Delete Task  .!');
          return redirect()->route('task.index');

      } catch (\Exception $ex) {

          toastr()->error('there are error on data', ['timeOut' => 8000]);
          return redirect()->route('task.index');

      }

  }

}

?>
