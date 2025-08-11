@extends('backend.layout.master')
@section('mainContent')

    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">Ebook Details</h4>
            <hr class="w-50 mx-auto">

            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('storage/' . $ebook->cover_image) }}" class="img-fluid" alt="Cover">
                </div>
                <div class="col-md-8">
                    <p><strong>Title:</strong> {{ $ebook->title }}</p>
                    <p><strong>Author:</strong> {{ $ebook->author }}</p>
                    <p><strong>Price:</strong> ৳{{ $ebook->price }}</p>
                    <p><strong>Status:</strong> {{ $ebook->status ? 'Active' : 'Inactive' }}</p>
                    <p><strong>Description:</strong><br> {!! nl2br(e($ebook->description)) !!}</p>
                    @if($ebook->download_link)
                        <p><strong>Download:</strong> <a href="{{ $ebook->download_link }}" target="_blank">Click here</a></p>
                    @endif
                </div>
            </div>

            <hr>
            <h5>Purchasers:</h5>
            <ul>
                @forelse($ebook->purchases as $purchase)
                    <li>{{ $purchase->customer->name ?? 'Unknown' }} — ৳{{ $purchase->price_paid }} ({{ $purchase->purchased_at->format('d M Y') }})</li>
                @empty
                    <li>No purchases found.</li>
                @endforelse
            </ul>

            <a href="{{ route('ebooks.index') }}" class="btn btn-secondary btn-sm mt-3">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

@endsection
