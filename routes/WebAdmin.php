<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\AdminAuthController;
use App\Http\Controllers\backend\AdminChatController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\BackendEventController;
use App\Http\Controllers\backend\BackendEventCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\backend\TrainerTypeController;
use App\Http\Controllers\backend\TrainerController;
use App\Http\Controllers\backend\TrainingCategoryController;
use App\Http\Controllers\backend\TrainingController;
use App\Http\Controllers\backend\TranieeController;
use App\Http\Controllers\backend\AcademicSessionController;
use App\Http\Controllers\backend\AchivementController;
use App\Http\Controllers\backend\SkillLevelController;
use App\Http\Controllers\backend\LanguageController;
use App\Http\Controllers\backend\BackendCustomerCourseCertificateController;
use App\Http\Controllers\backend\BackendCustomerCoursePaymentController;
use App\Http\Controllers\backend\BackendCustomerCourseBookingController;
use App\Http\Controllers\backend\BackendSystemSettingController;
use App\Http\Controllers\backend\BackendSystemMailSettingController;
use App\Http\Controllers\backend\BackendNewBatchUpcomingController;
use App\Http\Controllers\backend\AdmissionController;
use App\Http\Controllers\backend\CustomerChatMessageController;
use App\Http\Controllers\backend\StudyMaterialsController;
use App\Http\Controllers\backend\ExamSystemController;
use App\Http\Controllers\backend\AssignmentController;
use App\Http\Controllers\backend\LabAccessCredentialController;
use App\Http\Controllers\backend\EbookController;
use App\Http\Controllers\backend\HeroSliderController;
use App\Http\Controllers\backend\VisitorController;
use App\Http\Controllers\backend\SoftwareCategoryController;
use App\Http\Controllers\backend\SoftwareController;
use App\Http\Controllers\backend\ITServiceCategoryController;
use App\Http\Controllers\backend\ITServiceController;
use App\Http\Controllers\backend\KidsProgrammeCategoryController;
use App\Http\Controllers\backend\KidsProgrammeController;




Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'adminLogin']);
Route::get('admin/register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/admin/register', [AdminAuthController::class, 'adminStore'])->name('admin.store');
Route::get('admin/forgot-pass', [AdminAuthController::class, 'showForgotPassForm'])->name('admin.forgot');
Route::get('admin/reset-pass', [AdminAuthController::class, 'showResetPassForm'])->name('admin.reset');



//backend
Route::get('/admin', [AdminAuthController::class, 'index'])
    ->middleware(['auth:admin', 'update.lastseen','verified'])
    ->name('dashboard');


// Authenticated admin routes
Route::middleware('auth:admin')->group(function () {
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
});


//for chat message
Route::middleware(['auth:admin'])->prefix('admin/chat')->group(function () {
    // Chat main page (loads the view)
    Route::get('/', function () {
        return view('admin.chat');  // your Blade chat panel view
    })->name('admin.chat');

    // Optionally: List of customers if needed (or load customers in the view directly)
    Route::get('/index', [AdminChatController::class, 'index'])->name('admin.chat.index');

    // Fetch messages for a customer (by customer ID)
    Route::get('/messages/{customer}', [AdminChatController::class, 'fetchMessages'])->name('admin.chat.messages');

    // Send message POST route
    Route::post('/send', [AdminChatController::class, 'sendMessage'])->name('admin.chat.send');
});



Route::middleware('auth:admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('home/hero/image')->name('home.hero.image.')->group(function () {
        Route::get('/', [HeroSliderController::class, 'index'])->name('index');
        Route::get('/create', [HeroSliderController::class, 'create'])->name('create');
        Route::post('/store', [HeroSliderController::class, 'store'])->name('store');
        Route::get('/details/{id}', [HeroSliderController::class, 'details'])->name('details');
        Route::get('/edit/{id}', [HeroSliderController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [HeroSliderController::class, 'update'])->name('update');
        Route::get('/status/{id}', [HeroSliderController::class, 'status'])->name('status');
        Route::get('/delete/{id}', [HeroSliderController::class, 'delete'])->name('delete');
    });

    //   System Setting
    Route::get('/system/setting',[BackendSystemSettingController::class, 'index'])->name('system.setting.index');
    Route::get('/system/setting/create',[BackendSystemSettingController::class, 'create'])->name('system.setting.create');
    Route::post('/system/setting/store',[BackendSystemSettingController::class, 'store'])->name('system.setting.store');
    Route::get('/system/setting/detail/{id}',[BackendSystemSettingController::class, 'detail'])->name('system.setting.detail');
    Route::get('/system/setting/edit/{id}',[BackendSystemSettingController::class, 'edit'])->name('system.setting.edit');
    Route::post('/system/setting/update/{id}',[BackendSystemSettingController::class, 'update'])->name('system.setting.update');
    Route::get('/system/setting/status/{id}',[BackendSystemSettingController::class, 'status'])->name('system.setting.status');
    Route::get('/system/setting/delete/{id}',[BackendSystemSettingController::class, 'delete'])->name('system.setting.delete');

