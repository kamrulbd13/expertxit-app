@extends('backend.layout.master')
@section('mainContent')

    <div class="card ">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">Detail Trainee Payment Information</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">
              " Detail trainee payment Information "
            </p>
                <div class="form-group mb-2">
                    <strong for="school-name" class="col-form-label">Trainee Name</strong><br>
                    <label for="school-name" class="col-form-label">{{$customerCoursePaymentDetail->customer->name ?? 'N/A'}}</label>
                </div>

                <div class="form-group mb-2">
                    <strong for="school-publish-status" class="col-form-label">Training Name</strong><br><br>
                    <label for="school-publish-status" class="form-check-label">{{$customerCoursePaymentDetail->training->training_name ?? 'N/A'}}</label>
                </div>
            <div class="form-group mb-2">
                <strong for="school-publish-status" class="col-form-label">Invoice ID</strong><br><br>
                <label for="school-publish-status" class="form-check-label">{{$customerCoursePaymentDetail->invoice_id ?? 'N/A'}}</label>
            </div>
            <div class="form-group mb-2">
                <strong for="school-publish-status" class="col-form-label">Training Fees</strong><br><br>
                <label for="school-publish-status" class="form-check-label">{{number_format($customerCoursePaymentDetail->current_fees ?? 'N/A',2)}}</label>
            </div>
            <div class="form-group mb-2">
                <strong for="school-publish-status" class="col-form-label">Transaction Number</strong><br><br>
                <label for="school-publish-status" class="form-check-label">{{$customerCoursePaymentDetail->transaction_id ?? 'N/A'}}</label>
            </div>
            <div class="form-group mb-2">
                <strong for="school-publish-status" class="col-form-label">Payment Sender AC</strong><br><br>
                <label for="school-publish-status" class="form-check-label">{{$customerCoursePaymentDetail->payment_sender_ac ?? 'N/A'}}</label>
            </div>
            <div class="form-group mb-2">
                <strong for="school-publish-status" class="col-form-label">Payment Sender AC</strong><br><br>
                <label for="school-publish-status" class="form-check-label">
                    {{ optional($customerCoursePaymentDetail->created_at)?->format('l, F j, Y h:m A') ?? 'N/A' }}

                </label>
            </div>
            <div class="form-group mb-2">
                <strong for="school-publish-status" class="col-form-label">Note</strong><br><br>
                <label for="school-publish-status" class="form-check-label">{!! $customerCoursePaymentDetail->note_reference ?? 'N/A' !!}</label>
            </div>
            <div class="form-group mb-2">
                <strong for="school-publish-status" class="col-form-label">Image</strong><br><br>
                <img class="mt-2" style="width: 300px; height: 250px;" src="{{asset($customerCoursePaymentDetail->image_path)}}" alt="">
            </div>
            <div class="form-group mb-2">
                <strong for="school-publish-status" class="col-form-label">Payment Verify Status</strong><br><br>
                <label for="school-publish-status" class="form-check-label">{{$customerCoursePaymentDetail->verify_status === 1 ? 'YES' : 'No'}}</label>
            </div>

              <div class="text-center">
                  <a href="{{route('trainee.course.payment.index')}}" class="btn btn-danger" data-dismiss="modal">
                      <i class="fa fa-times-circle" aria-hidden="true"></i>
                      Close
                  </a>                  <a href="{{route('trainee.course.payment.verified', $customerCoursePaymentDetail->id)}}" class="btn btn-success" data-dismiss="modal">
                      <i class="fa fa-check-circle" aria-hidden="true"></i>
                      Verify
                  </a>
              </div>

        </div>
    </div>

@endsection
