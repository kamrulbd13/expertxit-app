@extends('backend.layout.master')
@section('mainContent')

    <div class="card ">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">Edit Certificate Information</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">
              " Edit Certificate Information "
            </p>
            <form action="{{route('trainee.course.certificate.update', $customerCourseCertificateInfo->id)}}" method="POST" class="forms">
                @csrf

                <div class="form-group mb-2">
                    <label for="school-name" class="col-form-label">Name</label>
                    <input type="text" name="name" readonly value="{{$customerCourseCertificateInfo->customer->name ?? ''}}" class="form-control form-control-sm" required/>
                </div>
                <div class="form-group mb-2">
                    <label for="school-name" class="col-form-label">Training Name</label>
                    <input type="text" name="name" readonly value="{{$customerCourseCertificateInfo->training->training_name ?? ''}}" class="form-control form-control-sm" required/>
                </div>
                <div class="form-group mb-2">
                    <label for="school-name" class="col-form-label">Issue Date</label>
                    <input type="date" name="certificate_issue_date" value="{{$customerCourseCertificateInfo->certificate_issue_date ?? ''}}" class="form-control form-control-sm" required/>
                </div>
                <div class="form-group mb-2">
                    <label for="school-name" class="col-form-label">Generate by</label>
                    <input type="text" name="name" readonly value="{{Auth::user()->name}}" class="form-control form-control-sm" required/>
                </div>

                    <div class="form-group ">
                        <label class="col-sm-3 col-form-label">Publish Status</label>
                        <div class="col-sm-4">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="membershipRadios1" value="1" {{$customerCourseCertificateInfo->certificate_status === 1 ? 'checked' : ''}}>
                                    Yes
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="membershipRadios2" value="0" {{$customerCourseCertificateInfo->certificate_status === 0 ? 'checked' : ''}}>
                                    No
                                </label>
                            </div>
                        </div>
                    </div>


              <div class="text-center">
                  <button type="submit" class="btn btn-success">
                      <i class="fa fa-check-circle"></i>
                      Create
                  </button>
                  <a href="{{route('trainee.course.certificate.index')}}" class="btn btn-danger" data-dismiss="modal">
                      <i class="fa fa-times-circle" aria-hidden="true"></i>
                      Close
                  </a>
              </div>
            </form>
        </div>
    </div>

    <!-- toastr JS -->
    <script src="{{asset('/')}}backend/js/toastr.min.js"></script>

    @if (Session::has('update'))
        <script>
            toastr.options = {
                "progressBar" :true,
                "closeButton" : true,
            }
            toastr["success"]("Certificate has been created and send mail.","Done");
        </script>
    @endif

    @if (Session::has('warning'))
        <script>
            toastr.options = {
                "progressBar" :true,
                "closeButton" : true,
            }
            toastr["error"]("Payment already verified","Warning");
        </script>
    @endif

@endsection
