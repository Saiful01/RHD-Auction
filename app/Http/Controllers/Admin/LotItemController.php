<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyLotItemRequest;
use App\Http\Requests\StoreLotItemRequest;
use App\Http\Requests\UpdateLotItemRequest;
use App\Models\Lot;
use App\Models\LotItem;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class LotItemController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('lot_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lotItems = LotItem::with(['lot'])->get();

        return view('admin.lotItems.index', compact('lotItems'));
    }

    public function create()
    {
        abort_if(Gate::denies('lot_item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lots = Lot::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lotItems.create', compact('lots'));
    }

    public function store(StoreLotItemRequest $request)
    {
        $lotItem = LotItem::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $lotItem->id]);
        }

        return redirect()->route('admin.lot-items.index');
    }

    public function edit(LotItem $lotItem)
    {
        abort_if(Gate::denies('lot_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lots = Lot::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lotItem->load('lot');

        return view('admin.lotItems.edit', compact('lotItem', 'lots'));
    }

    public function update(UpdateLotItemRequest $request, LotItem $lotItem)
    {
        $lotItem->update($request->all());

        return redirect()->route('admin.lot-items.index');
    }

    public function show(LotItem $lotItem)
    {
        abort_if(Gate::denies('lot_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lotItem->load('lot');

        return view('admin.lotItems.show', compact('lotItem'));
    }

    public function destroy(LotItem $lotItem)
    {
        abort_if(Gate::denies('lot_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lotItem->delete();

        return back();
    }

    public function massDestroy(MassDestroyLotItemRequest $request)
    {
        $lotItems = LotItem::find(request('ids'));

        foreach ($lotItems as $lotItem) {
            $lotItem->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('lot_item_create') && Gate::denies('lot_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new LotItem();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function newCreate(Request $request)
    {
        abort_if(Gate::denies('lot_item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lots = Lot::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lotId = $request->get('lot_id'); // optional

        return view('admin.lotItems.newCreate', compact('lots', 'lotId'));
    }

    public function newStore(Request $request)
    {
        abort_if(Gate::denies('lot_item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'lot_id' => 'required|exists:lots,id',
            'name.*' => 'required|string',
            'unit.*' => 'required',
        ]);

        foreach ($request->name as $index => $name) {
            LotItem::create([
                'lot_id'          => $request->lot_id,
                'name'            => $name,
                'tree_no'         => $request->tree_no[$index] ?? null,
                'dia'             => $request->dia[$index] ?? null,
                'quantity'        => $request->quantity[$index] ?? null,
                'unit'            => $request->unit[$index],
                'unit_price'      => $request->unit_price[$index] ?? null,
                'estimated_price' => $request->estimated_price[$index] ?? null,
            ]);
        }

        return redirect()
            ->route('admin.lots.lot-items.newCreate', ['lot_id' => $request->lot_id])
            ->with('success', 'Lot items added successfully');
    }

    public function newUpdate(Request $request, LotItem $lotItem)
    {
        abort_if(Gate::denies('lot_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'name' => 'required|string',
            'unit' => 'required',
        ]);

        $lotItem->update([
            'name'            => $request->name,
            'tree_no'         => $request->tree_no,
            'dia'             => $request->dia,
            'quantity'        => $request->quantity,
            'unit'            => $request->unit,
            'unit_price'      => $request->unit_price,
            'estimated_price' => $request->estimated_price,
        ]);

        return redirect()
            ->route('admin.lots.lot-items.newCreate', ['lot_id' => $lotItem->lot_id])
            ->with('success', 'Lot item updated successfully');
    }

    // public function destroy(LotItem $lotItem)
    // {
    //     abort_if(Gate::denies('lot_item_delete'), 403);

    //     $lotItem->delete();

    //     return redirect()->back()->with('success', 'Lot item deleted successfully');
    // }
}
