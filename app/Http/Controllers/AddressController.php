<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('addresses.index', [
            'addresses' => Address::with(['user', 'country'])->latest()->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addresses.create', [
            'countries' => Country::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'street'      => ['required', 'string'],
            'number'      => ['required', 'string'],
            'city'        => ['required', 'string'],
            'state'       => ['required', 'string'],
            'postal_code' => ['required', 'string'],
            'country'     => ['required', 'string'],
            'phone'       => ['required', 'string'],
            'is_billing'  => ['boolean', 'nullable'],
        ]);

        Address::create([
            'user_id'      => auth()->id(),
            'token'        => Str::random(32),
            'street_name'  => $request->street,
            'house_number' => $request->number,
            'postal_code'  => $request->postal_code,
            'state'        => $request->state,
            'city'         => $request->city,
            'country_id'   => $request->country,
            'phone'        => $request->phone,
            'is_billing'   => $request->is_billing,
        ]);

        return redirect()->route('addresses.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        $countries = Country::all();

        return view('addresses.edit', compact('address', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        $request->validate([
            'street'      => ['required', 'string'],
            'number'      => ['required', 'string'],
            'city'        => ['required', 'string'],
            'state'       => ['required', 'string'],
            'postal_code' => ['required', 'string'],
            'country'     => ['required', 'string'],
            'phone'       => ['required', 'string'],
            'is_billing'  => ['boolean', 'nullable'],
        ]);

        $address->user_id      = auth()->id();
        $address->street_name  = $request->street;
        $address->house_number = $request->number;
        $address->postal_code  = $request->postal_code;
        $address->state        = $request->state;
        $address->city         = $request->city;
        $address->country_id   = $request->country;
        $address->phone        = $request->phone;
        $address->is_billing   = $request->is_billing;

        $address->save();

        return redirect()->route('addresses.index');
    }
}
