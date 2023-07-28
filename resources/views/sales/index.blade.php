@extends('layouts.main')
@inject('carbon', 'Carbon\Carbon')

@section('title')
Sales Order
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
                    <h2>Sales Order</h2>
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
                                @foreach ($sessiondatamenu as $action )
                                    @if($action->Add == 1 && $action->IdMenu == 3)
                                    <tr>
                                        <td>
                                            <a href="/sales/create" class="btn btn-success btn-xs" title="Tambah Data Baru"
                                                role="button"><i class="fas fa-plus-circle"></i>Tambah</a>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                
                            </table>

                            <table id="dt-basic-example"
                                class="table table-responsive table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>User</th>
                                        <th>Code Sales</th>
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
                                    @foreach ($salesdetail as $sd)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $sd->Name }}</td>
                                        <td>{{ $sd->CodeSales }}</td>
                                        <td>{{ $sd->NameProduct }}</td>
                                        <td>@currency( $sd->Qty )</td>
                                        <td>{{ $sd->NameUnit }}</td>
                                        <td> @currency( $sd->HargaSatuan )</td>
                                        <td> @currency( $sd->Amount )</td>
                                        <td>{{ $sd->NamaDepartement }}</td>
                                        <td>{{ $sd->NamaDepartement }}</td>
                                        <td>{{ $sd->Name }}</td>
                                        <td>{{ $sd->Name }}</td>
                                        <td>{{ $sd->Name }}</td>
                                        <td>{{ $carbon::parse($sd->DateRequired)->format('d/m/Y H:i:s') }}</td>
                                        <td>{{ $sd->PaymentDate }}</td>
                                        <td>{{ $sd->NamaSuplier }}</td>
                                        <td>
                                            @foreach ($sessiondatamenu as $action )
                                            @if($action->Print == 1 && $action->IdMenu == 3)
                                                <a href="/sales/printsalesorder/{{$sd->IdSales}}" title="Print"
                                                class="btn btn-primary btn-xs" role="button"><i
                                                    class="fas fa-print"></i> Print</a>
                                            @endif

                                            @if($action->Edit == 1 && $action->IdMenu == 3)
                                                <a href="/sales/edit/{{ $sd->IdSalesDetail }}" title="Edit"
                                                class="btn btn-warning btn-xs" role="button"><i class="fas fa-pen"></i>
                                                Edit</a>
                                            @endif

                                            @if($action->Delete == 1 && $action->IdMenu == 3)
                                               <form action="/sales/delete/{{ $sd->IdSalesDetail}}" method="post">
                                                @csrf
                                                @method('put')
                                                <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                                            </form> 
                                            @endif


                                            @if($action->Check == 1 && $action->IdMenu == 3)
                                                @if($sd->StatusChecked == 0)
                                                <form action="/sales/checked/{{ $sd->IdSales}}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" class="btn btn-warning btn-xs">Checked</button>
                                                </form>
                                                @endif

                                                {{-- <form action="/sales/approved/{{ $sd->IdSales}}" method="post">
                                                    <button type="submit" class="btn btn-primary btn-xs" hidden>Approved</button>
                                                </form> --}}
                                            

                                                @if($sd->StatusChecked == 1 && $sd->StatusApproved == 0 )
                                                <form action="/sales/checked/{{ $sd->IdSales}}" method="post">
                                                    <button type="submit" class="btn btn-warning btn-xs" hidden>Checked</button>
                                                </form>
                                                @endif
                                                {{-- <form action="/sales/approved/{{ $sd->IdSales}}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" class="btn btn-primary btn-xs">Approved</button>
                                                </form> --}}
                                                
                                                @if($sd->StatusChecked == 1 && $sd->StatusApproved == 1)
                                                <form action="/sales/checked/{{ $sd->IdSales}}" method="post">
                                                    <button type="submit" class="btn btn-warning btn-xs" hidden>Checked</button>
                                                </form>
                                                @endif
                                                {{-- <form action="/sales/approved/{{ $sd->IdSales}}" method="post">
                                                    <button type="submit" class="btn btn-primary btn-xs" hidden>Approved</button>
                                                </form> --}}
                                            @endif

                                            @if($action->Approve == 1 && $action->IdMenu == 3)
                                                @if($sd->StatusApproved == 0)
                                                <form action="/sales/approved/{{ $sd->IdSales}}" method="post">
                                                    <button type="submit" class="btn btn-primary btn-xs" hidden>Approved</button>
                                                </form>
                                                @endif

                                                @if($sd->StatusChecked == 1 && $sd->StatusApproved == 0)
                                                <form action="/sales/approved/{{ $sd->IdSales}}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" class="btn btn-primary btn-xs">Approved</button>
                                                </form>
                                                @endif

                                                @if($sd->StatusChecked == 1 && $sd->StatusApproved == 1)
                                                <form action="/sales/approved/{{ $sd->IdSales}}" method="post">
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
    $(document).ready(function () {
        $('#dt-basic-example').DataTable({
            "order": []
        });
    });

</script>
@endpush
@endsection
