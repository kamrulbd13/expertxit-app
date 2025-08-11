@extends('frontend.layout.master')

@section('mainContent')
    <style>
        .ebook-hero {
            background: linear-gradient(to right, rgba(43, 33, 85, 0.9), rgba(43, 33, 85, 0.8)),
            url('{{ asset($ebook->cover_image ?? "backend/images/ebook/default.jpg") }}') center/cover no-repeat;
            color: white;
            padding: 5rem 2rem;
            text-align: center;
        }

        .ebook-hero h1 {
            font-size: 3rem;
            font-weight: 700;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.7);
        }

        .ebook-hero p {
            font-size: 1.2rem;
            margin-top: 1rem;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.5);
        }

        .ebook-details {
            padding: 3rem 1rem;
        }

        .ebook-meta i {
            margin-right: 6px;
        }

        .ebook-meta span {
            display: inline-block;
            margin-right: 1.2rem;
            font-size: 0.95rem;
            color: #555;
        }

        .btn-purchase {
            padding: 0.65rem 1.5rem;
            font-size: 1rem;
        }

        .description-box {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            font-size: 0.95rem;
            line-height: 1.7;
        }

        @media (max-width: 768px) {
            .ebook-hero h1 {
                font-size: 2rem;
            }

            .ebook-hero p {
                font-size: 1rem;
            }
        }
    </style>

    <!-- Hero Section -->
    <section class="ebook-hero">
        <h1>{{ $ebook->title }}</h1>
        <p>By {{ $ebook->author }}</p>
    </section>

    <!-- Details Section -->
    <div class="container ebook-details">
        <div class="row g-4">
            <!-- Cover Image -->
            <div class="col-md-5">
                <div class="bg-white rounded shadow-sm p-2">
                    <img src="{{ asset($ebook->cover_image ?? 'backend/images/ebook/default.jpg') }}"
                         alt="{{ $ebook->title }}"
                         class="img-fluid rounded w-100"
                         style="height: 500px; object-fit: cover;">
                </div>
            </div>

            <!-- Content -->
            <div class="col-md-7">
                <h4 class="text-primary fw-bold mb-3">About This eBook</h4>

                <div class="description-box mb-4">
                    {!! $ebook->description !!}
                </div>

                <div class="ebook-meta mb-3">
                    <span><i class="fa fa-user text-primary"></i><strong>Author:</strong> {{ $ebook->author }}</span>
                    <span><i class="fa fa-calendar text-primary"></i><strong>Published:</strong> {{ $ebook->created_at->format('M d, Y') }}</span>
                    <span>
                        <i class="fa fa-tag text-primary"></i><strong>Price:</strong>
                        <span class="text-success fw-semibold">
                            {{ $ebook->price > 0 ? 'Tk. ' . number_format($ebook->price, 2) : 'Free' }}
                        </span>
                    </span>
                </div>

                <div class="d-flex flex-wrap gap-2 py-2">
                    <!-- Details Page Button (Triggers Modal) -->
                    <button type="button" class="btn btn-success btn-purchase" data-bs-toggle="modal" data-bs-target="#loginInstructionModal">
                        <i class="fa fa-shopping-cart me-1"></i>
                        {{ $ebook->price > 0 ? 'Purchase Now' : 'Download Free' }}
                    </button>


                    <a href="{{ route('ebook.store.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2">
                        <i class="fa fa-arrow-left"></i>
                        <span>Back to Store</span>
                    </a>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="loginInstructionModal" tabindex="-1" aria-labelledby="loginInstructionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-sm rounded rounded-3">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="loginInstructionModalLabel">
                        <i class="fa fa-lock me-1"></i> Login Required
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-dark">
                    <p>
                        To purchase this eBook, you must be logged in.
                        If you don’t have an account, please register first.
                    </p>
                    <p class="mb-0">
                        <strong>Note:</strong> Only registered users can access purchased eBooks.
                    </p>
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="{{ route('customer.login') }}" class="btn btn-primary">
                        <i class="fa fa-sign-in-alt me-1"></i> Login / Register
                    </a>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i>
                        Cancel</button>
                </div>
            </div>
        </div>
    </div>

@endsection
