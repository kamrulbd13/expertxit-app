@extends('backend.layout.master')
@section('mainContent')

    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">Ebook List</h4>
            <a href="{{ route('backend.ebooks.create') }}" class="btn btn-primary btn-sm mb-3">
                <i class="fa fa-plus"></i> Add New Ebook
            </a>

            <table class="table table-bordered table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Cover Image</th>
                    <th>Title</th>
                    <th>Writer</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th width="150">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ebooks as $key => $ebook)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset($ebook->cover_image ? $ebook->cover_image : 'backend/images/ebook/default.jpg') }}" width="50" alt=""></td>
                        <td>{{ $ebook->title }}</td>
                        <td>{{ $ebook->author }}</td>
                        <td>৳{{ $ebook->price }}</td>
                        <td>
                            <span class="badge bg-{{ $ebook->status ? 'success' : 'danger' }}">
                                {{ $ebook->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('backend.ebooks.edit', $ebook->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                            <a href="{{ route('backend.ebooks.detail', $ebook->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                            <form method="POST" action="{{ route('backend.ebooks.delete', $ebook->id) }}" style="display:inline;">
                                @csrf
                                <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $ebooks->links() }}
        </div>
    </div>

@endsection
