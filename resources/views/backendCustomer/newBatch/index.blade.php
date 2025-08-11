@extends('backendCustomer.layout.master')
@section('mainContent')
   <div class="row">
                <!-- Your Profile Views Chart -->
                <div class="col-lg-12 m-b30">
                    <div class="widget-box">
                        <div class="wc-title d-flex justify-content-between align-baseline">
                            <div class="mt-3">
                                <h4 class="font-bold">New Batch
                                        <?php
                                            echo date('F-Y');
                                        ?>
                                </h4>
                            </div>
                            <div>
                                <div class="mail-search-bar">
                                    <input type="text" class="form-control" placeholder="Search"/>
                                </div>
                            </div>
                        </div>
                        <div class="widget-inner">
                            <div class="row">
                                @if($newBatches ->count())
                            @foreach($newBatches as $item)
                                    <div class="card-courses-list admin-courses">
                                        <div class="card-courses-media">
                                            <img src="{{asset($item->training->image_path ?? '')}}" class="img-thumbnail" alt=""/>
                                        </div>
                                        <div class="card-courses-full-dec">
                                            <div class="card-courses-title">
                                                <h4>{{$item->training->training_name ?? 'Not found data'}}</h4>
                                            </div>
                                            <div class="card-courses-list-bx">
                                                <ul class="card-courses-view">
                                                    <li class="card-courses-user">
                                                        <div class="card-courses-user-pic">
                                                            <img src="{{asset('/')}}customer/images/icon/avater.png" alt=""/>
                                                        </div>

                                                        <div class="card-courses-user-info">
                                                            <h5>Teacher</h5>
                                                            <h4>{{$item->trainer->trainer_name ?? ''}}</h4>
                                                        </div>
                                                    </li>
                                                    <li class="card-courses-categories">
                                                        <h5>Categories</h5>
                                                        <h4>{{$item->trainingCategory->training_category ?? ''}}</h4>
                                                    </li>
{{--                                                    <li class="card-courses-review">--}}
{{--                                                        <h5>3 Review</h5>--}}
{{--                                                        <ul class="cours-star">--}}
{{--                                                            <li class="active"><i class="fa fa-star"></i></li>--}}
{{--                                                            <li class="active"><i class="fa fa-star"></i></li>--}}
{{--                                                            <li class="active"><i class="fa fa-star"></i></li>--}}
{{--                                                            <li><i class="fa fa-star"></i></li>--}}
{{--                                                            <li><i class="fa fa-star"></i></li>--}}
{{--                                                        </ul>--}}
{{--                                                    </li>--}}
                                                    <li class="card-courses-categories">
                                                        <h5>Start Date</h5>
                                                        <h4>{{ \Carbon\Carbon::parse($item->start_date)->format('d M Y') }}</h4>
                                                    </li>
                                                    <li class="card-courses-categories">
                                                        <h5 class="">Last Date</h5>
                                                        <h4 class="text-danger">{{ \Carbon\Carbon::parse($item->end_date)->format('d M Y') }}</h4>
                                                    </li>

                                                    <li class="card-courses-price">
                                                        <del class="text-danger"><b>Tk.{{$item->training->regular_fees ?? ''}}</b></del>
                                                        <h5 class="text-primary">Tk.{{$item->training->current_fees ?? ''}}</h5>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="row card-courses-dec">
                                                <div class="col-md-12">
                                                    <h6 class="m-b10">Course Description</h6>

                                                    @php
                                                        // Strip HTML tags and replace non-breaking spaces with regular spaces
                                                        $cleanContent = str_replace('&nbsp;', ' ', $item->training->trainingDetails ?? '');
                                                        $cleanContent = strip_tags($cleanContent); // Remove any other HTML tags if needed
                                                        $limitedWords = \Illuminate\Support\Str::words($cleanContent, 150, '...');
                                                    @endphp

                                                    <p class="mb-0" style="text-align: justify;">
                                                        {{ $limitedWords }}
                                                    </p>
                                                </div>


                                                <div class="col-md-12 py-4">
                                                    <div class="d-flex align-items-center">
                                                        <!-- View Courses Button -->
                                                        <a href="{{ route('new.batch.details', $item->id) }}" class="btn btn-outline-dark radius shadow-sm me-3">
                                                            <i class="fa fa-book me-1"></i> Course Details
                                                        </a>&nbsp;

                                                        <!-- Enrollment Button -->
                                                        <form action="{{ route('customer.batch.admission', $item->id) }}" method="POST" class="me-3">
                                                            @csrf
                                                            <input type="hidden" name="course_id" value="{{ $item->course_id }}">
                                                            <input type="hidden" name="batch_id" value="{{ $item->batch_id }}">
                                                            <button type="submit" class="btn btn-outline-success radius shadow-sm">
                                                                Enroll Now
                                                                <i class="fa fa-arrow-circle-o-right"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>


                                            </div>

                                        </div>
                                    </div>
                            @endforeach
                                @else
                                    <div class="col-12">
                                        <p>No new batch found.</p>
                                    </div>
                                @endif
                            </div>
                                <!-- Pagination Links -->
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <!-- Left side: Total pages -->
                                    <div>
                                        Total Pages: {{ $newBatches->lastPage() }}
                                    </div>

                                    <!-- Right side: Pagination links -->
                                    <div>
                                        {{ $newBatches->links('pagination::bootstrap-4') }}
                                    </div>
                                </div>


                        </div>
                </div>
                <!-- Your Profile Views Chart END-->
            </div>


{{--search batch--}}
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

   <!-- toastr JS -->
   <script src="{{asset('/')}}customer/js/toastr.min.js"></script>

   {{--    bookingCourse--}}
   @if (Session::has('bookingCourse'))
       <script>
           toastr.options = {
               "progressBar" :true,
               "closeButton" : true,
           }
           toastr["success"]("Thanks for Booking Course","Done");
       </script>
   @endif

   {{--    status--}}
   @if (Session::has('status'))
       <script>
           toastr.options = {
               "progressBar" :true,
               "closeButton" : true,
           }
           toastr["info"]("Status has been Update Successfully.","Status");
       </script>
   @endif


@endsection
