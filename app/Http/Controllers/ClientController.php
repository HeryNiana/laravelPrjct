<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return response()->json($clients);
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
        $request->validate([
            'person_name' => 'required',
            'business_name' => 'required',
            'business_gst_number' => 'required' 
        ]);
        $clients = Client::create($request->all());
        return response()->json([
            'status' =>200,
            'clients' => $clients]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Client $clients)
    {
        return $clients;
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
    public function update(Request $request, Client $clients)
    {
        $request->validate([
            'person_name' => 'required',
            'business_name' => 'required',
            'business_gst_number' => 'required' //optional if you want this to be required
        ]);
       $clients->update($request->all());
        
        return response()->json([
            'message' => 'client updated!',
            'expense' => $clients,
            'status' => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $clients)
    {
        $clients->delete();
        return response()->json([
            'message' => 'client deleted'
        ]);
    }
}
