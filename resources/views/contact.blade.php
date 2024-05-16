@extends('layouts.main')

@section('container')
    <div class="container">
        <section id="banner">
            <div class="row mb-5">
                <div class="col text-center">
                    <img src="/img/contact.png" alt="packages" class="w-50" />
                </div>
            </div>
        </section>
        <section id="content">
            <div class="row">
                <div class="col ps-2 pe-1 rounded" id="location">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.631087393701!2d107.76911487499666!3d-6.934619593065341!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68c5bb412ecf0d%3A0xb439a06f39e1be29!2sJatinangor%20Town%20Square%20-%20JATOS!5e0!3m2!1sid!2sid!4v1700555951615!5m2!1sid!2sid" width="600" height="450" style="border:5;" allowfullscreen=""
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="rounded"></iframe>
                </div>
                <div class="col p-3 border rounded ms-3" id="detail">
                    <div class="rows">
                        <div class="col bg-secondary border">Address</div>
                        <div class="col bg-secondary border">Website</div>
                        <div class="col bg-secondary border">Contact Person</div>
                        <div class="col bg-secondary border">Social

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
