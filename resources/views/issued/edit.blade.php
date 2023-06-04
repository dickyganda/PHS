@extends('layouts.main')

@section('title')
Edit Surat Jalan
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
                    <h2>Edit Surat Jalan</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div>
                            {{-- form edit sales order --}}
                            @foreach($issueddetail as $issued)
                            <form action={{ route('issuedupdate', $issued->IdIssuedDetail) }} method="POST"
                                id="editissued">
                                @csrf
                                @method('put')
                                <div class="form-group">

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>TOIdDepartement</label>
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
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>FROMIdDepartement</label>
                                                <select id="FROMIdDepartement" name="FROMIdDepartement"
                                                    style="width: 100%" class="form-control form-control-sm select2">
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
        $('#FROMIdDepartement').select2({
            placeholder: "Select Departement"
        });

        $('#TOIdDepartement').select2({
            placeholder: "Select Departement"
        });
    });

</script>
@endpush
