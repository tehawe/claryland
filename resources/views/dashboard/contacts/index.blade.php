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
                                <th align="center">No</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)
                                <tr>
                                    <td align="right">{{ $loop->iteration }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td align="center">{{ $contact->contact }}</td>
                                    <td>{{ $contact->email }}</td>
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
