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
                        <form action="/invoice/salesorder/insertsalesorder" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
      {{-- <label>ID BOM</label> --}}
    <div class="row">
    <div class="col-lg-6">
    <div class="form-group">
      <label>ID User</label>
      <input type="text" class="form-control" id="IdUserFK" placeholder="User" name="IdUserFK">
    </div>
    </div>
    <div class="col-lg-6">
    <div class="form-group">
      <label>TOIdDepartementFK</label>
      <input type="text" class="form-control" id="TOIdDepartementFK" placeholder="TOIdDepartementFK" name="TOIdDepartementFK">
    </div>
    </div>
    </div>
    <div class="row">
    <div class="col-lg-6">
    <div class="form-group">
      <label>FROMIdDepartementFK</label>
      <input type="text" class="form-control" id="FROMIdDepartementFK" placeholder="FROMIdDepartementFK" name="FROMIdDepartementFK">
    </div>
    </div>
    <div class="col-lg-6">
    <div class="form-group">
      <label for="pwd">CreatedBy</label>
      <input type="text" class="form-control" id="CreatedBy" placeholder="CreatedBy" name="CreatedBy">
    </div>
    </div>
    </div>
    <div class="row">
    <div class="col-lg-6">
    <div class="form-group">
      <label for="pwd">CheckedBy</label>
      <input type="text" class="form-control" id="CheckedBy" placeholder="CheckedBy" name="CheckedBy">
    </div>
    </div>
    <div class="col-lg-6">
    <div class="form-group">
      <label>ApprovedBy</label>
      <input type="text" class="form-control" id="ApprovedBy" placeholder="ApprovedBy" name="ApprovedBy">
    </div>
    </div>
    </div>
    <div class="row">
    <div class="col-lg-6">
    <div class="form-group">
      <label>DateRequired</label>
      <input type="date" class="form-control" id="DateRequired" placeholder="DateRequired" name="DateRequired">
    </div>
    </div>
    <div class="col-lg-6">
    <div class="form-group">
      <label>PaymentDate</label>
      <input type="date" class="form-control" id="PaymentDate" placeholder="PaymentDate" name="PaymentDate">
    </div>
    </div>
    </div>
    <div class="row">
    <div class="col-lg-6">
    <div class="form-group">
      <label>IdPaymentFK</label>
      <input type="text" class="form-control" id="IdPaymentFK" placeholder="IdPaymentFK" name="IdPaymentFK">
    </div>
    </div>
    <div class="col-lg-6">
    <div class="form-group">
      <label>IdSuplierFK</label>
      <input type="text" class="form-control" id="IdSuplierFK" placeholder="IdSuplierFK" name="IdSuplierFK">
    </div>
    </div>
    </div>

      <input type="text" class="form-control" id="IdSales" placeholder="" name="IdSales" hidden>
    </div>
    
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