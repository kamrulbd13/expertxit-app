@extends('backendCustomer.layout.master')
@section('mainContent')
<div class="pb-4">
    <!-- Card -->
    <div class="row">
        <div class="col-md-6 col-lg-4 col-xl-4 col-sm-6 col-12">
            <a href="{{route('our.courses.index')}}">
                <div class="widget-card widget-bg1">
                    <div class="wc-item">
                        <h4 class="wc-title">
                            Our Courses
                        </h4>
                        <span class="wc-des">
								Visit all our valuable course
							</span>
                        <span class="wc-stats">
								<span class="counter">{{$ourCourses}}</span>
							</span>
                        <div class="progress wc-progress">
                            <div class="progress-bar" role="progressbar" style="width: 78%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="wc-progress-bx">
								<span class="wc-change">
									We are flowing standard structure
								</span>
								<span class="wc-number ml-auto">
{{--									90%+--}}
								</span>
							</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-4 col-sm-6 col-12">
            <a href="{{route('new.batch.index')}}">
                <div class="widget-card widget-bg1">
                    <div class="wc-item">
                        <h4 class="wc-title">
                            New Batches
                        </h4>
                        <span class="wc-des">
								Visit all our upcoming course
							</span>
                        <span class="wc-stats">
								<span class="counter">{{$allEvent}}</span>
							</span>
                        <div class="progress wc-progress">
                            <div class="progress-bar" role="progressbar" style="width: 78%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="wc-progress-bx">
								<span class="wc-change">
									We are flowing standard structure
								</span>
								<span class="wc-number ml-auto">
{{--									90%+--}}
								</span>
							</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-4 col-sm-6 col-12">
            <a href="{{route('new.event.index')}}">
                <div class="widget-card widget-bg1">
                    <div class="wc-item">
                        <h4 class="wc-title">
                            New Events
                        </h4>
                        <span class="wc-des">
								Visit all our upcoming activity.
							</span>
                        <span class="wc-stats">
								<span class="counter">{{$ourCourses}}</span>
							</span>
                        <div class="progress wc-progress">
                            <div class="progress-bar" role="progressbar" style="width: 78%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="wc-progress-bx">
								<span class="wc-change">
									We are flowing standard structure
								</span>
								<span class="wc-number ml-auto">
{{--									90%+--}}
								</span>
							</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <!-- event calendar -->
