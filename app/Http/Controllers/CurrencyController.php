<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use App\Http\Requests\CurrencyRequest;

class CurrencyController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    // get currency list
    public function currency(Request $request) {
        return view('currencies.currency');
    }

    public function index(Request $request) {
        $currencies = Currency::orderBy('iso')->paginate(15);
        return View('currencies.index', ['currencies' => $currencies]);
    }

    public function create(Request $request) {
        return view('currencies.create');
    }

    public function store(CurrencyRequest $request) {
        $request->user()->currencies()->create($request->all());
        return redirect(route('currencies.index'))->with('success', 'Currency Created Successfully');
    }

    public function edit(Currency $currency) {
        return view('currencies.edit', ['currency' => $currency]);
    }

    public function update(CurrencyRequest $request, Currency $currency) {
        $currency->update($request->all());
        return redirect(route('currencies.index'))->with('success', 'Currency Deleted Successfully!!');
    }

    public function destroy(Currency $currency) {
        $currency->delete();
        return redirect(route('currencies.index'))->with('success', 'Currency Deleted Successfully!!');
    }

    public function currency_list() {
        $currencies = Currency::orderBy('iso')->get();
        return response()->json(['currencies' => $currencies]);
    }
}
