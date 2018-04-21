<?php

namespace App\Http\Controllers\AccessToken;

use App\Model\AccessToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccessTokenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accessToken = AccessToken::all();

        return response()->json(['data' => $accessToken], Response::HTTP_OK);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'token' => 'required',
            'driver_id' => 'required',
        ];

        $this->validate($request, $rules);

        $accessToken = AccessToken::create($request->all());

        return response()->json(['data' => $accessToken, 'code' => Response::HTTP_CREATED], Response::HTTP_CREATED);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $accessToken = Vehicle::findOrFail($id);

        $data = $request->all();

        $accessToken->fill($data);

        $accessToken->save();

        return response()->json(['data' => $accessToken, 'code' => Response::HTTP_OK], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
