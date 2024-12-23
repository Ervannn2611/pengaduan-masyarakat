<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Report;
use App\Models\Response;
use App\Models\StaffProvince;
use Hash;

class HeadStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data jumlah pengaduan
        $reports = Report::count();

        $reports = Report::where('province', 'Jawa Barat')->count();

        $responses = Report::with('responses')->where('province', 'Jawa Barat')->count();

        // Kirim data ke view
        return view('headstaff.dashboard', compact('reports', 'responses'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('headstaff.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|',
        ]);
        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'STAFF',
        ]);
        StaffProvince::create([
            'user_id' => User::latest()->first()->id,
            'province' => 'Jawa Barat'
        ]);
        return redirect()->route('headstaff.create')->with('success', 'Akun staff berhasil dibuat!');
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
        $user = User::findOrFail($id);

        $staffProvince = StaffProvince::where('user_id', $id)->first();
        if ($staffProvince) {
            $staffProvince->delete();
        }

        $user->delete();

        return redirect()->route('headstaff.create')->with('success', 'Akun staff berhasil dihapus!');
    }



}
