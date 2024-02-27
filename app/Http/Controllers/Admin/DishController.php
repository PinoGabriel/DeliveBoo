<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Dish;
use App\Http\Requests\StoreDishRequest;
use App\Http\Requests\UpdateDishRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        $user = auth()->user();
        $dishes = Dish::all();

        return view("admin.dishes.index", compact("user", "dishes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::find(Auth::id());
        return view("admin.dishes.create", compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDishRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDishRequest $request)
    {
        $data = $request->all();
        $path = Storage::disk('public')->put('uploads/dishes', $request['img']);
        $data['img'] = $path;
        $data['user_id'] = auth()->user()->id;

        $newDish = new Dish();
        $newDish->fill($data);
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
        $user = auth()->user();
        return view("admin.dishes.show", compact("user", "dish"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        $user = auth()->user();
        return view("admin.dishes.edit", compact("user", "dish"));
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
        $data = $request->all();
        if ($request['img']) {
            Storage::disk('public')->delete($dish->img);
            $path = Storage::disk('public')->put('uploads/dishes', $request['img']);
            $data['img'] = $path;
        }
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
        Storage::disk('public')->delete($dish->img);

        $dish->delete();

        return redirect()->route("admin.dishes.index");
    }
}
