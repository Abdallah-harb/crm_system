<?php

namespace App\Http\Controllers\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
        $projects = Project::all();
        $users = User::all();
        $clients = Client::all();
        return view('Dashboard.projects.index',compact('projects','users','clients'));
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
  public function store(ProjectRequest $request)
  {

      try {

          $project = Project::create($request->except('_token'));
          $project->save();

          toastr()->success("data added successfully", ['timeOut' => 5000]);

          return redirect()->route('project.index');

      } catch (\Exception $ex) {
          toastr()->error('there are error on data', ['timeOut' => 8000]);
          return redirect()->route('client.index');
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
  public function update(ProjectRequest $request)
  {
    try{

        $project = Project::findOrFail($request->id);

        if(!$project) {
            toastr()->error('there are error on data', ['timeOut' => 8000]);
            return redirect()->route('client.index');
        }

        $project->update($request->except('_token','id'));
        $project -> save();
        toastr()->success("data updated successfully", ['timeOut' => 5000]);

        return redirect()->route('project.index');


    } catch (\Exception $ex) {
        toastr()->error('there are error on data', ['timeOut' => 8000]);
        return redirect()->route('project.index');
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

          $project = Project::find($request->id)->delete();
          toastr()->warning('You Are Delete project  .!');
          return redirect()->route('project.index');

       } catch (\Exception $ex) {

        toastr()->error('there are error on data', ['timeOut' => 8000]);
        return redirect()->route('project.index');

       }

      //if want to restore data
      //$clients = Client::find($request->[name of request]);
      // Client::restore();

  }

}

?>
