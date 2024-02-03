@extends('layouts.app')

@section('content')
    <div class="container mt-5 d-flex justify-content-center align-items-center">
        <div class="col-md-6">
            <h4>Statistics</h4>
            {{-- <div class="form-group my-2">
                <a href="{{ route('home') }}" class="btn btn-primary">Back</a>
            </div> --}}
            <table class="table">
                <thead class="bg-dark text-white">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">count</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($statistics as $statistic)
                        <tr>
                            <th scope="row">{{ $statistic->id }}</th>
                            <td>{{ $statistic->user?->name }}</td>
                            <td>{{ $statistic->count }}</td>
                        </tr>
                    @empty
                        <p>No data</p>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endsection
