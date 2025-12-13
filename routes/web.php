<?php


// use App\Http\Controllers\Api\TourController;

// use App\Http\Controllers\Api\QuestionController;
// use App\Http\Controllers\Auth\AuthController;
// use App\Http\Controllers\Dashboard\DashboardController;
// use App\Http\Controllers\Dashboard\EvaluationController;
// use App\Http\Controllers\Dashboard\SessionController;
// use App\Http\Controllers\Dashboard\SurveyController;
// use App\Http\Controllers\FooController;
//////////////////////

use App\Http\Controllers\site\AuthController;
use App\Http\Controllers\site\CourseController;
use App\Http\Controllers\site\UserController;
use App\Http\Controllers\site\DashboardController;
use App\Http\Controllers\site\LayoutController;
use App\Http\Controllers\site\SessionController;
use App\Http\Controllers\site\KonkorController;


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


//    Route::prefix('/insert')->group(function () {
//                     Route::get('/', [adminController::class, 'insert']);
//                     Route::post('/', [adminController::class, 'insertPost']);
//                 });

//چک
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginpost'])->name('loginpost');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/ref', [AuthController::class, 'ref'])->name('ref');
Route::get('/reg', [AuthController::class, 'reg'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/global', [AuthController::class, 'reg'])->name('global');
Route::post('/survey-answer', [AuthController::class, 'Survey'])->name('survey.answer');

///چک پایان


// Route::group(['namespace' => 'Dashboard'], function () {
//     Route::get('dashboard/actuality', [UserController::class, 'findActuality']);
// });

Route::middleware('auth')->group(function () {
    Route::get('/change', [AuthController::class, 'change'])->name('change');
    Route::group(['namespace' => 'Dashboard'], function () {
        Route::get('/active', [CourseController::class, 'active'])->name('rotbe');
        Route::get('/publics', [CourseController::class, 'publics'])->name('publics');

        Route::group(['prefix' => 'dashboard'], function () {

            Route::group(['prefix' => 'courses'], function () {
                Route::group(['middleware' => ['role:teacher|admin|student']], function () {
                    Route::middleware('cours')->group(function () {
                    });
                    Route::any('/create', [CourseController::class, 'create'])->name('course.create');
                    Route::get('/delete/{id}', [CourseController::class, 'delete'])->name('course.delete');
                    Route::post('/period/{id}', [CourseController::class, 'period'])->name('course.period');
                    Route::get('/private/{id}', [CourseController::class, 'private'])->name('course.private');
                    Route::get('/status/{id}', [CourseController::class, 'status'])->name('course.status');
                    Route::get('/active/{id}', [CourseController::class, 'active'])->name('course.active');
                    Route::get('/pishraft/{id}', [CourseController::class, 'pishraft'])->name('course.pishraft');
                    Route::get('/davari/{id}', [CourseController::class, 'davari'])->name('course.davari');
                    Route::get('/quiz/{id}', [CourseController::class, 'quiz'])->name('course.quiz');
                    Route::get('/faaliat/{id}', [CourseController::class, 'faaliat'])->name('course.faaliat');
                    Route::any('/bank', [QuestionController::class, 'show'])->name('bank');
                    Route::any('/update/{id}', [CourseController::class, 'update'])->name('course.update');
                    Route::any('/setting', [CourseController::class, 'setting'])->name('setting');
                    Route::any('/edit-setting', [CourseController::class, 'editSetting']);
                    Route::any('/edit/{id}', [CourseController::class, 'edit'])->name('course.edit');

                    Route::post('/amali/{id}', [CourseController::class, 'amali'])->name('course.amali');
                });
                ///چک
                Route::get('/list', [CourseController::class, 'list'])->name('course.list');
                Route::get('/arch', [CourseController::class, 'arch'])->name('course.arch');
                Route::get('/arch-post/{id}', [CourseController::class, 'archPost'])->name('course.arch.post');
                Route::get('/students', [CourseController::class, 'students'])->name('course.students');
                Route::get('/destroy-user', [CourseController::class, 'destroyUser'])->name('destroyUser');
                //                    Route::get('/destroy-user/{id}/{cid}', 'CourseController@destroyUser')->name('destroyUser');

                Route::group(['middleware' => ['role:student']], function () {
                    Route::any('/join', [CourseController::class, 'join']);
                });
                Route::group(['prefix' => 'sessions'], function () {
                    Route::get('/', [SessionController::class, 'list'])->name('session.list');
                    Route::group(['middleware' => ['role:teacher']], function () {
                        Route::any('/create', [SessionController::class, 'create'])->name('session.create');
                        Route::get('/delete-item', [SessionController::class, 'deleteItem']);
                        Route::any('/edit/{id}', [SessionController::class, 'edit'])->name('session.edit');
                        Route::any('/active/{id}', [SessionController::class, 'active']);
                        Route::get('/delete/{id}', [SessionController::class, 'delete'])->name('session.delete');
                        Route::get('/prof-ex/{id}', [SessionController::class, 'profEx'])->name('course.profEx');

                    });
                });
            });



            Route::get('/rotbe', [CourseController::class, 'rotbe'])->name('rotbe');

            Route::get('/allprogress', [CourseController::class, 'allProgress']);

            Route::get('/', [DashboardController::class, 'dashboards'])->name('dashboard');
            Route::get('/send', [SurveyController::class, 'sendTest'])->name('test');

            Route::get('/progress', [CourseController::class, 'progress'])->name('progress');
            Route::get('/kholaseha', [CourseController::class, 'kholaseha'])->name('kholaseha');

            // Route::get('/', 'CourseController@list')->name('course.list');
            Route::get('/user/{id}', [UserController::class, 'profile']);
            Route::post('/user/edit/{id}', [UserController::class, 'edit']);

            Route::group(['middleware' => ['role:teacher|admin']], function () {
                Route::get('/students/export', [CourseController::class, 'nomreha']);

                Route::get('/export-survey', [SurveyController::class, 'export']);
                Route::get('/export-students', [SurveyController::class, 'exportStudent']);
                Route::get('/export-survey-teacher', [SurveyController::class, 'exportTeacher']);
            });
            Route::group(['prefix' => 'referee'], function () {
                Route::get('/', [EvaluationController::class, 'refereeList'])->name('referee');
                Route::get('foo', [EvaluationController::class, 'renderJudment'])->name('survay.judment');
                Route::post('foo/{id}', [EvaluationController::class, 'postJudment'])->name('judments.post');
                Route::post('/edit', [EvaluationController::class, 'edit']);
            });

            Route::group(['prefix' => 'survey'], function () {

                Route::group(['middleware' => ['role:teacher|admin|content']], function () {

                    Route::get('/cats', [SurveyController::class, 'catlist'])->name('survey.cat');
                    Route::get('/delcat', [SurveyController::class, 'deleteCat']);
                    Route::post('/cat', [SurveyController::class, 'createCat']);

                    Route::get('/', [SurveyController::class, 'home'])->name('survey.list');
                    Route::post('/create', [SurveyController::class, 'create']);
                    Route::get('/edit/{id}', [SurveyController::class, 'showEdit']);
                    Route::post('/edit/{id}', [SurveyController::class, 'edit']);
                    Route::get('/remove/{id}', [SurveyController::class, 'remove']);
                    Route::get('/active/{id}', [SurveyController::class, 'active']);
                });
            });

            Route::group(['prefix' => 'tour'], function () {
                Route::get('/', [TourController::class, 'list']);
                Route::get('/davaran/{id}', [TourController::class, 'davaran']);
                Route::get('/davari/{id}', [TourController::class, 'davari']);
                Route::get('/create', [TourController::class, 'create']);
                Route::post('/create', [TourController::class, 'createPost']);
                Route::post('/davar/add/{id} ', [TourController::class, 'davar']);
                Route::get('/score/{id}', [TourController::class, 'score']);
                Route::post('/score/{id}', [TourController::class, 'scorePost']);
            });
            Route::group(['prefix' => 'discussion'], function () {
                Route::get('/create/{id}', 'DiscussionController@show')->name('disc.show');
                Route::post('/create', 'DiscussionController@create');
                Route::post('/scoring', 'DiscussionController@scoring');
            });
            Route::group(['prefix' => 'question'], function () {
                Route::get('/show', 'QuestionController@show')->name('question.show');
                Route::post('/create', 'QuestionController@create');
                Route::any('/edit/{id?}', 'QuestionController@edit')->name('editQ');
                Route::any('/delete/{id?}', 'QuestionController@delete')->name('deleteQ');
                Route::group(['middleware' => ['role:teacher|student']], function () {
                    Route::post('/scoring', 'QuestionController@scoring');
                });
                Route::group(['middleware' => ['role:teacher']], function () {
                    Route::any('/star/{id?}', 'QuestionController@star')->name('star');
                });
            });
            Route::group(['prefix' => 'exercise'], function () {
                Route::get('/show/{session_id}', 'ExerciseController@show')->name('exercise.show');
                Route::post('/create', 'ExerciseController@create')->name('exercise.create');
                Route::get('/edit', 'ExerciseController@edit')->name('exercise.edit');
                Route::get('/delete', 'ExerciseController@delete')->name('exercise.delete');
                Route::post('/edit', 'ExerciseController@reedit')->name('exercise.reedit');
                Route::group(['middleware' => ['role:teacher']], function () {
                    Route::post('/scoring', 'ExerciseController@scoring');
                });

                //                Route::group(['middleware' => ['role:teacher']], function () {

                Route::post('/answer', 'ExerciseController@answer')->name('exercise.answer');
                Route::post('/answer-edit', 'ExerciseController@answerEdit')->name('exercise.answerEdit');

                //                });

            });

            Route::group(['prefix' => 'quiz'], function () {
                Route::group(['middleware' => ['role:student']], function () {
                    Route::get('/', 'QuizController@quiz');
                    Route::post('/question', 'QuizController@question')->name('quiz');
                });
                Route::get('/list', 'QuizController@list')->name('quiz.list');
                Route::get('/view', 'QuizController@view')->name('quiz.view');
            });


            Route::group(['prefix' => 'user', 'middleware' => ['role:admin']], function () {
                Route::get('/', 'UserController@list')->name('users.list');
                Route::get('/remove/{id}', 'UserController@remove');
            });

            Route::group(['prefix' => 'angizeshi', 'middleware' => ['role:admin']], function () {
                Route::get('/', 'DashboardController@angizeshList')->name('angizesh');
                Route::post('/', 'DashboardController@angizeshPost')->name('angizesh.post');
                Route::get('/delete', 'DashboardController@angizeshDelete')->name('');
                Route::post('/edit', 'DashboardController@angizeshEditPost')->name('');
                Route::get('/edit', 'DashboardController@angizeshEdit')->name('');
            });
            Route::group(['prefix' => 'evaluation'], function () {
                Route::get('/', 'EvaluationController@list')->name('eva');
                Route::post('/edit', 'EvaluationController@edit');
            });

            //                chat
            Route::get('/chat', 'ChatController@chats')->name('chats');
            Route::post('/chat', 'ChatController@chat')->name('chat');
            Route::group(['prefix' => 'azmon'], function () {
                Route::get('/', 'AzmonController@list');
                Route::get('/create', 'AzmonController@create');
                Route::post('/create', 'AzmonController@createPost');
                Route::get('/edit', 'AzmonController@edit');
                Route::post('/edit/{id}', 'AzmonController@editPost');
                Route::get('/delete/{id}', 'AzmonController@delete');
                Route::get('/azmon', 'AzmonController@azmon');
            });

            Route::get('/barom', 'DashboardController@barom')->name('baroms');
           
            Route::get('/faq', 'DashboardController@faq');
            Route::get('/konkor', 'KonkorController@konkor');
            Route::post('/konkor', 'KonkorController@konkorAdd');
            Route::get('/konkor/coworker', 'KonkorController@coworker');
            Route::get('/konkor/students', 'KonkorController@students');
            Route::post('/konkor/coworker/{id}', 'KonkorController@coworkerAdd');
            Route::get('/konkor/coworker-delete/{id}/{user}', 'KonkorController@coworkerDelete');
            Route::get('/konkor/question', 'KonkorController@question');
            Route::post('/konkor/question', 'KonkorController@questionAdd');
            Route::get('/konkor/myquestion', 'KonkorController@questionMy');
            Route::get('/konkor/final-questions', 'KonkorController@questionFinal');
            Route::get('/konkor/refree', 'KonkorController@refree');
            Route::get('/konkor/accept', 'KonkorController@accept');
            Route::get('/konkor/decline', 'KonkorController@decline');
            Route::get('/konkor/active', 'KonkorController@active');

            Route::get('/konkor/list',[App\Http\Controllers\site\KonkorController::class ,'konkors'])->name('konkors');
            Route::get('/konkor/enter',[App\Http\Controllers\site\KonkorController::class , 'enter'])->name('enter');

            Route::get('/konkor/question/delete/{id}', 'KonkorController@questionDelete');
            Route::get('/konkor/question/edit/{id}', 'KonkorController@questionEditGet');
            Route::post('/konkor/question/edit/{id}', 'KonkorController@questionEditPost');
            
            Route::get('/konkor/box5', 'KonkorController@box5')->name('box5');
            Route::post('/konkor/answer/{id}', 'KonkorController@answer')->name('konkor.answer');
            Route::post('/konkor/upload/{id}', 'KonkorController@upload')->name('konkor.upload');
            Route::get('/konkor/delete', 'KonkorController@delete');
            Route::get('/user-content', 'KonkorController@users');

        });
    });

    Route::group(['prefix' => 'shop', 'namespace' => 'Dashboard'], function () {
        Route::get('/', 'ShopController@view')->name('shop.list');
        Route::get('/buy', 'ShopController@buy')->name('shop.buy');
        Route::get('/shop-details/{shopId}', 'ShopController@getShopDetails')->name('shop.details');
    });

    Route::group(['prefix' => 'order', 'namespace' => 'Dashboard'], function () {
        Route::post('/', 'OrderController@createOrder')->name('order.create');
        Route::get('/', 'OrderController@orderList')->name('order.list');
        Route::get('/{orderId}', 'OrderController@view')->name('order.details')->middleware('shop');
        Route::post('/{orderId}/pay-request', 'OrderController@payRequest')->name('order.payRequest')->middleware('shop');
        Route::get('/{orderId}/cancel', 'OrderController@cancelOrder')->name('order.cancel')->middleware('shop');
        Route::get('/pay/{paymentId}/commit', 'OrderController@payCommit')->name('payment.commit')->middleware('shop');
    });

});

