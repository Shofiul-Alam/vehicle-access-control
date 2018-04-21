<?php

namespace App\Http\Controllers\Driver;

use App\Model\Driver;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = Driver::with('user')->get();

        return response()->json(['data' => $drivers], Response::HTTP_OK);
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password'=>'required|min:6|confirmed',
        ];
        $rulesDriver = [
            'last_name' => 'required',
            'license_no'=>'required',
            'nfc_id'=>'required',
        ];



//        $this->validate($request, $rules); //return exception if not validate. Handle exception future


        $x = Validator::make($request->user, $rules);

        $y = Validator::make($request->driver, $rulesDriver);

        if($x->passes() == 'true' && $y->passes() == 'true') {
            $data = $request->all();
            $driverArr = $data['driver'];
            $userArr = $data['user'];
            $userArr['password'] = bcrypt($userArr['password']);
            $user = User::create($userArr);

            if($user && $driverArr) {
                $driverArr['user_id'] = $user->id;
                $driver = Driver::create($driverArr);

                $driverCompleteData = Driver::with('user')->findOrFail($driver->id);

                return response()->json(['data'=>$driverCompleteData, 'code'=>Response::HTTP_OK], Response::HTTP_OK);
            } else {
                return response()->json(['error'=>'Unexpected Error', 'code'=>Response::HTTP_UNPROCESSABLE_ENTITY],
                    Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        } else {
            $messege = [];

            if(!($x->passes() =='true')) {

                $messege = $x->errors()->getMessages();
            }
            if(!($y->passes() =='true')) {
                $erro = $y->errors()->getMessages();
                $messege= array_merge($messege, $erro);
            }

            return response()->json(['error'=>$messege, 'code'=>Response::HTTP_UNPROCESSABLE_ENTITY],
                Response::HTTP_UNPROCESSABLE_ENTITY);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $driver = Driver::findOrFail($id);
        $user = User::findOrFail($id);


        $rules = [
            'email' => 'email|unique:users',
            'password' => 'min:6|confirmed',
//            'admin' => 'in:' . User::ADMIN_USER . ',' . User::REGULAR_USER
        ];

        $x = Validator::make($request->user, $rules);

        if($x->passes()) {

            if($request->user) {

                if(isset($request->user['password'])) {
                    $request->user['password'] = bcrypt($request->user['password']);
                }
                $user->fill($request->user);
                $user->save();
            }
            if($request->driver) {

                $driver->fill($request->driver);
                $driver->save();
            }



        } else {
            $messege = [];

            if(!($x->passes() =='true')) {

                $messege = $x->errors()->getMessages();
            }
            if(!($y->passes() =='true')) {
                $erro = $y->errors()->getMessages();
                $messege= array_merge($messege, $erro);
            }

            return response()->json(['error'=>$messege, 'code'=>Response::HTTP_UNPROCESSABLE_ENTITY],
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }


//        if($user->isDirty()) {
//            if(!$user->isVerified()) {
//                return response()->json(['error' => 'Only verified users can modify the admin field',
//                    'code' => Response::HTTP_UNPROCESSABLE_ENTITY], Response::HTTP_UNPROCESSABLE_ENTITY);
//            }
//        }

        $driverCompleteData = Driver::with('user')->findOrFail($id);


        return response()->json(['data' => $driverCompleteData], Response::HTTP_OK);
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
