@extends('frontend_layouts.frontend')

@section('title', 'Bidder Login')

@section('content')
<div class="auth-section" style="min-height: 80vh; display: flex; align-items: center; padding-top:50px; padding-bottom:50px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="auth-card shadow-lg rounded-4 p-4" style="background: #ffffff; border: none;">
                    
                    {{-- Card Header --}}
                    <div class="text-center mb-4">
                        <h3 class="fw-bold mb-2">Bidder Login</h3>
                        <p class="text-muted small">নিলামে অংশ নিতে লগইন করুন</p>
                    </div>

                    {{-- Error Message --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    {{-- Form --}}
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Email --}}
                        <div class="form-group mb-3">
                            <label class="fw-semibold small">Email Address</label>
                            <input type="email" name="email" class="form-control form-control"
                                placeholder="Enter your email" required>
                        </div>

                        {{-- Password with toggle --}}
                        <div class="form-group mb-4 position-relative">
                            <label class="fw-semibold small">Password</label>
                            <input type="password" name="password" id="password"
                                class="form-control form-control pe-5"
                                placeholder="Enter your password" required>
                            <span onclick="togglePassword()"
                                style="position:absolute; top:38px; right:15px; cursor:pointer;">
                                <i class="bx bx-show fs-5" id="eyeIcon"></i>
                            </span>
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit" class="btn btn-primary w-100 btn-lg fw-bold">
                            Login
                        </button>
                    </form>

                    {{-- Signup Link --}}
                    <div class="text-center mt-4">
                        <span class="text-muted small">নতুন bidder?</span>
                        <a href="{{ route('bidder.signup') }}" class="fw-bold ms-1 text-primary small">
                            Signup করুন
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function togglePassword() {
        const password = document.getElementById('password');
        const icon = document.getElementById('eyeIcon');

        if (password.type === 'password') {
            password.type = 'text';
            icon.classList.remove('bx-show');
            icon.classList.add('bx-hide');
        } else {
            password.type = 'password';
            icon.classList.remove('bx-hide');
            icon.classList.add('bx-show');
        }
    }
</script>
@endpush
