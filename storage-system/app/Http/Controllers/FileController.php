<?php

namespace App\Http\Controllers;

use App\Bucket;
use App\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Bucket $bucket)
    {
        $user_bucket = $this->checkIfUserIsAuthorized($bucket);
        $files = $user_bucket->files;
        return view('files.index', ['bucket' => $user_bucket, 'files' => $files]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Bucket $bucket)
    {
        $user_bucket = $this->checkIfUserIsAuthorized($bucket);
        return view('files.create', ['bucket' => $user_bucket]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Bucket $bucket)
    {
        $user_bucket = $this->checkIfUserIsAuthorized($bucket);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'file' => 'required|file',
        ]);

        // Get the currently authenticated user...
        $user = Auth::user();
        $directory = 'users/' . $user->id . '/' . $bucket->id;
        $path = $request->file('file')->store($directory);

        $file = new File;
        $file->name = $request->name;
        $file->bucket_id = $bucket->id;
        $file->path = $path;
        $file->save();

        $files = $user_bucket->files;
        return view('files.index', ['bucket' => $bucket, 'files' => $files]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(Bucket $bucket, File $file)
    {
        $user_bucket = $this->checkIfUserIsAuthorized($bucket);
        return view('files.show', ['bucket' => $bucket, 'file' => $file]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(Bucket $bucket, File $file)
    {
        $user_bucket = $this->checkIfUserIsAuthorized($bucket);
        return view('files.edit', ['bucket' => $bucket, 'file' => $file]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bucket $bucket, File $file)
    {
        $user_bucket = $this->checkIfUserIsAuthorized($bucket);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $file->name = $request->name;
        $file->save();

        $files = $user_bucket->files;
        return view('files.index', ['bucket' => $bucket, 'files' => $files]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bucket $bucket, File $file)
    {
        $user_bucket = $this->checkIfUserIsAuthorized($bucket);

        Storage::delete($file->path);

        $file->delete();

        $files = $user_bucket->files;
        return view('files.index', ['bucket' => $bucket, 'files' => $files]);
    }

    /**
     * Download the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function download(Bucket $bucket, File $file)
    {
        $user_bucket = $this->checkIfUserIsAuthorized($bucket);

        return Storage::download($file->path);
    }

    public function checkIfUserIsAuthorized(Bucket $bucket)
    {
        // Get the currently authenticated user...
        $user = Auth::user();

        $user_bucket = $user->buckets()->where('id', $bucket->id)->first();

        if ( is_null($user_bucket) ) {
            abort(403, 'You are trying to access other users\' bucket or this bucket doens not exist.');
        }

        return $user_bucket;
    }
}
