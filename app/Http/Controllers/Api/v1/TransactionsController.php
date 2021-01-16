<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transactions;
use Validator;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Transactions::all();
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
        $validator = Validator::make(
            $request->all(),
            [
              'type_profit_id'=>["required"],
              'categories_id'=>["required"],
              'person_id'=>["required"],
              'sum'=>["required"],
            ]
        );
        if($validator->fails())
        {
          return [
            "status"=>false,
            "errors"=>$validator->messages()
          ];
        }

        $transaction=new Transactions();
        $transaction->type_profit_id=$request->input('type_profit_id');
        $transaction->categories_id=$request->input('categories_id');
        $transaction->person_id=$request->input('person_id');
        $transaction->sum=$request->input('sum');
        $transaction->comment=$request->input('comment');

        $transaction->save();

        return [
          "status"=>true,
          "transaction"=>$transaction
        ];

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction=Transactions::find($id);

        if(!$transaction)
        {
          return response()->json([
            "status"=>false,
            "message"=>"Транзакция не найдена"
          ])->setStatusCode(404);
        }

        return $transaction;  
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
        $transaction=Transactions::find($id);
        $transaction->type_profit_id =$request->input('type_profit_id');
        $transaction->categories_id =$request->input('categories_id');
        $transaction->person_id =$request->input('person_id');
        $transaction->sum=$request->input('sum');
        $transaction->comment=$request->input('comment');

        $updated_date=date("Y-m-d H:i:s");

        $transaction->updated_at=$updated_date;

        $transaction->save();

        if(!$transaction)
        {
          return response()->json([
            "status"=>false,
            "message"=>"Транзакция не обновлена"
          ])->setStatusCode(404);
        }
        else
        {
          return response()->json([
            "status"=>true,
            "message"=>"Транзакция обновлена"
          ])->setStatusCode(200);
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
        $del_transaction=Transactions::find($id)->delete();

        if(!$del_transaction)
        {
          return response()->json([
            "status"=>false,
            "message"=>"Транзакция не найдена"
          ])->setStatusCode(404);
        }
        else
        {
          return response()->json([
            "status"=>true,
            "message"=>"Транзакция удалена"
          ])->setStatusCode(200);
        }

       
    }
}
