@extends('layouts.main')

@section('title')
Insert Sales Order
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
                    <h2>Insert Order</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div>
                        {{-- form insert sales order --}}
                        <form action={{route('sales.store')}} method="POST">
                        @csrf
                        <div class="form-group">
    <div class="row">
    <div class="col-lg-2">
    <div class="form-group">
      <label>Product</label>
      {{-- <input type="text" class="form-control" id="FROMIdDepartementFK" placeholder="FROMIdDepartementFK" name="FROMIdDepartementFK"> --}}
      <select id="IdProduct" name="IdProduct[]" style="width: 100%" class="form-control form-control-sm select2">
                                                            <option disabled selected>Pilih Product</option>
                                                            @foreach ($product as $p)
                                                            <option value="{{ $p->IdProduct }}">
                                                                {{ $p->NameProduct }}
                                                            </option>
                                                            @endforeach
                                                        </select>
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
      <label>Rate</label>
      <input type="text" class="form-control" id="IdHarga" placeholder="Rate" name="IdHarga">
    </div>
    </div>

    <div class="col-lg-2">
    <div class="form-group">
      <label>Amount</label>
      <input type="number" class="form-control" id="Amount" placeholder="Amount" name="Amount">
    </div>
    </div>
    <div class="col-lg-2">
    <div class="form-group">
      <label>FROM Departement</label>
      {{-- <input type="text" class="form-control" id="FROMIdDepartementFK" placeholder="FROMIdDepartementFK" name="FROMIdDepartementFK"> --}}
      <select id="FROMIdDepartement" name="FROMIdDepartement" style="width: 100%" class="form-control form-control-sm select2">
                                                            <option disabled selected>Select Departement</option>
                                                            @foreach ($departement as $d)
                                                            <option value="{{ $d->IdDepartement }}">
                                                                {{ $d->NamaDepartement }}
                                                            </option>
                                                            @endforeach
                                                        </select>
    </div>
    </div>
    <div class="col-lg-2">
    <div class="form-group">
      <label>TOIdDepartement</label>
      {{-- <input type="text" class="form-control" id="TOIdDepartementFK" placeholder="TOIdDepartementFK" name="TOIdDepartementFK"> --}}
      <select id="TOIdDepartement" name="TOIdDepartement" style="width: 100%" class="form-control form-control-sm select2">
                                                            <option disabled selected>Select Departement</option>
                                                            @foreach ($departement as $d)
                                                            <option value="{{ $d->IdDepartement }}">
                                                                {{ $d->NamaDepartement }}
                                                            </option>
                                                            @endforeach
                                                        </select>
    </div>
    </div>
    <div class="col-lg-2">
    <div class="form-group">
      <label>DateRequired</label>
      <input type="date" class="form-control" id="DateRequired" placeholder="DateRequired" name="DateRequired">
    </div>
    </div>

    <div class="col-lg-2">
    <div class="form-group">
      <label>PaymentDate</label>
      <input type="date" class="form-control" id="PaymentDate" placeholder="PaymentDate" name="PaymentDate">
    </div>
    </div>

    <div class="col-lg-2">
    <div class="form-group">
      <label>Payment</label>
      <select id="IdPayment" name="IdPayment" style="width: 100%" class="form-control form-control-sm select2">
                                                            <option disabled selected>Select Payment</option>
                                                            @foreach ($payment as $pay)
                                                            <option value="{{ $pay->IdPayment }}">
                                                                {{ $pay->NamaPayment }}
                                                            </option>
                                                            @endforeach
                                                        </select>
    </div>
    </div>

    <div class="col-lg-2">
    <div class="form-group">
      <label>IdSuplier</label>
      <select id="IdSuplier" name="IdSuplier" style="width: 100%" class="form-control form-control-sm select2">
                                                            <option disabled selected>Select Suplier</option>
                                                            @foreach ($suplier as $sup)
                                                            <option value="{{ $sup->IdSuplier }}">
                                                                {{ $sup->NamaSuplier }}
                                                            </option>
                                                            @endforeach
                                                        </select>
    </div>
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