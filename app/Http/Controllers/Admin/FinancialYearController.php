<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFinancialYearRequest;
use App\Http\Requests\StoreFinancialYearRequest;
use App\Http\Requests\UpdateFinancialYearRequest;
use App\Models\FinancialYear;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FinancialYearController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('financial_year_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $financialYears = FinancialYear::all();

        return view('admin.financialYears.index', compact('financialYears'));
    }

    public function create()
    {
        abort_if(Gate::denies('financial_year_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.financialYears.create');
    }

    public function store(StoreFinancialYearRequest $request)
    {
        $financialYear = FinancialYear::create($request->all());

        return redirect()->route('admin.financial-years.index');
    }

    public function edit(FinancialYear $financialYear)
    {
        abort_if(Gate::denies('financial_year_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.financialYears.edit', compact('financialYear'));
    }

    public function update(UpdateFinancialYearRequest $request, FinancialYear $financialYear)
    {
        $financialYear->update($request->all());

        return redirect()->route('admin.financial-years.index');
    }

    public function show(FinancialYear $financialYear)
    {
        abort_if(Gate::denies('financial_year_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $financialYear->load('financialYearAuctions');

        return view('admin.financialYears.show', compact('financialYear'));
    }

    public function destroy(FinancialYear $financialYear)
    {
        abort_if(Gate::denies('financial_year_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $financialYear->delete();

        return back();
    }

    public function massDestroy(MassDestroyFinancialYearRequest $request)
    {
        $financialYears = FinancialYear::find(request('ids'));

        foreach ($financialYears as $financialYear) {
            $financialYear->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
