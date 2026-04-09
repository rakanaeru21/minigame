<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/undercover/offline', function () {
    return view('undercover-offline');
});

Route::get('/undercover/words', function () {
    $words = DB::table('words')
        ->select('id', 'kata1', 'kata2', 'created_at')
        ->orderByDesc('id')
        ->limit(20)
        ->get();

    return view('undercover-words', compact('words'));
});

Route::post('/undercover/words', function (Request $request) {
    $validated = $request->validate([
        'kata1' => ['required', 'string', 'max:255'],
        'kata2' => ['required', 'string', 'max:255'],
    ]);

    $kata1 = strtoupper(trim($validated['kata1']));
    $kata2 = strtoupper(trim($validated['kata2']));

    if ($kata1 === $kata2) {
        return back()
            ->withInput()
            ->withErrors(['kata1' => 'Kata tidak boleh sama.']);
    }

    $alreadyUsed = DB::table('words')
        ->where(function ($query) use ($kata1, $kata2) {
            $query->where('kata1', $kata1)
                ->orWhere('kata2', $kata1)
                ->orWhere('kata1', $kata2)
                ->orWhere('kata2', $kata2);
        })
        ->exists();

    if ($alreadyUsed) {
        return back()
            ->withInput()
            ->withErrors(['kata1' => 'Kata telah digunakan.']);
    }

    DB::table('words')->insert([
        'kata1' => $kata1,
        'kata2' => $kata2,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect('/undercover/words')->with('success', 'Kata berhasil ditambahkan.');
});

Route::get('/undercover/play', function () {
    $wordPairs = DB::table('words')
        ->select('kata1', 'kata2')
        ->inRandomOrder()
        ->get()
        ->map(function ($word) {
            return [
                'kata1' => $word->kata1,
                'kata2' => $word->kata2,
            ];
        })
        ->values();

    return view('undercover-play', compact('wordPairs'));
});
