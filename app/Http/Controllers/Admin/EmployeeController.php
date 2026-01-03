<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEmployeeRequest;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Office;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('employee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::with(['office', 'designation', 'media'])->paginate(100);

        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        abort_if(Gate::denies('employee_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $offices = Office::pluck('office_name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $designations = Designation::pluck('designation_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.employees.create', compact('designations', 'offices'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        $employee = Employee::create($request->all());

        if ($request->input('signature', false)) {
            $employee->addMedia(storage_path('tmp/uploads/' . basename($request->input('signature'))))->toMediaCollection('signature');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $employee->id]);
        }

        return redirect()->route('admin.employees.index');
    }

    public function edit(Employee $employee)
    {
        abort_if(Gate::denies('employee_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $offices = Office::pluck('office_name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $designations = Designation::pluck('designation_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employee->load('office', 'designation');

        return view('admin.employees.edit', compact('designations', 'employee', 'offices'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->all());

        if ($request->input('signature', false)) {
            if (! $employee->signature || $request->input('signature') !== $employee->signature->file_name) {
                if ($employee->signature) {
                    $employee->signature->delete();
                }
                $employee->addMedia(storage_path('tmp/uploads/' . basename($request->input('signature'))))->toMediaCollection('signature');
            }
        } elseif ($employee->signature) {
            $employee->signature->delete();
        }

        return redirect()->route('admin.employees.index');
    }

    public function show(Employee $employee)
    {
        abort_if(Gate::denies('employee_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employee->load('office', 'designation', 'employeesAuctions');

        return view('admin.employees.show', compact('employee'));
    }

    public function destroy(Employee $employee)
    {
        abort_if(Gate::denies('employee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employee->delete();

        return back();
    }

    public function massDestroy(MassDestroyEmployeeRequest $request)
    {
        $employees = Employee::find(request('ids'));

        foreach ($employees as $employee) {
            $employee->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('employee_create') && Gate::denies('employee_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Employee();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function search(Request $request)
    {
        $q = $request->get('q');

        $users = Employee::query()
            ->where('name_en', 'like', "%{$q}%")
            ->orWhere('personnel', 'like', "%{$q}%")
            ->limit(20)
            ->get(['id', 'name_en', 'personnel']);

        return response()->json($users);
    }
}
