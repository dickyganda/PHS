@extends('layouts.main')

@section('title')
Edit Purchasing
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
                    <h2>Edit Purchasing</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div>
                            {{-- form edit sales order --}}
                            @foreach($purchasingdetail as $purchasing)
                            <form action="{{ route('purchasingupdate', $purchasing->IdPurchasingDetail) }}"
                                method="POST">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Priority</label>
                                                <select id="Priority" name="Priority" style="width: 100%"
                                                    class="form-control form-control-sm select2">
                                                    <option disabled selected>Select Priority</option>
                                                    @foreach ($priority as $priority)
                                                    <option value="{{ $priority->IdPriority }}">
                                                        {{ $priority->NamePriority }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Qty</label>
                                                <input type="text" class="form-control" id="Qty" placeholder="Qty"
                                                    name="Qty" value="{{ $purchasing->Qty }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Unit</label>
                                                <select id="Unit" name="Unit" style="width: 100%"
                                                    class="form-control form-control-sm select2">
                                                    <option disabled selected>Select Unit</option>
                                                    @foreach ($unit as $unit)
                                                    <option value="{{ $unit->IdUnit }}">
                                                        {{ $unit->NameUnit }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
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
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Payment</label>
                                                <select id="IdPayment" name="IdPayment" style="width: 100%"
                                                    class="form-control form-control-sm select2">
                                                    <option disabled selected>Select Payment</option>
                                                    @foreach ($payment as $pay)
                                                    <option value="{{ $pay->IdPayment }}">
                                                        {{ $pay->NamaPayment }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>To Departement</label>
                                                <select id="TOIdDepartement" name="TOIdDepartement" style="width: 100%"
                                                    class="form-control form-control-sm select2">
                                                    <option disabled selected>Select Departement</option>
                                                    @foreach ($departement as $depto)
                                                    <option value="{{ $depto->IdDepartement }}">
                                                        {{ $depto->NamaDepartement }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>From Departement</label>
                                                <select id="FROMIdDepartement" name="FROMIdDepartement"
                                                    style="width: 100%" class="form-control form-control-sm select2">
                                                    <option disabled selected>Select Departement</option>
                                                    @foreach ($departement as $depfrom)
                                                    <option value="{{ $depfrom->IdDepartement }}">
                                                        {{ $depfrom->NamaDepartement }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-default">Submit</button>
                            </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>


</main>
@endsection
@push('script')
<script>
    $(document).ready(function () {
        $('#Priority').select2({
            placeholder: "Select Priority"
        });

        $('#Unit').select2({
            placeholder: "Select Unit"
        });

        $('#IdSuplier').select2({
            placeholder: "Select Suplier"
        });

        $('#IdPayment').select2({
            placeholder: "Select Payment"
        });

        $('#FROMIdDepartement').select2({
            placeholder: "Select Departement"
        });

        $('#TOIdDepartement').select2({
            placeholder: "Select Departement"
        });
    });

</script>
@endpush
