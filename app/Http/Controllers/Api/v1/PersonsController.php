<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persons;

class PersonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persons= new Persons;
        return $persons->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $person=new Persons();
      $person->first_name=$request->input('first_name');
      $person->last_name=$request->input('last_name');
      $person->role=$request->input('role');
      $person->date_birth=$request->input('date_birth');
      $person->save();

      if(!$person)
      {
        return response()->json([
          "status"=>false,
        ])->setStatusCode(404);
      }
      else
      {
        return response()->json([
          "status"=>true,
        ])->setStatusCode(200);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $delete_person=Persons::find($id)->delete();

        if(!$delete_person)
        {
          return response()->json([
            "status"=>false,
          ])->setStatusCode(404);
        }
        else
        {
          return response()->json([
            "status"=>true,
          ])->setStatusCode(200);
        }
    }
}
