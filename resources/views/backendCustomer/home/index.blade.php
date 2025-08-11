@extends('backendCustomer.layout.master')
@section('mainContent')
    <!-- Card -->
    <div class="row">
           <div class="col-md-6 col-lg-4 col-xl-4 col-sm-6 col-12">
            <div class="widget-card widget-bg2">
                <div class="wc-item">
                    <h4 class="wc-title">
                        Your Course
                    </h4>
                    <span class="wc-des">
								<a href="{{route('customer.courses.index')}}">Show Details</a>
							</span>
                    <span class="wc-stats counter">
								{{$customerCourses}}
							</span>
                    <div class="progress wc-progress">
                        <div class="progress-bar" role="progressbar" style="width: 88%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-4 col-sm-6 col-12">
            <div class="widget-card widget-bg3">
                <div class="wc-item">
                    <h4 class="wc-title">
                        Orders
                    </h4>
                    <span class="wc-des">
								<a href="{{route('customer.order.index')}}">Details Order</a>
							</span>
                    <span class="wc-stats counter">
								{{$customerTotalOrder}}
							</span>
                    <div class="progress wc-progress">
                        <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-4 col-sm-6 col-12">
            <div class="widget-card widget-bg4">
                <div class="wc-item">
                    <h4 class="wc-title">
                        <h4 class="wc-title">
                            Certificate
                        </h4>
                    <span class="wc-des">
								Certificate Details
							</span>
                    <span class="wc-stats counter">
								{{$customerCertificates}}
							</span>
                    <div class="progress wc-progress">
                        <div class="progress-bar" role="progressbar" style="width: 90%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    </h4>
                </div>
            </div>
        </div>
    </div>
    <!-- Card END -->
    <div class="row">
        <div class="col-lg-5 m-b30">
            <div class="widget-box">
                <div class="wc-title">
                    <h4>Event Notifications</h4>
                </div>
                <div class="widget-inner">
                    <div class="noti-box-list">
                        <ul>
                            @foreach($upComingEvents as $item)
                            <li>
										<span class="notification-icon dashbg-gray">
											<i class="fa fa-check"></i>
										</span>
                                <span class="notification-text">
											<span>{{$item->category->name  ?? ''}}</span> <br>
                                        <a href="{{route('event.calendar')}}">
                                            {{\Illuminate\Support\Str::words($item->title, '5', '...')}}
                                        </a>
										</span>
                                <span class="notification-time">
                                    <a href="{{route('event.calendar')}}" class="">
                                        {{ $item->start_time ? \Carbon\Carbon::parse($item->start_time)->format('h:m A') : '' }}

                                    </a>
											<span>
                                              {{ $item->start_date ? \Carbon\Carbon::parse($item->start_date)->format('d M Y') : '' }}<br>

                                            </span>
										</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7 m-b30">
            <div class="widget-box">
                <div class="wc-title">
                    <h4>Pending Orders</h4>
                </div>
                <div class="widget-inner">
                    <div class="orders-list">
                        <ul>
                            @foreach($customerOrders as $item)
                            <li>
										<span class="orders-title">
											<a href="{{route('customer.order.index')}}" class="orders-title-name">{{\Illuminate\Support\Str::words($item->training->training_name, '5', '...')}}</a>
											<span class="orders-info">Order #{{$item->invoice_id ?? ''}} | Date {{date_format($item->created_at ?? '', ('d M Y'))}}</span>
										</span>
                                        <span class="orders-btn">
                                        <a href="{{route('customer.order.index')}}" class="btn button-sm red">
                                            {{ $item->payment_status == 0 ? 'Pending' : 'Paid' }}
                                        </a>

										</span>
                             </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
