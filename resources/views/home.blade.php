@extends('layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <section id="carousel" style="max-height: 500px; overflow:hidden;">
                    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="4000">
                                <img src="https://source.unsplash.com/600x300/?playground" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item" data-bs-interval="2000">
                                <img src="https://source.unsplash.com/600x300/?play" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="https://source.unsplash.com/600x300/?mall" class="d-block w-100" alt="...">
                            </div>
                        </div>
                    </div>
                </section>
                <section id="info">
                    <p>{{ $info }}</p>
                    <ul>
                        <li>Entrance ticket for 1 child and 1 adult companion</li>
                        <li>Each child must be accompanied by 1 adult companion, not allowed to leave the child to play alone</li>
                        <li>Companion must be 17 years old and over</li>
                        <li>Must wear a mask and socks while in the play area</li>
                    </ul>
                </section>

            </div>
        </div>
    </div>
@endsection
