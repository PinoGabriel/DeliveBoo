<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Models\Type;
use App\Http\Requests\StorerestaurantRequest;
use App\Http\Requests\UpdaterestaurantRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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


        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

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
        $restaurant->types()->sync($request->types);
        $restaurant->update($request->all());
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
        $restaurant->delete();

        return redirect()->route("admin.restaurants.index");
    }
}
