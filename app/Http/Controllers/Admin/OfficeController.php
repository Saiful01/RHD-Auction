<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOfficeRequest;
use App\Http\Requests\StoreOfficeRequest;
use App\Http\Requests\UpdateOfficeRequest;
use App\Models\Office;
use App\Models\OfficeType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OfficeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('office_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $offices = Office::with(['office_type'])->get();

        return view('admin.offices.index', compact('offices'));
    }

    public function create()
    {
        abort_if(Gate::denies('office_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $office_types = OfficeType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.offices.create', compact('office_types'));
    }

    public function store(StoreOfficeRequest $request)
    {
        $office = Office::create($request->all());

        return redirect()->route('admin.offices.index');
    }

    public function edit(Office $office)
    {
        abort_if(Gate::denies('office_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $office_types = OfficeType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $office->load('office_type');

        return view('admin.offices.edit', compact('office', 'office_types'));
    }

    public function update(UpdateOfficeRequest $request, Office $office)
    {
        $office->update($request->all());

        return redirect()->route('admin.offices.index');
    }

    public function show(Office $office)
    {
        abort_if(Gate::denies('office_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $office->load('office_type', 'officeEmployees');

        return view('admin.offices.show', compact('office'));
    }

    public function destroy(Office $office)
    {
        abort_if(Gate::denies('office_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $office->delete();

        return back();
    }

    public function massDestroy(MassDestroyOfficeRequest $request)
    {
        $offices = Office::find(request('ids'));

        foreach ($offices as $office) {
            $office->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
