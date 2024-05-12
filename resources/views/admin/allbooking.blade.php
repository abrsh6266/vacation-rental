@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 d-inline">Bookings</h5>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">check in</th>
                                <th scope="col">check out</th>
                                <th scope="col">full name</th>
                                <th scope="col">hotel name</th>
                                <th scope="col">room name</th>
                                <th scope="col">status</th>
                                <th scope="col">payment</th>
                                <th scope="col">change status</th>
                                <th scope="col">delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->check_in }}</td>
                                    <td>{{ $booking->check_out }}</td>
                                    <td>{{ $booking->name }}</td>
                                    <td>{{ $booking->hotel_name }}</td>
                                    <td>{{ $booking->room_name }}</td>
                                    <td>{{ $booking->status }}</td>
                                    <td>${{ $booking->price }}</td>
                                    <td><a href="" class="btn btn-warning text-center">Change Status</a></td>
                                    <td>
                                        <form action="{{ route('booking.delete', $booking->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
