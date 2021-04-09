<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exchange;

class ExchangeController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $exchanges = Exchange::orderBy('created_at', 'desc')->paginate(15);
        return view('exchanges.index', ['exchanges' => $exchanges]);
    }

    public function show(Exchange $exchange) {
        return response()->json($exchange);
    }

    public function create() {
        return view('exchanges.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'from' => 'required',
            'to' => 'required',
            'rate' => 'required',
            'sell' => 'required',
            'buy' => 'required',
            'sell_margin' => 'required',
            'buy_margin' => 'required'
        ]);
        if(!$validated) return response()->json(['status' => 'error', 'msg' => 'not valid'], 400);
        $exchange = new Exchange([
            'from' => $request->from,
            'to' => $request->to,
            'rate' => $request->rate,
            'sell' => $request->sell,
            'buy' => $request->buy,
            'sell_margin' => $request->sell_margin,
            'buy_margin' => $request->buy_margin
        ]);
        $exchange->save();
        return response()->json(['status' => 'success', 'exchange' => $exchange]);
    }

    public function edit(Exchange $exchange) {
        return view('exchanges.edit', ['exchange' => $exchange]);
    }

    public function update(Request $request, Exchange $exchange) {
        /*$exchange->rate = $request->rate;
        $exchange->sell_margin = $request->sell_margin;
        $echange->sell = $request->sell;
        $exchange->buy_margin = $request->buy_margin;
        $echange->buy = $request->buy;
        $exchange->save();*/
        $exchange->update($request->all());
        return response()->json(['status' => 'success', 'exchange' => $exchange]);
    }

    public function exchange_list() {
        $exchanges = Exchange::orderBy('created_at', 'desc')->limit(10)->get();
        return response()->json(['status' => 'success', 'exchanges' => $exchanges]);
    }

    public function destroy(Request $request, Exchange $exchange) {
        $exchange->delete();
        return redirect(route('exchanges.index'))->with('success', 'Exchange deleted with success');
    }

    public function screen1() {
        return view('exchanges.screen1');
    }
    
}
