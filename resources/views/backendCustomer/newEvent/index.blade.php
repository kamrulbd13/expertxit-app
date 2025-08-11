@extends('backendCustomer.layout.master')
@section('mainContent')

    <style>
        .event-card {
            background: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            transition: box-shadow 0.3s ease-in-out;
            margin-bottom: 2rem;
        }

        .event-card:hover {
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
        }

        .event-category {
            background-color: #2b2155;
            color: #fff;
            padding: 2rem;
            text-align: center;
            font-size: 2rem;
            font-weight: 700;
            text-transform: uppercase;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .event-body {
            display: flex;
            flex-direction: row;
            gap: 2rem;
            padding: 2rem;
            flex-wrap: wrap;
        }

        .event-date-box {
            background-color: #2b2155;
            color: #fff;
            padding: 1rem;
            border-radius: 0.75rem;
            min-width: 80px;
            text-align: center;
            font-weight: 600;
        }

        .event-date-box .date {
            font-size: 2rem;
            line-height: 1;
        }

        .event-date-box .month {
            font-size: 0.85rem;
            text-transform: uppercase;
        }

        .event-info {
            flex: 1;
            min-width: 250px;
        }

        .event-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #2b2155;
            margin-bottom: 0.5rem;
        }

        .event-title a {
            text-decoration: none;
            color: inherit;
        }

        .event-title a:hover {
            color: #e67e22;
        }

        .event-meta {
            list-style: none;
            padding: 0;
            margin-bottom: 1rem;
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            color: #555;
            font-size: 0.95rem;
        }

        .event-meta i {
            color: #2b2155;
            margin-right: 5px;
        }

        .event-description {
            font-size: 0.95rem;
            line-height: 1.5;
            color: #333;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            padding: 1rem 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .search-bar {
            max-width: 300px;
        }

        .pagination-container {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #e9ecef;
        }

        .event-date-box {
            background-color: #2b2155;
            color: #fff;
            padding: 0.6rem 1rem;
            font-weight: 600;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .event-date-box .date {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 0;
        }

        .event-date-box .month {
            font-size: 0.95rem;
            text-transform: uppercase;
            margin-bottom: 0;
        }

    </style>

    <div class="row">
        <div class="col-lg-12">
            <div class="widget-box">
                <div class="wc-title px-3">
                    <div class="header-section">
                        <h4 class="fw-bold mb-0">New Events — {{ now()->format('F Y') }}</h4>
                        <div class="search-bar">
                            <input type="text" class="form-control" placeholder="Search events...">
                        </div>
                    </div>
                </div>

                <div class="widget-inner p-3">
                    <div class="row">
                        @if($newEvents->count())
                            @foreach($newEvents as $item)
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="event-card">
                                        <!-- Category Header -->
                                        <div class="event-category">
                                            {{ $item->category->name ?? '' }}
                                        </div>

                                        <!-- Body Content -->
                                        <div class="event-body">
                                            <!-- Date -->
                                            <div class="event-date-box d-flex align-items-center justify-content-center gap-2">
                                                <span class="date me-2">{{ \Carbon\Carbon::parse($item->start_date)->format('d') }}</span>
                                                <span class="month">{{ \Carbon\Carbon::parse($item->start_date)->format('M Y') }}</span>
                                            </div>


                                            <!-- Info -->
                                            <div class="event-info">
                                                <div class="event-title">
                                                    <a href="{{ route('new.event.details', $item->id) }}">
                                                        {{ $item->title ?? 'N/A' }}
                                                    </a>
                                                </div>

                                                <ul class="event-meta">
                                                    <li><i class="fa fa-clock-o"></i>
                                                        {{ \Carbon\Carbon::parse($item->start_time)->format('h:i a') }}
                                                        - {{ \Carbon\Carbon::parse($item->end_time)->format('h:i a') }}
                                                    </li>
                                                    <li><i class="fa fa-map-marker"></i> {{ $item->session_method }}</li>
                                                </ul>

                                                <p class="event-description">
                                                    {!! \Illuminate\Support\Str::words($item->description ?? '', 20, '...') !!}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12 text-center text-muted py-5">
                                <p>No new events found for this month.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-container d-flex justify-content-between align-items-center">
                        <div><strong>Total Pages:</strong> {{ $newEvents->lastPage() }}</div>
                        <div>{{ $newEvents->links('pagination::bootstrap-4') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toastr Notifications -->
    <script src="{{ asset('customer/js/toastr.min.js') }}"></script>
    @if (Session::has('bookingCourse'))
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            };
            toastr.success("Thanks for Booking Course", "Done");
        </script>
    @endif

    @if (Session::has('status'))
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            };
            toastr.info("Status has been updated successfully.", "Status");
        </script>
    @endif

@endsection
