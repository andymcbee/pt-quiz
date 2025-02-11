<?php

use App\Models\Question;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/questions/update-response', function (Request $request) {
    //dd($request->all());
    // return response()->json(['message' => 'Success', 'status' => true]);
    // validate the response
    // question_id must be a number
    // status must be correct or incorrect
    // user_res must be not null

    try {


        $validated = $request->validate([
            'question_id' => 'required|numeric',
            'status' => 'required|string|in:correct,incorrect',
            'user_response' => 'string|required'
        ]);

        $question = Question::findOrFail($validated['question_id']);

        $question->update([
            'status' => $validated['status'],
            'user_response' => $validated['user_response']
        ]);

        return response()->json([
            'message' => 'Question updated successfully',
            'data' => $question
        ]);
    } catch (ValidationException $e) {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $e->errors()
        ], 422);
    } catch (ModelNotFoundException $e) {
        return response()->json([
            'message' => 'Question not found'
        ], 404);
    } catch (Exception $e) {
        // log error for debugging
        Log::error('Update Error: '.$e->getMessage());
        return response()->json([
            'message' => 'An unexpected error occurred',
            'error' => $e->getMessage()
        ], 500);
    }


});

