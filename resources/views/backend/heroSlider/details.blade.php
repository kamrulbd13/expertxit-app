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
            <td>{{$heroSliderImage->title}}</td>
        </tr>
        <tr>
            <th> Description</th>
            <td>:</td>
            <td>{!! $heroSliderImage->description ?? '' !!}</td>
        </tr>
        <tr>
            <th>Image</th>
            <td>:</td>
            <td>
                <img src="{{asset($heroSliderImage->image_path)}}" class="mt-2 rounded img-thumbnail" style="width: 120px; height: 120px;" alt="">
            </td>
        </tr>
        <tr>
            <th> Publish Status</th>
            <td>:</td>
            <td>{{$heroSliderImage->status == 1 ? 'Yes' : 'No'}}</td>
        </tr>
    </table>

                        <div class="text-center">
                            <a href="{{route('home.hero.image.index')}}" class="btn btn-danger" data-dismiss="modal">
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
