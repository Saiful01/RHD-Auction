@extends('frontend_layouts.frontend')

@section('title', 'Bidder Change Password')

@section('content')

    @if (session('success'))
        <div id="success-message" class="alert alert-success" role="alert"
            style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
            {{ session('success') }}
        </div>

        <script>
            setTimeout(function() {
                var msg = document.getElementById('success-message');
                if (msg) {
                    msg.style.transition = 'opacity 0.5s';
                    msg.style.opacity = '0';
                    setTimeout(() => msg.remove(), 500);
                }
            }, 3000); // 3 seconds
        </script>
    @endif

    <!-- Start Breadcrumb section -->
    @include('frontend_layouts.partials.breadcrumb', [
        'title' => 'Profile',
        'breadcrumb' => 'Profile',
    ])
    <!-- End Breadcrumb section -->

    <!-- Start Dashboard section -->
    <div class="dashboard-section pt-50 mb-110">
        <div class="container">
            <div class="dashboard-wrapper">
                @include('frontend.bidder.partials.sidebar')
                <div class="dashboard-content-wrap two">
                    <div class="change-pass-wrap">
                        <div class="edit-info-area">
                            <h6>Update Your Password</h6>
                            <form action="{{ route('bidder.updatePassword') }}" method="POST" class="edit-info-form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-50">
                                        <div class="form-inner">
                                            <label>Old Password</label>
                                            <input name="current_password" id="password" type="password"
                                                placeholder="Old Password" required>
                                            <i class="bi
                                                bi-eye-slash"
                                                id="togglePassword"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-30">
                                        <div class="form-inner">
                                            <label>New Password</label>
                                            <input name="password" id="password2" type="password" placeholder="New Password"
                                                required>
                                            <i class="bi
                                                bi-eye-slash"
                                                id="togglePassword2"></i>
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-60">
                                        <div class="form-inner">
                                            <label>Confirm Password</label>
                                            <input name="password_confirmation" id="password3" type="password"
                                                placeholder="Confirm Password" required>
                                            <i class="bi
                                                bi-eye-slash bi-eye"
                                                id="togglePassword3"></i>
                                            @error('password_confirmation')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button class="primary-btn btn-hover two">
                                    Change Password
                                    <span></span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Dashboard section -->
@endsection
