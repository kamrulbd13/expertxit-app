@extends('backendCustomer.layout.master')
@section('mainContent')

    <style>
        /* Ensure only the title text is underlined on hover */
        .accordion-toggle .accordion-title {
            text-decoration: none;
        }

        .accordion-toggle:hover .accordion-title {
            text-decoration: none;
        }

        /* Smooth rotation of arrow */
        .rotate-icon {
            transition: transform 0.3s ease;
        }

        .accordion-toggle[aria-expanded="true"] .rotate-icon {
            transform: rotate(180deg);
        }
        th.text-nowrap {
            width: 180px; /* adjust as needed */
        }
        .custom-line {
            border: 0;
            height: 2px;
            background-color: #6a008a;  /* Change to any color */
            margin-top: 20px;
            margin-bottom: 20px;
        }

    </style>



    <div class="shadow-sm p-2 page-content bg-white">
        <div class="content-block">
            <div class="section-area section-sp4 m-0">
                <div class="container">
                    <div class="row d-flex flex-row-reverse">
                        <!-- Sidebar -->
                        <div class="col-lg-3 col-md-4 col-sm-12 m-b30">
                            <div class="course-detail-bx rounded rounded-2 bg-light">
                                <div class="course-buy-now text-center">
                                    <h5 class="radius-xl text-uppercase">Activity</h5>
                                </div>
                                <div class="teacher-bx">
                                    <div class="teacher-info">
                                        <div class="teacher-thumb">
                                            <img src="{{asset($studyMaterial->training->image_path ?? '')}}" alt=""/>
                                        </div>
                                        <div class="teacher-name">

                                            <h5>{{ optional($studyMaterial->training->trainer)->trainer_name ?? 'No trainer assigned' }}</h5>
                                            <span>{{ optional($studyMaterial->training->trainerType)->trainer_type ?? 'No trainer assigned' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="course-info-list scroll-page">
                                    <ul class="navbar">
                                        <li><a href="#overview"><i class="ti-zip"></i>Overview</a></li>
                                        <li><a href="#curriculum"><i class="ti-bookmark-alt"></i>Curriculum</a></li>
                                        <li><a href="#materials"><i class="ti-folder"></i>Study Materials</a></li>
                                        <li><a href="#instructor"><i class="ti-user"></i>Instructor</a></li>
                                        <li><a href="#reviews"><i class="ti-comments"></i>Reviews</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Main Content -->
                        <div class="col-lg-9 col-md-8 col-sm-12">
                            <div id="overview" class="courses-post">
                                <div class="ttr-post-info" style="margin-top: -35px;">
                                    <div class="ttr-post-title">
                                        <h2 class="post-title">{{$studyMaterial->training->training_name ?? ''}}</h2>
                                    </div>
                                    <div class="ttr-post-text ps-2">
                                        <p style="line-height: 1.0 !important;">
                                            {!! $studyMaterial->training->trainingDetails !!}
                                        </p>
                                        <hr class="my-3">
                                    </div>


                                </div>
                            </div>

                            <!-- Curriculum -->
                            <div class="m-b30" id="curriculum">
                                <h4>
                                    <i class="fa fa-book text-info"></i>
                                    Curriculum</h4>

                                @if($studyMaterial->training->trainingCurriculam->isNotEmpty())
                                    <div id="trainingCurriculumAccordion">
                                        @foreach($studyMaterial->training->trainingCurriculam as $index => $item)
                                            @php
                                                // Remove any existing "Module X: " from title, just in case
                                                $cleanTitle = preg_replace('/^Module\s*\d+[:.\-]?\s*/i', '', $item->title);
                                            @endphp

                                            <div class="card mb-1 rounded rounded-2">
                                                <div class="card-header m-0" id="heading{{ $index }}" style="padding: 2px;">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-block text-left d-flex justify-content-between align-items-center"
                                                                type="button"
                                                                data-toggle="collapse"
                                                                data-target="#collapse{{ $index }}"
                                                                aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                                                aria-controls="collapse{{ $index }}">
                            <span>
                                <i class="fa fa-check-square fs-1 text-success me-2"></i>
                                Module {{ $index + 1 }}: {{ $cleanTitle }}
                            </span>
                                                            <span class="text-muted">Duration: {{ $item->duration }} Minutes</span>
                                                        </button>
                                                    </h5>
                                                </div>

                                                <div id="collapse{{ $index }}"
                                                     class="collapse {{ $index == 0 ? '' : '' }} p-0 m-0"
                                                     aria-labelledby="heading{{ $index }}"
                                                     data-parent="#trainingCurriculumAccordion">
                                                    <div class="card-body p-2 m-0">
                                                        <p class="mb-0">{{ $item->description }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted">No curriculum modules available for this training.</p>
                                @endif


                            </div>

                            <!-- Resources -->
                            <section id="materials" class="mb-5">
                                <h4 class="mb-3">📂 Study Materials</h4>

                                <div class="row">
                                    <!-- PDF -->
                                    <div class="col-md-12 mb-4">
                                        <div class="card shadow-sm h-100">
                                            <div class="card-body">
                                                <h5><i class="fa fa-file-pdf-o text-danger"></i> PDF Guides</h5>
                                                @if($studyMaterial->training && $studyMaterial->training->trainingCurriculam && $studyMaterial->training->trainingCurriculam->count())
                                                    <ul class="list-unstyled">
                                                        @foreach($studyMaterial->training->trainingCurriculam as $index => $item)
                                                            @php
                                                                $slug = $studyMaterial->slug ?? \Illuminate\Support\Str::slug($studyMaterial->training->training_name);
                                                            @endphp
                                                            <li class="p-1">
                                                                <a href="{{ route('materials.pdf.show', $slug) }}" target="_blank">
                                                                    Module {{ $index + 1 }}. {{ $item->title }}
                                                                </a>
                                                            </li>
                                                        @endforeach

                                                    </ul>
                                                @else
                                                    <p class="text-danger">No modules found for this training.</p>
                                                @endif

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Videos -->
                                    <div class="col-md-12 mb-4">
                                        <div class="card shadow-sm h-100">
                                            <div class="card-body">
                                                <h5><i class="fa fa-video-camera text-primary"></i> Video Tutorials</h5>
                                                @if($studyMaterial->training && $studyMaterial->training->trainingCurriculam && $studyMaterial->training->trainingCurriculam->count())
                                                    <ul class="list-unstyled">
                                                        @foreach($studyMaterial->training->trainingCurriculam as $index => $item)
                                                            @php
                                                                $slug = $studyMaterial->slug ?? \Illuminate\Support\Str::slug($studyMaterial->training->training_name);
                                                            @endphp
                                                            <li class="p-1">
                                                                <a href="{{ route('materials.video.show', $slug) }}" target="_blank">
                                                                    Module {{ $index + 1 }}. {{ $item->title }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <p class="text-danger">No modules found for this training.</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Practice Lab Access -->
                                    <div class="col-md-12 mb-4">
                                        <div class="card shadow-sm">
                                            <div class="card-body">
                                                <h5><i class="fa fa-flask text-warning"></i> Practice Lab Access</h5>

                                                @if($credential)
                                                    <div id="labAccessAccordion" class="mb-4">
                                                        <div class="card">
                                                            <div class="card-header p-0" id="labAccessHeading">
                                                                <h5 class="mb-0">
                                                                    <button class="btn  btn-block text-left text-primary font-weight-bold collapsed d-flex justify-content-between align-items-center accordion-toggle"
                                                                            data-toggle="collapse"
                                                                            data-target="#labAccessDetails"
                                                                            aria-expanded="false"
                                                                            aria-controls="labAccessDetails">
                                                                        <span class="accordion-title">🔐 Show Lab Access Credential Details</span>
                                                                        <i class="fa fa-chevron-down rotate-icon"></i>
                                                                    </button>
                                                                </h5>
                                                            </div>


                                                            <div id="labAccessDetails" class="collapse" aria-labelledby="labAccessHeading" data-parent="#labAccessAccordion">
                                                                <div class="card-body bg-light">
                                                                    <table class="table w-100 table-borderless table-responsive table-sm mb-0">
                                                                        <tbody>
                                                                        <tr>
                                                                            <th class="text-nowrap">📘 Training</th>
                                                                            <td class="text-wrap">{{ $credential->training->training_name ?? 'N/A' }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="text-nowrap">👤 Username</th>
                                                                            <td class="text-wrap">{{ $credential->username ?? '-' }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="text-nowrap">🔑 Access Key</th>
                                                                            <td class="text-wrap">{{ $credential->password_access_key ?? '-' }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="text-nowrap">🌐 Portal URL</th>
                                                                            <td class="text-wrap">
                                                                                @if($credential->portal_url)
                                                                                    <a href="{{ $credential->portal_url }}" target="_blank">{{ $credential->portal_url }}</a>
                                                                                @else
                                                                                    -
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="text-nowrap">🖥️ VM / RDP IP</th>
                                                                            <td class="text-wrap">{{ $credential->vm_rdp_ip ?? '-' }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="text-nowrap">🔗 SSH</th>
                                                                            <td class="text-wrap">{{ $credential->ssh ?? '-' }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="text-nowrap">🛡️ VPN</th>
                                                                            <td class="text-wrap">{{ $credential->vpn ?? '-' }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="text-nowrap">📅 Assigned</th>
                                                                            <td class="text-wrap">
                                                                                {{ $credential->assigned_date ? \Carbon\Carbon::parse($credential->assigned_date)->format('d M Y') : '-' }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="text-nowrap">⏳ Expires</th>
                                                                            <td class="text-wrap">
                                                                                {{ $credential->expiry_date ? \Carbon\Carbon::parse($credential->expiry_date)->format('d M Y') : '-' }}
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <p class="text-warning mb-1" style="line-height: 1.5;">
                                                        <b>Oops!</b> Lab Access credentials have not been provided for this training.
                                                    </p>
                                                    <small class="text-muted" style="line-height: 1.5;">
                                                        <b>Note:</b> Please contact support to obtain your lab access details.
                                                    </small>
                                                @endif



                                            </div>
                                        </div>
                                    </div>
                                    <!-- Assignments -->
                                    <div class="col-md-12 mb-4">
                                        <div class="card shadow-sm">
                                            <div class="card-body">
                                                <h5><i class="fa fa-download text-success"></i> Assignments</h5>
                                                @if($assignment && $assignment->training && $assignment->training->trainingCurriculam && $assignment->training->trainingCurriculam->count())
                                                    <ul class="list-unstyled">
                                                        @foreach($assignment->training->trainingCurriculam as $index => $item)
                                                            @php
                                                                $slug = \Illuminate\Support\Str::slug($item->title ?? 'module-' . $item->id);
                                                            @endphp
                                                            <li class="p-1">
                                                                <a href="#" onclick="checkPdfExists('{{ route('assignments.pdf.show', $slug) }}', this)">
                                                                    Module {{ $index + 1 }}. {{ $item->title }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>

                                                @else
                                                    <p class="text-warning mb-1" style="line-height: 1.2;">
                                                        <b>Sorry ! , </b> Modules Assignments Data is Missing.
                                                    </p>
                                                    <small class="text-muted" style="line-height: 1.2;">
                                                        <b>N.B. : </b> Please Contact Support to Details.
                                                    </small>
                                                @endif


                                            </div>
                                        </div>
                                    </div>

                                    <!-- Exam System -->
                                    <div class="col-md-12 ">
                                        <div class="card shadow-sm">
                                            <div class="card-body">
                                                <h5>📝  Online Exam System</h5>
                                                <p style="text-align: justify;">
                                                    The exam system ensures a secure and fair testing environment by enforcing fixed time limits, disabling question backtracking, and automatically submitting answers when time expires. It requires a stable internet connection for uninterrupted access. This format enables quick evaluation, automated scoring, and immediate result delivery to candidates.
                                                </p>
                                                <strong class="mb-3">Rules and Exam System:</strong>
                                                <ul class="py-2">
                                                    <li class="d-flex align-items-start mb-1">
                                                        <i class="fa fa-check-circle text-success" style="margin-right: 8px;"></i>
                                                        Exam Duration: Fixed time limit starting on exam start.
                                                    </li>
                                                    <li class="d-flex align-items-start mb-1">
                                                        <i class="fa fa-check-circle text-success" style="margin-right: 8px;"></i>
                                                        Question Format: Multiple Choice Questions.
                                                    </li>
                                                    <li class="d-flex align-items-start mb-1">
                                                        <i class="fa fa-check-circle text-success" style="margin-right: 8px;"></i>
                                                        No Navigation Back: Cannot return to previous questions.
                                                    </li>
                                                    <li class="d-flex align-items-start mb-1">
                                                        <i class="fa fa-check-circle text-success" style="margin-right: 8px;"></i>
                                                        Automatic Submission on time expiry.
                                                    </li>
                                                    <li class="d-flex align-items-start mb-1">
                                                        <i class="fa fa-check-circle text-success" style="margin-right: 8px;"></i>
                                                        No cheating or external help allowed.
                                                    </li>
                                                    <li class="d-flex align-items-start mb-1">
                                                        <i class="fa fa-check-circle text-success" style="margin-right: 8px;"></i>
                                                        Stable internet connection required.
                                                    </li>
                                                    <li class="d-flex align-items-start mb-1">
                                                        <i class="fa fa-check-circle text-success" style="margin-right: 8px;"></i>
                                                        Instant results after submission.
                                                    </li>
                                                    <li class="d-flex align-items-start">
                                                        <i class="fa fa-check-circle text-success" style="margin-right: 8px;"></i>
                                                        Only one attempt allowed unless specified.
                                                    </li>
                                                </ul>

                                                @php
                                                    $exam = \App\Models\ExamSystem::where('training_id', $studyMaterial->training_id)->first();
                                                @endphp

                                                @if($exam)
                                                    <a href="{{ route('exam.start', $studyMaterial->training_id) }}" class="btn btn-primary">
                                                        Start Exam
                                                        <i class="fa fa-arrow-right ms-1"></i>
                                                    </a>
                                                @else
                                                    <div class="alert alert-warning mt-2 shadow-sm d-flex align-items-center">
                                                        <i class="fa fa-exclamation-triangle me-2"></i>
                                                        <span>No exam is currently available for this training.</span>
                                                    </div>

                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- Instructor -->
                            <div class="m-b30" id="instructor">
                                <h4>
                                    <i class="fa fa-user text-secondary"></i>
                                    Instructor</h4>
                                <p>Hinata Hyuga is an experienced UI/UX designer with over 10 years of industry experience.</p>
                            </div>

                            {{--                            <!-- Reviews -->--}}
                            {{--                            <div class="m-b30" id="reviews">--}}
                            {{--                                <h4>--}}
                            {{--                                    <i class="fa fa-comment text-success"></i>--}}
                            {{--                                    Student Reviews</h4>--}}
                            {{--                                <p>No reviews yet. Be the first to review this course!</p>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <script>
            $(document).ready(function () {
                console.log("Page JS loaded");

                // Optional: Enable tooltips
                $('[data-toggle="tooltip"]').tooltip();

                // Optional: Fix dropdowns
                $('.dropdown-toggle').dropdown();
            });
        </script>


{{--not found assingment pdf --}}
    <script>
        function checkPdfExists(url, linkElement) {
            fetch(url, { method: 'HEAD' }) // Only check if file exists
                .then(response => {
                    if (response.ok) {
                        window.open(url, '_blank');
                    } else {
                        alert('PDF not found for this module.');
                    }
                })
                .catch(error => {
                    alert('Error checking the PDF: ' + error.message);
                });
        }
    </script>

@endsection
