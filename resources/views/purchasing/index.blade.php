@extends('layouts.main')
@inject('carbon', 'Carbon\Carbon')

@section('title')
Purchasing
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
                    <h2>Purchasing</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div>
                            @php
            use Illuminate\Support\Facades\Session;

                $sessiondatamenu = Session::get('datamenu');
                $sessionmenu = Session::get('menu');
                @endphp
                        <table>
                            @foreach ($sessiondatamenu as $action)
                            @if($action->Add == 1 && $action->IdMenu == 9)
                            <tr>
                                <td>
                                <a href="/purchasing/create" class="btn btn-success btn-xs" title="Tambah Data Baru" role="button"><i class="fas fa-plus-circle"></i>Tambah</a>
                                </td>
                                </tr>
                            @endif
                            @endforeach
            </table>
                        <table id="dt-basic-example" class="table table-responsive table-bordered table-hover table-striped w-100">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Code</th>
                                    <th>Code Sales</th>
                                    <th>Code BOM</th>
                                    <th>User</th>
                                    <th>Date Purchasing</th>
                                    <th>Date Required</th>
                                    <th>Payment Date</th>
                                    <th>Payment</th>
                                    <th>Suplier</th>
                                    <th>Priority</th>
                                    <th>Material</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    {{-- <th>Created At</th> --}}
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody height="10px">
                                @php $i=1 @endphp
                                @foreach ($purchasingdetail as $purchasing)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $purchasing->CodePurchasing }}</td>
                                    <td>{{ $purchasing->CodeSales }}</td>
                                    <td>{{ $purchasing->BomCode }}</td>
                                    <td>{{ $purchasing->Name }}</td>
                                    <td>{{ $carbon::parse($purchasing->DatePurchasing)->format('d/m/Y H:i:s') }}</td>
                                    <td>{{ $carbon::parse($purchasing->DateRequired)->format('d/m/Y H:i:s') }}</td>
                                    <td>{{ $carbon::parse($purchasing->PaymentDate)->format('d/m/Y H:i:s') }}</td>
                                    <td>{{ $purchasing->NamaPayment }}</td>
                                    <td>{{ $purchasing->NamaSuplier }}</td>
                                    <td>{{ $purchasing->NamePriority }}</td>
                                    <td>{{ $purchasing->MaterialName }}</td>
                                    <td>@currency($purchasing->Qty)</td>
                                    <td>{{ $purchasing->NameUnit }}</td>
                                    <td>@currency($purchasing->Price)</td>
                                    <td>@currency($purchasing->Total)</td>
                        <td>
                            @foreach($sessiondatamenu as $action)
                                @if($action->Print == 1 && $action->IdMenu == 9)
                        <a href="/purchasing/printpurchasingorder/{{$purchasing->IdPurchasing}}" title="Print" class="btn btn-primary btn-xs" role="button"><i class="fas fa-print"></i> Print</a>
                                @endif

                                @if($action->Edit == 1 && $action->IdMenu == 9)
                            <a href="/purchasing/edit/{{ $purchasing->IdPurchasingDetail }}" title="Edit" class="btn btn-warning btn-xs" role="button"><i class="fas fa-pen"></i> Edit</a>
                                @endif

                                @if($action->Delete == 1 && $action->IdMenu == 9)
                                <form action= "/purchasing/delete/{{ $purchasing->IdPurchasingDetail}}" method="post" >
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                                    </form>
                                @endif

                                @if($action->Check == 1 && $action->IdMenu == 9)
                                    @if($purchasing->StatusChecked == 0)
                                <form action="/purchasing/checked/{{ $purchasing->IdPurchasingDetail}}" method="post">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-warning btn-xs">Checked</button>
                                </form>
    
                                <form action="/purchasing/approved/{{ $purchasing->IdPurchasingDetail}}" method="post">
                                    <button type="submit" class="btn btn-primary btn-xs" hidden>Approved</button>
                                </form>
                                    @endif

                                    @if($purchasing->StatusChecked == 1 && $purchasing->StatusApproved == 0 )
                            <form action="/purchasing/checked/{{ $purchasing->IdPurchasingDetail}}" method="post">
                                <button type="submit" class="btn btn-warning btn-xs" hidden>Checked</button>
                            </form>
                            <form action="/purchasing/approved/{{ $purchasing->IdPurchasingDetail}}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-primary btn-xs">Approved</button>
                            </form>
                            @endif

                            @if($purchasing->StatusChecked == 1 && $purchasing->StatusApproved == 1)
                            <form action="/purchasing/checked/{{ $purchasing->IdPurchasingDetail}}" method="post">
                                <button type="submit" class="btn btn-warning btn-xs" hidden>Checked</button>
                            </form>
                            <form action="/purchasing/approved/{{ $purchasing->IdPurchasingDetail}}" method="post">
                                <button type="submit" class="btn btn-primary btn-xs" hidden>Approved</button>
                            </form>
                            @endif
                                @endif
                            @endforeach

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
$(document).ready(function() {
            $('#dt-basic-example').DataTable({
                "order": []
            });
        });
</script>
 @endpush
@endsection