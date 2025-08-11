@extends('backend.layout.master')
@section('mainContent')

    <div class="card ">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">Mail Information</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">
              " Entry  Information "
            </p>
            <form action="{{route('system.mail.setting.store')}}" method="POST" class="forms">
                @csrf
                <div class="form-group mb-2">
                    <label for="school-id" class="col-form-label text-capitalize ">Mail Mailer</label>
                    <input type="text" name="mail_mailer" class="form-control form-control-sm"  placeholder="smtp" required/>
                </div>
                <div class="form-group mb-2">
                    <label for="school-id" class="col-form-label text-capitalize ">mail host</label>
                    <input type="text" name="mail_host" class="form-control form-control-sm"  placeholder="smtp.xxx.com" required/>
                </div>
                <div class="form-group mb-2">
                    <label for="school-id" class="col-form-label text-capitalize ">mail port</label>
                    <input type="number" name="mail_port" class="form-control form-control-sm"  placeholder="465" required/>
                </div>
                <div class="form-group mb-2">
                    <label for="school-id" class="col-form-label text-capitalize ">mail username</label>
                    <input type="email" name="mail_username" class="form-control form-control-sm"  placeholder="xxx@gmail.com" required/>
                </div>
                <div class="form-group mb-2">
                    <label for="school-id" class="col-form-label text-capitalize ">mail password </label>
                    <input type="text" name="mail_password" class="form-control form-control-sm"  placeholder="xfkr mhrx aexs ifhv" required/>
                </div>
                <div class="form-group mb-2">
                    <label for="school-id" class="col-form-label text-capitalize" > mail encryption</label>
                    <input type="text" name="mail_encryption" class="form-control form-control-sm"  placeholder="tls" required/>
                </div>
                <div class="form-group mb-2">
                    <label for="school-id" class="col-form-label text-capitalize">mail from address</label>
                    <input type="email" name="mail_from_address" class="form-control form-control-sm"  placeholder="xxx@gmail.com" required/>
                <div class="form-group mb-2">
                    <label for="school-id" class="col-form-label text-capitalize">mail from name</label>
                    <input type="text" name="mail_from_name" class="form-control form-control-sm"  placeholder="demo" required/>
                </div>
                 <div class="form-group ">
                        <label class="col-sm-3 col-form-label">Publish Status</label>
                        <div class="col-sm-4">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="membershipRadios1" value="1" checked>
                                    Yes
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="membershipRadios2" value="0">
                                    No
                                </label>
                            </div>
                        </div>
                    </div>


              <div class="text-center">
                  <button type="submit" class="btn btn-success">
                      <i class="fa fa-check-circle"></i>
                      Save
                  </button>
                  <a href="{{route('system.mail.setting.index')}}" class="btn btn-danger" data-dismiss="modal">
                      <i class="fa fa-times-circle" aria-hidden="true"></i>
                      Close
                  </a>
              </div>
                </div>
            </form>
        </div>
    </div>
    <!-- toastr JS -->
    <script src="{{asset('/')}}backend/js/toastr.min.js"></script>
    @if (Session::has('message'))
        <script>
            toastr.options = {
                "progressBar" :true,
                "closeButton" : true,
            }
            toastr["success"]("Record has been saved successfully !","Success");
        </script>
    @endif



@endsection
