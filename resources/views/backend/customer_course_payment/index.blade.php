@extends('backend.layout.master')
@section('mainContent')
{{--    table --}}
<div class="card">
    <div class="card-body">
        <h4 class="card-title text-center font-weight-bold text-base text-uppercase">All Customer Payment Information</h4>
        <hr class="w-50 mx-auto">
        <div class="row">
            <div class="col-12">
                <div class="card-header d-flex justify-content-between mb-4">
                    <div>

                        <a href="#" class="btn btn-sm btn-info" >
                            <i class="fa fa-plus-circle me-2"></i>
                            Add New</a>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-outline-info">CSV</button>
                        <button class="btn btn-sm btn-outline-info">PDF</button>
                        <button class="btn btn-sm btn-outline-info">Print</button>
                        <button class="btn btn-sm btn-outline-info">Import</button>
                        <button class="btn btn-sm btn-outline-info">Export</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Training Name</th>
                            <th>Training ID</th>
                            <th>Trainee Name</th>
                            <th>Payment Date</th>
                            <th>Fees</th>
                            <th>Payment</th>
                            <th>Verify</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $sl = 1;
                        @endphp
                        @foreach($customerCoursePayments as $item)
                        <tr>
                            <td>{{$sl++}}</td>
                            <td>{{\Illuminate\Support\Str::words($item->training->training_name ?? 'N/A', '3','...')}}</td>
                            <td>{{$item->training->training_id ?? 'N/A'}}</td>
                            <td>{{$item->customer->name ?? ''}}</td>
                            <td>
                                {{ optional($item->created_at)?->format('l, F j, Y h:m A') ?? 'N/A' }}
                            </td>
                            <td>{{number_format($item->current_fees ?? '', 2)}}</td>
                            <td>
                                <label class="{{$item->payment_status === 1 ? 'badge badge-success' : 'badge badge-warning'}} w-100 ">
                                    {{$item->payment_status===1 ? 'Paid' : 'Pending'}}
                                </label>
                            </td>
                            <td>
                                <label class="{{$item->verify_status === 1 ? 'badge badge-success' : 'badge badge-warning'}} w-100 ">
                                    {{$item->verify_status===1 ? 'Verified' : 'Pending'}}
                                </label>
                            </td>
                            <td>
                                @if($item->payment_status == 0)
                                    <a href="{{ route('trainee.course.payment.verified', $item->id) }}"
                                       onclick="return confirm('Are you sure you want to mark this as Verified?')"
                                       data-toggle="tooltip"
                                       data-placement="bottom"
                                       title="Verified"
                                       class="btn btn-info">
                                        <i class="fa fa-location-arrow"></i>
                                    </a>
                                @else
                                    <a href="{{ route('trainee.course.payment.verified', $item->id) }}"
                                       onclick="return confirm('Are you sure you want to mark this as Pending?')"
                                       data-toggle="tooltip"
                                       data-placement="bottom"
                                       title="Pending"
                                       class="btn btn-warning">
                                        <i class="fa fa-location-arrow"></i>
                                    </a>
                                @endif


                                <a href="{{route('trainee.course.payment.detail', $item->id)}}" data-toggle="tooltip" data-placement="bottom" title="View" class="btn btn-info"><i class="fa fa-eye"></i></a>
{{--                                <a href="{{route('trainee.course.payment.edit', $item->id)}}"  data-toggle="tooltip" data-placement="bottom" title="Edit" class="btn btn-warning"><i class="fa fa-edit"></i></a>--}}
                                <a href="javascript:void(0);" onclick="confirmDelete({{$item->id}})" data-toggle="tooltip" data-placement="bottom" title="Delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
        toastr["info"]("Payment verified and certificate created.","Status");
    </script>
@endif


<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this record?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Yes, Delete</a>
            </div>
        </div>
    </div>
</div>

{{--delete script --}}
<script>
    function confirmDelete(id) {
        let url = "{{ route('trainee.course.payment.delete', ':id') }}".replace(':id', id);
        document.getElementById("confirmDeleteBtn").setAttribute("href", url);
        $('#deleteModal').modal('show'); // Show the modal
    }
</script>

{{--delete script --}}



@endsection
