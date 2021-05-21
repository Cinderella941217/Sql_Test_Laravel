<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Department;
use App\Models\Query;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
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

Route::get('/{id?}', function ($id = null) {
    $departments = Department::all();
    if(!$id) {
        $de = Department::first();
        if($de) $id = $de->id;
    }
    if($id) {
        $queries = Query::where('department', $id)->get();
    } else {
        $queries = array();
    }
    return view('welcome', compact('departments', 'id', 'queries'));
})->where('id', '[0-9]+');;
Route::get('/manageSchedule', function(){
    return redirect('/');
});
Route::post('/manageSchedule', function(Request $request){
    $email = $request->email;
    $schedules = Schedule::where('email', $request->email)->get();
    $departments = Department::all();
    return view('schedule', compact('schedules', 'email', 'departments'));
});
Route::post('/addNewSche', function(Request $request){
    $lastQuery = Query::find($request->queryId)->query;
    if (isset($request->keys)) {
        $promKeys = $request->keys;
        $promValues = $request->values;

        foreach($promKeys as $key => $promKey){
            // $rlt = preg_match_all('/set[^;]*' . $promKey .  '[ ]*=[ ]*[\'\"](.*?)[\'\"][^;]*;/i', $lastQuery, $matches);
            // dd($matches);
            $lastQuery = preg_replace('/(set[^;]*' . $promKey .  '[ ]*=[ ]*[\'\"])(.*?)([\'\"][^;]*;)/i', '${1}' . $promValues[$key] . '${3}', $lastQuery);
            // $lastQuery = str_replace($promKey, "'" . $promValues[$key] . "'", $lastQuery);
        }
    }
    // $request->query = $lastQuery;
    // Schedule::create(array(
    //     'email' => $request->email,
    //     'query' => $lastQuery,
    //     'subject' => $request->subject,
    //     'time' => $request->time,
    //     'reoccurring' => $request->reoccurring
    // ));
    DB::insert('insert into schedules (email, query, subject, time, reoccurring) values (?, ?, ?, ?, ?)', [$request->email, $lastQuery, $request->subject, $request->time, $request->reoccurring]);
    return redirect('/');
});
Route::get('/deleteSchedule/{id?}', function($id){
    Schedule::destroy($id);
    return redirect('/');
});

Route::post('/run', function(Request $request) {
    $lastQuery = Query::find($request->id)->query;

    if (isset($request->key)) {
        $promKeys = $request->key;
        $promValues = $request->value;


        foreach($promKeys as $key => $promKey){
            // $rlt = preg_match_all('/set[^;]*' . $promKey .  '[ ]*=[ ]*[\'\"](.*?)[\'\"][^;]*;/i', $lastQuery, $matches);
            // dd($matches);
            $lastQuery = preg_replace('/(set[^;]*' . $promKey .  '[ ]*=[ ]*[\'\"])(.*?)([\'\"][^;]*;)/i', '${1}' . $promValues[$key] . '${3}', $lastQuery);
            // $lastQuery = str_replace($promKey, "'" . $promValues[$key] . "'", $lastQuery);
        }
    }
    $conn = mysqli_connect(env('DB_HOST', 'localhost'), env('DB_USERNAME', 'forge'), env('DB_PASSWORD', ''), env('DB_DATABASE_SECOND', 'forge'));
    if($conn->connect_error){
        die('Error occured');
    }
    if ($conn->multi_query($lastQuery)) {
        do {
            $result = $conn->store_result();
        } while ($conn->next_result());
    }
    // $result = $conn->query($lastQuery);
    $rlt = [];
    if($result->num_rows){
        while($row = $result->fetch_assoc()) {
            array_push($rlt, $row);
        }
    }
    return $rlt;
});
Route::get('/runQuery/{id}', function($id){
    $query = Query::find($id);
    return view('client', compact('query'));
});
Route::post('/getQuery', function(Request $request){
    $queries = Query::where('department', $request->id)->get();
    return $queries;
});
Route::get('/department', function () {
    $departments = Department::all();
    return view('department', compact('departments'));
})->middleware(['auth'])->name('department');
Route::get('/query', function () {
    $queries = Query::all();
    $departments = Department::all();
    return view('query', compact('queries', 'departments'));
})->middleware(['auth'])->name('query');
Route::post('/department/add', function(Request $request){
    if($request->id){
        Department::find($request->id)->update($request->input());
    } else {
        Department::create($request->input());
    }
    return redirect('/department');
});
Route::get('/department/delete/{id}', function(Request $request, $id){
    Department::destroy($id);
    return redirect('/department');
});
Route::post('/query/add', function(Request $request){
    if($request->id){
        Query::find($request->id)->update($request->input());
    } else {
        Query::create($request->input());
    }
    return redirect('/query');
});
Route::get('/query/delete/{id}', function(Request $request, $id){
    Query::destroy($id);
    return redirect('/query');
});
Route::post('/exportExcel', function(Request $request) {
    $reqData = (array) json_decode($request->exportValue);
    $data = array();
    foreach ($reqData as $value) {
        array_push($data, (array) $value);
    }
    function cleanData(&$str) {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }
    // file name for download
    $filename = "website_data_" . date('Ymd') . ".xls";

    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Content-Type: application/vnd.ms-excel");

    $flag = false;
    foreach($data as $row) {
        if(!$flag) {
            // display field/column names as first row
            echo implode("\t", array_keys($row)) . "\n";
            $flag = true;
        }
        array_walk($row, __NAMESPACE__ . '\cleanData');
        echo implode("\t", array_values($row)) . "\n";
    }
    exit;
});

require __DIR__.'/auth.php';
