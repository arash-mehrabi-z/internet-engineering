@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('File') }}</div>

                <div class="card-body">
                    <div>
                        <a href="{{ route('files.index', ['bucket' => $bucket]) }}">Back to index</a>
                    </div>
                    <hr>
                    <div>
                        <div>{{ __('File:') }}</div>
                        <br>
                        ID: {{ $file->id }}<br>
                        Bucket ID: {{ $file->bucket_id }}<br>
                        Name: {{ $file->name }}<br>
                        Created at: {{ $file->created_at }}<br>
                        Updated at: {{ $file->updated_at }}<br>
                    </div>
                    <div>
                        <form action="{{ route('files.destroy', ['bucket' => $bucket->id, 'file' => $file->id]) }}" method="POST">
                            @csrf()
                            @method('DELETE')

                            <input type="submit" class="btn btn-danger" style="width: 100px; margin-top: 20px;" value="delete" />
                        </form><br>
                        <a href="{{ route('files.edit', ['bucket' => $bucket->id, 'file' => $file->id]) }}" class="btn btn-primary">Edit the file</a><br><br>
                        <a href="{{ route('files.download', ['bucket' => $bucket->id, 'file' => $file->id]) }}" class="btn btn-primary">Download the file</a><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
