<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PromoCode;

class PromoCodeController extends Controller
{
    public function index(Request $request)
    {
        $sortingBy = $request->sortingBy ?? 'id';
        $sortingDirection = $request->sortingDirection ?? 'desc';

        $promoCodes = PromoCode::orderBy($sortingBy, $sortingDirection)->paginate(10);
        return view('admin.promoCode.index',[
            'promoCodes' => $promoCodes,
            'sortingParams' => '?sortingBy='.request('sortingBy').'&sortingDirection='.request('sortingDirection'),
            'sortingOptions' => [
                ['val' => '?sortingBy=created_at&sortingDirection=desc', 'lable' => 'Нові'],
                ['val' => '?sortingBy=created_at&sortingDirection=asc', 'lable' => 'Старі'],
                ['val' => '?sortingBy=name&sortingDirection=asc', 'lable' => 'А-Я'],
                ['val' => '?sortingBy=name&sortingDirection=desc', 'lable' => 'Я-А'],
            ]
        ]);
    }

    public function create()
    {
        return view('admin.promoCode.create', [

        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'type' => 'required',
            'discount' => 'required',
            'active' => 'required',
            'end_term' => '',
		];

        $message =         [
            'name.required' => 'Напишіть будь ласка назву.',
            'type' => 'Виберіть будь ласка тип промо коду',
            'discount' => 'Напишіть будь ласка ціну промо коду',
            'active' => 'Напишіть будь ласка став',
        ];

        $data = $request->validate($rules, $message);
        $data['user_id'] = auth()->user()->id;

        $promoCode = PromoCode::create($data);

        return redirect()->route('admin.promoCode.index');
    }

    public function show(PromoCode $promoCode)
    {
        return view('admin.promoCode.show', [
            'promoCode' => $promoCode,
        ]);
    }

    public function edit(PromoCode $promoCode)
    {
        return view('admin.promoCode.edit', [
            'promoCode' => $promoCode,
        ]);
    }

    public function update(Request $request, PromoCode $promoCode)
    {
        $rules = [
            'name' => 'required',
            'type' => 'required',
            'discount' => 'required',
            'active' => 'required',
            'end_term' => '',
		];

        $message =         [
            'name.required' => 'Напишіть будь ласка назву.',
            'type' => 'Виберіть будь ласка тип промо коду',
            'discount' => 'Напишіть будь ласка ціну промо коду',
            'active' => 'Напишіть будь став',
        ];

        $data = $request->validate($rules, $message, );
        $data['user_id'] = auth()->user()->id;

        $saved = $promoCode->update($data);

        return redirect()->route('admin.promoCode.index');
    }

    public function delete($id)
    {
        $promoCode = PromoCode::findOrFail($id);

		$promoCode->delete();

        return redirect()->route('admin.promoCode.index');
    }


}
