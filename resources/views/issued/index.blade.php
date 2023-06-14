@extends('layouts.main')
@inject('carbon', 'Carbon\Carbon')


@section('title')
Issued
@endsection

@section('content')
<main id="js-page-content" role="main" class="page-content">
    {{-- <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
        <li class="breadcrumb-item">Application Intel</li>
        <li class="breadcrumb-item active">Analytics Dashboard</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol> --}}

    <div class="row">

        <div class="col-lg-12">

            <div id="panel-3" class="panel">
                <div class="panel-hdr">
                    <h2>Issued</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div>
                            <table>
                                <tr>
                                    <td>
                                        <a href="/issued/create" class="btn btn-success btn-xs" title="Tambah Data Baru"
                                            role="button"><i class="fas fa-plus-circle"></i>Tambah</a>
                                    </td>
                                </tr>
                            </table>
                            <table id="dt-basic-example"
                                class="table table-responsive table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Code Issued</th>
                                        <th>Code Sales</th>
                                        <th>User</th>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th>Rate</th>
                                        <th>Amount</th>
                                        <th>From Departement</th>
                                        <th>To Departement</th>
                                        <th>Created By</th>
                                        <th>Checked By</th>
                                        <th>Approved By</th>
                                        <th>Date Required</th>
                                        <th>Payment Date</th>
                                        <th>Suplier</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody height="10px">
                                    @php $i=1 @endphp
                                    @foreach ($issueddetail as $issued)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $issued->CodeIssued }}</td>
                                        <td>{{ $issued->CodeSales }}</td>
                                        <td>{{ $issued->Name }}</td>
                                        <td>{{ $issued->NameProduct }}</td>
                                        <td>@currency($issued->Qty)</td>
                                        <td>{{ $issued->NameUnit }}</td>
                                        <td>@currency($issued->HargaSatuan)</td>
                                        <td>@currency($issued->Amount)</td>
                                        <td>{{ $issued->FROMIdDepartement }}</td>
                                        <td>{{ $issued->TOIdDepartement }}</td>
                                        <td>{{ $issued->CreatedBy }}</td>
                                        <td>{{ $issued->CheckedBy }}</td>
                                        <td>{{ $issued->ApprovedBy }}</td>
                                        <td>{{ $carbon::parse($issued->DateRequired)->format('d/m/Y H:i:s') }}</td>
                                        <td>{{ $carbon::parse($issued->PaymentDate)->format('d/m/Y H:i:s') }}</td>
                                        <td>{{ $issued->NamaSuplier }}</td>
                                        <td>
                                            <a href="/issued/printissued/{{$issued->IdIssued}}" title="Print"
                                                class="btn btn-primary btn-xs" role="button"><i
                                                    class="fas fa-print"></i> Print</a>
                                            <a href="/issued/edit/{{ $issued->IdIssuedDetail }}" title="Edit"
                                                class="btn btn-warning btn-xs" role="button"><i class="fas fa-pen"></i>
                                                Edit</a>
                                            <form action="/issued/delete/{{ $issued->IdIssuedDetail}}" method="post">
                                                @csrf
                                                @method('put')
                                                <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                                            </form>
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
        {{-- <div class="col-lg-6">
            <div id="panel-5" class="panel">
                <div class="panel-hdr">
                    <h2>Subscriptions Hourly</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <h5>Subscription Views / hour</h5>
                        <div id="flotBar1" style="width: 100%; height: 160px;"></div>
                    </div>
                </div>
            </div>
            
        </div> --}}

</main>

<script src="{{asset('assets/js/vendors.bundle.js') }}"></script>
<script src="{{asset('assets/js/app.bundle.js') }}"></script>
<script src="{{asset('assets/js/datagrid/datatables/datatables.bundle.js') }}"></script>
@push('script')
<script>
$(document).ready(function () {
        $('#dt-basic-example').DataTable({
            "order": []
        });
    });
</script>
@endpush
@endsection
