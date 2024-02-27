@extends('dashboard.layouts.main')


@section('container')
    <div class="container-fluid">
        <div class="row py-2">
            <div class="col">
                <h1 class="border-bottom border-secondary pb-3 mb-3">Contacts</h1>
                <div class="row rounded">
                    <table class="data-table table table-bordered table-sm">
                        <thead class="table-info">
                            <tr>
                                <th>No</th>
                                <th>Contact</th>
                                <th>Name</th>
                                <th>Repeat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact => $data)
                                <tr>
                                    <td align="right">{{ $loop->iteration }}</td>
                                    <td>{{ $contact }}</td>
                                    <td>
                                        @foreach ($data as $contact)
                                            {{ $contact->customer_name . ' at ' . date_format($contact->created_at, 'd/m/Y') . ',' }}
                                        @endforeach
                                    </td>
                                    <td align="center">{{ $data->count() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        let table = new DataTable('.data-table');
    </script>
@endsection
