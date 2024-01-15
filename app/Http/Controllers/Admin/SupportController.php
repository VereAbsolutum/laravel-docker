<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Supports\{
    UpdateSupportDTO,
    CreateSupportDTO
};
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
        $supports = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('totalPerPage', 3),
            filter: $request->get('filter')
        );

        $filters = [
            'filter' => $request->get('filter', '')
        ];

        // dd($supports);

        return view("admin/supports/index", compact('supports', 'filters'));
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

        return redirect()
           ->route('supports.index')
        ->with('message', 'Cadastrado com sucesso');
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

        return redirect()
        ->route('supports.index')
        ->with('message', 'Atualizado com sucesso');
    }

    public function destroy(string | int $id)
    {
        // if (!$support = Support::find($id)) {
        //     return back();
        // };

        $this->service->delete($id);

        return redirect()
        ->route('supports.index')
        ->with('message', 'Deletado com sucesso');;
    }
}
