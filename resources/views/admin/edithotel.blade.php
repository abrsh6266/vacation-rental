@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                    </div>
                    <h5 class="card-title mb-5 d-inline">Update Hotel</h5>
                    <form action="{{ route('hotel.edit', $hotel->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name"
                                value="{{ $hotel->name }}" />
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3">{{ $hotel->description }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-outline mb-4 mt-4">
                            <label for="location">Location</label>
                            <input type="text" name="location" id="location" class="form-control"
                                value="{{ $hotel->location }}" />
                            @error('location')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mb-4 text-center">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
