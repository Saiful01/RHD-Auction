<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyLotRequest;
use App\Http\Requests\StoreLotRequest;
use App\Http\Requests\UpdateLotRequest;
use App\Models\Lot;
use App\Models\Package;
use App\Models\Road;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class LotController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('lot_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lots = Lot::with(['road', 'package'])->get();

        return view('admin.lots.index', compact('lots'));
    }

    public function create()
    {
        abort_if(Gate::denies('lot_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roads = Road::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $packages = Package::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lots.create', compact('packages', 'roads'));
    }

    public function store(StoreLotRequest $request)
    {
        $lot = Lot::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $lot->id]);
        }

        return redirect()->route('admin.lots.index');
    }

    public function edit(Lot $lot)
    {
        abort_if(Gate::denies('lot_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roads = Road::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $packages = Package::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lot->load('road', 'package');

        return view('admin.lots.edit', compact('lot', 'packages', 'roads'));
    }

    public function update(UpdateLotRequest $request, Lot $lot)
    {
        $lot->update($request->all());

        return redirect()->route('admin.lots.index');
    }

    public function show(Lot $lot)
    {
        abort_if(Gate::denies('lot_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lot->load('road', 'package', 'lotLotItems', 'lotAuctions');

        return view('admin.lots.show', compact('lot'));
    }

    public function destroy(Lot $lot)
    {
        abort_if(Gate::denies('lot_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lot->delete();

        return back();
    }

    public function massDestroy(MassDestroyLotRequest $request)
    {
        $lots = Lot::find(request('ids'));

        foreach ($lots as $lot) {
            $lot->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('lot_create') && Gate::denies('lot_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Lot();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
