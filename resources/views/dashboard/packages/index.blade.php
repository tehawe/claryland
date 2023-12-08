@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h2>Packages</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-sm">
                    <tbody>
                        @foreach ($packages as $package)
                            <tr>
                                <td>{{ $package->name }}</td>
                                <td align="right">Rp {{ number_format($package->price) }}</td>
                                <td>{{ $package->description }}</td>
                                <td>{{ $package->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
