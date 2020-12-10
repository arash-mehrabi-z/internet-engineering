@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bucket') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                        <a href="{{ route('buckets.edit', ['bucket' => $bucket->id]) }}">Edit the bucket</a>
                    </div>
                    <hr>
                    <div>
                        <div>{{ __('Bucket:') }}</div>
                        <br>
                        ID: {{ $bucket->id }}<br>
                        User ID: {{ $bucket->user_id }}<br>
                        Name: {{ $bucket->name }}<br>
                    </div>
                    <div>
                        <form action="{{ route('buckets.destroy', ['bucket' => $bucket->id]) }}" method="POST">
                            @csrf()
                            @method('DELETE')

                            <input type="submit" class="btn btn-danger float-left" style="width: 100px; margin-top: 20px;" value="delete" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
