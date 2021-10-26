<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $information = Information::all();

        return view('admin.information.index', compact('information'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Information  $information
     * @return \Illuminate\View\View
     */
    public function edit(Information $information)
    {
        return view('admin.information.edit', compact('information'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Information  $information
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Information $information)
    {
        if ($request->photo) {
            $information->updatePhoto($request->photo);
        } else {
            $information->update(['description' => $request->description]);
        }

        return redirect()->route('admin.information.index')->with('success', 'Data berhasil diubah');
    }
}
