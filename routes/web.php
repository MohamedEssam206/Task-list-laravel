<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//class Task
//{
//    public function __construct(
//        public int $id,
//        public string $title,
//        public string $description,
//        public ?string $long_description,
//        public bool $completed,
//        public string $created_at,
//        public string $updated_at
//    ) {
//    }
//}
//
//$tasks = [
//    new Task(
//        1,
//        'Buy groceries',
//        'Task 1 description',
//        'Task 1 long description',
//        false,
//        '2023-03-01 12:00:00',
//        '2023-03-01 12:00:00'
//    ),
//    new Task(
//        2,
//        'Sell old stuff',
//        'Task 2 description',
//        null,
//        false,
//        '2023-03-02 12:00:00',
//        '2023-03-02 12:00:00'
//    ),
//    new Task(
//        3,
//        'Learn programming',
//        'Task 3 description',
//        'Task 3 long description',
//        true,
//        '2023-03-03 12:00:00',
//        '2023-03-03 12:00:00'
//    ),
//    new Task(
//        4,
//        'Take dogs for a walk',
//        'Task 4 description',
//        null,
//        false,
//        '2023-03-04 12:00:00',
//        '2023-03-04 12:00:00'
//    ),
//];

Route::get('/', function(){
    return redirect()->route('tasks.index');
});



#الروت دي بتوديك علي صفحه الفيو ال بتعرض الداتا كلها
//Route::get('/tasks', function () {
//    return view('index' ,[ 'tasks' => Task::latest()->where('completed', false)->get() ]);
//})->name('tasks.index');
Route::get('/tasks', function () {
#   paginate ------لازمتها انها بتقسم الصفحات الي كذا صفحه في العرض
    return view('index' ,[ 'tasks' => Task::latest()->paginate(10) ]);
})->name('tasks.index');


#الروت دي بتوديك علي صفحه الفيو ال بتعمل منها كرييت
Route::view('/tasks/create' , 'create')->name('tasks.create');


#الروت دي بتوديك علي صفحه  الفيو ال بتعمل منها ابديت
Route::get('/tasks/{task}/edit' ,function(Task $task){
    return view('edit' ,[ 'task' => $task ]);
})->name('tasks.edit');


# الروت دي بتوديك علي صفحه الفيو ال بتعرض منها حاجه من الداتا
Route::get('/tasks/{task}' ,function(Task $task){
    return view('show' ,['task' => $task ]);
})->name('tasks.show');


//#الروت دي بتعمل انشاء للداتا
Route::post('/tasks' , function (TaskRequest $request){
//    $data = ;
//    $task = new Task();
//    $task->title = $data['title'];
//    $task->description =$data ['description'];
//    $task->long_description =$data ['long_description'];
//    $task->save();

    #الامر ده بيقولك ان الداتا ال جوا الصفحه ال اسمها تاسك ريكويست فالديتيد يعني تم التاكد منها
    $task = Task::create($request->validated());
#الامر ده بيرجعك لصفحه العرض
    return redirect()->route('tasks.show' , ['task'=> $task -> id] )
    ->with('success' , 'Task Created Succussfully !');
    #dd($request->all());
})->name('tasks.store');

#الروت دي بتعمل ابديت للداتا
Route::put('/tasks/{task}' , function (Task $task ,TaskRequest $request){
//    $data = ;
//    $task->title = $data['title'];
//    $task->description =$data ['description'];
//    $task->long_description =$data ['long_description'];
//    $task->save();

#الامر ده بيقولك ان الداتا ال جوا الصفحه ال اسمها تاسك ريكويست فالديتيد يعني تم التاكد منها
       $task->update($request ->validated());
#الامر ده بيرجعك لصفحه العرض
    return redirect()->route('tasks.show' , ['task' => $task -> id])
        ->with('success' , 'Task Updated Succussfully !');
    #dd($request->all());
})->name('tasks.update');

#الروت دي ال بتعمل ديليت للداتا
Route::delete('/tasks/{task}' , function (Task $task){
    $task->delete();

    return redirect()->route('tasks.index')
        ->with('success' , 'Task Deleted Succussfully !' );
})->name('tasks.destroy');


Route::put('tasks/{task}/toggle-complete' ,function(Task $task){
    $task->togglecomplete();

   return redirect()->back()->with('success' , 'Task Updated Succussfully !');
})->name('tasks.toggle-complete');

//Route::get('/tasks/{id}' ,function($id) use($tasks){
//    $tasks = collect($tasks)->firstwhere('id', $id);
//    if (!$tasks){
//        abort(Response::HTTP_NOT_FOUND);
//    }
//
//   return view('show' ,['tasks' =>$tasks]);
//})->name('tasks.show');

//Route::get('/aaaa', function () {
//    return 'hello from website';
//})->name('hello');
//
//Route::get('/hallo', function () {
//    return redirect()->route('hello');
//});
//
//
//Route::get('/body/{name}' , function($name){
//   return 'hello ' .$name  .'!';
//});
# لو الصفحه مش موجوده بيرجعلك الامر ده
Route::fallback(function(){
    return 'This Page Not Found ';
});
