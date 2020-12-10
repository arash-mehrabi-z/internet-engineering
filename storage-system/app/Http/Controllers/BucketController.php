<?php

namespace App\Http\Controllers;

use App\Bucket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BucketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the currently authenticated user...
        $user = Auth::user();

        $buckets = $user->buckets;

        return view('buckets.index', ['buckets' => $buckets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buckets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        // Get the currently authenticated user...
        $user = Auth::user();

        $bucket = new Bucket;
        $bucket->name = $request->name;
        $bucket->user_id = $user->id;
        $bucket->save();

        $directory = 'users/' . $user->id . '/' . $bucket->id;
        Storage::makeDirectory($directory);

        $buckets = $user->buckets;
        return view('buckets.index', ['buckets' => $buckets]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bucket  $bucket
     * @return \Illuminate\Http\Response
     */
    public function show(Bucket $bucket)
    {
        return view('buckets.show', ['bucket' => $bucket]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bucket  $bucket
     * @return \Illuminate\Http\Response
     */
    public function edit(Bucket $bucket)
    {
        return view('buckets.edit', ['bucket' => $bucket]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bucket  $bucket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bucket $bucket)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $bucket->name = $request->name;
        $bucket->save();

        // Get the currently authenticated user...
        $user = Auth::user();
        $buckets = $user->buckets;
        return view('buckets.index', ['buckets' => $buckets]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bucket  $bucket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bucket $bucket)
    {
        // Get the currently authenticated user...
        $user = Auth::user();
        $directory = $directory = 'users/' . $user->id . '/' . $bucket->id;

        Storage::deleteDirectory($directory);

        $bucket->delete();

        $buckets = $user->buckets;
        return view('buckets.index', ['buckets' => $buckets]);
    }
}
