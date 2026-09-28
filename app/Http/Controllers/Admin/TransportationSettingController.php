<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTransportationSettingRequest;
use App\Models\TransportationSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TransportationSettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.settings.edit', ['settings' => TransportationSetting::current()]);
    }

    public function update(UpdateTransportationSettingRequest $request): RedirectResponse
    {
        $settings = TransportationSetting::query()->firstOrCreate([]);
        $settings->update([
            ...$request->validated(),
            'price_estimates_enabled' => $request->boolean('price_estimates_enabled'),
            'currency' => strtoupper($request->string('currency')->toString()),
        ]);

        return to_route('admin.settings.edit')->with('status', 'Transportation settings saved.');
    }
}
