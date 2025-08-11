@extends('backendCustomer.layout.master')
@section('mainContent')
    <style>
        .status-unpaid,
        .status-paid {
            display: inline-block;
            padding: 1px 4px;          /* reduced vertical and horizontal padding */
            font-size: 11px;           /* optional: slightly smaller font */
            font-weight: bold;
            color: white;
            border-radius: 4px;
            min-width: 60px;           /* optional: reduce width too */
            line-height: .80;          /* reduces vertical space */
            text-align: center;
        }

        .status-unpaid {
            background-color: red;
        }

        .status-paid {
            background-color: green;
        }

#pay_btn{
    width: 80px;
}
    </style>
   <div class="row">
                <!-- Your Profile Views Chart -->
                <div class="col-lg-12 m-b30">
                    <div class="widget-box">
                        <div class="wc-title">
                            <h4>Certificate</h4>
                        </div>
                        <div class="widget-inner">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Training Name</th>
                                    <th scope="col">Certificate Number #</th>
                                    <th scope="col">Issue Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                $sl =1;
                                @endphp
                                @foreach($orders as $item)
                                    <tr>
                                        <td>{{$sl++}}</td>
                                        <td>{{\Illuminate\Support\Str::words($item->training->training_name ?? '', '6', '...')}}</td>
                                        <td>{{$item->certificate_id ?? ''}}</td>
                                        <td>{{$item->certificate_issue_date ?? 'N/A'}}</td>
                                        <td class="text-center align-middle mt-2 badge-pill {{ $item->certificate_status == 0 ? 'status-unpaid' : 'status-paid' }}">
                                            {{ $item->certificate_status == 0 ? 'Pending' : 'Completed' }}
                                        </td>
                                        <td class="text-center">
                                            <a  href="{{ $item->certificate_status == 1 ? route('customer.certificate.details', $item->id) : '#' }}"
                                                class="btn btn-info button-sm"
                                                @if($item->certificate_status == 0)
                                                style="pointer-events: none; opacity: 0.6; cursor: not-allowed;"
                                                @endif> <i class="ti-import"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Your Profile Views Chart END-->
            </div>


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
