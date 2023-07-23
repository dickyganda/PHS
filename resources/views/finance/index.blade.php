@extends('layouts.main')
@inject('carbon', 'Carbon\Carbon')

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
                            @php
            use Illuminate\Support\Facades\Session;

                $sessiondatamenu = Session::get('datamenu');
                $sessionmenu = Session::get('menu');
                @endphp
                            <table>
                                @foreach ($sessiondatamenu as $action )
                                    @if($action->Add == 1 && $action->IdMenu == 6)
                                    <tr>
                                        <td>
                                            <a href="/finance/create" class="btn btn-success btn-xs"
                                                title="Tambah Data Baru" role="button"><i
                                                    class="fas fa-plus-circle"></i>Tambah</a>
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
                                        <th>Code Invoice</th>
                                        <th>Code SJ</th>
                                        <th>Sales Order</th>
                                        <th>Invoice Date</th>
                                        <th>Due Date</th>
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
                                        <td>{{ $finance->CodeInvoice }}</td>
                                        <td>{{ $finance->CodeIssued }}</td>
                                        <td>{{ $finance->CodeInvoice }}</td>
                                        <td>{{ $carbon::parse($finance->CreatedAt)->format('d/m/Y H:i:s')}}</td>
                                        <td>{{ $finance->DueDate }}</td>
                                        <td>{{ $finance->NameProduct }}</td>
                                        <td>@currency($finance->Qty)</td>
                                        <td>{{ $finance->NameUnit }}</td>
                                        <td>@currency($finance->HargaSatuan)</td>
                                        <td>@currency($finance->Amount)</td>
                                        <td>{{ $finance->Name }}</td>
                                        <td>{{ $finance->Name }}</td>
                                        <td>{{ $finance->Name }}</td>
                                        <td>{{ $carbon::parse($finance->DateRequired)->format('d/m/Y H:i:s') }}</td>
                                        <td>{{ $finance->NamaPayment }}</td>
                                        <td>{{ $finance->NamaSuplier }}</td>
                                        <td>
                                            <a href="/finance/printinvoice/{{$finance->IdInvoice}}" title="Print"
                                                class="btn btn-primary btn-xs" role="button"><i
                                                    class="fas fa-print"></i> Print</a>
                                            <a href="/finance/edit/{{ $finance->IdInvoiceDetail }}" title="Edit"
                                                class="btn btn-warning btn-xs" role="button"><i class="fas fa-pen"></i>
                                                Edit</a>
                                            <form action="/finance/delete/{{ $finance->IdInvoiceDetail}}" method="post">
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
