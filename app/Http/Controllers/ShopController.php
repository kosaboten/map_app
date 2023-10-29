<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shops = Shop::all();
        // 取得したデータの中心地を求める
        $latitude = $shops->average('latitude');
        $longitude = $shops->average('longitude');
        $zoom = 5;

        return view('shops.index', compact('shops', 'latitude', 'longitude', 'zoom'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 最初に表示したい座標(今回は東京タワー)
        $latitude = 35.658584;
        $longitude = 139.7454316;
        $zoom = 10;
        return view('shops.create', compact('latitude', 'longitude', 'zoom'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $shop = new Shop();
        $shop->name = $request->name;
        $shop->description = $request->description;
        $shop->address = $request->address;
        $shop->latitude = $request->latitude;
        $shop->longitude = $request->longitude;
        $shop->save();
        return redirect()->route('shops.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shop $shop)
    {
        $latitude = $shop->latitude;
        $longitude = $shop->longitude;
        $zoom = 12;
        return view('shops.show', compact('shop', 'latitude', 'longitude', 'zoom'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop)
    {
        $latitude = $shop->latitude;
        $longitude = $shop->longitude;
        $zoom = 12;

        return view('shops.edit', compact('shop', 'latitude', 'longitude', 'zoom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shop $shop)
    {
        $shop->name = $request->name;
        $shop->description = $request->description;
        $shop->address = $request->address;
        $shop->latitude = $request->latitude;
        $shop->longitude = $request->longitude;
        $shop->save();
        return redirect()->route('shops.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();
        return redirect()->route('shops.index');
    }
}
