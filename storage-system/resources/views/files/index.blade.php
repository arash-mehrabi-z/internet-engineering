@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Files Index') }}</div>

                <div class="card-body">
                    <div>
                        <a href="{{ route('files.create', ['bucket' => $bucket->id]) }}">Create a new file</a>
                    </div>
                    <hr>
                    <div>
                        <div>{{ __('Your files:') }}</div>
                        <br>
                        @foreach ($files as $file)
                            <div><a href="{{ route('files.show', ['bucket' => $bucket->id, 'file' => $file->id]) }}">{{ $file->name }}</a></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
