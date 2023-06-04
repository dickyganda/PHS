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
                        <form action={{ route('salesupdate', $sales->IdSalesDetail) }} method="POST" id="editsales">
                        @csrf
                        @method('put')
                        <div class="form-group">
    <div class="row">
    <div class="col-sm-6">
    <div class="form-group">
      <label>TO Departement</label>
      <select id="TOIdDepartement" name="TOIdDepartement" style="width: 100%" class="form-control form-control-sm select2">
                                                            <option disabled selected>Select Departement</option>
                                                            @foreach ($departement as $depto)
                                                            <option value="{{ $depto->IdDepartement }}">
                                                                {{ $depto->NamaDepartement }}
                                                            </option>
                                                            @endforeach
                                                        </select>

    </div>
    </div>

    <div class="col-sm-6">
      <div class="form-group">
        <label>FROMIdDepartement</label>
        <select id="FROMIdDepartement" name="FROMIdDepartement" style="width: 100%" class="form-control form-control-sm select2">
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

    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <label>Qty</label>
          <input type="text" class="form-control" id="Qty" placeholder="Qty" name="Qty" value="{{ $sales->Qty }}">
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label>Unit</label>
          <select id="IdUnit" name="IdUnit" style="width: 100%" class="form-control form-control-sm select2">
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
@push('script')
<script>
   $(document).ready(function () {
        $('#IdUnit').select2({
            placeholder: "Select Unit"
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