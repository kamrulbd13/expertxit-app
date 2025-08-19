<?php

//customer
use App\Http\Controllers\backendCustomer\BackendCustomerController;
use App\Http\Controllers\backendCustomer\BackendCustomerDashboardController;
use App\Http\Controllers\backendCustomer\BackendCustomerCoursesController;
use App\Http\Controllers\backendCustomer\BackendOurCoursesController;
use App\Http\Controllers\backendCustomer\BackendEventCalendarController;
use App\Http\Controllers\backendCustomer\BackendCustomerPaymentController;
use App\Http\Controllers\backendCustomer\BackendCustomerStudyController;
use App\Http\Controllers\backendCustomer\BackendCustomerAuthController;
use App\Http\Controllers\backendCustomer\BackendCustomerOrderController;
use App\Http\Controllers\backendCustomer\BackendOurHomeController;
use App\Http\Controllers\backendCustomer\BackendCustomerCertificateController;
use App\Http\Controllers\backendCustomer\BackendCustomerNewBatchController;
use App\Http\Controllers\backendCustomer\BackendCustomerNewEventController;
use App\Http\Controllers\backendCustomer\PasswordResetController;
use App\Http\Controllers\backendCustomer\CustomerChatController;
use App\Http\Controllers\backendCustomer\BackendCustomerEbookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backendCustomer\CustomerAdmissionController;
use App\Http\Controllers\backend\TrainingProgramReviewController;
use App\Http\Controllers\backend\KidsProgramReviewController;
use App\Http\Controllers\backendCustomer\BackendCustomerKidsProgrammeController;



//certificate verify
Route::get('u/certificate/view',[BackendCustomerController::class, 'verifyCertificate'])->name('customer.verifyCertificate');
Route::post('u/certificate/search',[BackendCustomerController::class, 'searchCertificate'])->name('searchCertificate');

//login register
Route::get('/u/login', [BackendCustomerController::class, 'login'])->name('customer.login');
Route::post('/u/login/check', [BackendCustomerController::class, 'loginCheck'])->name('customer.login.check');
Route::get('u/create',[BackendCustomerController::class, 'create'])->name('customer.create');
Route::post('u/register',[BackendCustomerController::class, 'store'])->name('customer.store');
Route::get('u/register/congrats',[BackendCustomerController::class, 'congrats'])->name('customer.congrats');

Route::prefix('u')->group(function () {
    Route::post('/customer/logout/check', [BackendCustomerAuthController::class, 'logout'])->name('customer.logout.check');
});


//password reset
Route::get('u/password/forgot/',[PasswordResetController::class, 'passwordForgot'])->name('customer.forgot.password.form');
Route::post('u/password/email/', [PasswordResetController::class, 'sendResetLinkEmail'])->name('customer.password.email');
Route::get('u/password/reset/{token}/', [PasswordResetController::class, 'showResetForm'])->name('customer.password.reset');
Route::post('u/password/reset/', [PasswordResetController::class, 'reset'])->name('customer.passwords.update');


//existing phone and email check
Route::get('/ajax-phone-check', [BackendCustomerController::class, 'ajaxPhoneCheck'])->name('ajax-phone-check');
Route::get('/ajax-email-check', [BackendCustomerController::class, 'ajaxEmailCheck'])->name('ajax-email-check');




//for chat message
Route::middleware(['auth:customer'])->group(function () {
    Route::get('/customer/chat', function () {
        return view('customer.chat');});

    Route::post('/trainings/{id}/review', [TrainingProgramReviewController::class, 'store'])->name('training.review.store');
    Route::get('/user/reviews/{id}/edit', [TrainingProgramReviewController::class, 'edit'])->name('user.reviews.edit');
    Route::put('/user/reviews/{id}', [TrainingProgramReviewController::class, 'update'])->name('user.reviews.update');
    Route::delete('/user/reviews/{id}', [TrainingProgramReviewController::class, 'destroy'])->name('user.reviews.destroy');

    Route::post('/kidsProgramme/{id}/review', [KidsProgramReviewController::class, 'store'])->name('kids.programme.review.store');
    Route::get('/user/reviews/{id}/edit', [KidsProgramReviewController::class, 'edit'])->name('kids.programme.user.reviews.edit');
    Route::put('/user/reviews/{id}', [KidsProgramReviewController::class, 'update'])->name('kids.programme.user.reviews.update');
    Route::delete('/user/reviews/{id}', [KidsProgramReviewController::class, 'destroy'])->name('kids.programme.user.reviews.destroy');


    Route::get('/customer/chat/messages', [CustomerChatController::class, 'fetchMessages']);
    Route::post('/customer/chat/send', [CustomerChatController::class, 'sendMessage']);
});

