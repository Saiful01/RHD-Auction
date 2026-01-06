@extends('frontend_layouts.frontend')

@section('title', 'Profile')

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
                    <div class="settings-wrap">
                        <div class="edit-info-area">

                            <h6>Edit Your Information</h6>
                            <form action="{{ route('bidder.update') }}" class="edit-info-form" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="edit-info-area mb-30">
                                    <h6>Edit Your Profile Picture</h6>
                                    <div class="edit-profile-img-area">
                                        <div class="profile-img">
                                            @if ($bidder->getFirstMediaUrl('profile_image'))
                                                <img src="{{ $bidder->getFirstMediaUrl('profile_image') }}"
                                                    alt="Bidder Photo">
                                            @else
                                                <img src="{{ asset('assets/img/inner-pages/dashbaord-edit-profile-img.png') }}"
                                                    alt="">
                                            @endif
                                        </div>
                                        <div class="upload-img-area">
                                            <h6>Upload Your Image</h6>
                                            <div class="upload-filed">
                                                <input type="file" name="photo">
                                            </div>
                                            <span>JPEG 100 x 100</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-30">
                                        <div class="form-inner">
                                            <label>Full Name</label>
                                            <input type="text" name="name" value="{{ old('name', $bidder->name) }}"
                                                placeholder="Md. Rofiqul">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-30">
                                        <div class="verify-area">
                                            <div class="form-inner">
                                                <label>Email Address</label>
                                                <input type="email" name="email"
                                                    value="{{ old('email', $bidder->email) }}">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-30">
                                        <div class="form-inner">
                                            <label>Phone</label>
                                            <input type="text" name="phone" value="{{ old('phone', $bidder->phone) }}"
                                                placeholder="Md. Rofiqul">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-30">
                                        <div class="form-inner">
                                            <label>NID Number</label>
                                            <input type="text" name="nid_no"
                                                value="{{ old('nid_no', $bidder->nid_no) }}" placeholder="Md. Rofiqul">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-30">
                                        <div class="form-inner">
                                            <label>TIN Number</label>
                                            <input type="text" name="tin_no"
                                                value="{{ old('tin_no', $bidder->tin_no) }}" placeholder="Md. Rofiqul">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-30">
                                        <div class="form-inner">
                                            <label>BIN Number</label>
                                            <input type="text" name="bin_no"
                                                value="{{ old('bin_no', $bidder->bin_no) }}" placeholder="Md. Rofiqul">
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6 mb-30">
                                        <div class="form-inner">
                                            <label>Last Name</label>
                                            <input type="text" name="last_name"
                                                value="{{ old('last_name', $bidder->last_name) }}">
                                        </div>
                                    </div> --}}
                                    <div class="col-md-12 mb-50">
                                        <div class="form-inner">
                                            <label>Your Address</label>
                                            <input type="text" name="address"
                                                value="{{ old('address', $bidder->address) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-50">
                                        <div class="form-inner">
                                            <label>About Yourself</label>
                                            <input type="text" name="details"
                                                value="{{ old('details', $bidder->details) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-30">
                                        <div class="edit-info-area">
                                            <h6>NID File</h6>
                                            <div class="edit-profile-img-area">
                                                <div class="profile-img">
                                                    @if ($bidder->getFirstMediaUrl('nid_file'))
                                                        {{-- PDF or image preview --}}
                                                        @php
                                                            $nidFile = $bidder->getFirstMedia('nid_file');
                                                            $isImage = str_contains($nidFile->mime_type, 'image');
                                                        @endphp
                                                        @if ($isImage)
                                                            <img src="{{ $nidFile->getUrl('preview') }}" alt="NID File">
                                                        @else
                                                            <a href="{{ $nidFile->getUrl() }}" target="_blank">View NID
                                                                File</a>
                                                        @endif
                                                    @else
                                                        <span>No NID File Uploaded</span>
                                                    @endif
                                                </div>
                                                <div class="upload-img-area">
                                                    <h6>Upload NID File</h6>
                                                    <div class="upload-filed">
                                                        <input type="file" name="nid_file">
                                                    </div>
                                                    <span>PDF / JPEG / PNG, Max: 5MB</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-30">
                                        <div class="edit-info-area">
                                            <h6>TIN File</h6>
                                            <div class="edit-profile-img-area">
                                                <div class="profile-img">
                                                    @if ($bidder->getFirstMediaUrl('tin_file'))
                                                        {{-- PDF or image preview --}}
                                                        @php
                                                            $tinFile = $bidder->getFirstMedia('tin_file');
                                                            $isImage = str_contains($tinFile->mime_type, 'image');
                                                        @endphp
                                                        @if ($isImage)
                                                            <img src="{{ $tinFile->getUrl('preview') }}" alt="TIN File">
                                                        @else
                                                            <a href="{{ $tinFile->getUrl() }}" target="_blank">View TIN
                                                                File</a>
                                                        @endif
                                                    @else
                                                        <span>No NID File Uploaded</span>
                                                    @endif
                                                </div>
                                                <div class="upload-img-area">
                                                    <h6>Upload TIN File</h6>
                                                    <div class="upload-filed">
                                                        <input type="file" name="tin_file">
                                                    </div>
                                                    <span>PDF / JPEG / PNG, Max: 5MB</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-30">
                                        <div class="edit-info-area">
                                            <h6>BIN File</h6>
                                            <div class="edit-profile-img-area">
                                                <div class="profile-img">
                                                    @if ($bidder->getFirstMediaUrl('bin_file'))
                                                        {{-- PDF or image preview --}}
                                                        @php
                                                            $binFile = $bidder->getFirstMedia('bin_file');
                                                            $isImage = str_contains($binFile->mime_type, 'image');
                                                        @endphp
                                                        @if ($isImage)
                                                            <img src="{{ $binFile->getUrl('preview') }}" alt="BIN File">
                                                        @else
                                                            <a href="{{ $binFile->getUrl() }}" target="_blank">View BIN
                                                                File</a>
                                                        @endif
                                                    @else
                                                        <span>No BIN File Uploaded</span>
                                                    @endif
                                                </div>
                                                <div class="upload-img-area">
                                                    <h6>Upload BIN File</h6>
                                                    <div class="upload-filed">
                                                        <input type="file" name="bin_file">
                                                    </div>
                                                    <span>PDF / JPEG / PNG, Max: 5MB</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="primary-btn btn-hover two">
                                    Save Changes
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
