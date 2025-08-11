<!-- resources/views/components/amazing-facts.blade.php -->

<div class="container shadow-sm amazing-facts py-5 mb-5 bg-white">
    <div class="container mx-auto">
        <h2 class="text-center fw-bold text-dark mb-2">AMAZING FACTS ABOUT {{$systemInfo->site_name ?? ''}}</h2>
        <p class="text-center text-muted mb-5">Profession's Training Hub</p>

        <div class="row text-center d-flex justify-content-around">
            @php
                $facts = [
                    ['icon' => 'bi bi-calendar-event-fill text-primary fs-1', 'title' => '12+ YEARS', 'description' => 'Delivering Quality Training Worldwide'],
                    ['icon' => 'bi bi-briefcase-fill text-primary fs-1', 'title' => '10X', 'description' => 'Placements than any other Institute of Bangladesh'],
                    ['icon' => 'bi bi-award-fill text-primary fs-1', 'title' => '7+', 'description' => 'Educational Excellence Awards'],
                    ['icon' => 'bi bi-check-circle-fill text-primary fs-1', 'title' => '80% CCIE', 'description' => 'Students get placed without appearing for Cisco exams'],
                    ['icon' => 'bi bi-hdd-stack-fill text-primary fs-1', 'title' => '500+ HOURS', 'description' => 'of CCIE Rack Access'],
                ];
            @endphp

            @foreach ($facts as $fact)
                <div class="col-12 col-sm-6 col-md-4 col-lg-2 mb-4">
                    <div class="fact-item">
                        <div class="icon mb-3">
                            <i class="{{ $fact['icon'] }}"></i>
                        </div>
                        <h5 class="fw-bold">{{ $fact['title'] }}</h5>
                        <p class="small text-muted mb-0">{{ $fact['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<style>
    .amazing-facts {
        border-top: 3px solid #3AAD34;
        border-bottom: 1px solid #eee;
    }

    .fact-item .icon {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .fact-item h5 {
        margin-bottom: 0.25rem;
    }

</style>
