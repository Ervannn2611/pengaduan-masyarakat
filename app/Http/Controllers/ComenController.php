<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class ComenController extends Controller
{

        public function store(Request $request)
        {
            // Validasi input
            $validatedData = $request->validate([
                'user_id' => 'required|exists:users,id',
                'report_id' => 'required|exists:reports,id',
                'comment' => 'required|string|max:500',
            ]);

            // Simpan komentar
            Comment::create([
                'user_id' => $validatedData['user_id'],
                'report_id' => $validatedData['report_id'],
                'comment' => $validatedData['comment'],
            ]);

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
        }
}

