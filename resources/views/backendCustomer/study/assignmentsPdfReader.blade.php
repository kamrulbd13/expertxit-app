@extends('backendCustomer.layout.master')
@section('mainContent')
    <div class="page-content bg-white py-1">
        <div class="container-fluid">

            <div class="row">
                <!-- Sidebar: PDF Modules List -->
                <div class="col-md-3">
                    <div class="bg-light rounded shadow-sm">
                        <h5 class="text-uppercase text-primary p-3">📄 Assignments</h5>
                        <ul class="nav flex-column">
                            <ul class="nav flex-column">
                                @foreach($materials as $material)
                                    <li class="nav-item mb-2">
                                        <a href="{{ route('assignments.pdf.show', $material->slug) }}"
                                           class="nav-link {{ $material->slug === $activeMaterial->slug ? 'fw-bold text-success bg-light' : 'text-secondary' }}">
                                            @if($material->slug === $activeMaterial->slug)
                                                ✅
                                            @else
                                                📄
                                            @endif
                                            {{ $material->slug }}
                                        </a>
                                    </li>
                                @endforeach

                            </ul>


                        </ul>
                    </div>
                </div>

                <!-- PDF Viewer Area -->
                <div class="col-md-9">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">
                                <i class="fa fa-file-pdf-o me-2"></i> {{ $activeMaterial['slug'] }}
                            </h6>
                            <a href="{{ route('studyMaterials.download', $activeMaterial->slug) }}" class="btn btn-sm btn-light">
                                <i class="fa fa-download me-1"></i> Download
                            </a>

                        </div>
                        <div class="p-1" style="height: 80vh;">
                            <div style="background-color: white !important; width: 100%; height: 100%;" class="rounded">
                                <iframe
                                    src="{{ $pdfUrl }}#toolbar=0&navpanes=0&scrollbar=0"
                                    width="100%"
                                    height="100%"
                                    style="border: none;"
                                    class="rounded"
                                ></iframe>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .nav-link.active-link {
            font-weight: 700;
            color: #28a745 !important; /* Bootstrap success green */
            background-color: #e9f7ef;
            border-radius: 0.25rem;
        }
        .nav-link.inactive-link {
            color: #6c757d !important; /* Bootstrap secondary */
        }
    </style>
@endsection
