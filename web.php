<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/welcome',function(){
	return view('welcome');
})->name('welcome');

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/mylogin','LoginController@index')->name('mylogin');

Route::post('/userlogin','LoginController@userLogin')->name('userLogin');

Route::get('default','HomeController@defaultPage')->name('default');

Route::get('/geoAddress',function(){
	return view('myGeoAddress');
});

Route::post('/addPerson','HomeController@create')->name('addPerson');

Route::get('/builtIn',function(){
	return view('builtInGeoLocation');
});



Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');




Route::group(['middleware'=>'auth'],function(){

	Route::get('myMails','MailController@index')->name('myMails');

	Route::get('imageUpload','ImageUploadController@imageUpload')->name('imageUpload');

	Route::post('imageUpload','ImageUploadController@imageUploadPost')->name('imagePost');

	Route::post('getMailData','MailController@getData')->name('getMailData');

	Route::get('404','MailController@pageNotFound')->name('404');

	Route::get('compose','MailController@composeMail')->name('compose');

	Route::post('sendMail','MailController@create')->name('sendMail');

	Route::get('sentMails','MailController@sentMails')->name('sentMails');

	Route::post('/sentMailData','MailController@sentData')->name('sentMailData');

	Route::post('/deleteMailData','MailController@deleteData')->name('deleteMailData');


	/*Route::post('/forgetPassword','ForgetPasswordController@sendMail')->name('forgetPassword');*/

	/*
	*Routes for change password
	*/
	Route::get('/changePassword','HomeController@displayChangePassword')->name('changePassword');

	Route::post('/changePassword','HomeController@changePassword')->name('changePassword');

	/*
	*Route to display my profile
	*/
	Route::get('/profile','HomeController@myProfile')->name('myProfile');

	Route::post('/change/Image','HomeController@changeImage')->name('changeImage');

	

});

Route::group(['middleware' => ['admin','auth']], function () {
    
    /*
	*Route for performing CRUD operation on course
	*/
	Route::get('/display/course','CourseController@index')->name('course');

	Route::post('/editCourse','CourseController@update')->name('editCourse');

	Route::post('/addCourse','CourseController@addCourse')->name('addCourse');

	Route::post('/deleteCourse','CourseController@destroy')->name('/deleteCourse');

	/*
	*Route for performing CRUD operation on department
	*/
	Route::get('/display/department','DepartmentController@index')->name('department');

	Route::post('/editDepartment','DepartmentController@update')->name('editDepartment');

	Route::post('/addDepartment','DepartmentController@store')->name('addDepartment');

	Route::post('/deleteDepartment','DepartmentController@destroy')->name('deleteDepartment');

	/*
	*Route for performing CRUD operation on states
	*/

	Route::get('/display/states','StateController@index')->name('state');

	Route::post('/editState','StateController@update')->name('editState');

	Route::post('/addState','StateController@store')->name('addState');

	Route::post('/deleteState','StateController@destroy')->name('deleteState');	

	/*
	*Route for performing CRUD operation on states
	*/
	Route::get('/displayCity','CityController@index')->name('city');

	Route::post('/editCity','CityController@update')->name('editCity');

	Route::post('/addCity','CityController@store')->name('addCity');

	Route::post('/deleteCity','CityController@destroy')->name('deleteCity');

	Route::get('/getState','StateController@getStateData');

	Route::post('/getCity','CityController@getCityData');

	Route::get('/getUserDetails','UserController@getUser');

	Route::get('/getCourse','CourseController@getCourse');

	Route::get('/getDepartment','DepartmentController@getDepartment');

	/*
	*Route for performing CRUD operation on Student Data
	*/
	Route::get('/studentInfo','StudentController@index')->name('studentInfo');

	Route::post('/addStudentInfo','StudentController@store')->name('addStudentInfo');

	/*
	*Display Student, faculty, and other admin details to Admin
	*/
	Route::get('/smsStudent','StudentController@getStudent')->name('smsStudent');

	Route::get('/smsFaculty','FacultyController@getFaculty')->name('smsFaculty');

	Route::get('/smsAdmin','UserController@getAdmin')->name('smsAdmin');

	Route::post('/getUserInfo','UserController@getUserInfo');

	Route::post('/deleteUserInfo','UserController@deleteUserInfo');

	Route::get('/editStudent/{id}','StudentController@edit');

	Route::post('/updateStudent','StudentController@update')->name('updateStudent');

	Route::get('/editFaculty/{id}','FacultyController@edit');

	Route::post('/updateFaculty','FacultyController@update')->name('updateFaculty');

	/*
	*Update operation performed by Admin
	*/
	Route::get('/editAdmin/{id}','UserController@editAdmin');

	Route::post('/updateAdmin','UserController@updateAdmin')->name('updateAdmin');

	Route::get('/semester','SemesterController@create')->name('semester');

	Route::get('/getCourseForSemester','CourseController@getNotUsedCourse')->name('getCourseForSemester');

	/*
	*CRUD operations for semester by Admin
	*/
	Route::post('/addSemester','SemesterController@store')->name('addSemester');
	
	Route::get('/getDeleteCourseForSemester','CourseController@getUsedCourse')->name('getDeleteCourseForSemester');

	Route::post('/deleteSemester','SemesterController@destroy')->name('deleteSemester');

	/*
	*CRUD operations for subjects by Admin
	*/
	Route::get('/subject','SubjectController@index')->name('subject');

	Route::post('/addSubject','SubjectController@store')->name('addSubject');

	Route::post('/getSubjectForCourse','SubjectController@getSubject');

	Route::post('/getSemester','SemesterController@getSemester');

	Route::post('/deleteSubject','SubjectController@destroy');

	Route::get('/editSubject/{id}','SubjectController@edit');

	Route::post('/update/subject','SubjectController@update')->name('updateSubject');

	/*
	*CRUD operations for marks by Admin
	*/
	Route::get('/marks','MarkController@index')->name('marks');

	Route::get('/getStudent','StudentController@getStudentForMarks');

	Route::post('/getStudentCourse','StudentController@getStudentCourse');

	Route::post('/getCourseSemesterSubject','SubjectController@getSubject');

	Route::post('/addMarks','MarkController@store')->name('addMarks');

	Route::get('/editMarks/{id}','MarkController@edit');

	Route::post('/update/marks','MarkController@update')->name('updateSubject');

	Route::post('/deleteMarks','MarkController@destroy')->name('deleteMarks');
	});

Route::get('import-export-view', 'ExcelController@importExportView')->name('import.export.view');
Route::post('import-file', 'ExcelController@importFile')->name('import.file');
Route::get('export-file/{type}', 'ExcelController@exportFile')->name('export.file');



