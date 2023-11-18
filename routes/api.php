<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\AssessmentController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\UserAppointmentsController;
use App\Http\Controllers\Api\AssessmentQuestionsController;
use App\Http\Controllers\Api\PatientAppointmentsController;
use App\Http\Controllers\Api\QuestionAssessmentsController;

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

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('appointments', AppointmentController::class);

        Route::apiResource('assessments', AssessmentController::class);

        // Assessment Questions
        Route::get('/assessments/{assessment}/questions', [
            AssessmentQuestionsController::class,
            'index',
        ])->name('assessments.questions.index');
        Route::post('/assessments/{assessment}/questions/{question}', [
            AssessmentQuestionsController::class,
            'store',
        ])->name('assessments.questions.store');
        Route::delete('/assessments/{assessment}/questions/{question}', [
            AssessmentQuestionsController::class,
            'destroy',
        ])->name('assessments.questions.destroy');

        Route::apiResource('patients', PatientController::class);

        // Patient Appointments
        Route::get('/patients/{patient}/appointments', [
            PatientAppointmentsController::class,
            'index',
        ])->name('patients.appointments.index');
        Route::post('/patients/{patient}/appointments', [
            PatientAppointmentsController::class,
            'store',
        ])->name('patients.appointments.store');

        Route::apiResource('questions', QuestionController::class);

        // Question Assessments
        Route::get('/questions/{question}/assessments', [
            QuestionAssessmentsController::class,
            'index',
        ])->name('questions.assessments.index');
        Route::post('/questions/{question}/assessments/{assessment}', [
            QuestionAssessmentsController::class,
            'store',
        ])->name('questions.assessments.store');
        Route::delete('/questions/{question}/assessments/{assessment}', [
            QuestionAssessmentsController::class,
            'destroy',
        ])->name('questions.assessments.destroy');

        Route::apiResource('users', UserController::class);

        // User Appointments
        Route::get('/users/{user}/appointments', [
            UserAppointmentsController::class,
            'index',
        ])->name('users.appointments.index');
        Route::post('/users/{user}/appointments', [
            UserAppointmentsController::class,
            'store',
        ])->name('users.appointments.store');
    });
