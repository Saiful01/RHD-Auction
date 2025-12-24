<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDivisionRequest;
use App\Http\Requests\StoreDivisionRequest;
use App\Http\Requests\UpdateDivisionRequest;
use App\Models\Division;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DivisionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('division_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $divisions = Division::all();

        return view('admin.divisions.index', compact('divisions'));
    }

    public function create()
    {
        abort_if(Gate::denies('division_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.divisions.create');
    }

    public function store(StoreDivisionRequest $request)
    {
        $division = Division::create($request->all());

        return redirect()->route('admin.divisions.index');
    }

    public function edit(Division $division)
    {
        abort_if(Gate::denies('division_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.divisions.edit', compact('division'));
    }

    public function update(UpdateDivisionRequest $request, Division $division)
    {
        $division->update($request->all());

        return redirect()->route('admin.divisions.index');
    }

    public function show(Division $division)
    {
        abort_if(Gate::denies('division_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $division->load('divisionRoads');

        return view('admin.divisions.show', compact('division'));
    }

    public function destroy(Division $division)
    {
        abort_if(Gate::denies('division_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $division->delete();

        return back();
    }

    public function massDestroy(MassDestroyDivisionRequest $request)
    {
        $divisions = Division::find(request('ids'));

        foreach ($divisions as $division) {
            $division->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
