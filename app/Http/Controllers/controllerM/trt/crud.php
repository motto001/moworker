<?php

namespace App\Http\Controllers\controllerM\trt;

trait Crud 
{
    public function index(){
        return response()->json(['func'=>'index']);
    }
    public function create(){
        return response()->json(['func'=>'create']);
    }
    public function store(Request $request){
        return response()->json(['func'=>'store']);
    }
    public function edit($id){
        return response()->json(['func'=>'create','id'=>$id ]);
    }
    public function update($id, Request $request){
        return response()->json(['func'=>'store','id'=>$id ]);
    }

    public function destroy($id){
        return response()->json(['func'=>'destroy','id'=>$id]);
    }
    public function pub($id){
        return response()->json(['func'=>'pub','id'=>$id]);
    }
    public function unpub($id){
        return response()->json(['func'=>'unpub','id'=>$id]);
    }   
     public function show($id){
        return response()->json(['func'=>'show','id'=>$id]);
    }
}