@extends('backend.layout.master')
@section('mainContent')
{{--    table --}}
<div class="card">
    <div class="card-body">
        <h4 class="card-title text-center font-weight-bold text-base text-uppercase">System Information</h4>
        <hr class="w-50 mx-auto">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Site Name</th>
                            <th>Site Slogan</th>
                            <th>Image color</th>
                            <th>Image White</th>
                            <th>Mail</th>
                            <th>Number</th>
                            <th>Copy Right</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $sl = 1;
                        @endphp
                        @foreach($systemSettings as $item)
                        <tr>
                            <td>{{$sl++}}</td>
                            <td>{{$item->site_name ?? 'N/A'}}</td>
                            <td>{{$item->slogan ?? 'N/A'}}</td>
                            <td>
                                <img src="{{asset($item->image_logo_color ?? 'N/A')}}" class="" style="width: 90px; height: 50px;" alt="">
                            </td>
                            <td>
                                <img src="{{asset($item->image_logo_white ?? 'N/A')}}" class="" style="width: 90px; height: 50px;" alt="">
                            </td>
                            <td>
                                <span>{{$item->mail1 ?? 'N/A'}}</span><br>
                                <span>{{$item->mail2 ?? 'N/A'}}</span>
                            </td>
                            <td>
                                <span>{{$item->number1 ?? 'N/A'}}</span><br>
                                <span>{{$item->number2 ?? 'N/A'}}</span>
                            </td>
                            <td>
                                {{$item->copy_right ?? 'N/A'}}
                            </td>
                            <td>
                                <a href="{{route('system.setting.detail', $item->id)}}" data-toggle="tooltip" data-placement="bottom" title="View" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                <a href="{{route('system.setting.edit', $item->id)}}"  data-toggle="tooltip" data-placement="bottom" title="Edit" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{--    ./table --}}
<!-- toastr JS -->
<script src="{{asset('/')}}backend/js/toastr.min.js"></script>

{{--    delete--}}
@if (Session::has('delete'))
    <script>
        toastr.options = {
            "progressBar" :true,
            "closeButton" : true,
        }
        toastr["error"]("Record has been Deleted.","Delete");
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
