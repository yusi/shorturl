<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::latest()->paginate(10);
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $keys = Setting::KEYS;
        $existingKeys = Setting::pluck('key')->toArray();
        $availableKeys = array_diff_key($keys, array_flip($existingKeys));

        return view('admin.settings.create', compact('availableKeys'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:64|unique:settings',
            'value' => 'required',
            'comment' => 'nullable',
        ]);

        Setting::create($request->all());
        return redirect()->route('settings.index')->with('success', '設定が作成されました');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'value' => 'required',
            'comment' => 'nullable',
        ]);

        $setting->update($request->only(['value', 'comment']));
        return redirect()->route('settings.index')->with('success', '設定が更新されました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();
        return redirect()->route('settings.index')->with('success', '設定が削除されました');
    }
}
