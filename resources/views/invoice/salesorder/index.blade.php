@extends('layouts.main')

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
                        <table>
            <tr>
            <td>
            <a href="/invoice/salesorder/viewinsertsalesorder" class="btn btn-success btn-xs" title="Tambah Data Baru" role="button"><i class="fas fa-plus-circle"></i>Tambah</a>
            </td>
            </tr>
            </table>
                        <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>User</th>
                                    <th>From Departement</th>
                                    <th>To Departement</th>
                                    <th>Created By</th>
                                    <th>Checked By</th>
                                    <th>Approved By</th>
                                    <th>Date Required</th>
                                    <th>Payment Date</th>
                                    <th>Payment</th>
                                    <th>Suplier</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody height="10px">
                                @php $i=1 @endphp
                                @foreach ($SalesDetail as $sales)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $sales->IdUserFK }}</td>
                                    <td>{{ $sales->FROMIdDepartementFK }}</td>
                                    <td>{{ $sales->TOIdDepartementFK }}</td>
                                    <td>{{ $sales->CreatedBy }}</td>
                                    <td>{{ $sales->CheckedBy }}</td>
                                    <td>{{ $sales->ApprovedBy }}</td>
                                    <td>{{ $sales->DateRequired }}</td>
                                    <td>{{ $sales->PaymentDate }}</td>
                                    <td>{{ $sales->IdPaymentFK }}</td>
                                    <td>{{ $sales->IdSuplierFK }}</td>
                        <td>

                            <a href="/datapelanggan/editpelanggan/" title="Edit" class="btn btn-warning btn-xs" role="button"><i class="fas fa-pen"></i></a>

                            <a href="#" title="Hapus" class="btn btn-danger btn-xs" role="button"><i class="fas fa-trash"></i></a>
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

@push('script')
<script src="{{asset('assets/js/vendors.bundle.js') }}"></script>
<script src="{{asset('assets/js/app.bundle.js') }}"></script>
<script src="{{asset('assets/js/datagrid/datatables/datatables.bundle.js') }}"></script>
<script>
$(document).ready(function()
            {
                // initialize datatable
                $('#dt-basic-example').dataTable(
                {
                    responsive: true,
                    columnDefs: [
                    {
                        targets: -1,
                        title: 'Admin Controls',
                        orderable: false,
                        render: function(data, type, full, meta)
                        {

                            /*
                            -- ES6
                            -- convert using https://babeljs.io online transpiler
                            return `
                            <div class='d-flex mt-2'>
                            	<a href='javascript:void(0);' class='btn btn-sm btn-outline-danger mr-2' title='Delete Record'>
                            		<i class="fal fa-times"></i> Delete Record
                            	</a>
                            	<a href='javascript:void(0);' class='btn btn-sm btn-outline-primary mr-2' title='Edit'>
                            		<i class="fal fa-edit"></i> Edit
                            	</a>
                            	<div class='dropdown d-inline-block'>
                            		<a href='#'' class='btn btn-sm btn-outline-primary mr-2' data-toggle='dropdown' aria-expanded='true' title='More options'>
                            			<i class="fal fa-plus"></i>
                            		</a>
                            		<div class='dropdown-menu'>
                            			<a class='dropdown-item' href='javascript:void(0);'>Change Status</a>
                            			<a class='dropdown-item' href='javascript:void(0);'>Generate Report</a>
                            		</div>
                            	</div>
                            </div>`;
                            	
                            ES5 example below:	

                            */
                            return "\n\t\t\t\t\t\t<div class='d-flex mt-2'>\n\t\t\t\t\t\t\t<a href='javascript:void(0);' class='btn btn-sm btn-outline-danger mr-2' title='Delete Record'><i class=\"fal fa-times\"></i> Delete Record</a>\n\t\t\t\t\t\t\t<a href='javascript:void(0);' class='btn btn-sm btn-outline-primary mr-2' title='Edit'><i class=\"fal fa-edit\"></i> Edit</a>\n\t\t\t\t\t\t\t<div class='dropdown d-inline-block'>\n\t\t\t\t\t\t\t\t<a href='#'' class='btn btn-sm btn-outline-primary mr-2' data-toggle='dropdown' aria-expanded='true' title='More options'><i class=\"fal fa-plus\"></i></a>\n\t\t\t\t\t\t\t\t<div class='dropdown-menu'>\n\t\t\t\t\t\t\t\t\t<a class='dropdown-item' href='javascript:void(0);'>Change Status</a>\n\t\t\t\t\t\t\t\t\t<a class='dropdown-item' href='javascript:void(0);'>Generate Report</a>\n\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t</div>";
                        },
                    },
                    {
                        targets: 17,
                        /*	The `data` parameter refers to the data for the cell (defined by the
                        	`data` option, which defaults to the column being worked with, in this case `data: 16`.*/
                        render: function(data, type, full, meta)
                        {
                            var badge = {
                                1:
                                {
                                    'title': 'Pending',
                                    'class': 'badge-warning'
                                },
                                2:
                                {
                                    'title': 'Delivered',
                                    'class': 'badge-success'
                                },
                                3:
                                {
                                    'title': 'Canceled',
                                    'class': 'badge-secondary'
                                },
                                4:
                                {
                                    'title': 'Attempt #1',
                                    'class': 'bg-danger-100 text-white'
                                },
                                5:
                                {
                                    'title': 'Attempt #2',
                                    'class': 'bg-danger-300 text-white'
                                },
                                6:
                                {
                                    'title': 'Failed',
                                    'class': 'badge-danger'
                                },
                                7:
                                {
                                    'title': 'Attention!',
                                    'class': 'badge-primary'
                                },
                                8:
                                {
                                    'title': 'In Progress',
                                    'class': 'badge-success'
                                },
                            };
                            if (typeof badge[data] === 'undefined')
                            {
                                return data;
                            }
                            return '<span class="badge ' + badge[data].class + ' badge-pill">' + badge[data].title + '</span>';
                        },
                    }],
                });
            });
</script>
 @endpush
@endsection