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
                        {{-- form insert purchasing --}}
                        <form action={{route('sales.store')}} method="POST">
                        @csrf
                        <div class="form-group">
    <div class="row">
    <div class="col-lg-2">
    <div class="form-group">
      <label>Priority</label>
      {{-- <input type="text" class="form-control" id="FROMIdDepartementFK" placeholder="FROMIdDepartementFK" name="FROMIdDepartementFK"> --}}
      <select id="Priority" name="Priority" style="width: 100%" class="form-control form-control-sm select2">
                                                            <option disabled selected>Pilih Priority</option>
                                                            {{-- @foreach ($databarang as $penjualan) --}}
                                                            {{-- <option value="{{ $penjualan->id_barang }}"> --}}
                                                                {{-- {{ $penjualan->nama_barang }} --}}
                                                            </option>
                                                            {{-- @endforeach --}}
                                                        </select>
    </div>
    </div>

<div class="col-lg-2">
    <div class="form-group">
      <label>Material</label>
      <input type="text" class="form-control" id="Material" placeholder="Material" name="Material">
    </div>
    </div>

    <div class="col-lg-2">
    <div class="form-group">
      <label>Qty</label>
      <input type="number" class="form-control" id="Qty" placeholder="Qty" name="Qty">
    </div>
    </div>

    <div class="col-lg-2">
    <div class="form-group">
      <label>Unit</label>
      <input type="text" class="form-control" id="Unit" placeholder="Unit" name="Unit">
    </div>
    </div>

    <div class="col-lg-2">
    <div class="form-group">
      <label>Price</label>
      <input type="text" class="form-control" id="Price" placeholder="Price" name="Price">
    </div>
    </div>

    <div class="col-lg-2">
    <div class="form-group">
      <label>Total</label>
      <input type="text" class="form-control" id="Total" placeholder="Total" name="Total">
    </div>
    </div>

      {{-- <input type="text" class="form-control" id="IdSales" placeholder="" name="IdSales" hidden> --}}
    </div>
    
    <button type="submit" class="btn btn-default">Add Row</button>
    <button type="submit" class="btn btn-default">Delete Row</button>
    <button type="submit" class="btn btn-default">Submit</button>
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