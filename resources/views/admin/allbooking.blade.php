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
                                    <td>
                                        <form action="{{ route('booking.changeStatus', $booking->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-select" style="margin-bottom: 10px">
                                                <option value="Pending">Pending</option>
                                                <option value="Confirmed">Confirmed</option>
                                                <option value="Cancelled">Cancelled</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary">Change Status</button>
                                        </form>
                                    </td>
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
