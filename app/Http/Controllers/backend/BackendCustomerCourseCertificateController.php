<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\CustomerCertificate;
use Illuminate\Http\Request;

class BackendCustomerCourseCertificateController extends Controller
{
    //index
    public function index(){
        return view('backend.customer_course_certificate.index',[
            'customerCourseCertificates'    => CustomerCertificate::orderBy('created_at', 'desc')->get(),
        ]);
    }

    //edit
    public function edit($id){
        return view('backend.customer_course_certificate.edit',[
            'customerCourseCertificateInfo'    => CustomerCertificate::find($id),
        ]);
       }

    //     Create certificate
    public function update(Request $request, $id)
    {
        CustomerCertificate::updateDate($request, $id);
        return redirect()
            ->back()
            ->with('update','');
    }

    //      status
    public function status($id)
    {
        CustomerCertificate::statusUpdate($id);
        return redirect()
            ->back()
            ->with('status', '');
    }

    //    delete
    public function delete($id)
    {
//        CustomerCertificate::deleteData($id);
        return redirect()
            ->back()
            ->with('delete', '');
    }

}