Route::get('/trainings/{id}/reviews', [TrainingProgramReviewController::class, 'showReviews'])->name('training.reviews.show');
Route::get('/kidsProgramme/{id}/reviews', [KidsProgramReviewController::class, 'showReviews'])->name('kids.programme.reviews.show');




// All routes below require customer to be logged in
Route::middleware(['auth.customer', 'update.lastseen'])->group(function () {

    // Customer dashboard
    Route::get('/u/dashboard', [BackendCustomerDashboardController::class, 'index'])->name('customer.dashboard');

//    our home
    Route::get('/our/home', [BackendOurHomeController::class, 'index'])->name('our.home.index');

    // Our courses (protected)
    Route::get('/our/courses', [BackendOurCoursesController::class, 'index'])->name('our.courses.index');
    Route::get('/our/courses/details/{id}', [BackendOurCoursesController::class, 'details'])->name('our.courses.details');
    Route::get('/customer/courses/search', [BackendOurCoursesController::class, 'search'])->name('customer.courses.search');

    // Our Kids programme (protected)
    Route::get('/our/kids/programme', [BackendCustomerKidsProgrammeController::class, 'index'])->name('our.kids.programme.index');
    Route::get('/our/kids/programme/details/{id}', [BackendCustomerKidsProgrammeController::class, 'details'])->name('our.kids.programme.details');
    Route::get('/customer/kids/programme/search', [BackendCustomerKidsProgrammeController::class, 'search'])->name('customer.kids.programme.search');


    // new batch
    Route::get('/new/batch', [BackendCustomerNewBatchController::class, 'index'])->name('new.batch.index');
    Route::get('/new/batch/details/{id}', [BackendCustomerNewBatchController::class, 'details'])->name('new.batch.details');
    Route::get('/customer/courses/search', [BackendCustomerNewBatchController::class, 'search'])->name('customer.courses.search');

    // new event
    Route::get('/new/event', [BackendCustomerNewEventController::class, 'index'])->name('new.event.index');
    Route::get('/new/event/details/{id}', [BackendCustomerNewEventController::class, 'details'])->name('new.event.details');
    Route::get('/customer/courses/search', [BackendCustomerNewEventController::class, 'search'])->name('customer.courses.search');

//    admission
    Route::post('/customer/admission/{id}',[CustomerAdmissionController::class,'batchAdmission'])->name('customer.batch.admission');

    // Customer courses
    Route::get('/u/courses', [BackendCustomerCoursesController::class, 'index'])->name('customer.courses.index');
    Route::post('/u/courses/payment/{id}', [BackendCustomerCoursesController::class, 'customerPaymentCourse'])->name('customer.payment.courses');

    // Customer ebook
    Route::get('/u/ebook', [BackendCustomerCoursesController::class, 'ebookIndex'])->name('customer.ebook.index');
    Route::post('/u/ebook/payment/{id}', [BackendCustomerCoursesController::class, 'customerPaymentCourse'])->name('customer.payment.ebook');


//    customer order
//    course
    Route::get('/u/order', [BackendCustomerOrderController::class, 'index'])->name('customer.order.index');
    Route::get('/u/order/details/{id}', [BackendCustomerOrderController::class, 'details'])->name('customer.order.details');
    Route::get('/u/order/invoice/{id}', [BackendCustomerOrderController::class, 'invoice'])->name('customer.order.invoice');
    Route::post('/u/courses/booking/{id}', [BackendCustomerOrderController::class, 'customerBookingCourse'])->name('customer.booking.courses');
    Route::post('/u/courses/cancel/{id}', [BackendCustomerOrderController::class, 'customerCancelCourse'])->name('customer.bookmark.cancel');
//    ebook
    Route::get('/u/order/ebook', [BackendCustomerOrderController::class, 'ebookIndex'])->name('customer.ebook.order.index');
    Route::get('/u/order/ebook/details/{id}', [BackendCustomerOrderController::class, 'details'])->name('customer.ebook.order.details');
    Route::get('/u/order/ebook/invoice/{id}', [BackendCustomerOrderController::class, 'invoice'])->name('customer.ebook.order.invoice');

    //    customer certificate
    Route::get('/u/certificate', [BackendCustomerCertificateController::class, 'index'])->name('customer.certificate.index');
    Route::get('/u/certificate/details/{id}', [BackendCustomerCertificateController::class, 'details'])->name('customer.certificate.details');

    // Customer profile
    Route::get('/user/profile', [BackendCustomerController::class, 'index'])->name('customer.profile.index');
    Route::get('/user/profile/edit/{id}', [BackendCustomerController::class, 'edit'])->name('customer.profile.edit');
    Route::post('/user/profile/update/{id}', [BackendCustomerController::class, 'update'])->name('customer.profile.update');

    // Event calendar
    Route::get('/event/calendar', [BackendEventCalendarController::class, 'index'])->name('event.calendar');

    // Payment
    Route::get('/u/payment/{id}', [BackendCustomerPaymentController::class, 'create'])->name('customer.payment.create');
    Route::post('/u/payment/store', [BackendCustomerPaymentController::class, 'store'])->name('customer.payment.store');
    Route::get('/u/payment/congrats/message', [BackendCustomerPaymentController::class, 'paymentCongrats'])->name('customer.payment.congrats');


    // Study reading
    Route::get('/u/study/{training_id}', [BackendCustomerStudyController::class, 'index'])->name('customer.study.index');
    Route::get('/u/study/pdf/{slug}', [BackendCustomerStudyController::class, 'showPdf'])->name('materials.pdf.show');
    Route::get('/u/study/assignments/pdf/{slug}', [BackendCustomerStudyController::class, 'showAssignmentsPdf'])->name('assignments.pdf.show');
    Route::get('/study-material/{slug}', [BackendCustomerStudyController::class, 'downloadWatermarkedPdf'])->name('studyMaterials.download');
    Route::get('/u/study/video/{slug}', [BackendCustomerStudyController::class, 'showVideo'])->name('materials.video.show');
    Route::get('/u/exam/system/{id}', [BackendCustomerStudyController::class, 'examStart'])->name('exam.start');
    Route::post('/exam/submit/{id}', [BackendCustomerStudyController::class, 'submitExam'])->name('exam.submit');
    Route::get('/exam/result/{id}', [BackendCustomerStudyController::class, 'showExamResult'])->name('exam.result');
    Route::get('/exam/{id}/result/details', [BackendCustomerStudyController::class, 'showResultDetails'])->name('exam.result.details');
    Route::get('/exam/{id}/details/download', [BackendCustomerStudyController::class, 'downloadDetails'])->name('exam.details.download');
    Route::get('/exam/{id}/transcript/download', [BackendCustomerStudyController::class, 'downloadTranscript'])->name('exam.transcript.download');
    Route::get('/u/exam/retake/{id}', [BackendCustomerStudyController::class, 'retake'])->name('exam.retake');


//    ebooks
    Route::get('/ebooks/', [BackendCustomerEbookController::class, 'index'])->name('ebook.index');
    Route::get('/ebooks/details/{id}', [BackendCustomerEbookController::class, 'details'])->name('ebooks.details');
    Route::get('/ebooks/purchase/{id}', [BackendCustomerEbookController::class, 'showPurchaseForm'])->name('ebook.purchase.form');
    Route::post('/ebooks/purchase/confirm/{id}', [BackendCustomerEbookController::class, 'confirmPurchase'])->name('ebooks.purchase.confirm');
    Route::get('/ebooks/purchase/{id}/success', [BackendCustomerEbookController::class, 'purchaseSuccess'])->name('ebooks.purchase.success');



});

