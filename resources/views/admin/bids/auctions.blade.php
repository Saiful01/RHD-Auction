@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="panel panel-default">
            <div class="panel-heading">
                Auction Wise Bids
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Auction Name</th>
                            <th>Auction Status</th>
                            <th>Total Bids</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($auctions as $key => $auction)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ strip_tags($auction->name) }}</td>
                                <td>{{ ($auction->status) }}</td>
                                <td>
                                    <span class="badge badge-info">
                                        {{ $auction->bids_count }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.bids.auction', $auction->id) }}" class="btn btn-xs btn-primary">
                                        View Bids Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
