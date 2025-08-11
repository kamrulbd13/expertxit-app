@extends('backend.layout.master')
@section('mainContent')
    {{--    table --}}
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">All Information</h4>
            <hr class="w-50 mx-auto">

            <div class="row">
                <div class="col-12">
                    <div class="card-header d-flex justify-content-between mb-4">
                        <div>

                            <a href="{{route('event.category.create')}}" class="btn btn-sm btn-info" >
                                <i class="fa fa-plus-circle me-2"></i>
                                Add New</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Color</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $sl = 1;
                            @endphp
                                @foreach($eventCategories as $eventCategory)
                                <tr>
                                    <td>{{$sl++}}</td>
                                    <td>{{$eventCategory->name}} </td>
                                    <td>
                                        <div class="card w-50 p-3" style="background-color: {{$eventCategory->color}}">

                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{route('event.category.detail', $eventCategory->id)}}" data-toggle="tooltip" data-placement="bottom" title="View" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                        <a href="{{route('event.category.edit', $eventCategory->id)}}" data-toggle="tooltip" data-placement="bottom" title="edit" class="btn btn-primary"><i class="fa fa-pen"></i></a>
                                        <a href="javascript:void (0)" onclick="confirmDelete({{$eventCategory->id}})" data-toggle="tooltip" data-placement="bottom" title="Delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
            let url = "{{ route('event.category.delete', ':id') }}".replace(':id', id);
            document.getElementById("confirmDeleteBtn").setAttribute("href", url);
            $('#deleteModal').modal('show'); // Show the modal
        }
    </script>

    {{--delete script --}}


    <!-- toastr JS -->
    {{--    update--}}
    <script src="{{asset('/')}}backend/js/toastr.min.js"></script>
    @if (Session::has('update'))
        <script>
            toastr.options = {
                "progressBar" :true,
                "closeButton" : true,
            }
            toastr["info"]("Record has been successfully updated !","Update");
        </script>
    @endif

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

@endsection
