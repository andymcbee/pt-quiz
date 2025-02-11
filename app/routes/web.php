<?php

use App\Http\Controllers\ProfileController;
use App\Models\Element;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Start');
});

Route::get('/play', function (Request $request) {

    //dd($request);

    $limit = $request->query('number', 10);

    $elements = Element::orderBy(DB::raw('RAND()'))->take($limit)->get();

    // create game item and return the id

    $gameId = DB::table('games')->insertGetId(
        [
            'questionCount' => $limit,
        ]
    );

    foreach ($elements as $element) {

        DB::table('questions')->insert([
            'game_id' => $gameId,
            'element_id' => $element->id,

        ]);

    }

    // get questions with respective elements

    $questions = Question::where('game_id', $gameId)->with('element')->get();
    // dd($questions[0]->element);

    return Inertia::render('Play',
        [
            'questions' => $questions,
        ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
