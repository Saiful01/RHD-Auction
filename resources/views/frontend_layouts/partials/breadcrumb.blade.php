<!-- Start Breadcrumb section -->
<div class="breadcrumb-section"
    style="background-image: url(../assets/img/inner-pages/breadcrumb-bg1.png), linear-gradient(87.29deg, #FDF8E7 0%, #E4FFF0 99.71%);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="banner-content">
                    <h1>{{ $title ?? '' }}</h1>
                    <ul class="breadcrumb-list">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>{{ $breadcrumb ?? ($title ?? '') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumb section -->
