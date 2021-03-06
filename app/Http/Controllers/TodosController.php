<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\DB;

class TodosController extends Controller
{
    public function get()
    {
        $items = Todo::all();
        return response()->json([
            'message' => '完了',
            'data' => $items
        ], 200);
    }
    public function post(Request $request)
    {
        // $param = [
        //     "id" => 0,
        //     "title" => $request->title,
        // ];
        // DB::table('todos')->insert($param);
        $todo = new Todo;
        $todo->title = $request->title;
        $todo->save();
        $items = Todo::all();
        return response()->json([
            'message' => '追加完了',
            'todo' => $todo
        ], 200);
    } //ここにVueからのデータを受け取ったあとの処理を書く。
    public function deleteTodo(Todo $todo)
    {
        $todo = Todo::where('id', $todo->id)->delete();
        // $items = Todo::all();
        // return $items;
        if($todo){
            return response()->json([
                'message' => '削除完了',
                'todos' => $todo
            ], 200);
        }else{
            return response()->json([
                'message' => '投稿が見つかりませんでした。',
            ], 404);}
    }
    public function put(Request $request, Todo $todo)
    {
        $todo = Todo::where('id', $todo->id)->first();
        $todo->title = $request->newTitle;
        $todo->save();
        if($todo) {
            return response()->json([
                'message' => $todo,
            ], 200);
        } else {
            return response()->json([
                'message' => '削除失敗',
            ], 404);
        }
    }
}
