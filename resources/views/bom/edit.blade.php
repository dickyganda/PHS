@extends('layouts.main')

@section('title')
Edit Bom
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
                    <h2>Edit Bom</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div>
                            {{-- form edit sales order --}}
                            @foreach($bomdetail as $bom)
                            <form action="{{ route('bomupdate', $bom->IdBomDetail )}}" method="POST">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>SBU</label>
                                                <input type="text" class="form-control" id="IdSbu"
                                                    placeholder="SBU" name="IdSbu"
                                                    value="{{ $bom->Name }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Qty</label>
                                                <input type="text" class="form-control" id="Qty"
                                                    placeholder="Qty" name="Qty"
                                                    value="{{ $bom->Qty }}">
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Holding</label>
                                                <input type="text" class="form-control" id="IdHolding"
                                                    placeholder="Holding" name="IdHolding"
                                                    value="{{ $bom->NameHolding }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="text" class="form-control" id="Price"
                                                    placeholder="Price" name="Price"
                                                    value="{{ $bom->Price }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="pwd">Product</label>
                                                <input type="text" class="form-control" id="IdProduct"
                                                    placeholder="Product" name="IdProduct"
                                                    value="{{ $bom->NameProduct }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Material</label>
                                                <input type="text" class="form-control" id="IdMaterial"
                                                    placeholder="Material" name="IdMaterial"
                                                    value="{{ $bom->MaterialName }}">
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
