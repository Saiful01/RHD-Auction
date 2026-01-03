@extends('layouts.admin')

@section('content')
    <div class="content">
        @if (isset($lot) && $lot)
            <div class="row mt-4 mb-4">
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <strong>Lot Information</strong>
                        </div>

                        <div class="panel-body">
                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <label class="text-uppercase" style="color:#5bc0de; font-size:12px; letter-spacing:1px;">
                                        Lot Name
                                    </label>
                                    <div class="fw-bold border-bottom pb-1">
                                        {{ $lot->name }}
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="text-uppercase"
                                        style="color:#5bc0de; font-size:12px; letter-spacing:1px;">
                                        Location
                                    </label>
                                    <div class="border-bottom pb-1">
                                        {{ strip_tags($lot->location ?? '—') }}
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="text-uppercase"
                                        style="color:#5bc0de; font-size:12px; letter-spacing:1px;">
                                        Package
                                    </label>
                                    <div class="border-bottom pb-1">
                                        {{ optional($lot->package)->name ?? '—' }}
                                    </div>
                                </div>

                                <div class="col-md-6 mt-4">
                                    <label class="text-uppercase"
                                        style="color:#5bc0de; font-size:12px; letter-spacing:1px;">
                                        Details
                                    </label>
                                    <div class="pt-2" style="line-height:1.6;">
                                        {{ $lot->details ?? '—' }}
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endif


        <div class="row">

            {{-- LEFT: CREATE LOT ITEM --}}
            <div class="col-lg-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Create Lot Item
                    </div>

                    <div class="panel-body">
                        <form method="POST" action="{{ route('admin.lots.lot-items.newStore') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="lot_id" value="{{ $lotId }}">

                            <div id="lotItemsContainer">

                                <div class="lot-item-row border p-3 mb-2 d-flex">
                                    <div class="flex-grow-1">
                                        {{-- NAME --}}
                                        <div class="form-group">
                                            <label class="required">Name (গাছের নাম)</label>
                                            <input type="text" name="name[]" class="form-control name" required>
                                        </div>

                                        {{-- TREE NO --}}
                                        <div class="form-group">
                                            <label>Tree No (গাছের নম্বর)</label>
                                            <textarea name="tree_no[]" class="form-control ckeditor"></textarea>
                                        </div>

                                        {{-- DIA --}}
                                        <div class="form-group">
                                            <label>Dia (বেড় ৫'-৬'.১১")</label>
                                            <input type="text" name="dia[]" class="form-control">
                                        </div>

                                        {{-- QUANTITY --}}
                                        <div class="form-group">
                                            <label>Quantity (কাঠের পরিমাণ)</label>
                                            <input type="number" step="0.0000001" name="quantity[]"
                                                class="form-control quantity">
                                        </div>

                                        {{-- UNIT --}}
                                        <div class="form-group">
                                            <label class="required">Unit (একক)</label>
                                            <select name="unit[]" class="form-control" required>
                                                @foreach (App\Models\LotItem::UNIT_SELECT as $k => $v)
                                                    <option value="{{ $k }}">{{ $v }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- UNIT PRICE --}}
                                        <div class="form-group">
                                            <label>Unit Price</label>
                                            <input type="number" step="0.0000001" name="unit_price[]"
                                                class="form-control unit_price">
                                        </div>

                                        {{-- ESTIMATED --}}
                                        <div class="form-group">
                                            <label>Estimated Price</label>
                                            <input type="number" step="0.0000001" name="estimated_price[]"
                                                class="form-control estimated_price" readonly>
                                        </div>

                                        {{-- IMAGE UPLOAD --}}
                                        <div class="form-group">
                                            <label>Image Upload</label>
                                            <input type="file" name="item_image[]" class="form-control item_image"
                                                accept="image/*">
                                        </div>

                                    </div>

                                    <div class="ms-3 d-flex flex-column">
                                        <button type="button" id="addLotItem" class="btn btn-primary mb-2">+</button>

                                        <button type="button" class="btn btn-danger remove-lot-item mb-2">×</button>

                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- RIGHT: LIST --}}
            <div class="col-lg-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Lot Items List
                    </div>

                    <div class="panel-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Unit Price</th>
                                    <th>Est Total</th>
                                    <th>Image Upload</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach (\App\Models\LotItem::where('lot_id', $lotId)->get() as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ \App\Models\LotItem::UNIT_SELECT[$item->unit] ?? '' }}</td>
                                        <td>{{ $item->unit_price }}
                                        </td>
                                        <td>
                                            {{ $item->estimated_price }}</td>
                                        <td>
                                            @if ($item->item_image)
                                                <img src="{{ asset('storage/' . $item->item_image) }}" width="70"
                                                    class="rounded border" alt="Item Image">
                                            @else
                                                <span class="text-muted">No image</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div style="display: inline-flex; gap: 5px; align-items: center;">
                                                {{-- Bootstrap 3 safe --}}
                                                <button type="button" class="btn btn-info btn-xs editBtn"
                                                    data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                                    data-tree_no="{{ $item->tree_no }}" data-dia="{{ $item->dia }}"
                                                    data-quantity="{{ $item->quantity }}"
                                                    data-unit="{{ $item->unit }}"
                                                    data-unit_price="{{ $item->unit_price }}"
                                                    data-estimated_price="{{ $item->estimated_price }}"
                                                    data-image="{{ $item->item_image ? asset('storage/' . $item->item_image) : '' }}">
                                                    <i class="fa fa-edit"></i>
                                                </button>

                                                <form method="POST"
                                                    action="{{ route('admin.lots.lot-items.destroy', $item->id) }}"
                                                    style="display:inline-block; margin:0;"
                                                    onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-xs">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>


                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- EDIT MODAL --}}
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form method="POST" id="editForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="lotItem_id" id="editLotItemId">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Lot Item</h5>

                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" id="editName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tree No</label>
                            <textarea name="tree_no" id="editTreeNo" class="form-control ckeditor"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Dia</label>
                            <input type="text" name="dia" id="editDia" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" step="0.0000001" name="quantity" id="editQuantity"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Unit</label>
                            <select name="unit" id="editUnit" class="form-control">
                                @foreach (App\Models\LotItem::UNIT_SELECT as $k => $v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Unit Price</label>
                            <input type="number" step="0.0000001" name="unit_price" id="editUnitPrice"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Estimated Price</label>
                            <input type="number" step="0.0000001" name="estimated_price" id="editEstimatedPrice"
                                class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label>Image Upload</label>
                            <input type="file" name="item_image" id="editItemImage" class="form-control"
                                accept="image/*">
                            <div class="mt-2">
                                <img id="editImagePreview" src="" alt="Current Image" style="height:70px;">
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-secondary" id="cancelEditBtn">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            // AUTO CALCULATE ESTIMATED PRICE
            $(document).on('input', '.quantity,.unit_price', function() {
                let row = $(this).closest('.lot-item-row');
                let q = parseFloat(row.find('.quantity').val()) || 0;
                let p = parseFloat(row.find('.unit_price').val()) || 0;
                row.find('.estimated_price').val((q * p).toFixed(7));
            });

            // ADD NEW LOT ITEM ROW
            $('#addLotItem').click(function() {
                let clone = $('.lot-item-row:first').clone();
                clone.find('input,textarea,select').val('');
                clone.find('.item_image').val('');
                $('#lotItemsContainer').append(clone);
            });

            // REMOVE LOT ITEM ROW
            $(document).on('click', '.remove-lot-item', function() {
                if ($('.lot-item-row').length > 1) {
                    $(this).closest('.lot-item-row').remove();
                }
            });

            // EDIT BUTTON CLICK
            $('.editBtn').click(function() {
                let btn = $(this);
                $('#editLotItemId').val(btn.data('id'));
                $('#editName').val(btn.data('name'));
                $('#editTreeNo').val(btn.data('tree_no'));
                $('#editDia').val(btn.data('dia'));
                $('#editQuantity').val(btn.data('quantity'));
                $('#editUnit').val(btn.data('unit'));
                $('#editUnitPrice').val(btn.data('unit_price'));
                $('#editEstimatedPrice').val(btn.data('estimated_price'));

                // SET FORM ACTION
                let id = btn.data('id');
                $('#editForm').attr('action', '{{ url('admin/lots/lot-items/new-update') }}/' + id);

                // SHOW IMAGE PREVIEW
                let imageUrl = btn.data('image') ?? '';
                if (imageUrl) {
                    $('#editImagePreview').attr('src', imageUrl).show();
                } else {
                    $('#editImagePreview').hide();
                }

                // SHOW MODAL (Bootstrap 3)
                $('#editModal').modal('show');
            });

            // EDIT MODAL AUTO CALC ESTIMATED PRICE
            $('#editQuantity, #editUnitPrice').on('input', function() {
                let q = parseFloat($('#editQuantity').val()) || 0;
                let p = parseFloat($('#editUnitPrice').val()) || 0;
                $('#editEstimatedPrice').val((q * p).toFixed(7));
            });

            // CANCEL BUTTON CLICK
            $('#cancelEditBtn').click(function() {
                $('#editModal').modal('hide');
            });

            // EDIT IMAGE PREVIEW ON SELECT
            $('#editItemImage').on('change', function(e) {
                const file = e.target.files[0];
                const preview = $('#editImagePreview');
                if (file) {
                    preview.attr('src', URL.createObjectURL(file)).show();
                }
            });

        });
    </script>
@endsection
