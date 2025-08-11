@extends('backend.layout.master')
@section('mainContent')

    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">Study Material Details</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">Details of the attached PDF and YouTube video</p>

            <div class="mb-3">
                <label class="form-label">Training Name:</label>
                <p class="form-control-plaintext">{{ $material->training->training_name ?? 'N/A' }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label">Module Title:</label>
                <p class="form-control-plaintext">{{ $material->curriculum->title ?? 'N/A' }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label">PDF File:</label><br>
                @if($material->pdf_path)
                    <a href="{{ asset($material->pdf_path) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fa fa-file-pdf-o"></i> View PDF
                    </a>
                @else
                    <span class="text-muted">No PDF attached</span>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">YouTube Video:</label><br>
                @if($material->youtube_url)
                    <div class="ratio ratio-16x9">
                        <iframe src="{{ $material->youtube_url }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                @else
                    <span class="text-muted">No video attached</span>
                @endif
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('study.material.index') }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
                <a href="{{ route('study.material.edit', $material->id) }}" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

@endsection
