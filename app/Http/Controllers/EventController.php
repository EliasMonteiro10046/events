<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){

        $search = request('search');

        if($search){
            $events = Event::where([
                ['title', 'like', '%'.$search.'%'],
            ])->get();
        }else{
            $events = Event::all();
        }

        return view('welcome', compact('events','search'));
    }

    public function create(){
        return view('events/create');
    }

    public function store(Request $request){

        $event = new Event;

        $event->title = $request->title;
        $event->date = $request->date;
        $event->description = $request->description;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->items = $request->items;

        if($request->hasFile('image') && $request->file('image')->isValid()){

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('image/events'), $imageName);

            $event->image = $imageName;
        }

        $event->save();

        return redirect('/')->with('msg','!!EVENTO CRIADO COM SUCESSO!!');
    }

    public function show($id){
        $event = Event::findOrFail($id);

        return view('events.show', compact('event'));
    }
}
