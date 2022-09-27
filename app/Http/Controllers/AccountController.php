<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;


class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index()
    {
        $response = Http::withHeaders([
            'X-Riot-Token' => env('LOL_KEY'),
        ])->get(env('LOL_URL') . '/lol/league/v4/entries/by-summoner/rUJS-Tm32JfcKR8sFHsVT7ZPjo1KfAKge2ut8arOhHT0u2Y');

        return json_decode($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Account::create([
            'lolID' => self::getID($request->account),
            'name' => $request->name,
            'account' => $request->account,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = self::getID($request->account);
        Account::destroy($id);
    }

    public static function getID($name) {
        $response = Http::withHeaders([
            'X-Riot-Token' => env('LOL_KEY'),
        ])->get(env('LOL_URL') . '/lol/summoner/v4/summoners/by-name/' . $name);

        return json_decode($response)->id;
    }

    public static function getInfo($id) {
        $response = Http::withHeaders([
            'X-Riot-Token' => env('LOL_KEY'),
        ])->get(env('LOL_URL') . '/lol/league/v4/entries/by-summoner/' . $id);

        return json_decode($response);
    }

    public static function getMatches($id) {
        $response = Http::withHeaders([
            'X-Riot-Token' => env('LOL_KEY'),
        ])->get(env('LOL_URL') . '/lol/league/v4/entries/by-summoner/' . $id);
        return (json_decode($response)[0]->wins + json_decode($response)[0]->losses);
    }

    public static function getWins($id) {
        $response = Http::withHeaders([
            'X-Riot-Token' => env('LOL_KEY'),
        ])->get(env('LOL_URL') . '/lol/league/v4/entries/by-summoner/' . $id);
        return json_decode($response)[0]->wins;
    }

    public static function getLosses($id) {
        $response = Http::withHeaders([
            'X-Riot-Token' => env('LOL_KEY'),
        ])->get(env('LOL_URL') . '/lol/league/v4/entries/by-summoner/' . $id);
        return json_decode($response)[0]->losses;
    }

}
