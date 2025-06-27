<?php
namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UsersController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user/login');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $table = Users::create([
        //     "full_name"   => $request->name,
        //     "username"   => $request->name,
        //     "email"   => $request->name,
        //     "name"   => $request->name,
        //     "name"   => $request->name,
        //     "name"   => $request->name,
        //     "name"   => $request->name,
        //     "gender" => $request->gender,
        //     "age"    => $request->age,
        // ]);

        // return response()->json([
        //     "message" => "Store Success!",
        //     "data"    => $table,
        // ], 201);

        // dd($request->all());
        // $book = Book::create($request->all());
        // $book->save();

        $validatedData = $request->validate([
            'full_name'     => 'required|max:255',
            'username'      => 'required|max:255',
            'email'         => 'required|max:255|email:rfc,dns',
            'password'      => 'required|max:255',
            'date_of_birth' => 'required|max:255',
            'gender'        => 'required|max:255',
            'address'       => 'required|max:255',
            'role_id'       => 'required',
        ]);

        $d = Carbon::createFromFormat('Y-m-d', $validatedData['date_of_birth'])->format('Y/m/d');

        $book                = new Users;
        $book->full_name     = $validatedData['full_name'];
        $book->username      = $validatedData['username'];
        $book->email         = $validatedData['email'];
        $book->password      = $validatedData['password'];
        $book->date_of_birth = $d;
        $book->gender        = $validatedData['gender'];
        $book->address       = $validatedData['address'];
        $book->role_id       = $validatedData['role_id'];
        $book->save();

        return redirect()->route('users.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
