<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dish;
use App\Models\Restaurant;
use App\Models\Type;
use App\Http\Requests\StorerestaurantRequest;
use App\Http\Requests\UpdaterestaurantRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
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
            return view('errors.restaurants.index_error');
        }

        $types = Type::all();
        return view("admin.restaurants.index", compact("user", "types"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::find(Auth::id());
        if ($user->restaurant) {
            return view('errors.restaurants.create_error');
        }
        $types = Type::all();
        return view("admin.restaurants.create", compact("types", 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRestaurantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRestaurantRequest $request)
    {

        $path = Storage::disk('public')->put('uploads/restaurants', $request['img']);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['img'] = $path;

        $newRestaurant = new Restaurant();
        $newRestaurant->fill($data);
        $newRestaurant->save();

        if ($request->types) {
            $newRestaurant->types()->attach($request->types);
        }

        return redirect()->route("admin.restaurants.show", $newRestaurant->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        $user = auth()->user();
        if (!$user->restaurant || $restaurant->user_id != $user->id) {
            return view('errors.restaurants.show_error');
        }
        $types = Type::all();
        return view("admin.restaurants.show", compact("user", "restaurant", "types"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $user = auth()->user();
        if (!$user->restaurant || $restaurant->user_id != $user->id) {
            return view('errors.restaurants.edit_error');
        }
        $types = Type::all();
        return view("admin.restaurants.edit", compact("user", "restaurant", "types"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRestaurantRequest  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdaterestaurantRequest $request, Restaurant $restaurant)
    {
        $data = $request->all();
        if ($request['img']) {
            Storage::disk('public')->delete($restaurant->img);
            $path = Storage::disk('public')->put('uploads/restaurants', $request['img']);
            $data['img'] = $path;
        } else {
            $data['img'] = $restaurant->img;
        }
        $restaurant->types()->sync($request->types);
        $restaurant->update($data);
        return redirect()->route("admin.restaurants.show", $restaurant->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        Storage::disk('public')->delete($restaurant->img);

        Dish::where('restaurant_id', $restaurant->id)->delete();
        $restaurant->delete();

        return redirect()->route("admin.restaurants.index");
    }
}
