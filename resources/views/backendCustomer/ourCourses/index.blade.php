@extends('backendCustomer.layout.master')

@section('mainContent')
    <div class="row">
        <!-- Main Course Panel -->
        <div class="col-lg-12 m-b30">
            <div class="widget-box">
                <div class="wc-title d-flex justify-content-between align-items-center">
                    <h4 class="font-bold mt-3">Our Courses</h4>

                    <div class="mail-search-bar">
                        <input type="text" class="form-control" id="search_course" name="search_course" placeholder="Search"/>
                    </div>
                </div>

                <div class="widget-inner">
                    <div id="course-list">
                        <div class="row">
                            @if($courses->count())
                                @foreach($courses as $item)
                                    <div class="col-md-6 col-lg-6 col-sm-6 m-b30">
                                        <div class="cours-bx">
                                            <div class="action-box">
                                                <img src="{{ asset($item->image_path ?? '') }}" class="img-thumbnail rounded" style="height: 250px;" alt=""/>
                                                <a href="{{ route('our.courses.details', $item->id) }}" class="btn">Read More</a>
                                            </div>
                                            <div class="info-bx text-center" style="height: 100px;">
                                                <h5>
                                                    <a href="{{ route('our.courses.details', $item->id) }}">
                                                        {{ $item->training_name ?? 'Not found data' }}
                                                    </a>
                                                </h5>
                                                <span>{{ $item->trainingCategory->training_category ?? '' }}</span>
                                            </div>
                                            <div class="cours-more-info">
                                                <div class="review">
                                                    <span>Teacher Type</span>
                                                    <ul class="cours-star">
                                                        <li class="active">{{ $item->trainerType->trainer_type ?? '' }}</li>
                                                    </ul>
                                                </div>
                                                <div class="price">
                                                    <del class="text-danger">Tk.{{ $item->regular_fees ?? '' }}</del>
                                                    <h5>
                                                        @if($item->current_fees == 0 || $item->current_fees === null)
                                                            <span class="badge text-white px-2 py-1 bg-success">Free</span>
                                                        @else
                                                            <span class="text-primary">Tk. {{ number_format($item->current_fees, 0) }}</span>
                                                        @endif
                                                    </h5>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-12">
                                    <p>No courses found.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div>Total Pages: {{ $courses->lastPage() }}</div>
                            <div>{{ $courses->links('pagination::bootstrap-4') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- AJAX and Toastr -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let debounce;
        $('#search_course').on('keyup', function () {
            clearTimeout(debounce);
            let query = $(this).val();
            debounce = setTimeout(() => {
                $.ajax({
                    url: "{{ route('customer.courses.search') }}",
                    type: "GET",
                    data: { search: query },
                    success: function (data) {
                        $('#course-list').html(data);
                    }
                });
            }, 300);
        });
    </script>

    <!-- Toastr Notifications -->
    <script src="{{ asset('/') }}customer/js/toastr.min.js"></script>
    @if (Session::has('bookingCourse'))
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            }
            toastr["success"]("Thanks for Booking Course", "Done");
        </script>
    @endif

    @if (Session::has('status'))
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            }
            toastr["info"]("Status has been Update Successfully.", "Status");
        </script>
    @endif
@endsection
