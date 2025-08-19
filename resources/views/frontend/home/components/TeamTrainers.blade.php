<div class="team-trainers py-5 bg-light border-top border-4" style="border-color:#0d47a1;">
    <div class="container text-center">

        <!-- Section Header -->
        <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-3 mb-4">
            <h2 class="fw-bold position-relative mb-0" style="color:#0d1b2a;">
                Professional & Certified Team of Trainers
                <span class="d-block mx-auto mt-2" style="width:60px; height:3px; background:#1976d2;"></span>
            </h2>
            <a href="#" class="btn btn-outline-primary btn-sm fw-semibold px-3" aria-label="View all trainers">
                View All &raquo;
            </a>
        </div>

        <p class="text-muted mb-4 mx-auto" style="max-width:580px; font-weight:500;">
            Our expert trainers are committed to helping you achieve your career goals.
        </p>

        <!-- Trainer Grid -->
        <div class="row justify-content-center g-3">
            @foreach ($teamTrainers as $trainer)
                @php
                    $imagePath = public_path($trainer['image'] ?? '');
                    $imageUrl = (isset($trainer['image']) && file_exists($imagePath))
                        ? asset($trainer['image'])
                        : asset('frontend/img/teamTrainer/avater.jpeg');
                @endphp

                <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                    <div class="card trainer-card shadow-sm border-0 text-center w-100" tabindex="0" aria-label="{{ $trainer['trainer_name'] }} - {{ $trainer['certification'] }}">
                        <img src="{{ $imageUrl }}" class="card-img-top img-fluid" alt="{{ $trainer['trainer_name'] }} Photo">

                        <div class="card-body px-3 py-4">
                            <h5 class="card-title fw-bold mb-1 text-dark">{{ $trainer['trainer_name'] }}</h5>
                            <p class="card-text text-muted small mb-2">{{ $trainer['certification'] }}</p>
                            <hr class="my-2 w-50 mx-auto" style="border-color:#1976d2;">
                            <p class="text-uppercase fw-bold small text-secondary mb-0">{{ $trainer->trainerType->trainer_type ?? 'Professional Trainer' }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>

<style>
    /* Card Hover & Size */
    .trainer-card {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        border-radius: 5px;
        max-width: 280px; /* Slightly bigger card */
    }

    .trainer-card:hover,
    .trainer-card:focus {
        transform: scale(1.03); /* reduced from 1.07 to 1.03 */
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); /* softer, lighter shadow */
    }


    .trainer-card img {
        object-fit: cover;
        aspect-ratio: 4/3;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        transition: transform 0.3s ease;
    }



    .trainer-card hr {
        border-top: 2px solid #1976d2;
        opacity: 0.8;
    }

    .team-trainers h2 {
        color: #0d1b2a;
    }

    .btn-outline-primary {
        border-color: #1976d2;
        color: #1976d2;
    }


    .trainer-card h5 {
        color: #0d1b2a;
    }

    /* Reduce spacing on small screens */
    @media (max-width: 768px) {
        .row.g-2 > [class*='col-'] {
            margin-bottom: 0.75rem;
        }
    }
</style>
