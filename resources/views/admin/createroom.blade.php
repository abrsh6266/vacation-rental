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
                    <h5 class="card-title mb-5 d-inline">Create Rooms</h5>
                    <form method="POST" action="{{ route('room.store') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Name input -->
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="name" class="form-control" placeholder="Name" />
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Image input -->
                        <div class="form-outline mb-4 mt-4">
                            <input type="file" name="image" class="form-control" />
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Price input -->
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="price" class="form-control" placeholder="Price" />
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Number of persons input -->
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="max_persons" class="form-control" placeholder="Number of Persons" />
                            @error('max_persons')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Number of beds input -->
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="num_beds" class="form-control" placeholder="Number of Beds" />
                            @error('num_beds')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Size input -->
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="size" class="form-control" placeholder="Size" />
                            @error('size')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- View input -->
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="view" class="form-control" placeholder="View" />
                            @error('view')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Hotel selection -->
                        <select name="hotel_id" class="form-control mb-4">
                            <option value="">Choose Hotel</option>
                            @foreach ($hotels as $hotel)
                                <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                            @endforeach
                        </select>
                        @error('hotel_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary mb-4 text-center">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
