@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Buckets Index') }}</div>

                <div class="card-body">
                    <div>
                        <a href="{{ route('buckets.create') }}">Create a new bucket</a>
                    </div>
                    <hr>
                    <div>
                        <div>{{ __('Your buckets:') }}</div>
                        <br>
                        @foreach ($buckets as $bucket)
                            <div><a href="{{ route('buckets.show', ['bucket' => $bucket->id]) }}">{{ $bucket->name }}</a></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
