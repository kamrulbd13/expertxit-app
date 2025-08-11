@extends('backend.layout.master')
@section('mainContent')
    @php
    use Illuminate\Support\Str;
    @endphp
    {{--    table --}}

    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">All Information</h4>
            <hr class="w-50 mx-auto">
            <div class="row">
                <div class="col-12">
                    <div class="card-header d-flex justify-content-between mb-4">
                        <div>

                            <a href="{{route('event.calendar.create')}}" class="btn btn-sm btn-info" >
                                <i class="fa fa-plus-circle me-2"></i>
                                Add New</a>

                            <a href="{{route('event.category.index')}}" class="btn btn-sm btn-info" >
                                <i class="fa fa-arrow-alt-circle-right me-2"></i>
                                Event Category</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Start Date</th>
                                <th>Start Time</th>
                                <th>status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $sl = 1;
                            @endphp
                         @foreach($events as $event)
                                <tr>
                                    <td>{{$sl++}}</td>
                                    <td ata-toggle="tooltip" data-placement="bottom" title="{{$event->title ?? ''}}">
                                        {{str::limit($event->title ?? '', '35', '...')}}
                                    </td>
                                    <td>{{$event->category->name}}</td>
                                    <td>{{ \Carbon\Carbon::parse($event->start_date)->format('d-M-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }}</td>
                                    <td>
                                        <label for="" class="{{$event->status == 1 ? 'badge badge-success' : 'badge badge-warning'}} rounded rounded-5 w-75">
                                            {{$event->status === 1 ? 'Published' : 'Pending'}}
                                        </label>
                                    </td>
                                    <td>
                                        <a href="{{route('event.calendar.detail', $event->id)}}" data-toggle="tooltip" data-placement="bottom" title="View" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                        <a href="{{route('event.calendar.edit', $event->id)}}" data-toggle="tooltip" data-placement="bottom" title="edit" class="btn btn-primary"><i class="fa fa-pen"></i></a>
                                        <a href="javascript:void(0);" onclick="confirmDelete({{$event->id}})" data-toggle="tooltip" data-placement="bottom" title="Delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>

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
            let url = "{{ route('event.calendar.delete', ':id') }}".replace(':id', id);
            document.getElementById("confirmDeleteBtn").setAttribute("href", url);
            $('#deleteModal').modal('show'); // Show the modal
        }
    </script>

    {{--delete script --}}


@endsection
