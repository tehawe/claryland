@extends('dashboard.layouts.main')

@section('container')
    <div class="container" id="dashboard">
        <h1>Dashboard</h1>
        <div class="content" id="counter">
            <div class="row d-flex" id="sales">
                <div class="col-md-4 border" id="sales">
                    <h4>Sales</h4>
                    <h6>value</h6>
                    <div class="row justify-content-between" id="info">
                        <div class="key col">key</div>
                        <div class="value col text-end">value</div>
                    </div>
                </div>

            </div>
            <div class="col-md-4" id="visitors">
                <h4>Visitors</h3>
            </div>
            <div class="col-md-4" id="members">
                <h4>Members</h4>
            </div>
        </div>
        <div class="row d-flex">
            <div class="col-md-6">
                <h4>Package</h4>
            </div>
            <div class="col-md-6">
                <h4>Pengunjung</h3>
            </div>
        </div>
    </div>
    </div>
@endsection
