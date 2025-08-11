@extends('backend.layout.master')
@section('mainContent')

    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-uppercase">Visitor Request Details</h4>
            <hr class="w-50 mx-auto">

            <div class="row justify-content-center">
                <div class="col-md-8">

                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 text-dark fw-semibold">
                                <i class="fa fa-user me-2 text-primary"></i> Visitor Information
                            </h5>
                            <a href="{{ route('visitor.index') }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fa fa-arrow-left me-1"></i> Back to List
                            </a>
                        </div>

                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <th class="text-end" style="width: 35%;">Full Name:</th>
                                    <td class="text-start">{{ $visitor->name }}</td>
                                </tr>
                                <tr>
                                    <th class="text-end">Email Address:</th>
                                    <td class="text-start">{{ $visitor->email }}</td>
                                </tr>
                                <tr>
                                    <th class="text-end">Phone Number:</th>
                                    <td class="text-start">{{ $visitor->phone }}</td>
                                </tr>
                                <tr>
                                    <th class="text-end">Course of Interest:</th>
                                    <td class="text-start">{{ $visitor->course }}</td>
                                </tr>
                                <tr>
                                    <th class="text-end">Message:</th>
                                    <td class="text-start">
                                        @if($visitor->message)
                                            {{ $visitor->message }}
                                        @else
                                            <span class="text-muted">No message provided.</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-end">Status:</th>
                                    <td class="text-start">
                                        @if($visitor->status)
                                            <span class="badge bg-success">Contacted</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-end">Submitted On:</th>
                                    <td class="text-start">{{ $visitor->created_at->format('d M Y, h:i A') }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="card-footer bg-white text-end">
                            <a href="{{ route('visitor.delete', $visitor->id) }}" onclick="return confirm('Are you sure you want to delete this record?')" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash me-1"></i> Delete
                            </a>
                            <a href="{{ route('visitor.status', $visitor->id) }}" class="btn btn-sm btn-info">
                                <i class="fa fa-sync-alt me-1"></i>
                                {{ $visitor->status ? 'Mark as Pending' : 'Mark as Contacted' }}
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
