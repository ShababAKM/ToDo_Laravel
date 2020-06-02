<?php

namespace App\Http\Controllers;
use App\todo;
use Illuminate\Http\Request;

class todosController extends Controller
{
    public function index()
    {
        $todos=todo::all();//(static function "all()" fetches all DB record in the todos table )
        return view('todos.index')->with('todos',$todos);
    }

    public function show($todoid)
    {
       //dd($todoid)
       $todo = Todo::find($todoid);
        return view('todos.show')->with('todo',$todo);
    }

    public function create()
    {
       //dd($todoid)
        return view('todos.create');
    }

    public function store()
    {
       $this->validate(request(),['name'=>'required|min:6|max:12','description'=>'required']); 
       $data=request()->all();
       $todo = new todo();
       $todo->name=$data['name'];
       $todo->description=$data['description'];
       $todo->completed=false;
       $todo->save();

       return redirect('/todos');
    }
}
