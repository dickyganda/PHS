@extends('layouts.main')

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
            <a href={{ route('issued.create')}} class="btn btn-success btn-xs" title="Tambah Data Baru" role="button"><i class="fas fa-plus-circle"></i>Tambah</a>
            </td>
            </tr>
            </table>
                        <table id="dt-basic-example" class="table table-responsive table-bordered table-hover table-striped w-100">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>ID Sales</th>
                                    <th>User</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    {{-- <th>Rate</th> --}}
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
                                    <td>{{ $issued->IdSalesFK }}</td>
                                    <td>{{ $issued->IdUserFK }}</td>
                                    <td>{{ $issued->IdProductFK }}</td>
                                    <td>{{ $issued->Qty }}</td>
                                    {{-- <td>{{ $sales->IdHargaFK }}</td> --}}
                                    <td>{{ $issued->Amount }}</td>
                                    {{-- <td>{{ $sales->IdUserFK }}</td> --}}
                                    <td>{{ $issued->FROMIdDepartementFK }}</td>
                                    <td>{{ $issued->TOIdDepartementFK }}</td>
                                    <td>{{ $issued->CreatedBy }}</td>
                                    <td>{{ $issued->CheckedBy }}</td>
                                    <td>{{ $issued->ApprovedBy }}</td>
                                    <td>{{ $issued->DateRequired }}</td>
                                    <td>{{ $issued->PaymentDate }}</td>
                                    {{-- <td>{{ $sales->IdPaymentFK }}</td> --}}
                                    <td>{{ $issued->IdSuplierFK }}</td>
                        <td>

                            <a href="{{ route('issued.edit', $issued->IdSalesDetail) }}" title="Edit" class="btn btn-warning btn-xs" role="button"><i class="fas fa-pen"></i> Edit</a>
<form action="{{ route('issued.destroy', $issued->IdSalesDetail) }}" method="post" type="button" class="btn btn-danger btn-xs" onsubmit="return confirm('Delete')">
@csrf
@method('delete')

<button class="btn btn-danger btn-xs">Delete</button>
</form>

                            {{-- <a href="{{ route('sales.destroy', $sales->IdSalesDetail) }}" method="post" title="Hapus" class="btn btn-danger btn-xs" role="button"><i class="fas fa-trash"></i> Delete</a> --}}
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

</script>
 @endpush
@endsection