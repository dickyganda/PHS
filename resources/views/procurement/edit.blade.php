@extends('layouts.main')

@section('title')
Edit Procurement
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
                    <h2>Edit Procurement</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div>
                            {{-- form edit sales order --}}
                            @foreach($procurementdetail as $procurement)
                            <form action="{{ route('procurementupdate', $procurement->IdProcurementDetail) }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Material</label>
                                                     <select id="IdMaterial" name="IdMaterial" style="width: 100%" class="form-control form-control-sm select2">
                                                            <option disabled selected>Select Material</option>
                                                            @foreach ($material as $material)
                                                            <option value="{{ $material->IdMaterial }}">
                                                                {{ $material->MaterialName }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Qty</label>
                                                <input type="text" class="form-control" id="Qty"
                                                    placeholder="Qty" name="Qty"
                                                    value="{{ $procurement->Qty }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Unit</label>
                                                {{-- <input type="text" class="form-control" id="IdUnit"
                                                    placeholder="Unit" name="IdUnit"
                                                    value="{{ $bom->IdUnit }}"> --}}
                                                    <select id="Unit" name="Unit" style="width: 100%" class="form-control form-control-sm select2">
                                                            <option disabled selected>Select Unit</option>
                                                            @foreach ($unit as $unit)
                                                            <option value="{{ $unit->IdUnit }}">
                                                                {{ $unit->NameUnit }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="text" class="form-control" id="Price"
                                                    placeholder="Price" name="Price"
                                                    value="{{ $procurement->Price }}">
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
