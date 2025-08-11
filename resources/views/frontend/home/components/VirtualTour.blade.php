<style scoped>
    .virtual-tour-section {
        background: linear-gradient(135deg, var(--accent) 0%, var(--dark) 100%);
        position: relative;
        overflow: hidden;
    }

    .virtual-tour-section:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--primary-dark));
    }

    .tour-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .tour-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .btn-tour {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border: none;
        color: white;
        font-weight: 500;
        letter-spacing: 0.05em;
        padding: 0.75rem 1.75rem;
        border-radius: 6px;
        box-shadow: 0 4px 15px rgba(0, 102, 220, 0.3);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-tour:after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: all 0.5s ease;
    }

    .btn-tour:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 102, 220, 0.4);
    }

    .btn-tour:hover:after {
        left: 100%;
    }

    .video-container {
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
    }

    .video-container:hover {
        border-color: var(--primary);
        box-shadow: 0 10px 35px rgba(0, 102, 220, 0.4);
    }

    .form-icon {
        width: 48px;
        height: 48px;
        background: var(--primary);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        box-shadow: 0 4px 10px rgba(0, 102, 220, 0.3);
    }

    .input-group-text-custom {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: var(--muted);
    }

    .form-control-custom {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
    }

    .form-control-custom:focus {
        background: rgba(255, 255, 255, 0.05);
        border-color: var(--primary);
        color: white;
        box-shadow: 0 0 0 0.25rem rgba(0, 102, 220, 0.25);
    }

    .captcha-container {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 6px;
        padding: 0.5rem;
    }

    .btn-refresh {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: var(--muted);
        transition: all 0.3s ease;
    }

    .btn-refresh:hover {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .alert-custom {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(5px);
    }

    @media (max-width: 767.98px) {
        .video-container {
            margin-bottom: 2rem;
        }
    }
</style>

<div class="virtual-tour-section py-5 position-relative">
    <div class="container position-relative">
        <div class="row align-items-center">
            <!-- Video Section -->
            <div class="col-lg-7 mb-5 mb-lg-0">
                <div class="pe-lg-4">
                    <h2 class="display-6 fw-bold text-white mb-3">
                        <span class="">{{$systemInfo->site_name ?? 'Our Institution'}}</span> Virtual Tour
                    </h2>
                    <p class="lead text-muted mb-4">Experience our world-class facilities, labs, and learning environment through this immersive virtual tour.</p>

                    <div class="video-container">
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/YOUR_VIDEO_ID"
                                    title="Virtual Tour"
                                    allowfullscreen
                                    class="rounded-2">
                            </iframe>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <button class="btn btn-tour">
                            <i class="bi bi-play-circle-fill me-2"></i> Watch Full Tour
                        </button>
                        <button class="btn btn-outline-light">
                            <i class="bi bi-images me-2"></i> View Gallery
                        </button>
                    </div>
                </div>
            </div>

            <!-- Callback Form -->
            <div class="col-lg-5">
                <div class="tour-card rounded-3 p-4 h-100">
                    <div class="text-center mb-4">
                        <div class="form-icon">
                            <i class="bi bi-headset fs-4"></i>
                        </div>
                        <h3 class="text-white mb-1">Request a Callback</h3>
                        <p class="text-muted small">We'll contact you within 24 hours</p>
                    </div>

                    <form action="{{route('visitor.store')}}" method="POST" id="callback-form">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom">
                                        <i class="bi bi-person-fill"></i>
                                    </span>
                                    <input type="text"
                                           class="form-control form-control-custom"
                                           name="name"
                                           placeholder="Full Name"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom">
                                        <i class="bi bi-envelope-fill"></i>
                                    </span>
                                    <input type="email"
                                           class="form-control form-control-custom"
                                           name="email"
                                           placeholder="Email Address"
                                           required>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mt-3">
                            <span class="input-group-text input-group-text-custom">
                                <i class="bi bi-telephone-fill"></i>
                            </span>
                            <input type="tel"
                                   class="form-control form-control-custom"
                                   name="phone"
                                   placeholder="Phone Number"
                                   required>
                        </div>

                        <div class="input-group mt-3">
                            <span class="input-group-text input-group-text-custom">
                                <i class="bi bi-book-fill"></i>
                            </span>
                            <input type="text"
                                   class="form-control form-control-custom"
                                   name="course"
                                   placeholder="Course of Interest"
                                   required>
                        </div>

                        <div class="form-group mt-3">
                            <textarea class="form-control form-control-custom"
                                      name="message"
                                      rows="3"
                                      placeholder="Your message or questions"></textarea>
                        </div>

                        <!-- CAPTCHA -->
                        <div class="form-group mt-3">
                            <div class="input-group">
                                <span class="input-group-text input-group-text-custom">
                                    <i class="bi bi-shield-lock-fill"></i>
                                </span>
                                <input type="text"
                                       class="form-control form-control-custom"
                                       name="captcha"
                                       placeholder="Enter CAPTCHA"
                                       required>
                            </div>
                            @error('captcha')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <div class="d-flex align-items-center justify-content-between mt-3" style="width: 100%; max-width: 100%;">
                                <div class="captcha-container flex-grow-1 me-3" style="border: 1px solid #ced4da; border-radius: 6px; overflow: hidden;">
                                    <img src="{{ captcha_src('flat') }}"
                                         alt="CAPTCHA"
                                         class="img-fluid d-block"
                                         style="width: 100%; height:30px ; object-fit: contain;">
                                </div>
                                <button type="button"
                                        class="btn btn-outline-secondary p-2 d-flex align-items-center justify-content-center"
                                        onclick="refreshCaptcha()"
                                        aria-label="Refresh CAPTCHA"
                                        style="width: 42px; height: 42px; border-radius: 6px;">
                                    <i class="bi bi-arrow-clockwise fs-5"></i>
                                </button>
                            </div>


                        </div>

                        <button type="submit"
                                class="btn btn-tour w-100 mt-4 py-2 fw-semibold d-flex justify-content-center align-items-center">
                            <i class="bi bi-send-fill me-2"></i> Submit Request
                        </button>

                    </form>

                    @if(session('success'))
                        <div class="alert alert-success alert-custom mt-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-custom mt-3">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function refreshCaptcha() {
        fetch('{{ url("/refresh-captcha") }}')
            .then(response => response.json())
            .then(data => {
                document.querySelector('.captcha-container img').src = data.captcha + '?' + Date.now();
            });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(el => el.style.display = 'none');
        }, 5000);

        // Scroll to form if there are messages
        const hasMessages = document.querySelector('.alert-success, .alert-danger');
        if (hasMessages) {
            const formSection = document.getElementById('callback-form');
            if (formSection) {
                formSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }
    });
</script>
