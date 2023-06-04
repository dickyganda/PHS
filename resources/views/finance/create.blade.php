@extends('layouts.main')

@section('title')
Insert Invoice
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
                    <h2>Insert Invoice</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div>
                            {{-- form insert sales order --}}
                            <form action="/finance/store" method="POST" id="insertfinance">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Sales From</label>
                                            <select id="SOFrom" name="SOFrom" style="width: 100%"
                                                class="form-control form-control-sm select2">
                                                <option disabled selected>Select SO From</option>
                                                @foreach ($buyer as $buy)
                                                <option value="{{ $buy->IdBuyer }}">
                                                    {{ $buy->NamaBuyer }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Invoice To</label>
                                            <select id="InvoiceTo" name="InvoiceTo" style="width: 100%"
                                                class="form-control form-control-sm select2">
                                                <option disabled selected>Select Invoice To</option>
                                                @foreach ($buyer as $buy)
                                                <option value="{{ $buy->IdBuyer }}">
                                                    {{ $buy->NamaBuyer }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Ship Date</label>
                                            <input type="date" class="form-control" id="ShipDate" placeholder="ShipDate"
                                                name="ShipDate">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Due Date</label>
                                            <input type="date" class="form-control" id="DueDate" placeholder="DueDate"
                                                name="DueDate">
                                        </div>
                                    </div>
                                </div>

                                <table id="form_finance">
                                    <tr>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th>Rate</th>
                                        <th>Amount</th>
                                        <th>From Departement</th>
                                        <th>To Departement</th>
                                        <th>Date Required</th>
                                        <th>Payment Date</th>
                                        <th>Payment</th>
                                        <th>Suplier</th>
                                    </tr>

                                    <tr>
                                        <td id="col0">
                                            <div class="form-group">
                                                <select id="IdProduct" name="IdProduct[]" style="width: 100%"
                                                    class="form-control form-control-sm select2"
                                                    onchange="selectTypeProduct(this)">
                                                    <option disabled selected>Select Product</option>
                                                    @foreach ($product as $p)
                                                    <option value="{{ $p->IdProduct }}">
                                                        {{ $p->NameProduct }}
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

                                        <td id="col3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="IdHarga" placeholder="Rate"
                                                    name="IdHarga[]"
                                                    onkeyup="sum(this.parentElement.parentElement.parentElement);">
                                            </div>
                                        </td>

                                        <td id="col4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="Amount" placeholder="Amount"
                                                    name="Amount[]">
                                            </div>
                                        </td>

                                        <td id="col5">
                                            <div class="form-group">
                                                <select id="FROMIdDepartement" name="FROMIdDepartement[]"
                                                    style="width: 100%" class="form-control form-control-sm select2">
                                                    <option disabled selected>Select Departement</option>
                                                    @foreach ($departement as $d)
                                                    <option value="{{ $d->IdDepartement }}">
                                                        {{ $d->NamaDepartement }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>

                                        <td id="col6">
                                            <div class="form-group">
                                                <select id="TOIdDepartement" name="TOIdDepartement[]"
                                                    style="width: 100%" class="form-control form-control-sm select2">
                                                    <option disabled selected>Select Departement</option>
                                                    @foreach ($departement as $d)
                                                    <option value="{{ $d->IdDepartement }}">
                                                        {{ $d->NamaDepartement }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>

                                        <td id="col7">
                                            <div class="form-group">
                                                <input type="date" class="form-control" id="DateRequired"
                                                    placeholder="DateRequired" name="DateRequired[]">
                                            </div>
                                        </td>

                                        <td id="col8">
                                            <div class="form-group">
                                                <input type="date" class="form-control" id="PaymentDate"
                                                    placeholder="PaymentDate" name="PaymentDate[]">
                                            </div>
                                        </td>

                                        <td id="col9">
                                            <div class="form-group">
                                                <select id="IdPayment" name="IdPayment[]" style="width: 100%"
                                                    class="form-control form-control-sm select2">
                                                    <option disabled selected>Select Payment</option>
                                                    @foreach ($payment as $pay)
                                                    <option value="{{ $pay->IdPayment }}">
                                                        {{ $pay->NamaPayment }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>

                                        <td id="col10">
                                            <div class="form-group">
                                                <select id="IdSuplier" name="IdSuplier[]" style="width: 100%"
                                                    class="form-control form-control-sm select2">
                                                    <option disabled selected>Select Suplier</option>
                                                    @foreach ($suplier as $sup)
                                                    <option value="{{ $sup->IdSuplier }}">
                                                        {{ $sup->NamaSuplier }}
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
        $('#IdProduct').select2({
            placeholder: "Select Product"
        });

        $('#IdUnit').select2({
            placeholder: "Select Unit"
        });

        $('#FROMIdDepartement').select2({
            placeholder: "Select Departement"
        });

        $('#TOIdDepartement').select2({
            placeholder: "Select Departement"
        });

        $('#IdPayment').select2({
            placeholder: "Select Payment"
        });

        $('#IdSuplier').select2({
            placeholder: "Select Suplier"
        });

        $('#SOFrom').select2({
            placeholder: "Select SO From"
        });

        $('#InvoiceTo').select2({
            placeholder: "Select Invoice To"
        });
    });

    function addRows() {
        $('#IdProduct').select2("destroy");
        $('#IdUnit').select2("destroy");
        $('#FROMIdDepartement').select2("destroy");
        $('#TOIdDepartement').select2("destroy");
        $('#IdPayment').select2("destroy");
        $('#IdSuplier').select2("destroy");
        var table = document.getElementById('form_finance');
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
        $(".select2").select2();
        $(".select2").select2();
        $(".select2").select2();
        $(".select2").select2();
    }

    function deleteRows() {
        var table = document.getElementById('form_finance');
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
            url: '/finance/getproduct',
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

    $("#insertfinance").submit(function (event) {
        event.preventDefault();
        var formdata = new FormData(this);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '/finance/store',
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
                    location.replace("/finance/index");
                });
            }
        });
    });

</script>
@endpush
