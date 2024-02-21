@extends('dashboard.layouts.main')


@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1 class="border-bottom border-dark">Sales</h1>
                @if ($sales->count() >= 1)
                    <div class="border rounded p-2 my-2">
                        <table class="table table-sm table-bordered data-table">
                            <thead class="table-info">
                                <tr valign="middle" align="center">
                                    <th>No</th>
                                    <th>Dates</th>
                                    <th>Order Count</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $saleDate => $items)
                                    <tr align="center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ date_format(new DATETIME($saleDate), 'd/m/Y') }}</td>
                                        <td align="right">{{ $items->count() }}</td>
                                        <td align="right">{{ 'Rp ' . number_format($items->where('created_date', $saleDate)->sum('total')) }}</td>
                                        <td><a href="{{ route('sales.show', ['date' => $saleDate]) }}" class="btn btn-info btn-sm"><i class="bi-box-arrow-in-right me-1"></i>Detail</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="bg-warning p-2 my-2 text-center w-50 rounded">
                        Data sales not found.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        let table = new DataTable('.data-table');
    </script>
@endsection
