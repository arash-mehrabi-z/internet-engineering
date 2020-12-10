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

                    <form class="form" action="{{ route('buckets.store') }}" method="POST">
                        @csrf()
                        <div class="row">
                            <div class="col-12 col-xl-6">
                                <label for="name">Name:</label><br>
                                <input type="text" id="name" name="name"><br>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <input type="submit" class="btn btn-primary float-left" style="width: 100px; margin-top: 20px;" value="create" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