//    mail setting
    Route::get('/mail/setting',[BackendSystemMailSettingController::class, 'index'])->name('system.mail.setting.index');
        Route::get('/mail/setting/create',[BackendSystemMailSettingController::class, 'create'])->name('system.mail.setting.create');
        Route::post('/mail/setting/store',[BackendSystemMailSettingController::class, 'store'])->name('system.mail.setting.store');
        Route::get('/mail/setting/detail/{id}',[BackendSystemMailSettingController::class, 'detail'])->name('system.mail.setting.detail');
        Route::get('/mail/setting/edit/{id}',[BackendSystemMailSettingController::class, 'edit'])->name('system.mail.edit.setting');
        Route::post('/mail/setting/update/{id}',[BackendSystemMailSettingController::class, 'update'])->name('system.mail.setting.update');
        Route::get('/mail/setting/status/{id}',[BackendSystemMailSettingController::class, 'status'])->name('system.mail.setting.status');
        Route::get('/mail/setting/delete/{id}',[BackendSystemMailSettingController::class, 'delete'])->name('system.mail.setting.delete');

//    customer chat
    Route::get('/backend/chat/index',[AdminChatController::class, 'index'])->name('customer.chat.index');
    Route::get('/backend/chat/create',[AdminChatController::class, 'create'])->name('customer.chat.create');

    //    Trainer Type
    Route::get('/trainer/type',[TrainerTypeController::class, 'index'])->name('trainer.type.index');
    Route::get('/trainer/type/create',[TrainerTypeController::class, 'create'])->name('trainer.type.create');
    Route::post('/trainer/type/store',[TrainerTypeController::class, 'store'])->name('trainer.type.store');
    Route::get('/trainer/type/detail/{id}',[TrainerTypeController::class, 'detail'])->name('trainer.type.detail');
    Route::get('/trainer/type/edit/{id}',[TrainerTypeController::class, 'edit'])->name('trainer.type.edit');
    Route::post('/trainer/type/update/{id}',[TrainerTypeController::class, 'update'])->name('trainer.type.update');
    Route::get('/trainer/type/status/{id}',[TrainerTypeController::class, 'status'])->name('trainer.type.status');
    Route::get('/trainer/type/delete/{id}',[TrainerTypeController::class, 'delete'])->name('trainer.type.delete');

    //    Trainer
    Route::get('/trainer',[TrainerController::class, 'index'])->name('trainer.index');
    Route::get('/trainer/create',[TrainerController::class, 'create'])->name('trainer.create');
    Route::post('/trainer/store',[TrainerController::class, 'store'])->name('trainer.store');
    Route::get('/trainer/detail/{id}',[TrainerController::class, 'detail'])->name('trainer.detail');
    Route::get('/trainer/edit/{id}',[TrainerController::class, 'edit'])->name('trainer.edit');
    Route::post('/trainer/update/{id}',[TrainerController::class, 'update'])->name('trainer.update');
    Route::get('/trainer/status/{id}',[TrainerController::class, 'status'])->name('trainer.status');
    Route::get('/trainer/delete/{id}',[TrainerController::class, 'delete'])->name('trainer.delete');

    Route::prefix('software')->as('software.')->group(function () {
        Route::resource('category', SoftwareCategoryController::class);
        Route::resource('/', SoftwareController::class)->parameters([
            '' => 'id'  // now {id} will be used instead of {software}
        ]);
    });


    Route::prefix('itService')->as('itService.')->group(function () {
        Route::resource('category', ITServiceCategoryController::class);
        Route::resource('/', ITServiceController::class)->parameters([
            '' => 'id'
        ]);
    });

    Route::prefix('kidsProgramme')->as('kidsProgramme.')->group(function () {
        Route::resource('category', KidsProgrammeCategoryController::class);
        Route::resource('/', KidsProgrammeController::class)->parameters([
            '' => 'id',
        ]);
    });

    //    Training Category
    Route::get('/training/category',[TrainingCategoryController::class, 'index'])->name('training.category.index');
    Route::get('/training/category/create',[TrainingCategoryController::class, 'create'])->name('training.category.create');
    Route::post('/training/category/store',[TrainingCategoryController::class, 'store'])->name('training.category.store');
    Route::get('/training/category/detail/{id}',[TrainingCategoryController::class, 'detail'])->name('training.category.detail');
    Route::get('/training/category/edit/{id}',[TrainingCategoryController::class, 'edit'])->name('training.category.edit');
    Route::post('/training/category/update/{id}',[TrainingCategoryController::class, 'update'])->name('training.category.update');
    Route::get('/training/category/status/{id}',[TrainingCategoryController::class, 'status'])->name('training.category.status');
    Route::get('/training/category/delete/{id}',[TrainingCategoryController::class, 'delete'])->name('training.category.delete');

    //    Training
    Route::get('/training',[TrainingController::class, 'index'])->name('training.index');
    Route::get('/training/create',[TrainingController::class, 'create'])->name('training.create');
    Route::post('/training/store',[TrainingController::class, 'store'])->name('training.store');
    Route::get('/training/detail/{id}',[TrainingController::class, 'detail'])->name('training.detail');
    Route::get('/training/edit/{id}',[TrainingController::class, 'edit'])->name('training.edit');
    Route::post('/training/update/{id}',[TrainingController::class, 'update'])->name('training.update');
    Route::get('/training/status/{id}',[TrainingController::class, 'status'])->name('training.status');
    Route::get('/training/delete/{id}',[TrainingController::class, 'delete'])->name('training.delete');

    //    new batch upcoming
    Route::get('/new/batch/upcoming',[BackendNewBatchUpcomingController::class, 'index'])->name('backend.new.batch.upcoming.index');
    Route::get('/new/batch/upcoming/create',[BackendNewBatchUpcomingController::class, 'create'])->name('backend.new.batch.upcoming.create');
    Route::post('/new/batch/upcoming/store',[BackendNewBatchUpcomingController::class, 'store'])->name('backend.new.batch.upcoming.store');
    Route::get('/new/batch/upcoming/detail/{id}',[BackendNewBatchUpcomingController::class, 'detail'])->name('backend.new.batch.upcoming.detail');
    Route::get('/new/batch/upcoming/edit/{id}',[BackendNewBatchUpcomingController::class, 'edit'])->name('backend.new.batch.upcoming.edit');
    Route::post('/new/batch/upcoming/update/{id}',[BackendNewBatchUpcomingController::class, 'update'])->name('backend.new.batch.upcoming.update');
    Route::get('/new/batch/upcoming/status/{id}',[BackendNewBatchUpcomingController::class, 'status'])->name('backend.new.batch.upcoming.status');
    Route::get('/new/batch/upcoming/delete/{id}',[BackendNewBatchUpcomingController::class, 'delete'])->name('backend.new.batch.upcoming.delete');
    Route::post('/generate-batch-id', [BackendNewBatchUpcomingController::class, 'generateBatchId'])->name('batch.generate');

    //    admission
    Route::get('/admission',[AdmissionController::class, 'index'])->name('admission.index');
    Route::get('/admission/create',[AdmissionController::class, 'create'])->name('admission.create');
    Route::post('/admission/store',[AdmissionController::class, 'store'])->name('admission.store');
    Route::get('/admission/detail/{id}',[AdmissionController::class, 'detail'])->name('admission.detail');
    Route::get('/admission/edit/{id}',[AdmissionController::class, 'edit'])->name('admission.edit');
    Route::post('/admission/update/{id}',[AdmissionController::class, 'update'])->name('admission.update');
    Route::get('/admission/status/{id}',[AdmissionController::class, 'status'])->name('admission.status');
    Route::get('/admission/delete/{id}',[AdmissionController::class, 'delete'])->name('admission.delete');

    //    Trainee
    Route::get('/trainee',[TranieeController::class, 'index'])->name('trainee.index');
    Route::get('/trainee/create',[TranieeController::class, 'create'])->name('trainee.create');
    Route::post('/trainee/store',[TranieeController::class, 'store'])->name('trainee.store');
    Route::get('/trainee/detail/{id}',[TranieeController::class, 'detail'])->name('trainee.detail');
    Route::get('/trainee/edit/{id}',[TranieeController::class, 'edit'])->name('trainee.edit');
    Route::post('/trainee/update/{id}',[TranieeController::class, 'update'])->name('trainee.update');
    Route::get('/trainee/status/{id}',[TranieeController::class, 'status'])->name('trainee.status');
    Route::get('/trainee/delete/{id}',[TranieeController::class, 'delete'])->name('trainee.delete');

    //    Trainee course booking
    Route::get('/trainee/course/booking',[BackendCustomerCourseBookingController::class, 'index'])->name('trainee.course.booking.index');
    Route::get('/trainee/course/booking/create',[BackendCustomerCourseBookingController::class, 'create'])->name('trainee.course.booking.create');
    Route::post('/trainee/course/booking/store',[BackendCustomerCourseBookingController::class, 'store'])->name('trainee.course.booking.store');
    Route::get('/trainee/course/booking/detail/{id}',[BackendCustomerCourseBookingController::class, 'detail'])->name('trainee.course.booking.detail');
    Route::get('/trainee/course/booking/edit/{id}',[BackendCustomerCourseBookingController::class, 'edit'])->name('trainee.course.booking.edit');
    Route::post('/trainee/course/booking/update/{id}',[BackendCustomerCourseBookingController::class, 'update'])->name('trainee.course.booking.update');
    Route::get('/trainee/course/booking/status/{id}',[BackendCustomerCourseBookingController::class, 'status'])->name('trainee.course.booking.status');
    Route::get('/trainee/course/booking/delete/{id}',[BackendCustomerCourseBookingController::class, 'delete'])->name('trainee.course.booking.delete');

    //    Trainee course payment
    Route::get('/trainee/course/payment',[BackendCustomerCoursePaymentController::class, 'index'])->name('trainee.course.payment.index');
    Route::get('/trainee/course/payment/create',[BackendCustomerCoursePaymentController::class, 'create'])->name('trainee.course.payment.create');
    Route::post('/trainee/course/payment/store',[BackendCustomerCoursePaymentController::class, 'store'])->name('trainee.course.payment.store');
    Route::get('/trainee/course/payment/detail/{id}',[BackendCustomerCoursePaymentController::class, 'detail'])->name('trainee.course.payment.detail');
    Route::get('/trainee/course/payment/edit/{id}',[BackendCustomerCoursePaymentController::class, 'edit'])->name('trainee.course.payment.edit');
    Route::post('/trainee/course/payment/update/{id}',[BackendCustomerCoursePaymentController::class, 'update'])->name('trainee.course.payment.update');
    Route::get('/trainee/course/payment/verified/{id}',[BackendCustomerCoursePaymentController::class, 'paymentVerified'])->name('trainee.course.payment.verified');
    Route::get('/trainee/course/payment/delete/{id}',[BackendCustomerCoursePaymentController::class, 'delete'])->name('trainee.course.payment.delete');

    //    Trainee certificate
    Route::get('/trainee/course/certificate',[BackendCustomerCourseCertificateController::class, 'index'])->name('trainee.course.certificate.index');
    Route::get('/trainee/course/certificate/create',[BackendCustomerCourseCertificateController::class, 'create'])->name('trainee.course.certificate.create');
    Route::post('/trainee/course/certificate/store',[BackendCustomerCourseCertificateController::class, 'store'])->name('trainee.course.certificate.store');
    Route::get('/trainee/course/certificate/detail/{id}',[BackendCustomerCourseCertificateController::class, 'detail'])->name('trainee.course.certificate.detail');
    Route::get('/trainee/course/certificate/edit/{id}',[BackendCustomerCourseCertificateController::class, 'edit'])->name('trainee.course.certificate.edit');
    Route::post('/trainee/course/certificate/update/{id}',[BackendCustomerCourseCertificateController::class, 'update'])->name('trainee.course.certificate.update');
    Route::get('/trainee/course/certificate/status/{id}',[BackendCustomerCourseCertificateController::class, 'status'])->name('trainee.course.certificate.status');
    Route::get('/trainee/course/certificate/delete/{id}',[BackendCustomerCourseCertificateController::class, 'delete'])->name('trainee.course.certificate.delete');

    //    Academic Session
    Route::get('/academicSession',[AcademicSessionController::class, 'index'])->name('academic.session.index');
    Route::get('/academicSession/create',[AcademicSessionController::class, 'create'])->name('academic.session.create');
    Route::post('/academicSession/store',[AcademicSessionController::class, 'store'])->name('academic.session.store');
    Route::get('/academicSession/detail/{id}',[AcademicSessionController::class, 'detail'])->name('academic.session.detail');
    Route::get('/academicSession/edit/{id}',[AcademicSessionController::class, 'edit'])->name('academic.session.edit');
    Route::post('/academicSession/update/{id}',[AcademicSessionController::class, 'update'])->name('academic.session.update');
    Route::get('/academicSession/status/{id}',[AcademicSessionController::class, 'status'])->name('academic.session.status');
    Route::get('/academicSession/delete/{id}',[AcademicSessionController::class, 'delete'])->name('academic.session.delete');

    //    Academic Session
    Route::get('/academicSession/achivement',[AchivementController::class, 'index'])->name('academic.session.achivement.index');
    Route::get('/academicSession/achivement/create',[AchivementController::class, 'create'])->name('academic.session.achivement.create');
    Route::post('/academicSession/achivement/store',[AchivementController::class, 'store'])->name('academic.session.achivement.store');
    Route::get('/academicSession/achivement/detail/{id}',[AchivementController::class, 'detail'])->name('academic.session.achivement.detail');
    Route::get('/academicSession/achivement/edit/{id}',[AchivementController::class, 'edit'])->name('academic.session.achivement.edit');
    Route::post('/academicSession/achivement/update/{id}',[AchivementController::class, 'update'])->name('academic.session.achivement.update');
    Route::get('/academicSession/achivement/status/{id}',[AchivementController::class, 'status'])->name('academic.session.achivement.status');
    Route::get('/academicSession/achivement/delete/{id}',[AchivementController::class, 'delete'])->name('academic.session.achivement.delete');

    //    skillLevel
    Route::get('/skill/level',[SkillLevelController::class, 'index'])->name('skill.level.index');
    Route::get('/skill/level/create',[SkillLevelController::class, 'create'])->name('skill.level.create');
    Route::post('/skill/level/store',[SkillLevelController::class, 'store'])->name('skill.level.store');
    Route::get('/skill/level/detail/{id}',[SkillLevelController::class, 'detail'])->name('skill.level.detail');
    Route::get('/skill/level/edit/{id}',[SkillLevelController::class, 'edit'])->name('skill.level.edit');
    Route::post('/skill/level/update/{id}',[SkillLevelController::class, 'update'])->name('skill.level.update');
    Route::get('/skill/level/status/{id}',[SkillLevelController::class, 'status'])->name('skill.level.status');
    Route::get('/skill/level/delete/{id}',[SkillLevelController::class, 'delete'])->name('skill.level.delete');

    //    Language
    Route::get('/language',[LanguageController::class, 'index'])->name('language.index');
    Route::get('/language/create',[LanguageController::class, 'create'])->name('language.create');
    Route::post('/language/store',[LanguageController::class, 'store'])->name('language.store');
    Route::get('/language/detail/{id}',[LanguageController::class, 'detail'])->name('language.detail');
    Route::get('/language/edit/{id}',[LanguageController::class, 'edit'])->name('language.edit');
    Route::post('/language/update/{id}',[LanguageController::class, 'update'])->name('language.update');
    Route::get('/language/status/{id}',[LanguageController::class, 'status'])->name('language.status');
    Route::get('/language/delete/{id}',[LanguageController::class, 'delete'])->name('language.delete');

    //    event
    Route::get('/backend/event/',[BackendEventController::class, 'index'])->name('event.calendar.index');
    Route::get('/backend/event/create',[BackendEventController::class, 'create'])->name('event.calendar.create');
    Route::post('/backend/event/store',[BackendEventController::class, 'store'])->name('event.calendar.store');
    Route::get('/backend/event/detail/{id}',[BackendEventController::class, 'detail'])->name('event.calendar.detail');
    Route::get('/backend/event/edit/{id}',[BackendEventController::class, 'edit'])->name('event.calendar.edit');
    Route::post('/backend/event/update/{id}',[BackendEventController::class, 'update'])->name('event.calendar.update');
    Route::get('/backend/event/status/{id}',[BackendEventController::class, 'status'])->name('event.calendar.status');
    Route::get('/backend/event/delete/{id}',[BackendEventController::class, 'delete'])->name('event.calendar.delete');

    //    event category
    Route::get('/event/category/',[BackendEventCategoryController::class, 'index'])->name('event.category.index');
    Route::get('/event/category/create',[BackendEventCategoryController::class, 'create'])->name('event.category.create');
    Route::post('/event/category/store',[BackendEventCategoryController::class, 'store'])->name('event.category.store');
    Route::get('/event/category/detail/{id}',[BackendEventCategoryController::class, 'detail'])->name('event.category.detail');
    Route::get('/event/category/edit/{id}',[BackendEventCategoryController::class, 'edit'])->name('event.category.edit');
    Route::post('/event/category/update/{id}',[BackendEventCategoryController::class, 'update'])->name('event.category.update');
    Route::get('/event/category/status/{id}',[BackendEventCategoryController::class, 'status'])->name('event.category.status');
    Route::get('/event/category/delete/{id}',[BackendEventCategoryController::class, 'delete'])->name('event.category.delete');

