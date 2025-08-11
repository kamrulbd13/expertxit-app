<div class="team-trainers py-5" style="background: #f9fbff; border-top: 4px solid var(--primary);">
    <div class="container text-center">
        <div class="section-header mb-4 d-flex justify-content-center align-items-center flex-wrap gap-3">
            <h2 class="section-title mb-0 text-dark fw-semibold text-uppercase position-relative" aria-label="Professional & Certified Team of Trainers">
                Professional & Certified Team of Trainers
                <span class="section-underline" aria-hidden="true"></span>
            </h2>
            <a href="#" class="btn btn-outline-primary btn-sm fw-semibold" aria-label="View all trainers">
                View All &raquo;
            </a>
        </div>

        <p class="text-muted fs-6 mb-5 mx-auto" style="max-width: 580px; font-weight: 500;">
            Biggest pool of expert trainers to help you succeed
        </p>

        <div class="trainer-grid">
            @foreach ($teamTrainers as $trainer)
                @php
                    $imagePath = public_path($trainer['image'] ?? '');
                    $imageUrl = (isset($trainer['image']) && file_exists($imagePath))
                        ? asset($trainer['image'])
                        : asset('frontend/img/teamTrainer/avater.jpeg');
                @endphp

                <article class="trainer-card" tabindex="0" aria-label="{{ $trainer['trainer_name'] }} - {{ $trainer['certification'] }}">
                    <figure class="trainer-img-wrapper overflow-hidden">
                        <img
                            src="{{ $imageUrl }}"
                            alt="{{ $trainer['trainer_name'] }} Photo"
                            class="trainer-img w-100"
                            loading="lazy"
                            decoding="async"
                        />
                    </figure>

                    <div class="trainer-info px-3 pt-3 pb-4 text-start">
                        <h3 class="trainer-name fw-semibold text-dark mb-1">
                            {{ $trainer['trainer_name'] }}
                        </h3>
                        <p class="trainer-certification fst-italic text-secondary mb-2">
                            {{ $trainer['certification'] }}
                        </p>
                        <hr />
                        <p class="trainer-type text-uppercase fw-semibold small mb-0 text-muted">
                            {{ $trainer->trainerType->trainer_type ?? 'Trainer' }}
                        </p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

    :root {
        --primary: #1e293b; /* Dark Navy */
        --primary-light: #cbd5e1; /* Light slate */
        --muted: #475569; /* Slate blue-gray */
        --border-radius: 10px;
        --transition-speed: 0.3s;
    }


    .team-trainers {
        background: #f9fbff;
        color: #0f172a;
        border-top-color: var(--primary);
    }

    .section-header {
        gap: 12px;
    }

    .section-title {
        font-size: 1.9rem;
        letter-spacing: 0.05em;
        position: relative;
        padding-bottom: 0.4rem;
        color: var(--primary);
        font-weight: 600;
        user-select: none;
    }



    .btn-outline-primary {
        color: var(--primary);
        border: 1.5px solid var(--primary);
        background: transparent;
        padding: 0.35rem 0.9rem;
        border-radius: 6px;
        font-weight: 600;
        transition: background-color var(--transition-speed) ease, color var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
        user-select: none;
        cursor: pointer;
        box-shadow: inset 0 0 0 0 var(--primary);
        will-change: box-shadow;
    }

    .btn-outline-primary:hover,
    .btn-outline-primary:focus {
        background-color: var(--primary);
        color: white;
        outline: none;
        box-shadow: 0 4px 14px rgba(30, 41, 59, 0.6);
    }

    p.fs-6 {
        max-width: 580px;
        font-weight: 500;
        color: var(--muted);
        margin-left: auto;
        margin-right: auto;
        font-size: 1rem;
        line-height: 1.5;
        user-select: none;
    }

    /* Grid layout */
    .trainer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 1.5rem 1.75rem;
        justify-items: center;
        padding: 0 1rem;
    }

    /* Card */
    .trainer-card {
        background: white;
        border: 1.5px solid #e2e8f0; /* lighter slate */
        border-radius: var(--border-radius);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        cursor: default;
        transition: box-shadow var(--transition-speed) ease, transform var(--transition-speed) ease, border-color var(--transition-speed) ease;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.06);
    }

    .trainer-card:focus,
    .trainer-card:hover {
        box-shadow: 0 6px 20px rgba(30, 41, 59, 0.18);
        border-color: var(--primary);
        transform: translateY(-6px);
        outline: none;
        z-index: 1;
    }

    /* Image */
    .trainer-img-wrapper {
        width: 100%;
        aspect-ratio: 4 / 3;
        overflow: hidden;
        border-bottom: 1.5px solid var(--primary-light);
        border-radius: var(--border-radius) var(--border-radius) 0 0;
        box-shadow: inset 0 0 8px rgba(30, 41, 59, 0.05);
        background-color: #f1f5f9;
    }

    .trainer-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform var(--transition-speed) ease;
        display: block;
    }

    .trainer-card:hover .trainer-img {
        transform: scale(1.04);
    }

    /* Info */
    .trainer-info {
        padding: 1rem 1rem 1.5rem;
        text-align: left;
    }

    .trainer-name {
        font-size: 1.35rem;
        color: var(--primary);
        margin-bottom: 0.3rem;
        font-weight: 600;
        letter-spacing: 0.02em;
        user-select: text;
    }

    .trainer-certification {
        font-size: 1rem;
        font-style: italic;
        color: var(--muted);
        margin-bottom: 0.6rem;
        user-select: text;
    }

    hr {
        border: none;
        border-top: 1.5px solid var(--primary-light);
        margin: 0.6rem 0 1rem;
        opacity: 0.3;
        width: 45%;
    }

    .trainer-type {
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        color: var(--muted);
        margin: 0;
        letter-spacing: 0.06em;
        user-select: text;
    }

    /* Responsive tweaks */
    @media (max-width: 576px) {
        .trainer-img-wrapper {
            aspect-ratio: 3 / 2;
        }
    }
</style>
