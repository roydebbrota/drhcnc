<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\CompusController;
use App\Http\Controllers\EligibilityController;
use App\Http\Controllers\EducationSummaryController;
use App\Http\Controllers\JobSummaryController;
use App\Http\Controllers\CatagoryController;
use App\Http\Controllers\SubCatagoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('/', [App\Http\Controllers\Frontend\IndexController::class, 'index'])->name('home');

Route::get('/get-district/{division_id}', [App\Http\Controllers\Frontend\IndexController::class, 'getDistrict']);
Route::get('/get-upazila/{district_id}', [App\Http\Controllers\Frontend\IndexController::class, 'getUpazila']);


Route::middleware(['superAdmin'])->group(function () {
    Route::get('/admin-dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/student-add', [StudentController::class, 'studentAdd'])->name('student.add');
    Route::post('/student-save', [StudentController::class, 'registerStudent'])->name('student.save');
    Route::get('/student-all', [StudentController::class, 'allStudent'])->name('student.all');
    Route::get('/student-edit/{slug}', [StudentController::class,'editStudent'])->name('student.edit');
    Route::post('/general-details-report', [ReportController::class,'generalDetailsReport'])->name('general.details.report');
    //account user
    Route::get('/user-create', [AccountController::class,'userCreate'])->name('user.create');
    Route::post('/user-save', [AccountController::class,'usersave'])->name('user.save');

//institute
    Route::get('/institute-add', [InstituteController::class, 'instituteAdd'])->name('institute.add');
    Route::post('/institute-save', [InstituteController::class, 'instituteSave'])->name('institute.information.save');
    Route::get('/institute-all', [InstituteController::class, 'allInstitute'])->name('institute.all');
    Route::get('/institute-all-table', [InstituteController::class,'allInstituteTable'])->name('all.institute.table');
    Route::get('/edit-institute-info/{institute_id}', [InstituteController::class, 'editInstitute'])->name('edit.institute.info');
    Route::post('/edit-institute-info-update', [InstituteController::class, 'updateInstitute'])->name('institute.information.update');

    //Campuses
    Route::get('/campus-add', [CompusController::class, 'campusAdd'])->name('campus.add');
    Route::post('/campus-save', [CompusController::class, 'campusSave'])->name('campus.information.save');
    Route::get('/campus-all', [CompusController::class, 'allCampus'])->name('campus.all');
    Route::get('/campus-all-table', [CompusController::class,'allCampusTable'])->name('all.campus.table');
    Route::get('/edit-campus-info/{campus_id}', [CompusController::class, 'editCampusInfo'])->name('edit.campus.info');
    Route::post('/update-campus-info', [CompusController::class, 'updateCampusInfo'])->name('campus.information.update');


    //Eligibilities
    Route::get('/eligibility-add', [EligibilityController::class, 'eligibilityAdd'])->name('eligibility.add');
    Route::post('/eligibility-save', [EligibilityController::class, 'eligibilitySave'])->name('eligibility.information.save');
    Route::get('/eligibility-all', [EligibilityController::class, 'allEligibility'])->name('eligibility.all');
    Route::get('/eligibility-all-table', [EligibilityController::class,'allEligibilityTable'])->name('all.eligibility.table');
    Route::get('/edit-eligibility-info/{eligibility_id}', [EligibilityController::class, 'editEligibilityInfo'])->name('edit.eligibility.info');
    Route::post('/eligibility-update', [EligibilityController::class, 'eligibilityUpdate'])->name('eligibility.information.update');

    //Category
    Route::get('/category-add', [CatagoryController::class, 'catagoryAdd'])->name('catagory.add');
    Route::post('/category-save', [CatagoryController::class, 'catagorySave'])->name('catagory.save');
    Route::get('/category-all', [CatagoryController::class, 'allCatagory'])->name('catagory.all');
    Route::get('/category-all-table', [CatagoryController::class,'allCatagoryTable'])->name('all.catagory.table');
    Route::get('/category-info-edit/{id}', [CatagoryController::class, 'editCatagoryInfo'])->name('edit.catagory.info');
    Route::post('/category-update', [CatagoryController::class, 'catagoryUpdate'])->name('catagory.information.update');

    //Sub Category
    Route::get('/category-sub-add', [SubCatagoryController::class, 'subCatagoryAdd'])->name('sub.catagory.add');
    Route::post('/category-sub-save', [SubCatagoryController::class, 'subCatagorySave'])->name('sub.catagory.save');
    Route::get('/category-sub-all', [SubCatagoryController::class, 'allSubCatagory'])->name('sub.catagory.all');
    Route::get('/category-sub-all-table', [SubCatagoryController::class,'allSubCatagoryTable'])->name('all.sub.catagory.table');
    Route::get('/category-sub-info-edit/{id}', [SubCatagoryController::class, 'editSubCatagoryInfo'])->name('edit.sub.catagory.info');
    Route::post('/category-sub-update', [SubCatagoryController::class, 'subCatagoryUpdate'])->name('sub.catagory.information.update');

    //Courses
Route::get('/course-type-add', [CourseController::class, 'courseTypeAdd'])->name('course.type.add');
Route::post('/course-type-save', [CourseController::class, 'courseTypeSave'])->name('course.type.save');
Route::post('/course-type-update', [CourseController::class, 'courseTypeUpdate'])->name('course.type.update');
Route::get('/course-add', [CourseController::class, 'courseAdd'])->name('course.add');
Route::post('/course-information-save', [CourseController::class, 'courseInformationSave'])->name('course.information.save');
Route::get('/course-all', [CourseController::class, 'allCourse'])->name('course.all');
Route::get('/course-all-table', [CourseController::class,'courseAllTable'])->name('all.course.table');
Route::get('/get-category/{cat_id}', [CourseController::class, 'getCategory']);
Route::get('/get-campus/{institute_id}', [CourseController::class, 'getCampus']);



    Route::get('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'resetPasswordPage'])->name('password.change');
    Route::post('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'changePassword'])->name('password.change');

});


Route::group(['middleware' => ['account']], function () {

    //account

});

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/account-dashboard', [AccountController::class, 'dashboard'])->name('account.dashboard');
    Route::get('/account-all-student', [AccountController::class, 'accountAllStudent'])->name('account.all.student');
    Route::get('/reports', [ReportController::class,'reportAllStudent'])->name('reports');
    Route::post('/date-wise-reports', [ReportController::class,'monthWisePaymentReport'])->name('date.wise.payment.reports');
    Route::get('/student-all-table-report', [ReportController::class,'allStudentTableReport'])->name('all.student.table.report');


    Route::get('/individual-student-report/{id}', [ReportController::class,'IndividualStudentReport'])->name('individual.student.report');
    Route::get('/individual-student-payment-report/{id}', [ReportController::class,'IndividualStudentPaymentReport'])->name('individual.student.payment.report');

        Route::get('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'resetPasswordPage'])->name('password.change');
        Route::post('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'changePassword'])->name('password.change');
        Route::get('/student-fees/{slug}', [StudentController::class,'uploadStudentFee'])->name('upload.student.fee');
        Route::post('/fees-update', [StudentController::class,'updateStudentFee']);
        Route::post('/student-fee', [StudentController::class,'collectStudentFee'])->name('collect.fee');
        Route::get('/student-dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
        Route::get('/registration-complited', [StudentController::class, 'afterCompleted'])->name('register.completed');
        Route::post('/student-information-save', [StudentController::class, 'studentInformationSave'])->name('student.information.save');
        Route::get('/student-info', [StudentController::class, 'studentInfo'])->name('student.info');
        Route::get('/student-file', [StudentController::class, 'studentFile'])->name('student.file');
        Route::post('/upload-document', [StudentController::class, 'uploadDocument'])->name('upload.document');
        Route::get('/upload-student-document/{slug}', [StudentController::class, 'uploadStudentDocument'])->name('upload.student.document');
        Route::post('/update-document', [StudentController::class, 'updateDocument'])->name('update.document');
        Route::post('/upload-student-image', [StudentController::class, 'uploadStudentImage'])->name('upload.student.image');
        Route::get('/profile-edit', [StudentController::class, 'studentProfileEdit'])->name('profile.edit');
        Route::post('/student-update', [StudentController::class,'updateStudent'])->name('student.update');
        Route::get('/student-all-table', [StudentController::class,'allStudentTable'])->name('all.student.table');


        //Eduction Summary
        Route::get('/education-summary-add', [EducationSummaryController::class, 'educationSummaryAdd'])->name('education.summary.add');
        Route::post('/education-summary-save', [EducationSummaryController::class, 'educationSummarySave'])->name('education.summary.save');
        //Job Summary
        Route::get('/student-job-summary-add', [JobSummaryController::class, 'jobSummaryAdd'])->name('student.job.summary');
        Route::post('/job-summary-save', [JobSummaryController::class, 'jobSummarySave'])->name('job.summary.save');
        Route::post('/job-document-add', [JobSummaryController::class, 'uploadDocument'])->name('job.document.add');
        Route::post('/job-document-update', [JobSummaryController::class, 'updateDocument'])->name('job.document.update');
    });