<div class="row">
    <div class="col-md-12 mx-auto">
        <section class=" m-0 ">
            <h3 class="text-primary text-center" style="font-family: sans-serif;">
                <b>Event calendar : </b> <b id="monthName">{{ now()->format('F Y') }}</b>
            </h3>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var calendarsEl = document.getElementById('calendars');

                    var calendars = new Fullcalendars.calendars(calendarsEl, {
                        initialView: 'dayGridMonth',
                        events: [
                                @foreach($events as $event)
                            {
                                title: '{{ $event->title }}',
                                start: '{{ $event->start_date }}T{{ $event->start_time }}',
                                end: '{{ $event->end_date }}T{{ $event->end_time }}',
                                description: '{{ $event->description }}',
                                color: '{{ $event->category->color }}',
                                category: '{{ $event->category->name }}'
                            },
                            @endforeach
                        ],
                        datesSet: function(info) {
                            // Update the month name whenever the view is changed
                            var monthName = info.view.title;
                            document.getElementById('monthName').innerText = monthName;
                        }
                    });

                    calendars.render();

                    // Bind the previous and next month buttons to calendars navigation
                    document.getElementById('prevMonth').addEventListener('click', function(e) {
                        e.preventDefault();
                        calendars.prev(); // Go to the previous month
                    });

                    document.getElementById('nextMonth').addEventListener('click', function(e) {
                        e.preventDefault();
                        calendars.next(); // Go to the next month
                    });
                });
            </script>


            <div class="bg-white" style="margin-top: -25px;" id="calendars"></div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var calendarsEl = document.getElementById('calendars');

                    // Get all events and categories
                    var allEvents = [
                            @foreach($events as $event)
                        {
                            title: '{{ $event->title }}',
                            start: '{{ $event->start_date }}T{{ $event->start_time }}',
                            end: '{{ $event->end_date }}T{{ $event->end_time }}',
                            description: '{{ $event->description }}',
                            color: '{{ $event->category->color }}',  // Use category color for event background
                            category: '{{ $event->category->name }}'
                        },
                        @endforeach
                    ];

                    // Initialize Fullcalendars
                    var calendars = new Fullcalendars.calendars(calendarsEl, {
                        initialView: 'dayGridMonth',
                        events: allEvents,

                        eventClick: function (info) {
                            info.jsEvent.preventDefault();

                            function formatAMPM(date) {
                                return date.toLocaleString('en-US', {
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric',
                                    hour: 'numeric',
                                    minute: '2-digit',
                                    hour12: true
                                });
                            }

                            // Populate modal with formatted data
                            $('#eventTitle').text(info.event.title);
                            $('#eventCategory').text(info.event.extendedProps.category);
                            $('#eventStart').text(formatAMPM(info.event.start));
                            $('#eventEnd').text(info.event.end ? formatAMPM(new Date(info.event.end)) : 'Same as Start Date');
                            $('#eventDescription').text(info.event.extendedProps.description);

                            // Set category color
                            $('#eventCategory').css('color', info.event.extendedProps.color);

                            // Show modal
                            var myModal = new bootstrap.Modal(document.getElementById('eventModal'), {});
                            myModal.show();
                        }

                    });

                    // Render the calendars
                    calendars.render();

                    // Function to filter events based on selected categories
                    function updatecalendarsEvents() {
                        var selectedCategories = [];

                        // Get all checked category checkboxes
                        $('.category-checkbox:checked').each(function () {
                            selectedCategories.push($(this).val());
                        });

                        // Filter events based on selected categories
                        var filteredEvents = allEvents.filter(event => selectedCategories.includes(event.category) || selectedCategories.length === 0);

                        // Remove all events and add the filtered ones
                        calendars.removeAllEvents();
                        calendars.addEventSource(filteredEvents);
                    }

                    // When category checkboxes change, update calendars events
                    $('.category-checkbox').on('change', function () {
                        updatecalendarsEvents();
                    });
                });
            </script>


            <!-- Modal -->
            <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 650px !important;">
                    <div class="modal-content p-0 m-0 rounded mx-auto" style="width: 80% !important;">
                        <div class="modal-header pt-2 pb-2 ps-3 pe-3 m-0">
                            <h6 class="modal-title p-0 m-0 text-primary-emphasis" id="eventModalLabel" style="line-height: 1.2;">Event Details</h6>

                        </div>
                        <div class="modal-body m-0 text-start" style="line-height: 1.2; max-height: 80vh; overflow-y: auto;">
                            <p class="p-1 m-0"><strong>Title:</strong> <span id="eventTitle"></span></p>
                            <p class="p-1 m-0"><strong>Category:</strong> <span id="eventCategory"></span></p>
                            <p class="p-1 m-0"><strong>Start:</strong> <span id="eventStart"></span></p>
                            <p class="p-1 m-0"><strong>End:</strong> <span id="eventEnd"></span></p>
                            <p class="p-1 m-0"><strong>Description:</strong> <span id="eventDescription"></span></p>
                        </div>
                    </div>
                </div>
            </div>



        </section>
    </div>
</div>

@push('scripts')
    <!-- Calendar Libraries -->
        <script src="{{ asset('customer/vendors/calendar/moment.min.js') }}"></script>
        <script src="{{ asset('customer/vendors/calendar/fullcalendar.js') }}"></script>

        <!-- Custom Calendar JS -->
        <script src="{{ asset('customer/js/calendar.js') }}"></script>
        <script src="{{ asset('customer/js/calendar.main.js') }}"></script>

        <!-- Calendar Initialization -->
        <script>
            $(document).ready(function () {
                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay,listWeek'
                    },
                    navLinks: true,
                    weekNumbers: true,
                    weekNumbersWithinDays: true,
                    weekNumberCalculation: 'ISO',
                    editable: true,
                    eventLimit: true
                });
            });
        </script>
@endpush
@endsection
