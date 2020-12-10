@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create a new bucket') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="form" action="{{ route('buckets.update', ['bucket' => $bucket->id]) }}" method="POST">
                        @method('PUT')
                        @csrf()
                        <div class="row">
                            <div class="col-12 col-xl-6">
                                <label for="name">Name:</label><br>
                                <input type="text" id="name" name="name" value="{{ $bucket->name }}"><br>
                                <input type="submit" class="btn btn-primary float-left" style="width: 100px; margin-top: 20px;" value="Edit" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
