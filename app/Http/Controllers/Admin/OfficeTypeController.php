<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOfficeTypeRequest;
use App\Http\Requests\StoreOfficeTypeRequest;
use App\Http\Requests\UpdateOfficeTypeRequest;
use App\Models\OfficeType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OfficeTypeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('office_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $officeTypes = OfficeType::all();

        return view('admin.officeTypes.index', compact('officeTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('office_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.officeTypes.create');
    }

    public function store(StoreOfficeTypeRequest $request)
    {
        $officeType = OfficeType::create($request->all());

        return redirect()->route('admin.office-types.index');
    }

    public function edit(OfficeType $officeType)
    {
        abort_if(Gate::denies('office_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.officeTypes.edit', compact('officeType'));
    }

    public function update(UpdateOfficeTypeRequest $request, OfficeType $officeType)
    {
        $officeType->update($request->all());

        return redirect()->route('admin.office-types.index');
    }

    public function show(OfficeType $officeType)
    {
        abort_if(Gate::denies('office_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $officeType->load('officeTypeOffices');

        return view('admin.officeTypes.show', compact('officeType'));
    }

    public function destroy(OfficeType $officeType)
    {
        abort_if(Gate::denies('office_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $officeType->delete();

        return back();
    }

    public function massDestroy(MassDestroyOfficeTypeRequest $request)
    {
        $officeTypes = OfficeType::find(request('ids'));

        foreach ($officeTypes as $officeType) {
            $officeType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
