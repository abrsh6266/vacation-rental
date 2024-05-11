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
                    <h5 class="card-title mb-5 d-inline">Create Hotels</h5>
                    <form method="POST" action="{{ route('hotel.store') }}" enctype="multipart/form-data">
                        <!-- Email input -->
                        @csrf
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="name" id="form2Example1" class="form-control"
                                placeholder="name" />

                        </div>
                        @if ($errors->has('name'))
                            <p class="alert alert-success">{{ $errors->first('name') }}</p>
                        @endif

                        <div class="form-outline mb-4 mt-4">
                            <input type="file" name="image" id="form2Example1" class="form-control" />

                        </div>
                        @if ($errors->has('image'))
                            <p class="alert alert-success">{{ $errors->first('image') }}</p>
                        @endif
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        @if ($errors->has('description'))
                            <p class="alert alert-success">{{ $errors->first('description') }}</p>
                        @endif
                        <div class="form-outline mb-4 mt-4">
                            <label for="exampleFormControlTextarea1">Location</label>

                            <input placeholder="location" type="text" name="location" id="form2Example1"
                                class="form-control" />

                        </div>
                        @if ($errors->has('location'))
                            <p class="alert alert-success">{{ $errors->first('location') }}</p>
                        @endif


                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
