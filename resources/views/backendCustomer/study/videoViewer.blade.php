@extends('backendCustomer.layout.master')
@section('mainContent')

    <div class="page-content bg-white py-1">
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar Video List -->
                <div class="col-md-3">
                    <div class="bg-light rounded shadow-sm">
                        <h5 class="text-uppercase text-primary py-3">🎥 Video Modules</h5>
                        <ul class="nav flex-column">
                            @foreach($videos as $video)
                                <li class="nav-item mb-2">
                                    <a href="{{ route('materials.video.show', $video['slug']) }}"
                                       class="nav-link {{ $activeVideo['slug'] === $video['slug'] ? 'fw-bold text-success' : '' }}">
                                        {{ $activeVideo['slug'] === $video['slug'] ? '✅' : '🎥' }} {{ $video['slug'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Video Player Area -->
                <div class="col-md-9">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                            <h6 class="mb-0"><i class="fa fa-video-camera me-2"></i> {{ $activeVideo['slug'] }}</h6>
                        </div>
                        <div class="card-body p-0" style="height: 80vh;">
                            @php
                                $youtubeEmbedUrl = null;

                                if (!empty($activeVideo['youtube_url']) && str_contains($activeVideo['youtube_url'], 'youtube.com')) {
                                    // Extract video ID from various formats
                                    preg_match('/(?:v=|\/)([a-zA-Z0-9_-]{11})/', $activeVideo['youtube_url'], $matches);
                                    $youtubeEmbedUrl = isset($matches[1]) ? 'https://www.youtube.com/embed/' . $matches[1] : null;
                                }
                            @endphp

                            @if($youtubeEmbedUrl)
                                <iframe width="100%" height="100%" src="{{ $youtubeEmbedUrl }}" frameborder="0"
                                        allowfullscreen style="border: none;"></iframe>
                            @elseif(!empty($activeVideo['file']))
                                <video width="100%" height="100%" controls style="object-fit: cover;">
                                    <source src="{{ asset('storage/videos/' . $activeVideo['file']) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <div class="p-3">No video available.</div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
