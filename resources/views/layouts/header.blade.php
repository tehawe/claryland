<nav class="navbar navbar-expand-sm">
    <div class="container-fluid col-md-10">
        <a class="navbar-brand" href="home"><img src="img/claryland-text.png" height="70" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse navbar-expand-sm" id="navbar">
            <ul class="navbar-nav ms-auto mb-2 mb-sm-0">
                <li class="nav-item"><a class="nav-link {{ $active == 'home' ? 'active' : '' }}" href="home">Home</a></li>
                <li class="nav-item"><a class="nav-link {{ $active == 'package' ? 'active' : '' }}" href="package">Package</a></li>
                <li class="nav-item"><a class="nav-link {{ $active == 'gallery' ? 'active' : '' }}" href="gallery">Gallery</a></li>
                <li class="nav-item"><a class="nav-link {{ $active == 'FAQs' ? 'active' : '' }}" href="FAQs">FAQs</a></li>
                <li class="nav-item"><a class="nav-link {{ $active == 'contact' ? 'active' : '' }}" href="contact">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>