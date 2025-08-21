@php
    $roleName = Auth::user()->role?->name ?? 'No Role Assigned';
@endphp


<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        {{-- editor, default & Admin can see Trainings --}}
        @if(in_array($roleName, ['admin', 'editor', 'default']))
            <li class="nav-item nav-profile">
                <div class="nav-link">
                    <div class="profile-image">
                        <img src="{{ asset('backend/images/faces/avater.jpg') }}" alt="image"/>
                    </div>
                    <div class="profile-name">
                        <p class="name">Welcome !</p>
                        <strong class="text-primary font-weight-bold">{{ Auth::user()->name }}</strong>
                        <p class="designation">{{ $roleName ?? 'No Role' }}</p>
                    </div>
                </div>
            </li>

        @endif

        {{-- Only ADMIN can see these --}}
        @if(Auth::user()->role?->name === 'admin')
            {{-- Dashboard (Everyone can see) --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fa fa-home menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
{{--visitor query--}}
        <li class="nav-item d-none d-lg-block">
            <a class="nav-link" data-toggle="collapse" href="#visitorQuery" aria-expanded="false" aria-controls="sidebar-layouts">
                <i class="fas fa-columns menu-icon"></i>
                <span class="menu-title">Visitor Query</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="visitorQuery">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('visitor.index')}}">All Query</a></li>
                </ul>
            </div>
        </li>
{{--        admission--}}
        <li class="nav-item d-none d-lg-block">
            <a class="nav-link" data-toggle="collapse" href="#admission" aria-expanded="false" aria-controls="sidebar-layouts">
                <i class="fas fa-columns menu-icon"></i>
                <span class="menu-title">Admission</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="admission">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('admission.index')}}">All Admission</a></li>
                </ul>
            </div>
        </li>
{{--        trainer--}}
      <li class="nav-item d-none d-lg-block">
        <a class="nav-link" data-toggle="collapse" href="#Trainers" aria-expanded="false" aria-controls="sidebar-layouts">
          <i class="fas fa-columns menu-icon"></i>
          <span class="menu-title">Trainers</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="Trainers">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('trainer.index')}}">All Trainer</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('trainer.type.index')}}">Trainer Type</a></li>
          </ul>
        </div>
      </li>
{{--        software--}}
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Software" aria-expanded="false" aria-controls="ui-basic">
                <i class="far fa-compass menu-icon"></i>
                <span class="menu-title">Software</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Software">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('software.index')}}">All Software</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('software.category.index')}}">Category</a></li>
                </ul>
            </div>
        </li>
{{--        it service--}}
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#itServices" aria-expanded="false" aria-controls="ui-basic">
                <i class="far fa-compass menu-icon"></i>
                <span class="menu-title">IT Services</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="itServices">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('itService.index')}}">All IT Service</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('itService.category.index')}}">Category</a></li>
                </ul>
            </div>
        </li>
{{--        training --}}
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Trainings" aria-expanded="false" aria-controls="ui-basic">
                <i class="far fa-compass menu-icon"></i>
                <span class="menu-title">Trainings</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Trainings">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('training.index')}}">All Training</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('training.category.index')}}">Category</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('language.index')}}">Language</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('skill.level.index')}}">Skill Level</a></li>
                </ul>
            </div>
        </li>
{{--        kids comuter--}}
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#kidsProgramming" aria-expanded="false" aria-controls="ui-basic">
          <i class="far fa-compass menu-icon"></i>
          <span class="menu-title">Kids Computer</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="kidsProgramming">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('kidsProgramme.index')}}">All Kids Programmes</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{route('kidsProgramme.category.index')}}">Category</a></li>
          </ul>
          </div>
      </li>
{{--        ebook--}}
        <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ebook" aria-expanded="false" aria-controls="ui-basic">
          <i class="far fa-compass menu-icon"></i>
          <span class="menu-title">E-Book</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ebook">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('backend.ebooks.index')}}">All Ebook</a></li>
          </ul>
          </div>
      </li>
{{--        study materials--}}
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#studyMaterials" aria-expanded="false" aria-controls="ui-basic">
          <i class="far fa-compass menu-icon"></i>
          <span class="menu-title">Study Materials</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="studyMaterials">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('study.material.index')}}">Study Materials</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('lab.access.credential.index')}}">Lab Credentials</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('study.material.assignment.index')}}">Assignments</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('exam.system.index')}}">Exam System</a></li>
          </ul>
          </div>
      </li>
{{--        new batch--}}
        <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#upcoming" aria-expanded="false" aria-controls="ui-basic">
          <i class="far fa-compass menu-icon"></i>
          <span class="menu-title">New Batch </span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="upcoming">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('backend.new.batch.upcoming.index')}}">All New Batch</a></li>
            </ul>
          </div>
      </li>
{{--        Trainee--}}
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#Childes" aria-expanded="false" aria-controls="ui-advanced">
          <i class="fas fa-clipboard-list menu-icon"></i>
          <span class="menu-title">Trainee</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="Childes">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('trainee.index')}}">All Trainee</a></li>
          </ul>
        </div>
      </li>
{{--        course booking--}}
        <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#traineeCourseBooking" aria-expanded="false" aria-controls="ui-advanced">
          <i class="fas fa-clipboard-list menu-icon"></i>
          <span class="menu-title">Course Booking</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="traineeCourseBooking">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('trainee.course.booking.index')}}">Booking</a></li>
          </ul>
        </div>
      </li>
{{--        course payment--}}
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#traineeCoursePayment" aria-expanded="false" aria-controls="ui-advanced">
                <i class="fas fa-clipboard-list menu-icon"></i>
                <span class="menu-title">Course Payment</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="traineeCoursePayment">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('trainee.course.payment.index')}}">Payment</a></li>
                </ul>
            </div>
        </li>
{{--        course certificate--}}
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#traineeCourseCertificate" aria-expanded="false" aria-controls="ui-advanced">
                <i class="fas fa-clipboard-list menu-icon"></i>
                <span class="menu-title">Course Certificate</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="traineeCourseCertificate">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('trainee.course.certificate.index')}}">Certificate</a></li>
                </ul>
            </div>
        </li>
{{--        event calendar--}}
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#EventCalendar" aria-expanded="false" aria-controls="form-elements">
                <i class="fab fa-wpforms menu-icon"></i>
                <span class="menu-title">Event Calendar </span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="EventCalendar">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{route('event.calendar.index')}}">Event Calendar</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('event.category.index')}}">Event Category</a></li>

                </ul>
            </div>
        </li>
{{--            Communication--}}
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#communication" aria-expanded="false" aria-controls="form-elements">
                <i class="fab fa-wpforms menu-icon"></i>
                <span class="menu-title">Communication</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="communication">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{route('admin.chat.index')}}">Chat</a></li>
                </ul>
            </div>
        </li>
{{--        system setting --}}
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#systemSetting" aria-expanded="false" aria-controls="form-elements">
                <i class="fab fa-wpforms menu-icon"></i>
                <span class="menu-title">System Settings</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="systemSetting">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{route('home.hero.image.index')}}">Hero Slider</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('system.setting.index')}}">Site Setting</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('system.mail.setting.index')}}">Mail Setting</a></li>
                </ul>
            </div>
        </li>
{{--        user management --}}
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#userManagement" aria-expanded="false" aria-controls="form-elements">
                <i class="fab fa-wpforms menu-icon"></i>
                <span class="menu-title">User Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="userManagement">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{route('roles.index')}}">Role</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('permissions.index')}}">Permission</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('user-roles.index')}}">Manage Permission</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('permission-role.index')}}">Manage Roles</a></li>
                </ul>
            </div>
        </li>
        @endif

        {{-- Only editor can see these --}}
        @if(Auth::user()->role?->name === 'editor')
            {{-- Dashboard (Everyone can see) --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fa fa-home menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            {{--        software--}}
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#Software" aria-expanded="false" aria-controls="ui-basic">
                    <i class="far fa-compass menu-icon"></i>
                    <span class="menu-title">Software</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="Software">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{route('software.index')}}">All Software</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{route('software.category.index')}}">Category</a></li>
                    </ul>
                </div>
            </li>
            {{--        it service--}}
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#itServices" aria-expanded="false" aria-controls="ui-basic">
                    <i class="far fa-compass menu-icon"></i>
                    <span class="menu-title">IT Services</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="itServices">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{route('itService.index')}}">All IT Service</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{route('itService.category.index')}}">Category</a></li>
                    </ul>
                </div>
            </li>
            {{--        training --}}
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#Trainings" aria-expanded="false" aria-controls="ui-basic">
                    <i class="far fa-compass menu-icon"></i>
                    <span class="menu-title">Trainings</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="Trainings">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{route('training.index')}}">All Training</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{route('training.category.index')}}">Category</a></li>
                    </ul>
                </div>
            </li>
            {{--        kids comuter--}}
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#kidsProgramming" aria-expanded="false" aria-controls="ui-basic">
                    <i class="far fa-compass menu-icon"></i>
                    <span class="menu-title">Kids Computer</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="kidsProgramming">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{route('kidsProgramme.index')}}">All Kids Programmes</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{route('kidsProgramme.category.index')}}">Category</a></li>
                    </ul>
                </div>
            </li>
        @endif


    </ul>
  </nav>
