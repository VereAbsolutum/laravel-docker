<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        $supports = Support::all();
        return view("admin/supports/index", compact('supports'));
    }
    public function create()
    {

        return view('admin/supports/create');
    }
    public function store(StoreUpdateSupport $request)
    {
        $data = $request->all();
        $data['status'] = 'a';

        return redirect()->route('supports.index');
    }
    public function show(string | int $id)
    {
        if (!$support = Support::find($id)) {
            return back();
        };

        return view('admin/supports/show', compact('support'));
    }

    public function edit(string | int $id)
    {
        if (!$support = Support::find($id)) {
            return back();
        };

        return view('admin/supports/edit', compact('support'));
    }

    public function update(Request $request, Support $support, string | int $id)
    {
        if (!$support = Support::find($id)) {
            return back();
        };

        $support->update($request->only([
            'subject', 'body',
        ]));

        return redirect()->route('supports.index');
    }

    public function destroy(Support $support, string | int $id)
    {
        if (!$support = Support::find($id)) {
            return back();
        };

        $support->delete();

        return redirect()->route('supports.index');
    }
}
