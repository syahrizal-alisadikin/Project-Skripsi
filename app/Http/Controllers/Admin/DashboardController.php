<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class DashboardController extends Controller
{
    public function index()
    {
        $admin = Admin::all();
        return view('pages.admin.dashboard',compact('admin'));
    }

    public function create()
    {
        return view('pages.admin.admin.create');
    }

    public function store(Request $request)
    {
         $this->validate(
                $request,
                [
                    'name'    => 'required',
                    'email'    => 'required|email',
                    'phone'   => 'required|min:10|max:13',
                    'password' => 'required|min:6|confirmed',
                    'password_confirmation' => 'required',
                ],
                [
                    'password.confirmed' => 'Password Tidak sama!',
                ]
            );
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('dashboard-admin')->with('success','data berhasil ditambahkan !!');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('pages.admin.admin.edit',compact('admin'));
    }

    public function update(Request $request,$id)
    {
        if($request->password)
        {
            $this->validate(
                $request,
                [
                    'name'    => 'required',
                    'email'    => 'required|email',
                    'phone'   => 'required|min:10|max:13',
                    'password' => 'required|min:6|confirmed',
                    'password_confirmation' => 'required',
                ],
                [
                    'password.confirmed' => 'Password Tidak sama!',
                ]
            );

            $admin = Admin::findOrFail($id);
            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password)
            ]);
            return redirect()->route('dashboard-admin')->with('success','data berhasil diupdate !!');

        } else{
            $this->validate(
                $request,
                [
                    'name'    => 'required',
                    'email'    => 'required|email',
                    'phone'   => 'required|min:10|max:13',
                ]
            );

            $admin = Admin::findOrFail($id);
            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            return redirect()->route('dashboard-admin')->with('success','data berhasil diupdate !!');

        }
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);
        $admin->delete();

        if ($admin) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
