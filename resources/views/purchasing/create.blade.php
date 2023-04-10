@extends('layouts.main')

@section('title')
Insert Purchasing
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
                    <h2>Insert Purchasing</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div>
                        {{-- form insert sales order --}}
                        <form action={{route('sales.store')}} method="POST">
                        @csrf
                       
    <table id="form_purchasing">
    <tr>
    <th>Procurement</th>
    <th>BOM</th>
    <th>From Departement</th>
    <th>To Departement</th>
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
    </tr>
    <tr>

    <td id="col0">
<div class="form-group">
<select id="IdProcurement" name="IdProcurement[]" style="width: 100%" class="form-control form-control-sm select2">
                                                            <option disabled selected>Select Procurement</option>
                                                            @foreach ($procurement as $p)
                                                            <option value="{{ $p->IdProcurement }}">
                                                                {{ $p->CodeProcurement }}
                                                            </option>
                                                            @endforeach
                                                        </select>
</div>
    </td>

    <td id="col1">
<div class="form-group">
<select id="IdBom" name="IdBom[]" style="width: 100%" class="form-control form-control-sm select2">
                                                            <option disabled selected>Select BOM</option>
                                                            @foreach ($bom as $b)
                                                            <option value="{{ $b->IdBom }}">
                                                                {{ $b->BomCode }}
                                                            </option>
                                                            @endforeach
                                                        </select>
</div>
    </td>

    <td id="col2">
    <div class="form-group">
      <select id="FROMIdDepartement" name="FROMIdDepartement[]" style="width: 100%" class="form-control form-control-sm select2">
                                                            <option disabled selected>Select Departement</option>
                                                            @foreach ($departement as $d)
                                                            <option value="{{ $d->IdDepartement }}">
                                                                {{ $d->NamaDepartement }}
                                                            </option>
                                                            @endforeach
                                                        </select>
    </div>
    </td>

    <td id="col3">
    <div class="form-group">
      <select id="TOIdDepartement" name="TOIdDepartement[]" style="width: 100%" class="form-control form-control-sm select2">
                                                            <option disabled selected>Select Departement</option>
                                                            @foreach ($departement as $d)
                                                            <option value="{{ $d->IdDepartement }}">
                                                                {{ $d->NamaDepartement }}
                                                            </option>
                                                            @endforeach
                                                        </select>
    </div>
    </td>

    <td id="col4">
    <div class="form-group">
      <input type="date" class="form-control" id="DatePurchasing" placeholder="Date Purchasing" name="DatePurchasing[]">
    </div>
    </td>

    <td id="col5">
    <div class="form-group">
      <input type="date" class="form-control" id="DateRequired" placeholder="DateRequired" name="DateRequired[]">
    </div>
    </td>

    <td id="col6">
    <div class="form-group">
      <input type="date" class="form-control" id="PaymentDate" placeholder="PaymentDate" name="PaymentDate[]">
    </div>
    </td>

<td id="col7">
    <div class="form-group">
      <select id="IdPayment" name="IdPayment[]" style="width: 100%" class="form-control form-control-sm select2">
                                                            <option disabled selected>Select Payment</option>
                                                            @foreach ($payment as $pay)
                                                            <option value="{{ $pay->IdPayment }}">
                                                                {{ $pay->NamaPayment }}
                                                            </option>
                                                            @endforeach
                                                        </select>
    </div>
    </td>

    <td id="col8">
    <div class="form-group">
      <select id="IdSuplier" name="IdSuplier[]" style="width: 100%" class="form-control form-control-sm select2">
                                                            <option disabled selected>Select Suplier</option>
                                                            @foreach ($suplier as $sup)
                                                            <option value="{{ $sup->IdSuplier }}">
                                                                {{ $sup->NamaSuplier }}
                                                            </option>
                                                            @endforeach
                                                        </select>
    </div>
    </td>

    <td id="col9">
    <div class="form-group">
      <select id="IdPriority" name="IdPriority[]" style="width: 100%" class="form-control form-control-sm select2">
                                                            <option disabled selected>Select Priority</option>
                                                            @foreach ($priority as $pri)
                                                            <option value="{{ $pri->IdPriority }}">
                                                                {{ $pri->NamePriority }}
                                                            </option>
                                                            @endforeach
                                                        </select>
    </div>
    </td>

    <td id="col10">
    <div class="form-group">
      <select id="IdMaterial" name="IdMaterial[]" style="width: 100%" class="form-control form-control-sm select2">
                                                            <option disabled selected>Select Material</option>
                                                            @foreach ($material as $m)
                                                            <option value="{{ $m->IdMaterial }}">
                                                                {{ $m->MaterialCode }}
                                                            </option>
                                                            @endforeach
                                                        </select>
    </div>
    </td>

    <td id="col11">
    <div class="form-group">
      <input type="text" class="form-control" id="Qty" placeholder="Qty" name="Qty[]">
    </div>
    </td>

    <td id="col12">
    <div class="form-group">
      <select id="IdUnit" name="IdUnit[]" style="width: 100%" class="form-control form-control-sm select2">
                                                            <option disabled selected>Select Unit</option>
                                                            @foreach ($unit as $u)
                                                            <option value="{{ $u->IdUnit }}">
                                                                {{ $u->NameUnit }}
                                                            </option>
                                                            @endforeach
                                                        </select>
    </div>
    </td>

    <td id="col13">
    <div class="form-group">
      <input type="text" class="form-control" id="Price" placeholder="Price" name="Price[]">
    </div>
    </td>

    <td id="col14">
    <div class="form-group">
      <input type="text" class="form-control" id="Total" placeholder="Total" name="Total[]">
    </div>
    </td>
    </tr>
</table>
<table>
                                            <tr>
                                                <td><input type="button" class="btn btn-primary btn-xs" value="Add Row" onclick="addRows()" /></td>
                                                <td><input type="button" class="btn btn-danger btn-xs" value="Delete Row" onclick="deleteRows()" />
                                                </td>
                                                <td><input type="submit" class="btn btn-success btn-xs" value="Submit" /></td>
                                            </tr>
                                        </table>

  </form>
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
@endsection
@push('script')
<script>
$(document).ready(function() {
                    $('#IdProduct').select2({
                        placeholder: "Select Product"
                    });
                });

function addRows() {
                    //$('#IdProduct').select2("destroy");
                    var table = document.getElementById('form_purchasing');
                    var rowCount = table.rows.length;
                    var cellCount = table.rows[0].cells.length;
                    var row = table.insertRow(rowCount);
                    for (var i = 0; i < cellCount; i++) {
                        // console.log('col' + i);
                        var cell = 'cell' + i;
                        cell = row.insertCell(i);
                        var copycel = document.getElementById('col' + i).innerHTML;
                        cell.innerHTML = copycel;
                    }
                    $(".select2").select2();
                }

                function deleteRows() {
                    var table = document.getElementById('form_sales');
                    var rowCount = table.rows.length;
                    if (rowCount > '2') {
                        var row = table.deleteRow(rowCount - 1);
                        rowCount--;
                    } else {
                        alert('There should be atleast one row');
                    }
                }
</script>
@endpush