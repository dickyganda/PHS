@extends('layouts.main')
@inject('carbon', 'Carbon\Carbon')

@section('title')
Kas
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
                    <h2>Kas</h2>
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
                                @if($action->Add == 1 && $action->IdMenu == 11)
                                <tr>
                                    <td>
                                        <a href="" class="btn btn-success btn-xs" title="Tambah Data Baru"
                                            role="button" data-toggle="modal" data-target="#modaltambahdata"><i class="fas fa-plus-circle"></i>Tambah</a>
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
                                        <th>Description</th>
                                        <th>Date</th>
                                        <th>Debit</th>
                                        <th>Kredit</th>
                                        <th>Saldo</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody height="10px">
                                    @php $i=1 @endphp
                                    @foreach ($t_kas as $kas)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $kas->Keterangan }}</td>
                                        <td>{{ $carbon::parse($kas->TglKas)->format('d/m/Y H:i:s') }}</td>
                                        <td> @currency($kas->Debit) </td>
                                        <td> @currency($kas->Kredit) </td>
                                        <td> @currency($kas->SaldoKas) </td>
                                        <td>{{ $kas->Name }}</td>
                                        <td>
                                            @foreach ($sessiondatamenu as $action )
                                            @if($action->Print == 1 && $action->IdMenu == 11)
                                            {{-- <a href="/sales/printsalesorder/{{$sd->IdSales}}" title="Print"
                                                class="btn btn-primary btn-xs" role="button"><i
                                                    class="fas fa-print"></i> Print</a> --}}
                                            @endif

                                            @if($action->Edit == 1 && $action->IdMenu == 11)
                                            {{-- <a href="/sales/edit/{{ $sd->IdSalesDetail }}" title="Edit"
                                                class="btn btn-warning btn-xs" role="button"><i class="fas fa-pen"></i>
                                                Edit</a> --}}
                                            @endif

                                            @if($action->Delete == 1 && $action->IdMenu == 11)
                                            <form action="/kas/delete/{{ $kas->IdKas}}" method="post">
                                                @csrf
                                                @method('put')
                                                <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                                            </form>
                                            @endif
                                            @endforeach

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6">Total Saldo</td>
                                        <td>@currency($dataSaldo->Debit - $dataSaldo->Kredit)</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        {{-- modal insert kas --}}
                        <div class="modal fade" id="modaltambahdata">
                            <div class="modal-dialog">
                                <div class="modal-content">
    
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tambah Transaksi Kas</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
    
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form id="tambahkas" method="post">
                                            {{ csrf_field() }}
    
                                            <div class="form-group">
                                                <select id="debit_kredit" name="type" class="form-control form-control-sm select2" style="width:100%;" required>
                                                    <option></option>
                                                    <option value="1">Debit</option>
                                                    <option value="0">Kredit</option>
                                                </select>
                                            </div>
    
                                            <div class="form-group">
                                                <input type="number" name="jumlah" class="form-control form-control-sm" placeholder="Jumlah Rupiah">
                                            </div>
    
                                            <div class="form-group">
                                                <input type="text" name="Keterangan" class="form-control form-control-sm" placeholder="Keterangan">
                                            </div>
    
                                            <br>
                                            <button class="btn btn-primary btn-xs" type="submit">Tambah</button>
                                        </form>
                                    </div>
    
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> --}}
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

    $("#tambahkas").submit(function(event) {
                    event.preventDefault();
                    var formdata = new FormData(this);
                    $.ajax({
                        type: 'POST'
                        , dataType: 'json'
                        , url: '/kas/store'
                        , data: formdata
                        , contentType: false
                        , cache: false
                        , processData: false
                        , success: function(data) {
                            Swal.fire(
                                'Sukses!', data.reason, 'success'
                            ).then(() => {
                                location.replace("/kas/index");
                            });
                        }
                    });
                });

                

</script>
@endpush
@endsection
