@extends('layouts.main')

@section('title')
Procurement
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
                    <h2>Procurement</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div>
                        <table>
            <tr>
            <td>
            {{-- <a href="/purchasing/create" class="btn btn-success btn-xs" title="Tambah Data Baru" role="button"><i class="fas fa-plus-circle"></i>Tambah</a> --}}
            </td>
            </tr>
            </table>
                        <table id="dt-basic-example" class="table table-responsive table-bordered table-hover table-striped w-100">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Code BOM</th>
                                    <th>Code Procurement</th>
                                    <th>From Departement</th>
                                    <th>To Departement</th>
                                    <th>Date Procurement</th>
                                    <th>User</th>
                                    <th>Created By</th>
                                    <th>Checked By</th>
                                    <th>Aproved By</th>
                                    <th>Date Required</th>
                                    <th>Material</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody height="10px">
                             @php $i=1 @endphp
                                @foreach ($procurementdetail as $procurement)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $procurement->BomCode }}</td>
                                    <td>{{ $procurement->CodeProcurement }}</td>
                                    <td>{{ $procurement->NamaDepartement }}</td>
                                    <td>{{ $procurement->NamaDepartement }}</td>
                                    <td>{{ $procurement->DateProcurement }}</td>
                                    <td>{{ $procurement->Name }}</td>
                                    <td>{{ $procurement->CreatedBy }}</td>
                                    <td>{{ $procurement->CheckedBy }}</td>
                                    <td>{{ $procurement->ApprovedBy }}</td>
                                    <td>{{ $procurement->DateRequired }}</td>
                                    <td>{{ $procurement->MaterialName }}</td>
                                    <td>@currency($procurement->Qty)</td>
                                    <td>{{ $procurement->NameUnit }}</td>
                                    <td>{{ $procurement->Price }}</td>
                                    <td>@currency($procurement->Total)</td>
                        <td>
                        <a href="" title="Print" class="btn btn-primary btn-xs" role="button"><i class="fas fa-print"></i> Print</a>
                            <a href="" title="Edit" class="btn btn-warning btn-xs" role="button"><i class="fas fa-pen"></i> Edit</a>
                            
                            <form action= "" method="post" >
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                            </form>
                            <a href="" title="Edit" class="btn btn-warning btn-xs" role="button"><i class="fas fa-pen"></i>Check</a>
                            <a href="" title="Edit" class="btn btn-success btn-xs" role="button"><i class="fas fa-pen"></i>Approve</a>

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