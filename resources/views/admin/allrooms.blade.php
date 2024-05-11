@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 d-inline">Rooms</h5>
                    <a href="create-rooms.html" class="btn btn-primary mb-4 text-center float-right">Create Room</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">image</th>
                                <th scope="col">price</th>
                                <th scope="col">num of persons</th>
                                <th scope="col">size</th>
                                <th scope="col">view</th>
                                <th scope="col">num of beds</th>
                                <th scope="col">hotel name</th>
                                <th scope="col">delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $room)
                                <tr>
                                    <th scope="row">{{ $room->id }}</th>
                                    <td>{{ $room->name }}</td>
                                    <td><img width="40" height="40" src="{{ asset('assets/images/' . $room->image . '') }}" alt=""></td>
                                    <td>${{ $room->price }}</td>
                                    <td>{{$room->max_persons}}</td>
                                    <td>{{$room->size}}</td>
                                    <td>{{$room->view}}</td>
                                    <td>{{$room->num_beds}}</td>
                                    <td>{{$room->hotel->name}}</td>
                                    <td><a href="delete-country.html" class="btn btn-danger  text-center ">Delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
