<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Dish;
use App\Http\Requests\StoreDishRequest;
use App\Http\Requests\UpdateDishRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;


class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get current user
        $user = auth()->user();
        //get all dishes
        $dishes = Dish::all();

        return Response::view("admin.dishes.index", compact("user", "dishes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get current user
        $user = User::find(Auth::id());
        return Response::view("admin.dishes.create", compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDishRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDishRequest $request)
    {
        //get all data
        $data = $request->all();
        //get image path
        $path = Storage::disk('public')->put('uploads/dishes', $request['img']);
        //set image path
        $data['img'] = $path;
        //set user
        $data['user_id'] = auth()->user()->id;

        $newDish = new Dish();
        //fill data
        $newDish->fill($data);
        //set visibility checkbox
        $newDish->visibility = $request->has('visibility');
        $newDish->save();

        return redirect()->route("admin.dishes.show", $newDish->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        //get current user
        $user = auth()->user();
        return Response::view("admin.dishes.show", compact("user", "dish"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        //get current user
        $user = auth()->user();
        return Response::view("admin.dishes.edit", compact("user", "dish"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDishRequest  $request
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDishRequest $request, Dish $dish)
    {
        //get all data
        $data = $request->all();
        //set new image while removing the old one
        if ($request['img']) {
            Storage::disk('public')->delete($dish->img);
            $path = Storage::disk('public')->put('uploads/dishes', $request['img']);
            $data['img'] = $path;
        }
        //set visibility checkbox
        $dish->visibility = $request->has('visibility');
        $dish->update($data);
        return redirect()->route("admin.dishes.show", $dish->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        //delete image
        Storage::disk('public')->delete($dish->img);
        //delete dish
        $dish->delete();

        return redirect()->route("admin.dishes.index");
    }
}
