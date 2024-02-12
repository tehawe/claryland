@extends('layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div id="carouselClaryland" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/slide.jpg" class="d-block w-100" alt="Slides">
                        </div>
                        <div class="carousel-item">
                            <img src="img/ballpool.jpg" class="d-block w-100" alt="Ballpool">
                        </div>
                        <div class="carousel-item">
                            <img src="img/sandpool.jpg" class="d-block w-100" alt="Sandpool">
                        </div>
                        <div class="carousel-item">
                            <img src="img/trampolin.jpg" class="d-block w-100" alt="Trampolin">
                        </div>
                        <div class="carousel-item">
                            <img src="img/vehiclestrack.jpg" class="d-block w-100" alt="Vehicles Track">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path fill="#af64ff" fill-opacity="1" d="M0,192L60,176C120,160,240,128,360,138.7C480,149,600,203,720,208C840,213,960,171,1080,160C1200,149,1320,171,1380,181.3L1440,192L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
                </svg>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <img src="img/claryland-icon.png" height="250px;">
                <p class="fs-1">Selamat bermain<br />&<br />Selamat menikmati permainan yang menyenangkan</p>
            </div>
        </div>
    </div>


    </div>
@endsection
