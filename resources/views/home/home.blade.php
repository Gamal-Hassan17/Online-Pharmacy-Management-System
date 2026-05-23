@extends('include.templat.layout')
@section('title', 'Home')

@section('content')
<div class="container py-5">

        <div class="row align-items-center mb-5 ">
            <div class="col-md-6 ">
                <h1 class="display-4 fw-bold text-success mb-3">Your Health, Our Priority</h1>
                <p class="lead text-muted mb-4">Order your medicines and healthcare products online with fast delivery and trusted service.</p>
                <div class="d-flex flex-wrap gap-3 mb-3">
                    <a href="{{ route('all_pro') }}" class="btn btn-success btn-lg">🛒 Shop Now</a>
                    <a href="{{ route('my.orders') }}" class="btn btn-outline-success btn-lg">📦 My Orders</a>
                    <a href="{{ route('customer.cart') }}" class="btn btn-outline-secondary btn-lg">🛍️ View Cart</a>
                    <a href="#contact" class="btn btn-outline-info btn-lg">📞 Contact Us</a>
                    {{-- <a href="{{ route('chatbot') }}" class="btn btn-outline-info btn-lg">📞 chatbot</a> --}}
                    <a href="{{ route('conversation') }}" class="btn btn-outline-warning btn-lg">💬 Support</a>

                </div>
            </div>
            <div class="col-md-6 text-center">
                <img src="{{ asset('images/Best-Pharmacy-Website-Designs.jpg') }}" class="img-fluid rounded shadow" alt="Pharmacy">
            </div>
        </div>


    <div class="row mb-5 text-center">
        <h2 class="fw-bold text-success mb-4">Why Choose Our Pharmacy?</h2>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <span class="display-5">🚚</span>
                    <h5 class="fw-bold mt-3">Fast Delivery</h5>
                    <p class="text-muted">Get your medicines delivered to your doorstep quickly and safely.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <span class="display-5">💊</span>
                    <h5 class="fw-bold mt-3">Original Medicines</h5>
                    <p class="text-muted">We guarantee 100% authentic and high-quality products.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <span class="display-5">🕑</span>
                    <h5 class="fw-bold mt-3">24/7 Support</h5>
                    <p class="text-muted">Our team is always here to help you with any questions or issues.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Categories Section --}}
    <div class="mb-5">
        <h2 class="fw-bold text-center mb-4 text-success">All Categories</h2>
        <div class="d-flex overflow-auto gap-3 px-2 py-3">
                @foreach($categories as $cat)
                    @if($cat->is_active)

                        <div style="min-width: 250px;">

                            <div class="card p-4 shadow-sm border-0 h-100">

                                <img src="{{ asset('images/medicine.jpg') }}" class="card-img-top" alt="Category">

                                <h5 class="text-success mt-2">{{ $cat->name }}</h5>

                                <p class="text-muted">
                                    {{ $cat->description }}
                                </p>

                                <a href="{{ route('show_cat', $cat->id) }}" class="btn btn-outline-success btn-sm">
                                    View Details
                                </a>

                            </div>

                        </div>

                    @endif
                @endforeach

        </div>
    </div>

    {{-- Featured Products (Demo) --}}


    {{-- Order Tracking Section --}}
    <div class="container my-5">

    <!-- Track Orders -->
    <div class="text-center mb-5">
        <h2 class="fw-bold text-success mb-3">Track Your Orders</h2>
        <p class="text-muted">Easily check the status of your orders and view details anytime.</p>
        <a href="{{ route('my.orders') }}" class="btn btn-primary btn-lg px-4">
            📦 Track My Orders
        </a>
    </div>

    <!-- Contact Section -->
    <div class="row justify-content-center" id="contact">
        <div class="col-lg-6 text-center">
            <div class="card shadow-sm p-4 border-0">

                <h3 class="fw-bold text-success mb-3">Contact Us</h3>
                <p class="text-muted fs-5 mb-4">
                    Have a question or need help? Reach out to our support team anytime.
                </p>

                <div class="d-flex justify-content-center gap-3 flex-wrap">

                    <!-- Call -->
                    <a href="tel:+201550480826" class="btn btn-success px-4">
                        📞 Call Now
                    </a>

                    <!-- WhatsApp -->
                    <a href="https://wa.me/201550480826" target="_blank" class="btn btn-outline-success px-4">
                        💬 WhatsApp
                    </a>

                </div>

            </div>
        </div>
    </div>

</div>

    {{-- Footer --}}
    {{-- <footer class="footer mt-5 py-3 border-top text-center">
        <div class="container">
            <span class="text-muted">&copy; {{ date('Y') }} Pharmacy. All rights reserved.</span>
        </div>
    </footer> --}}
</div>
@endsection
