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
    $words = DB::table('kata')
        ->select('id', 'kata_1', 'kata_2')
        ->orderByDesc('id')
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

    $alreadyUsed = DB::table('kata')
        ->where(function ($query) use ($kata1, $kata2) {
            $query->where('kata_1', $kata1)
                ->orWhere('kata_2', $kata1)
                ->orWhere('kata_1', $kata2)
                ->orWhere('kata_2', $kata2);
        })
        ->exists();

    if ($alreadyUsed) {
        return back()
            ->withInput()
            ->withErrors(['kata1' => 'Kata telah digunakan.']);
    }

    DB::table('kata')->insert([
        'kata_1' => $kata1,
        'kata_2' => $kata2,
    ]);

    return redirect('/undercover/words')->with('success', 'Kata berhasil ditambahkan.');
});

Route::get('/undercover/play', function () {
    $wordPairs = DB::table('kata')
        ->select('kata_1', 'kata_2')
        ->inRandomOrder()
        ->get()
        ->map(function ($word) {
            return [
                'kata1' => $word->kata_1,
                'kata2' => $word->kata_2,
            ];
        })
        ->values();

    return view('undercover-play', compact('wordPairs'));
});
