<!-- resources/views/components/virtual-tour-section.blade.php -->
<style>
    .btn-gradient {
        background: linear-gradient(45deg, #0D0433, #3AAD34);
        border: none;
        color: #fff;
        border-radius: 5px;
        transition: background 0.5s cubic-bezier(0.4, 0, 0.2, 1),
        box-shadow 0.5s cubic-bezier(0.4, 0, 0.2, 1),
        color 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 8px rgba(58, 173, 52, 0.4);
    }

    .btn-gradient:hover {
        box-shadow: 0 6px 8px rgba(13, 4, 51, 0.6);
        color: #fff;
    }

     .virtual-tour-section {
         background: linear-gradient(80deg, #0d0433 30%, #3AAD34 100%);
     }
    .captcha-img {
        width: 100%;
        height: 40px;
        object-fit: contain;
    }

</style>

<div class="virtual-tour-section py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <!-- Video Section -->
            <div class="col-md-7 text-center mb-4 mb-md-0">
                <h4 class="fw-bold text-white">
                    <span class="text-white">{{$systemInfo->site_name ?? ''}}</span> - <span class="text-light">A Virtual Tour</span>
                </h4>
                <p class="text-light small">Quick Look at Practice Labs, Facilities, Trainers, Awards & Much More</p>
                <div class="ratio ratio-16x9 border border-2 border-light rounded shadow-sm mt-3 p-2">
                    <iframe class="rounded rounded-2"
                            src="https://www.youtube.com/embed/YOUR_VIDEO_ID"
                            title="YouTube video"
                            allowfullscreen>
                    </iframe>
                </div>
            </div>

            <!-- Callback Form -->
            <div class="col-md-5">
                <div class="card border-0 rounded-3 shadow-lg">
                    <div class="card-header bg-white text-center border-bottom">
                        <div class="d-flex flex-column align-items-center">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mb-2" style="width: 48px; height: 48px;">
                                <i class="bi bi-telephone-forward-fill fs-5"></i>
                            </div>
                            <h5 class="fw-semibold mb-0 text-dark">Request a Call Back</h5>
                            <small class="text-muted">We’ll get in touch with you shortly</small>
                        </div>
                    </div>

                    <div class="card-body" id="callback-form">
                        <form action="{{route('visitor.store')}}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-person-fill text-secondary"></i>
                            </span>
                                        <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-envelope-fill text-secondary"></i>
                            </span>
                                        <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group my-3">
                    <span class="input-group-text bg-light">
                        <i class="bi bi-telephone-fill text-secondary"></i>
                    </span>
                                <input type="tel" class="form-control" name="phone" placeholder="Phone Number" required>
                            </div>

                            <div class="input-group mb-3">
                    <span class="input-group-text bg-light">
                        <i class="bi bi-journal-text text-secondary"></i>
                    </span>
                                <input type="text" class="form-control" name="course" placeholder="Course of Interest" required>
                            </div>

                            <div class="form-group mb-3">
                                <textarea class="form-control" name="message" rows="3" placeholder="Your Message"></textarea>
                            </div>


                            {{-- CAPTCHA --}}
                            <div class="form-group mb-3">
                                <div class="input-group">
        <span class="input-group-text bg-light">
            <i class="bi bi-shield-lock-fill text-secondary"></i>
        </span>
                                    <input type="text" class="form-control" name="captcha" placeholder="Type the code" required>
                                </div>
                                @error('captcha')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror

                                <div class="d-flex align-items-stretch mt-2 gap-2">
                                    <img src="{{ captcha_src('flat') }}" alt="Captcha" class="captcha-img border rounded" style="height: 42px;">
                                    <button type="button" class="btn btn-sm btn-outline-secondary d-flex align-items-center justify-content-center" style="height: 42px;" onclick="refreshCaptcha()">
                                        <i class="bi bi-arrow-clockwise me-1"></i> Refresh
                                    </button>
                                </div>
                            </div>



                            {{-- Submit --}}
                            <button type="submit" class="btn btn-gradient w-50 fw-bold py-2 d-flex align-items-center justify-content-center gap-2 mx-auto">
                                <span>Submit Request</span>
                                <i class="bi bi-arrow-right-circle-fill fs-4" style="line-height: 1;"></i>
                            </button>
                        </form>


                        {{-- Success Message --}}
                        @if(session('success'))
                            <div class="alert alert-success mt-3">{{ session('success') }}</div>
                        @endif

                        {{-- Error Messages --}}
                        @if($errors->any())
                            <div class="alert alert-danger mt-3">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{-- JavaScript --}}
                        <script>
                            function refreshCaptcha() {
                                fetch('{{ url("/refresh-captcha") }}')
                                    .then(response => response.json())
                                    .then(data => {
                                        document.querySelector('.captcha-img').setAttribute('src', data.captcha + '?' + Date.now());
                                    });
                            }
                        </script>



                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(el => el.style.display = 'none');
    }, 5000);
</script>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        const hasMessages = document.querySelector('.alert-success, .alert-danger');
        if (hasMessages) {
            const formSection = document.getElementById('callback-form');
            if (formSection) {
                formSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }
    });
</script>
