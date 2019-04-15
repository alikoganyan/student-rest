<?php

use Illuminate\Http\Request;
use OpenApi\Annotations\OpenApi as OA;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="L5 OpenApi",
 *      description="L5 Swagger OpenApi description",
 *      @OA\Contact(
 *          email="darius@matulionis.lt"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 */
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('faculties')->group(function () {
    Route::get('/', 'FacultyController@index'); // get all
    Route::post('/', 'FacultyController@create'); // create faculty
    Route::get('/{id}', 'FacultyController@show'); // update page of faculty
    Route::put('/{id}', 'FacultyController@update'); // update faculty
    Route::delete('/{id}','FacultyController@destroy'); // delete faculty
    Route::get('/{id}/groups','FacultyController@getGroups'); // get groups of faculty
});

Route::prefix('groups')->group(function () {
    Route::get('/', 'GroupController@index'); // get all group
    Route::post('/', 'GroupController@create'); // create group
    Route::get('/{id}', 'GroupController@show'); // update page of group
    Route::put('/{id}', 'GroupController@update'); // update group
    Route::delete('/{id}','GroupController@destroy'); // delete group
});

Route::prefix('students')->group(function () {
    Route::get('/', 'StudentController@index'); // get all students
    Route::post('/', 'StudentController@create'); // create student
    Route::get('/{id}', 'StudentController@show'); // update page of student
    Route::put('/{id}', 'StudentController@update'); // update student
    Route::delete('/{id}','StudentController@destroy'); // delete student
});


