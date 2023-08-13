@extends('layouts.main')

@section('title')
Insert Warehouse In
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
                    <h2>Insert Warehouse In</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div>
                            {{-- form insert sales order --}}
                            <form action="/warehouse/store" method="POST" id="insertwarehouse">
                                @csrf

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Code Purchasing</label>
                                            <select id="IdPurchasing" name="IdPurchasing" style="width: 100%"
                                                class="form-control form-control-sm select2">
                                                <option disabled selected>Select Code Purchasing</option>
                                                @foreach ($purchasing as $purchasing)
                                                <option value="{{ $purchasing->IdPurchasing }}">
                                                    {{ $purchasing->CodePurchasing }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Material</label>
                                            <select id="IdMaterial" name="IdMaterial" style="width: 100%"
                                                class="form-control form-control-sm select2">
                                                <option disabled selected>Select Material</option>
                                                @foreach ($material as $material)
                                                <option value="{{ $material->IdMaterial }}">
                                                    {{ $material->MaterialName }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Suplier</label>
                                            <select id="IdSuplier" name="IdSuplier" style="width: 100%"
                                                class="form-control form-control-sm select2">
                                                <option disabled selected>Select Suplier</option>
                                                @foreach ($suplier as $suplier)
                                                <option value="{{ $suplier->IdSuplier }}">
                                                    {{ $suplier->NamaSuplier }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>In</label>
                                            <input type="text" class="form-control" id="In"
                                                    placeholder="In" name="In">
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-success btn-xs" value="Submit" />
                                </div>

                                

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
        $('#IdPurchasing').select2({
            placeholder: "Select Purchasing"
        });

        $('#IdSuplier').select2({
            placeholder: "Select Suplier"
        });

        $('#IdMaterial').select2({
            placeholder: "Select Material"
        });
    });

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

    $("#insertwarehouse").submit(function (event) {
        event.preventDefault();
        var formdata = new FormData(this);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '/warehouse/store',
            data: formdata,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.status == 'failed') {
                        Swal.fire(
                            'Gagal'
                            , data.reason
                            , 'error'
                        );
                    } else {
                        Swal.fire(
                    'Sukses!',
                    data.reason,
                    'success'
                ).then(() => {
                    location.replace("/warehouse/index");
                });
                    }
                
            }
        });
    });

</script>
@endpush
