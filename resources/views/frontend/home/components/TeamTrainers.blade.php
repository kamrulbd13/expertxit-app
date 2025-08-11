<!-- resources/views/components/team-trainers.blade.php -->

<div class="team-trainers pt-3 py-3 bg-white border-success border-top border-2">
    <div class="container text-center py-2">
        <span class="section-title fw-bold mb-1">
            <span class="line"></span>
           ✅  PROFESSIONAL AND CERTIFIED TEAM FOR TRAINERS ✅
            <span class="line"></span>
            <a href="#" class="text-decoration-none small ms-4 text-muted" style="font-size: 12px; font-weight: lighter">
                VIEW ALL >>
            </a>
        </span>
        <p class="text-muted mb-5">Biggest pool of Trainers</p>

        <div class="row justify-content-center">

            @foreach ($teamTrainers as $trainer)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card border-0 shadow-sm h-80 trainer-card">
                        @php
                            $imagePath = public_path($trainer['image']);
                            $imageUrl = (isset($trainer['image']) && file_exists($imagePath))
                                ? asset($trainer['image_path'])
                                : asset('frontend/img/teamTrainer/avater.jpeg');
                        @endphp

                        <img
                            src="{{ $imageUrl }}"
                            class="card-img-top border-bottom img-thumbnail p-2 trainer-img"
                            style="width: 300px; height: 250px;"
                            alt="{{ $trainer['trainer_name'] }} Photo" />

                        <div class="card-body px-3 py-3">
                            <h5 class="card-title text-primary fw-bold mb-1">{{ $trainer['trainer_name'] }}</h5>
                            <p class="small mb-1">{{ $trainer['certification'] }}</p>
                            <hr class="my-2" />
                            <p class="small text-muted">{{$trainer->trainerType->trainer_type ?? ''}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .section-title {
        font-size: 1.5rem;
        position: relative;
    }
    .line {
        display: inline-block;
        width: 80px;
        height: 2px;
        background: #3AAD34;
        vertical-align: middle;
        margin: 0 10px;
    }
    .trainer-img {
        object-fit: cover;
        height: 280px;
    }
    .trainer-card:hover {
        transform: translateY(-5px);
        transition: 0.3s ease-in-out;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

</style>