//    study materials
    Route::get('/study/materials/index', [StudyMaterialsController::class, 'index'])->name('study.material.index');
    Route::get('/study/materials/create', [StudyMaterialsController::class, 'create'])->name('study.material.create');
    Route::get('/study/materials/edit/{id}', [StudyMaterialsController::class, 'edit'])->name('study.material.edit');
    Route::post('/study/materials/store', [StudyMaterialsController::class, 'store'])->name('study.material.store');
    Route::get('/study/materials/detail/{id}',[StudyMaterialsController::class, 'detail'])->name('study.material.detail');
    Route::post('/study/materials/update/{id}',[StudyMaterialsController::class, 'update'])->name('study.material.update');
    Route::get('/study/materials/status/{id}',[StudyMaterialsController::class, 'status'])->name('study.material.status');
    Route::get('/study/materials/delete/{id}',[StudyMaterialsController::class, 'delete'])->name('study.material.delete');


    //    assignment
    Route::controller(AssignmentController::class)->prefix('study/materials/assignment')->name('study.material.assignment.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
    });

    //    LabAccessCredentialController
    Route::controller(LabAccessCredentialController::class)->prefix('lab/access/credential')->name('lab.access.credential.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/status/{id}', 'statusUpdate')->name('status');
        Route::get('/detail/{id}', 'details')->name('detail');
        Route::get('/delete/{id}', 'deleteData')->name('delete');
    });


//    exam system
    Route::get('/exam/system/index',[ExamSystemController::class, 'index'])->name('exam.system.index');
    Route::get('/exam/system/create',[ExamSystemController::class, 'create'])->name('exam.system.create');
    Route::post('/exam/system/store',[ExamSystemController::class, 'store'])->name('exams.store');


    //    EbookController
    Route::controller(EbookController::class)->prefix('backend/ebooks')->name('backend.ebooks.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/status/{id}', 'statusUpdate')->name('status');
        Route::get('/detail/{id}', 'details')->name('detail');
        Route::post('/delete/{id}', 'delete')->name('delete');
    });


    Route::prefix('admin/visitor')->group(function () {
        Route::get('/', [VisitorController::class, 'index'])->name('visitor.index');
        Route::get('/status/{id}', [VisitorController::class, 'changeStatus'])->name('visitor.status');
        Route::get('/details/{id}', [VisitorController::class, 'details'])->name('visitor.details');
        Route::get('/delete/{id}', [VisitorController::class, 'destroy'])->name('visitor.delete');
    });


});






