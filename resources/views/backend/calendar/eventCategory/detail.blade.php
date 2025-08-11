@extends('backend.layout.master')
@section('mainContent')
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center font-weight-bold text-base text-uppercase">Details Information</h4>
                    <hr class="w-50 mx-auto">
                    <p class="card-description">
                        " Details information "
                    </p>

    <table class=" table-borderless table table-responsive">
        <tr>
            <th> Title</th>
            <td>:</td>
            <td>{{$eventCategory->name}}</td>
        </tr>
        <tr>
            <th> Color</th>
            <td>:</td>
            <td>
            <div class="rounded rounded-2" style="width: 50px; height: 25px ; background-color: {{$eventCategory->color}}"></div>
            </td>
        </tr>
        <tr>
            <th> Publish Status</th>
            <td>:</td>
            <td>{{$eventCategory->status == 1 ? 'Yes' : 'No'}}</td>
        </tr>
    </table>

                        <div class="text-center">
                            <a href="{{route('event.category.index')}}" class="btn btn-danger" data-dismiss="modal">
                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                                Close
                            </a>
                        </div>
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
