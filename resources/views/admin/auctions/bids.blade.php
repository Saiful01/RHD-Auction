@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="card-header">
            <h4>
                নিলাম: {{ $auction->memo_no ?? $auction->name }} এর দরসমূহ
            </h4>
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Bidder</th>
                        <th>Auction</th>
                        {{-- <th>Vat</th>
                        <th>Tax</th> --}}
                        <th>Bid Amount</th>
                        <th>Total Amount</th>
                        {{-- <th>Condition Accept</th> --}}
                        <th>Is Winner</th>
                        {{-- <th>Status</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse($bids as $bid)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bid->bidder->name ?? '-' }}</td>
                            <td>{{ strip_tags($auction->name) }}</td>
                            {{-- <td>{{ $bid->vat }}</td>
                            <td>{{ $bid->tax }}</td> --}}
                            <td>{{ bangla_number_format($bid->bid_amount, 2) }}</td>
                            <td>{{ bangla_number_format($bid->total_amount, 2) }}</td>
                            {{-- <td>
                                @if ($bid->is_condition_accept)
                                    <span class="badge badge-success">Yes</span>
                                @else
                                    <span class="badge badge-danger">No</span>
                                @endif
                            </td> --}}
                            <td>
                                @if ($bid->is_winner)
                                    <span class="label label-success">Yes</span>
                                @else
                                    <span class="label label-danger">No</span>
                                @endif
                            </td>
                            {{-- <td>
                                {{ $bid->status }}
                            </td> --}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">
                                এই নিলামের জন্য এখনো কোনো দর দেওয়া হয়নি
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
