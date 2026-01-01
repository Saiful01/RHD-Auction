@extends('frontend_layouts.frontend')

@section('title', 'Bidder Signup')

@section('content')
    <div class="auth-section"
        style="min-height: 90vh; display: flex; align-items: center; padding-top: 50px; padding-bottom: 50px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="auth-card shadow-lg rounded-4 p-4" style="background: #ffffff; border: none;">

                        {{-- Card Header --}}
                        <div class="text-center mb-4">
                            <h3 class="fw-bold mb-2">Bidder Registration</h3>
                            <p class="text-muted small">তথ্য পূরণ করুন, যাচাই শেষে অ্যাকাউন্ট অনুমোদিত হবে</p>
                        </div>

                        {{-- Error Message --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Registration Form --}}
                        <form method="POST" action="" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-semibold small">Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="fw-semibold small">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3 position-relative">
                                    <label class="fw-semibold small">Password</label>
                                    <input type="password" name="password" id="password" class="form-control pe-5"
                                        required>
                                    <span onclick="togglePassword()"
                                        style="position:absolute; top:38px; right:15px; cursor:pointer;">
                                        <i class="bx bx-show fs-5" id="eyeIcon"></i>
                                    </span>
                                </div>

                                <div class="col-md-6 mb-3 position-relative">
                                    <label class="fw-semibold small">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="confirm_password"
                                        class="form-control pe-5" required>
                                    <span onclick="toggleConfirmPassword()"
                                        style="position:absolute; top:38px; right:15px; cursor:pointer;">
                                        <i class="bx bx-show fs-5" id="confirmEyeIcon"></i>
                                    </span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="fw-semibold small">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="fw-semibold small">NID Number</label>
                                    <input type="text" name="nid_number" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="fw-semibold small">TIN Number (Optional)</label>
                                    <input type="text" name="tin_number" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="fw-semibold small">BIN Number (Optional)</label>
                                    <input type="text" name="bin_number" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="fw-semibold small">Profile Photo (Optional)</label>
                                    <input type="file" name="photo" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="fw-semibold small">NID File</label>
                                    <input type="file" name="nid_file" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="fw-semibold small">TIN File</label>
                                    <input type="file" name="tin_file" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="fw-semibold small">BIN File</label>
                                    <input type="file" name="bin_file" class="form-control">
                                </div>
                            </div>

                            {{-- Submit Button --}}
                            <button type="submit" class="btn btn-primary w-100 fw-bold mt-3">
                                Submit Registration
                            </button>
                        </form>

                        {{-- Login Link --}}
                        <div class="text-center mt-4">
                            <span class="text-muted small">আগেই রেজিস্টার করেছেন?</span>
                            <a href="{{ route('bidder.login') }}" class="fw-bold ms-1 text-primary small">
                                Login করুন
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

        function toggleConfirmPassword() {
            const password = document.getElementById('confirm_password');
            const icon = document.getElementById('confirmEyeIcon');

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
