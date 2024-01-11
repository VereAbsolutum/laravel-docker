<?php

namespace App\Http\Controllers\Admin;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Services\SupportService;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function __construct(protected SupportService $service)
    {
    }

    public function index(Request $request)
    {
        // $supports = Support::all();
        $supports = $this->service->getAll($request->filter);

        // dd($supports);

        return view("admin/supports/index", compact('supports'));
    }
    public function create()
    {
        return view('admin/supports/create');
    }
    public function store(StoreUpdateSupport $request)
    {
        // $data = $request->validated();
        // $data['status'] = 'a';

        $this->service->new(CreateSupportDTO::makeFromRequest($request));

        return redirect()->route('supports.index');
    }
    public function show(string | int $id)
    {
        // if (!$support = Support::find($id)) {
        if (!$support = $this->service->findOne($id)) {
            return back();
        };

        return view('admin/supports/show', compact('support'));
    }

    public function edit(string | int $id)
    {
        // if (!$support = Support::find($id)) {
        if (!$support = $this->service->findOne($id)) {
            return back();
        };

        return view('admin/supports/edit', compact('support'));
    }

    public function update(StoreUpdateSupport $request)
    {
        // if (!$support = Support::find($id)) {
        //     return back();
        // };

        // $support->update($request->validated());

        $support = $this->service->update(UpdateSupportDTO::makeFromRequest($request));

        if (!$support) {
            return back();
        }

        return redirect()->route('supports.index');
    }

    public function destroy(string | int $id)
    {
        // if (!$support = Support::find($id)) {
        //     return back();
        // };

        $this->service->delete($id);

        redirect()->route('supports.index');
    }
}
