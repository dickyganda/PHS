@extends('layouts.main')

@section('title')
Insert BOM
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
                    <h2>Insert BOM</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div>
                            {{-- form insert sales order --}}
                            <form action="/bom/store" method="POST" id="insertbom">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Code Sales</label>
                                            <select id="IdSales" name="IdSales" style="width: 100%"
                                                class="form-control form-control-sm select2">
                                                <option disabled selected>Select Code Sales</option>
                                                @foreach ($sales as $sales)
                                                <option value="{{ $sales->IdSales }}">
                                                    {{ $sales->CodeSales }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>SBU</label>
                                            <select id="IdSbu" name="IdSbu" style="width: 100%"
                                                class="form-control form-control-sm select2">
                                                <option disabled selected>Select SBU</option>
                                                @foreach ($sbu as $sbu)
                                                <option value="{{ $sbu->IdSbu }}">
                                                    {{ $sbu->Name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Holding</label>
                                            <select id="IdHolding" name="IdHolding" style="width: 100%"
                                                class="form-control form-control-sm select2">
                                                <option disabled selected>Select Holding</option>
                                                @foreach ($holding as $hold)
                                                <option value="{{ $hold->IdHolding }}">
                                                    {{ $hold->NameHolding }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Product</label>
                                        <select id="IdProduct" name="IdProduct" style="width: 100%"
                                            class="form-control form-control-sm select2">
                                            <option disabled selected>Select Product</option>
                                            @foreach ($product as $p)
                                            <option value="{{ $p->IdProduct }}">
                                                {{ $p->NameProduct }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <table id="form_bom">
                                    <tr>
                                        <th>Material</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Unit</th>
                                    </tr>

                                    <tr>
                                        <td id="col0">
                                            <div class="form-group">
                                                <select id="IdMaterial" name="IdMaterial[]" style="width: 100%"
                                                    class="form-control form-control-sm select2"
                                                    onchange="selectTypeProduct(this)">
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
                                                <input type="text" class="form-control" id="Qty" placeholder="Qty"
                                                    name="Qty[]"
                                                    onkeyup="sum(this.parentElement.parentElement.parentElement);">
                                            </div>
                                        </td>

                                        <td id="col2">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="Price" placeholder="Price"
                                                    name="Price[]"
                                                    onkeyup="sum(this.parentElement.parentElement.parentElement);">
                                            </div>
                                        </td>

                                        <td id="col3">
                                            <div class="form-group">
                                                <select id="IdUnit" name="IdUnit[]" style="width: 100%"
                                                    class="form-control form-control-sm select2">
                                                    <option disabled selected>Select Unit</option>
                                                    @foreach ($unit as $u)
                                                    <option value="{{ $u->IdUnit }}">
                                                        {{ $u->NameUnit }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>

                                    </tr>
                                </table>
                                <table>
                                    <tr>
                                        <td><input type="button" class="btn btn-primary btn-xs" value="Add Row"
                                                onclick="addRows()" /></td>
                                        <td><input type="button" class="btn btn-danger btn-xs" value="Delete Row"
                                                onclick="deleteRows()" />
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
    $(document).ready(function () {
        $('#IdMaterial').select2({
            placeholder: "Select Material"
        });

        $('#IdUnit').select2({
            placeholder: "Select Unit"
        });

        $('#IdProduct').select2({
            placeholder: "Select Product"
        });

        $('#IdHolding').select2({
            placeholder: "Select Holding"
        });

        $('#IdSbu').select2({
            placeholder: "Select Sbu"
        });

        $('#IdSales').select2({
            placeholder: "Select Code Sales"
        });
    });

    function addRows() {
        $('#IdMaterial').select2("destroy");
        $('#IdUnit').select2("destroy");
        var table = document.getElementById('form_bom');
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
        var table = document.getElementById('form_bom');
        var rowCount = table.rows.length;
        if (rowCount > '2') {
            var row = table.deleteRow(rowCount - 1);
            rowCount--;
        } else {
            alert('There should be atleast one row');
        }
    }

    function selectTypeProduct(item) {
        var parent = item.parentElement.parentElement.parentElement;
        var formdata = new FormData();
        formdata.append('IdProduct', item.options[item.selectedIndex].value);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '/sales/getproduct',
            data: formdata,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                parent.querySelector("#IdHarga").value = data.HargaSatuan;
                // $('#harga_barang').val(data.harga_barang);
            }
        })
    }

    function sum(tableRow) {
        var txtFirstNumberValue = tableRow.querySelector("#Qty").value;
        var txtSecondNumberValue = tableRow.querySelector("#IdHarga").value;
        var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
        if (!isNaN(result)) {
            tableRow.querySelector("#Amount").value = result;
        }
    }

    $("#insertbom").submit(function (event) {
        event.preventDefault();
        var formdata = new FormData(this);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '/bom/store',
            data: formdata,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                Swal.fire(
                    'Sukses!',
                    data.reason,
                    'success'
                ).then(() => {
                    location.replace("/bom/index");
                });
            }
        });
    });

</script>
@endpush
