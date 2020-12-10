@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bucket') }}</div>

                <div class="card-body">
                    <div>
                        <a href="{{ route('buckets.index') }}">Back to index</a>
                    </div>
                    <hr>
                    <div>
                        <div>{{ __('Bucket:') }}</div>
                        <br>
                        ID: {{ $bucket->id }}<br>
                        User ID: {{ $bucket->user_id }}<br>
                        Name: {{ $bucket->name }}<br>
                        Created at: {{ $bucket->created_at }}<br>
                        Updated at: {{ $bucket->updated_at }}<br>
                    </div>
                    <div>
                        <form action="{{ route('buckets.destroy', ['bucket' => $bucket->id]) }}" method="POST">
                            @csrf()
                            @method('DELETE')

                            <input type="submit" class="btn btn-danger" style="width: 100px; margin-top: 20px;" value="delete" />
                        </form>
                        <br>
                        <a href="{{ route('buckets.edit', ['bucket' => $bucket->id]) }}" class="btn btn-primary">Edit the bucket</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
