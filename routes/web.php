<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'IndexController@index')->name('index.index');
Route::get('/terms-and-conditions', 'IndexController@termsAndConditions')->name('index.terms-and-conditions');
Route::get('/privacy-policy', 'IndexController@privacyPolicy')->name('index.privacy-policy');
Route::get('/refund-policy', 'IndexController@refundPolicy')->name('index.refund-policy');

// Clear Route
Route::get('/clear', ['as'=>'clear','uses'=>'IndexController@clear']);

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

Route::get('/dashboard/packages', 'DashboardController@getPackages')->name('dashboard.packages');
Route::post('/dashboard/packages/store', 'DashboardController@storePackage')->name('dashboard.packages.store');
Route::post('/dashboard/packages/{id}/update', 'DashboardController@updatePackage')->name('dashboard.packages.update');

Route::get('/dashboard/users', 'DashboardController@getUsers')->name('dashboard.users');
Route::get('/dashboard/users/{id}/single', 'DashboardController@getUser')->name('dashboard.users.single');
Route::get('/dashboard/users/{id}/single/otherpage', 'DashboardController@getUserWithOtherPage')->name('dashboard.users.singleother');
Route::post('/dashboard/users/store', 'DashboardController@storeUser')->name('dashboard.users.store');
Route::post('/dashboard/users/{id}/update', 'DashboardController@updateUser')->name('dashboard.users.update');
Route::get('/dashboard/users/{id}/delete', 'DashboardController@deleteUser')->name('dashboard.users.delete');

Route::get('/dashboard/questions', 'QuestionController@getQuestions')->name('dashboard.questions');
Route::post('/dashboard/questions/store', 'QuestionController@storeQuestion')->name('dashboard.questions.store');
Route::post('/dashboard/questions/{id}/update', 'QuestionController@updateQuestion')->name('dashboard.questions.update');
Route::get('/dashboard/questions/{id}/delete', 'QuestionController@deleteQuestion')->name('dashboard.questions.delete');

Route::post('/dashboard/questions/topic/store', 'QuestionController@storeQuestionsTopic')->name('dashboard.questions.topic.store');
Route::post('/dashboard/questions/topic/{id}/update', 'QuestionController@updateQuestionsTopic')->name('dashboard.questions.topic.update');
Route::get('/dashboard/questions/topic/{id}/delete', 'QuestionController@deleteQuestionsTopic')->name('dashboard.questions.topic.delete');

Route::post('/dashboard/questions/tag/store', 'QuestionController@storeQuestionsTag')->name('dashboard.questions.tag.store');
Route::post('/dashboard/questions/tag/{id}/update', 'QuestionController@updateQuestionsTag')->name('dashboard.questions.tag.update');
Route::get('/dashboard/questions/tag/{id}/delete', 'QuestionController@deleteQuestionsTag')->name('dashboard.questions.tag.delete');

Route::get('/dashboard/exams', 'ExamController@getExams')->name('dashboard.exams');
Route::post('/dashboard/exams/store', 'ExamController@storeExam')->name('dashboard.exams.store');
Route::post('/dashboard/exams/{id}/update', 'ExamController@updateExam')->name('dashboard.exams.update');
Route::post('/dashboard/exams/{id}/copy', 'ExamController@copyExam')->name('dashboard.exams.copy');
Route::get('/dashboard/exams/{id}/delete', 'ExamController@deleteExam')->name('dashboard.exams.delete');
Route::get('/dashboard/exams/add/question/{id}', 'ExamController@addQuestionToExam')->name('dashboard.exams.add.question');
Route::post('/dashboard/exams/add/question/store', 'ExamController@storeExamQuestion')->name('dashboard.exams.question.store');
Route::post('/dashboard/exams/add/question/automatic', 'ExamController@automaticeExamQuestionSet')->name('dashboard.exams.question.auto');

Route::post('/dashboard/exams/category/store', 'ExamController@storeExamCategory')->name('dashboard.exams.category.store');
Route::post('/dashboard/exams/category/{id}/update', 'ExamController@updateExamCategory')->name('dashboard.exams.category.update');
Route::get('/dashboard/exams/category/{id}/delete', 'ExamController@deleteExamCategory')->name('dashboard.exams.category.delete');

