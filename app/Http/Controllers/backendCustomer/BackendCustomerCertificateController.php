<?php

namespace App\Http\Controllers\backendCustomer;

use App\Http\Controllers\Controller;
use App\Models\CustomerCertificate;
use App\Models\SystemSetting;
use Illuminate\Http\Request;

class BackendCustomerCertificateController extends Controller
{
    //index
    public function index(){
        $customerId = auth('customer')->id();
        return view('backendCustomer.certificate.index',[
            'orders'    => CustomerCertificate::orderBy('created_at', 'desc')
                ->where('customer_id', $customerId)
                ->get(),
        ]);
    }

    public function details($id){
        return view('backendCustomer.certificate.certificate',[
            'detail'    => CustomerCertificate::find($id),
            'systemInfo'  => SystemSetting::first(),
        ]);
    }
}
