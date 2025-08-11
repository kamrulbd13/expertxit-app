@extends('backendCustomer.layout.master')
@section('mainContent')
    @php
        $paymentStatus = $detail->payment->payment_status ?? 0;
        $verifyStatus  = $detail->payment->verify_status ?? 0;
    @endphp
    <div class="row">
        <!-- Your Profile Views Chart -->
        <div class="col-lg-12 m-b30">
            <div class="widget-box">
                <div class="wc-title">
                    <h4>Order Details</h4>
                </div>
                <div class="widget-inner">
                    <div class="">
                        <div class="form-group row">
                            <div class="col-sm-10  ml-auto">
                                <h3>1. Course Details</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Course Name</label>
                                    <div class="col-sm-7">
                                        <input class="form-control" readonly  value="{{$detail->training->training_name ?? ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Course ID</label>
                                    <div class="col-sm-7">
                                        <input class="form-control" readonly value="{{$detail->training->training_id ?? ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Course Fees</label>
                                    <div class="col-sm-7">
                                        <input class="form-control" readonly  value="{{$detail->training->current_fees ?? ''}}">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="seperator"></div>

                        <div class="form-group row">
                            <div class="col-sm-10 ml-auto">
                                <h3>Payment Details</h3>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Invoice Id</label>
                            <div class="col-sm-7">
                                <input class="form-control" readonly value="{{$detail->payment->invoice_id ?? 'N/A'}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Order Date</label>
                            <div class="col-sm-7">
                                <input class="form-control" readonly value="{{date_format($detail->created_at ?? '', ('d M Y, h:m A'))}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Payment </label>
                            <div class="col-sm-7">
                                <input class="form-control" readonly value="{{$paymentStatus == 0 ? 'Unpaid' : 'Paid' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Verify</label>
                            <div class="col-sm-7">
                                <input class="form-control" readonly value="{{$verifyStatus == 0 ? 'Pending' : 'Completed' }}">
                            </div>
                        </div>
                        <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                        </div>

                        <div class="col-sm-7">
                            <a  href="{{ $paymentStatus == 1 ? '#' : route('customer.payment.create', $detail->id) }}"
                                class="btn radius outline"
                                @if($paymentStatus == 1)
                                style="pointer-events: none; opacity: 0.6; cursor: not-allowed;"
                                @endif> Payment</a>
                            <a  href="{{route('customer.order.index')}}" class="btn-secondry">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Your Profile Views Chart END-->
    </div>
@endsection
