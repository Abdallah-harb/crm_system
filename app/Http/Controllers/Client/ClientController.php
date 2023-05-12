<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientimageRequest;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class ClientController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $clients = Client::all();

        return view('Dashboard.clients.index', compact('clients'));

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
    public function store(ClientRequest $request)
    {

      try {
          //image
          $fileName = "";
          if ($request->has('image')) {
              $fileName = uploadImage('clients', $request->image);
          }
          $client = Client::create($request->except('_token', 'image'));

          //insert data on the categories_translation
          $client->image = $fileName;
          $client->save();

          toastr()->success(trans('messages.success'), ['timeOut' => 5000]);

          return redirect()->route('client.index');
      } catch (\Exception $ex) {
          toastr()->error('there are error on data', ['timeOut' => 8000]);
          return redirect()->route('client.index');
      }

  }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update(ClientRequest $request)

    {


        try{

            $clients = Client::findOrFail($request->id);

                // for image if[ user add new image save ] else [s ave old image ]

            if ($request->has('image')) {
                $fileName = uploadImage('clients',$request->image);
                Client::where('id',$request->id)->update(['image' => $fileName]);
            }

            $clients->update($request->except('_token','id','image'));
            $clients -> save();

            toastr()->success('Data Updated Successfully', ['timeOut' => 5000]);

            return redirect()->route('client.index');

        }catch (\Exception $ex){

            return redirect()->back()->withErrors(['error' =>$ex->getMessage()]);

            //return redirect()->back()->with(['error'=>'There are error on data' ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $clients = Client::find($request->id)->delete();
        toastr()->warning('Data Deleted .!');
        return redirect()->route('client.index');

        //if want to restore data
        //$clients = Client::find($request->[name of request]);
       // Client::restore();

    }


}