Route::get('/dashboard/courses', 'CourseController@getCourses')->name('dashboard.courses');
Route::post('/dashboard/courses/store', 'CourseController@storeCourse')->name('dashboard.courses.store');
Route::post('/dashboard/courses/{id}/update', 'CourseController@updateCourse')->name('dashboard.courses.update');
Route::get('/dashboard/courses/{id}/delete', 'CourseController@deleteCourse')->name('dashboard.courses.delete');
Route::get('/dashboard/courses/add/exam/{id}', 'CourseController@addExamToCourse')->name('dashboard.courses.add.exam');
Route::post('/dashboard/courses/add/exam/store', 'CourseController@storeCourseExam')->name('dashboard.courses.exam.store');

// Route::get('/dashboard/balance', 'DashboardController@getBalance')->name('dashboard.balance');
// Route::post('/dashboard/balance/store', 'DashboardController@storeBalance')->name('dashboard.balance.store');
// Route::get('/dashboard/balance/{id}/delete', 'DashboardController@deleteBalance')->name('dashboard.balance.delete');

Route::get('/dashboard/sites', 'DashboardController@getSites')->name('dashboard.sites');
Route::post('/dashboard/sites/store', 'DashboardController@storeSite')->name('dashboard.sites.store');
Route::post('/dashboard/sites/{id}/update', 'DashboardController@updateSite')->name('dashboard.sites.update');
Route::delete('/dashboard/sites/{id}/delete', 'DashboardController@deleteSite')->name('dashboard.sites.delete');

Route::get('/dashboard/sites/{id}', 'DashboardController@getSingleSite')->name('dashboard.sites.single');
Route::get('/dashboard/sites/{id}/categorywise', 'DashboardController@getSiteCategorywise')->name('dashboard.sites.categorywise');
Route::get('/dashboard/expense', 'DashboardController@getExpensePage')->name('dashboard.expense.index');
Route::post('/dashboard/expense/store', 'DashboardController@storeExpense')->name('dashboard.expense.store');
Route::get('/dashboard/expense/{id}/delete', 'DashboardController@deleteExpense')->name('dashboard.expense.delete');

Route::get('/dashboard/categories', 'DashboardController@getCategories')->name('dashboard.categories');
Route::get('/dashboard/categories/{id}', 'DashboardController@getSingleCategory')->name('dashboard.categories.single');
Route::get('/dashboard/categories/{id}/{selecteddate}', 'DashboardController@getSingleCategoryDate')->name('dashboard.categories.singledate');
Route::get('/dashboard/categories/{id}/{selecteddate}/{site_id}', 'DashboardController@getSingleCategoryDateSite')->name('dashboard.categories.singledatesite');
Route::post('/dashboard/categories/store', 'DashboardController@storeCategory')->name('dashboard.categories.store');
Route::post('/dashboard/categories/{id}/update', 'DashboardController@updateCategory')->name('dashboard.categories.update');

Route::get('/dashboard/monthly', 'DashboardController@getMonthly')->name('dashboard.monthly');

Route::get('/dashboard/creditors', 'DashboardController@getCreditors')->name('dashboard.creditors');
Route::get('/dashboard/creditors/{id}', 'DashboardController@getSingleCreditor')->name('dashboard.creditors.single');
Route::post('/dashboard/creditors/store', 'DashboardController@storeCreditor')->name('dashboard.creditors.store');
Route::post('/dashboard/creditors/{id}/update', 'DashboardController@updateCreditor')->name('dashboard.creditors.update');
Route::get('/dashboard/creditors/add/due', 'DashboardController@getAddDuePage')->name('dashboard.addduepage');
Route::post('/dashboard/creditors/due/store', 'DashboardController@storeCreditorDue')->name('dashboard.creditorsdue.store');
Route::post('/dashboard/creditors/due/{id}/update', 'DashboardController@updateCreditorDue')->name('dashboard.creditorsdue.update');
Route::get('/dashboard/creditors/due/{id}/delete', 'DashboardController@deleteCreditorDue')->name('dashboard.creditorsdue.delete');


Route::get('/dashboard/expenses/{transactiondate}/{user}', 'ExpenseController@getTodaysExpenseList')->name('dashboard.expenses.getlist');
Route::get('/dashboard/deposit/{transactiondate}/{user}', 'ExpenseController@getTodaysDepositList')->name('dashboard.deposit.getlist');

// COMPONENTS
Route::get('/dashboard/components', 'DashboardController@getComponents')->name('dashboard.components');