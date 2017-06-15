<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function registration()
    {
        return view('auth.registration', []);
    }



    public function registrationForm(Request $request)
    {
//        return $request->all();
        $validator = Validator::make($request->all(), [
            'name'                  => 'required',
            'email'                 => 'required|email',
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required',
            'department'            => 'required',
            'reg_no'                => 'required',
            'contact_no'            => 'required',
            'address'               => 'required',
        ]);

        if ($validator->fails())
        {
            dd ($validator->getMessageBag());
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();

        }
        if ($request -> image)
            $img = $this->uploadFile($request->file('image'), '/images/users/');
        else
            $img = '/images/categories/default.png';

            //dd($img);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->image = $img;
        $user->department = $request->department;
        $user->reg_no = $request->reg_no;
        $user->contact_no = $request->contact_no;
        $user->address = $request->address;
        $user->role = 'Public';
        $user->status = true;

        $user->save();

        return redirect()->route('login')->with('success', 'You are successfully registered!');
    }


    public function index()
    {
        //
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
        //
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
        //
    }
}
