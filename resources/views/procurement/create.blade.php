@extends('layouts.main')

@section('title')
Insert Procurement
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
                    <h2>Insert Procurement</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div>
                        {{-- form insert procurement --}}
                        <form action="/procurement/store" method="POST" id="insertprocurement">
                        @csrf

                        <div class="form-group">
    <label>Code BOM</label>
      <select id="IdBom" name="IdBom" style="width: 100%" class="form-control form-control-sm select2">
                                                            <option disabled selected>Select Bom</option>
                                                            @foreach ($bom as $bom)
                                                            <option value="{{ $bom->IdBom }}">
                                                                {{ $bom->BomCode }}
                                                            </option>
                                                            @endforeach
                                                        </select>
    </div>

    <div class="form-group">
        <label>From Departement</label>
          <select id="FROMIdDepartement" name="FROMIdDepartement" style="width: 100%" class="form-control form-control-sm select2">
                                                                <option disabled selected>Select Departement</option>
                                                                @foreach ($departement as $depfrom)
                                                                <option value="{{ $depfrom->IdDepartement }}">
                                                                    {{ $depfrom->NamaDepartement }}
                                                                </option>
                                                                @endforeach
                                                            </select>
        </div>

        <div class="form-group">
            <label>To Departement</label>
              <select id="TOIdDepartement" name="TOIdDepartement" style="width: 100%" class="form-control form-control-sm select2">
                                                                    <option disabled selected>Select Departement</option>
                                                                    @foreach ($departement as $depto)
                                                                    <option value="{{ $depto->IdDepartement }}">
                                                                        {{ $depto->NamaDepartement }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
            </div>

    <table id="form_procurement">

    <tr>
    <th>Material</th>
    <th>Qty</th>
    <th>Unit</th>
    <th>Price</th>
    <th>Total</th>
    </tr>
    <tr>

    <td id="col0">
<div class="form-group">
<select id="IdMaterial" name="IdMaterial[]" style="width: 100%" class="form-control form-control-sm select2">
                                                            <option disabled selected>Select Material</option>
                                                            @foreach ($material as $mat)
                                                            <option value="{{ $mat->IdMaterial }}">
                                                                {{ $mat->MaterialName }}
                                                            </option>
                                                            @endforeach
                                                        </select>
</div>
    </td>

    <td id="col1">
    <div class="form-group">
      <input type="text" class="form-control" id="Qty" placeholder="Qty" name="Qty[]" onkeyup="sum(this.parentElement.parentElement.parentElement);">
    </div>
    </td>

    <td id="col2">
    <div class="form-group">
      <select id="Unit" name="Unit[]" style="width: 100%" class="form-control form-control-sm select2">
                                                            <option disabled selected>Select Unit</option>
                                                            @foreach ($unit as $unit)
                                                            <option value="{{ $unit->IdUnit }}">
                                                                {{ $unit->NameUnit }}
                                                            </option>
                                                            @endforeach
                                                        </select>
    </div>
    </td>

    <td id="col3">
    <div class="form-group">
      <input type="text" class="form-control" id="Price" placeholder="Price" name="Price[]" onkeyup="sum(this.parentElement.parentElement.parentElement);">
    </div>
    </td>

    <td id="col4">
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
                    $('#IdMaterial').select2({
                        placeholder: "Select Material"
                    });

                    $('#Unit').select2({
                        placeholder: "Select Unit"
                    });

                    $('#IdBom').select2({
                        placeholder: "Select BOM"
                    });

                    $('#FROMIdDepartement').select2({
                        placeholder: "Select Departement"
                    });

                    $('#TOIdDepartement').select2({
                        placeholder: "Select Departement"
                    });
                });

function addRows() {
                    $('#IdMaterial').select2("destroy");
                    $('#Unit').select2("destroy");
                    var table = document.getElementById('form_procurement');
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
                    $(".select2").select2();
                }

                function deleteRows() {
                    var table = document.getElementById('form_procurement');
                    var rowCount = table.rows.length;
                    if (rowCount > '2') {
                        var row = table.deleteRow(rowCount - 1);
                        rowCount--;
                    } else {
                        alert('There should be atleast one row');
                    }
                }

                function sum(tableRow) {
                    var txtFirstNumberValue = tableRow.querySelector("#Qty").value;
                    var txtSecondNumberValue = tableRow.querySelector("#Price").value;
                    var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
                    if (!isNaN(result)) {
                        tableRow.querySelector("#Total").value = result;
                    }
                }

    $("#insertprocurement").submit(function(event){
    event.preventDefault();
    var formdata = new FormData(this);
    $.ajax({
      type:'POST',
      dataType: 'json',
      url: '/procurement/store',
      data: formdata,
      contentType: false,
      cache: false,
      processData: false,
      success:function(data){
        Swal.fire(
          'Sukses!',
          data.reason,
          'success'
        ).then(() => {
          location.replace("/procurement/index");
        });
      }
    });
  });
</script>
@endpush