@extends('layouts.main')

@section('container')
    <div class="container" id="package">
        <section id="banner">
            <img src="" alt="packages" width="100%" />
        </section>
        <section id="content">
            <div class="row">
                <div class="col mb-4">
                    <h1 class="text-center mb-5">Paket Harga Tiket</h1>
                    <p class="fs-4 text-center">Claryland Playground memberikan penawaran menarik dengan 2 tipe harga yaitu Regular/Weekdays dan Weekend/Holiday. Anda dapat bermain sepuasnya dengan anak kesayangan anda. Selain itu, anda juga bisa keluar masuk wahana bermain asalkan tiket tidak rusak/hilang.<br />Menarik bukan ?</p>
                </div>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col text-center">
                    <div class="card h-100 text-white" style="background:#FF73AF;">
                        <div class="card-body">
                            <h2 class="card-title my-2">Rp 50.000</h2>
                            <h3 class="card-subtitle mb-4">Regular or Weekdays</h3>
                            <p class="card-text fs-5">Harga tiket berlaku untuk Senin s/d Jumat selain tanggal merah dan hari libur nasional.</p>
                        </div>
                    </div>
                </div>
                <div class="col text-center">
                    <div class="card h-100 text-white" style="background:#af64ff;">
                        <div class="card-body">
                            <h2 class="card-title my-2">Rp 60.000</h2>
                            <h3 class="card-subtitle mb-4">Weekend or Holidays</h3>
                            <p class="card-text fs-5">Harga tiket berlaku untuk hari Sabtu s/d Minggu dan hari libur nasional.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col fs-5">
                    <ul>
                        <li>Tiket masuk untuk 1 anak dan 1 pendamping dewasa</li>
                        <li>Tiap anak harus didampingi 1 pendamping dewasa, tidak diperbolehkan untuk meninggalkan anak bermain sendiri</li>
                        <li>Pendamping harus berusia 15 tahun ke atas</li>
                        <li>Baik anak/pendamping wajib memakai kaos kaki selama berada di area bermain</li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
@endsection
