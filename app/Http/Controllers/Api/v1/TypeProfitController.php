<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type_profit;

class TypeProfitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type_profit= new Type_profit;
        return $type_profit->all();
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
        $type_profit=new Type_profit();
        $type_profit->type_profit=$request->input('type_profit');
        $type_profit->comment=$request->input('type_profit');
        $type_profit->save();

        if(!$type_profit)
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
        $delete_type_profit=Type_profit::find($id)->delete();

        if(!$delete_type_profit)
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
