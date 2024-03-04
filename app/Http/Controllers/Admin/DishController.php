<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Models\Type;
use App\Models\User;
use App\Models\Dish;
use App\Models\Order;
use App\Http\Requests\StoreDishRequest;
use App\Http\Requests\UpdateDishRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;


class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->restaurant->dishes->isEmpty()) {
            return view('errors.dishes.index_error');
        } else {
            return view("admin.dishes.index", compact("user"));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
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
        if ($data['price'] < 0) {
            throw ValidationException::withMessages(['price' => 'Il prezzo non può essere negativo']);
        }
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
     */
    public function show($id)
    {
        $user = auth()->user();
        $dish = Dish::find($id);
        $orders = Order::with(['restaurant', 'dishes'])
            ->whereHas('restaurant', function ($query) use ($user) {
                $query->where('id', $user->restaurant->id);
            })
            ->get();
        if (!$dish || $dish->restaurant->user_id !== $user->id) {

            return view('errors.dishes.show_error');
        }
        return view("admin.dishes.show", compact("user", "dish", "orders"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     */
    public function edit($id)
    {
        $user = auth()->user();
        $dish = Dish::find($id);
        if (!$user->restaurant) {
            return view('errors.dishes.edit_error');
        }

        // Controllo se il piatto esiste oppure se l'utente ha il permesso di editare il piatto
        if (!$dish || $dish->restaurant->user_id != $user->id) {
            return view('errors.dishes.dish_not_found', compact("user", "dish"));
        }

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
