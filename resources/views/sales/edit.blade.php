@extends('layouts.main')

@section('title')
Edit Sales Order
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
                    <h2>Edit Order</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div>
                        {{-- form edit sales order --}}
                        @foreach($salesdetail as $sales)
                        <form action={{ route('salesupdate', $sales->IdSalesDetail) }} method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
      {{-- <label>ID BOM</label> --}}
      {{-- <div class="row">
      <div class="col-lg-6">
    <div class="form-group">
      <label>ID Sales</label>
      <input type="text" class="form-control" id="IdSalesFK" placeholder="ID Sales" name="IdSalesFK">
    </div>
    </div>
      </div> --}}
    <div class="row">
    {{-- <div class="col-lg-6">
    <div class="form-group">
      <label>ID User</label>
      <input type="text" class="form-control" id="IdUserFK" placeholder="User" name="IdUserFK">
    </div>
    </div> --}}
    <div class="col-lg-6">
    <div class="form-group">
      <label>TOIdDepartementFK</label>
      {{-- <input type="text" class="form-control" id="TOIdDepartementFK" placeholder="TOIdDepartementFK" name="TOIdDepartementFK" value="{{ $salesdetail->TOIdDepartement }}"> --}}
      {{-- <select id="TOIdDepartement" name="TOIdDepartement" style="width: 100%" class="form-control form-control-sm select2">
                                                            <option disabled selected>Select Departement</option>
                                                            @foreach ($salesdetail as $sale)
                                                            <option value="{{ $sale->TOIdDepartement }}">
                                                                {{ $sale->TOIdDepartement }}
                                                            </option>
                                                            @endforeach
                                                        </select> --}}

      <input type="text" class="form-control" id="TOIdDepartementFK" placeholder="TOIdDepartementFK" name="TOIdDepartement" value="{{ $sales->TOIdDepartement }}">

    </div>
    </div>
    </div>
    <div class="row">
    <div class="col-lg-6">
    <div class="form-group">
      <label>FROMIdDepartementFK</label>
      <input type="text" class="form-control" id="FROMIdDepartementFK" placeholder="FROMIdDepartement" name="FROMIdDepartement" value="{{ $sales->FROMIdDepartement }}">
    </div>
    </div>
    {{-- <div class="col-lg-6">
    <div class="form-group">
      <label for="pwd">CreatedBy</label>
      <input type="text" class="form-control" id="CreatedBy" placeholder="CreatedBy" name="CreatedBy">
    </div>
    </div> --}}
    </div>
    <div class="row">
    <div class="col-lg-6">
    <div class="form-group">
      <label for="pwd">CheckedBy</label>
      <input type="text" class="form-control" id="CheckedBy" placeholder="CheckedBy" name="CheckedBy" value="{{ $sales->CheckedBy }}">
    </div>
    </div>
    <div class="col-lg-6">
    <div class="form-group">
      <label>ApprovedBy</label>
      <input type="text" class="form-control" id="ApprovedBy" placeholder="ApprovedBy" name="ApprovedBy" value="{{ $sales->ApprovedBy }}">
    </div>
    </div>
    </div>
    <div class="row">
    {{-- <div class="col-lg-6">
    <div class="form-group">
      <label>DateRequired</label>
      <input type="date" class="form-control" id="DateRequired" placeholder="DateRequired" name="DateRequired" value="{{ $salesdetail->DateRequired }}">
    </div>
    </div> --}}
    {{-- <div class="col-lg-6">
    <div class="form-group">
      <label>PaymentDate</label>
      <input type="date" class="form-control" id="PaymentDate" placeholder="PaymentDate" name="PaymentDate" value="{{ $salesdetail->PaymentDate }}">
    </div>
    </div> --}}
    </div>
    <div class="row">
    {{-- <div class="col-lg-6">
    <div class="form-group">
      <label>IdPaymentFK</label>
      <input type="text" class="form-control" id="IdPaymentFK" placeholder="IdPaymentFK" name="IdPaymentFK">
    </div>
    </div> --}}
    {{-- <div class="col-lg-6">
    <div class="form-group">
      <label>IdSuplierFK</label>
      <input type="text" class="form-control" id="IdSuplierFK" placeholder="IdSuplierFK" name="IdSuplierFK">
    </div>
    </div> --}}
    </div>

      {{-- <input type="text" class="form-control" id="IdSales" placeholder="" name="IdSales" hidden> --}}
    </div>
    
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
  @endforeach
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