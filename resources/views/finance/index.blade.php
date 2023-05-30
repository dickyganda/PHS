@extends('layouts.main')

@section('title')
Finance
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
                    <h2>Finance</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div>
                        <table>
            <tr>
            <td>
            {{-- <a href={{ route('finance.create')}} class="btn btn-success btn-xs" title="Tambah Data Baru" role="button"><i class="fas fa-plus-circle"></i>Tambah</a> --}}
            </td>
            </tr>
            </table>
                        <table id="dt-basic-example" class="table table-responsive table-bordered table-hover table-striped w-100">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Code Finance</th>
                                    <th>Invoice Date</th>
                                    <th>Due Date</th>
                                    <th>Delivery Order</th>
                                    <th>Sales Order</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Rate</th>
                                    <th>Amount</th>
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
                                @foreach ($financedetail as $finance)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $finance->IdSales }}</td>
                                    <td>{{ $finance->IdUser }}</td>
                                    <td>{{ $finance->IdProduct }}</td>
                                    <td>{{ $finance->Qty }}</td>
                                    {{-- <td>{{ $sales->IdHargaFK }}</td> --}}
                                    <td>{{ $finance->Amount }}</td>
                                    {{-- <td>{{ $sales->IdUserFK }}</td> --}}
                                    <td>{{ $finance->FROMIdDepartement }}</td>
                                    <td>{{ $finance->TOIdDepartement }}</td>
                                    <td>{{ $finance->CreatedBy }}</td>
                                    <td>{{ $finance->CheckedBy }}</td>
                                    <td>{{ $finance->ApprovedBy }}</td>
                                    <td>{{ $finance->DateRequired }}</td>
                                    <td>{{ $finance->PaymentDate }}</td>
                                    {{-- <td>{{ $sales->IdPaymentFK }}</td> --}}
                                    <td>{{ $finance->IdSuplier }}</td>
                        <td>

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