@extends('layouts.main')
@inject('carbon', 'Carbon\Carbon')

@section('title')
BOM
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
                    <h2>BOM</h2>
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
                                    @if($action->Add == 1 && $action->IdMenu == 4)
                                    <tr>
                                        <td>
                                            <a href="/bom/create" class="btn btn-success btn-xs" title="Tambah Data Baru"
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
                                        <th>BomCode</th>
                                        <th>BomDate</th>
                                        <th>SBU</th>
                                        <th>Holding</th>
                                        <th>Product</th>
                                        <th>Material</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Unit</th>
                                        <th>Action</th>


                                    </tr>
                                </thead>
                                <tbody height="10px">
                                    @php $i=1 @endphp
                                    @foreach ($bomdetail as $bom)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $bom->BomCode }}</td>
                                        <td>{{ $carbon::parse($bom->BomDate)->format('d/m/Y H:i:s') }}</td>
                                        <td>{{ $bom->Name }}</td>
                                        <td>{{ $bom->NameHolding }}</td>
                                        <td>{{ $bom->NameProduct }}</td>
                                        <td>{{ $bom->MaterialName }}</td>
                                        <td>@currency($bom->Qty)</td>
                                        <td>@currency($bom->Price)</td>
                                        <td>{{ $bom->NameUnit }}</td>
                                        <td>
                                            @foreach ($sessiondatamenu as $action )
                                                @if($action->Edit == 1 && $action->IdMenu == 4)
                                                <a href="/bom/edit/{{ $bom->IdBomDetail }}" class="btn btn-warning btn-xs"
                                                    role="button">Edit</a>
                                                @endif

                                                @if($action->Delete == 1 && $action->IdMenu == 4)
                                                <form action="/bom/delete/{{ $bom->IdBomDetail}}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                                                </form>
                                                @endif

                                                @if($action->Check == 1 && $action->IdMenu == 4)
                                                @if($bom->StatusCheckedBom == 0)
                                                <form action="/bom/checked/{{ $bom->IdBom}}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" class="btn btn-warning btn-xs">Checked</button>
                                                </form>
                                                @endif

                                                @if($bom->StatusCheckedBom == 1 && $bom->StatusApprovedBom == 0 )
                                            <form action="/bom/checked/{{ $bom->IdBom}}" method="post">
                                                <button type="submit" class="btn btn-warning btn-xs"
                                                    hidden>Checked</button>
                                            </form>
                                            @endif

                                            @if($bom->StatusCheckedBom == 1 && $bom->StatusApprovedBom == 1)
                                            <form action="/bom/checked/{{ $bom->IdBom}}" method="post">
                                                <button type="submit" class="btn btn-warning btn-xs"
                                                    hidden>Checked</button>
                                            </form>
                                            @endif
                                                @endif

                                                @if($action->Approve == 1 && $action->IdMenu == 4)
                                                @if($bom->StatusApprovedBom == 0)
                                                <form action="/bom/approved/{{ $bom->IdBom}}" method="post">
                                                    <button type="submit" class="btn btn-primary btn-xs"
                                                        hidden>Approved</button>
                                                </form>
                                                @endif

                                                @if($bom->StatusCheckedBom == 1 && $bom->StatusApprovedBom == 0)
                                            <form action="/bom/approved/{{ $bom->IdBom}}" method="post">
                                                @csrf
                                                @method('put')
                                                <button type="submit" class="btn btn-primary btn-xs">Approved</button>
                                            </form>
                                            @endif

                                            @if($bom->StatusCheckedBom == 1 && $bom->StatusApprovedBom == 1)
                                            <form action="/bom/approved/{{ $bom->IdBom}}" method="post">
                                                <button type="submit" class="btn btn-primary btn-xs"
                                                    hidden>Approved</button>
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
