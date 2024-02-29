<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Models\Type;
use App\Models\User;
use App\Models\Dish;
use App\Http\Requests\StoreDishRequest;
use App\Http\Requests\UpdateDishRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
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
        if (!$user->restaurant) {
            return view('errors.dishes.index_error');
        } else return view("admin.dishes.index", compact("user"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::find(Auth::id());
        if (!$user->restaurant) {
            return view('errors.dishes.create_error');
        } else return view("admin.dishes.create", compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDishRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDishRequest $request)
    {
        $user = auth()->user();
        $data = $request->all();
        $path = Storage::disk('public')->put('uploads/dishes', $request['img']);
        $data['img'] = $path;
        $data['user_id'] = $user->id;
        $data['restaurant_id'] = $user->restaurant->id;

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
        if ($dish->restaurant->user_id !== $user->id) {

            return view('errors.dishes.show_error');
        }
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
        if (!$user->restaurant || $dish->restaurant->user_id != $user->id) {
            return view('errors.dishes.edit_error');
        } else return view("admin.dishes.edit", compact("user", "dish"));
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
        return redirect()->route("admin.dishes.index");
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
