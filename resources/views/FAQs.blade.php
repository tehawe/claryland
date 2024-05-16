@extends('layouts.main')

@section('container')
    <div class="container" id="faq">
        <section id="banner">
            <div class="row mb-5">
                <div class="col text-center">
                    <img src="/img/faq.png" alt="packages" class="w-50" />
                </div>
            </div>
        </section>
        <section id="content">
            <div class="row">
                <div class="col">
                    <div class="accordion" id="accordionFaq">
                        <!-- Informasi -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                    <strong>Apa itu Claryland Playground ?</strong>
                                </button>
                            </h2>
                            <div id="collapse-1" class="accordion-collapse collapse show" data-bs-parent="#accordionFaq">
                                <div class="accordion-body">
                                    Claryland Playground merupakan wahana bermain untuk anak-anak.
                                </div>
                            </div>
                        </div>

                        <!-- HTM & Pembayaran -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
                                    <strong>Berapa Harga Tiket Masuk (HTM) Claryland Playground ?</strong>
                                </button>
                            </h2>
                            <div id="collapse-2" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                                <div class="accordion-body">
                                    <p>Harga Tiket Masuk (HTM) Claryland saat ini terbagi menjadi 2 tipe yaitu:</p>
                                    <ul>
                                        <li>
                                            <strong>Rp 50.000</strong> - Regular or weekdays<br />
                                            Harga tiket berlaku untuk Senin s/d Jumat selain tanggal merah dan hari libur nasional.
                                        </li>
                                        <li>
                                            <strong>Rp 60.000</strong> - Weekend and holidays<br />
                                            Harga tiket berlaku untuk hari Sabtu s/d Minggu dan hari libur nasional.
                                        </li>
                                    </ul>
                                    <h6>Catatan:</h6>
                                    <p>
                                        - Tiket masuk untuk 1 anak dan 1 pendamping dewasa<br />
                                        - Tiap anak harus didampingi minimal 1 pendamping dewasa, tidak diperbolehkan untuk meninggalkan anak bermain sendiri<br />
                                        - Pendamping harus berusia minimal 15 tahun ke atas<br />
                                        - Baik Anak maupun Pendamping wajib memakai <strong>kaos kaki</strong> selama berada di dalam playground
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                                    <strong>Apa saja metode pembayaran yang diterima untuk transaksi di Claryland Playground ?</strong>
                                </button>
                            </h2>
                            <div id="collapse-3" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                                <div class="accordion-body">
                                    <p>Saat ini Claryland Playground menerima 3 jenis metode pembayaran untuk seluruh transaksi, antara lain:</p>
                                    <ul>
                                        <li><strong>Cash</strong>, yaitu pembayaran menggunakan uang tunai.</li>
                                        <li><strong>Card/Debit</strong>, yaitu pembayaran menggunakan kartu debit.</li>
                                        <li><strong>QRIS</strong>, yaitu pembayaran menggunakan aplikasi uang elektronik.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Aturan Playground -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                    <strong>Apakah wajib menggunakan Kaos Kaki ?</strong>
                                </button>
                            </h2>
                            <div id="collapse-4" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                                <div class="accordion-body">
                                    <p>Setiap pengunjung baik Anak maupun Pendamping <strong>Wajib Menggunakan Kaos Kaki</strong>.</p>
                                    <p>Pengunjugn yang tidak membawa kaos kaki dapat membelinya diloket pembayaran, karena kami juga menjual kaos kaki dengan harga Rp 10.000</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
                                    <strong>Bagaimana jika ingin bertukar pendamping ?</strong>
                                </button>
                            </h2>
                            <div id="collapse-5" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                                <div class="accordion-body">
                                    <p>Claryland Playground memperbolehkan pertukaran pendamping dengan tujuan agar setiap anak yang bermain tetap ada yang mendampingi selama bermain di dalam playground.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-6" aria-expanded="false" aria-controls="collapse-6">
                                    <strong>Apakah jika sudah meninggalkan playground bisa masuk kembali ?</strong>
                                </button>
                            </h2>
                            <div id="collapse-6" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                                <div class="accordion-body">
                                    <p><strong>Bisa</strong>, Setiap pengunjung yang sudah keluar meninggalkan playground diperbolehkan kembali lagi selama Gelang Tiket tidak hilang atau rusak. Tapi, hanya berlaku dihari yang sama.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
