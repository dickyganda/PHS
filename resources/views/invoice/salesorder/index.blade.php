@extends('layouts.main')

@section('title')
Dashboard
@endsection

@section('content')
<main id="js-page-content" role="main" class="page-content">
    {{-- <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
        <li class="breadcrumb-item">Application Intel</li>
        <li class="breadcrumb-item active">Analytics Dashboard</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol> --}}
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-chart-area'></i> Sales Order <span class='fw-300'></span>
        </h1>
        <div class="subheader-block d-lg-flex align-items-center">
            <div class="d-inline-flex flex-column justify-content-center mr-3">
                <span class="fw-300 fs-xs d-block opacity-50">
                    <small>EXPENSES</small>
                </span>
                <span class="fw-500 fs-xl d-block color-primary-500">
                    $47,000
                </span>
            </div>
            <span class="sparklines hidden-lg-down" sparkType="bar" sparkBarColor="#886ab5" sparkHeight="32px" sparkBarWidth="5px" values="3,4,3,6,7,3,3,6,2,6,4"></span>
        </div>
        <div class="subheader-block d-lg-flex align-items-center border-faded border-right-0 border-top-0 border-bottom-0 ml-3 pl-3">
            <div class="d-inline-flex flex-column justify-content-center mr-3">
                <span class="fw-300 fs-xs d-block opacity-50">
                    <small>MY PROFITS</small>
                </span>
                <span class="fw-500 fs-xl d-block color-danger-500">
                    $38,500
                </span>
            </div>
            <span class="sparklines hidden-lg-down" sparkType="bar" sparkBarColor="#fe6bb0" sparkHeight="32px" sparkBarWidth="5px" values="1,4,3,6,5,3,9,6,5,9,7"></span>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
        <div class="h-100" style="overflow: hidden; width: auto; height: 100%;">
            <table>
            <tr>
            <td>
            <a href="" class="btn btn-success btn-xs" title="Tambah Data Baru" role="button" data-toggle="modal" data-target="#tambahsalesorder"><i class="fas fa-plus-circle"></i>
                            Tambah</a>
            </td>
            </tr>
            </table>
        </div>
        </div>
        <div class="col-lg-6">
            <div id="panel-2" class="panel" data-panel-fullscreen="false">
                <div class="panel-hdr">
                    <h2>
                        Smart Chat
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content p-0">
                        <div class="d-flex flex-column">
                            <div class="bg-subtlelight-fade custom-scroll" style="height: 244px">
                                <div class="h-100">
                                    <!-- message -->
                                    <div class="d-flex flex-row px-3 pt-3 pb-2">
                                        <!-- profile photo : lazy loaded -->
                                        <span class="status status-danger">
                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-j.png')"></span>
                                        </span>
                                        <!-- profile photo end -->
                                        <div class="ml-3">
                                            <a href="javascript:void(0);" title="Lisa Hatchensen" class="d-block fw-700 text-dark">Lisa Hatchensen</a>
                                            Hey did you meet the new board of director? He's a bit of a geek if you ask me...anyway here is the report you requested. I am off to launch with Lisa and Andrew, you wanna join?
                                            <!-- file download -->
                                            <div class="d-flex mt-3 flex-wrap">
                                                <div class="btn-group mr-1 mt-1" role="group" aria-label="Button group with nested dropdown ">
                                                    <button type="button" class="btn btn-default btn-xs btn-block px-1 py-1 fw-500" data-action="toggle">
                                                        <span class="d-block text-truncate text-truncate-sm">
                                                            <i class="fal fa-file-pdf mr-1 color-danger-700"></i> Report-2013-demographic-repo
                                                        </span>
                                                    </button>
                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button" class="btn btn-default btn-xs dropdown-toggle px-2 js-waves-off" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                                        <div class="dropdown-menu p-0 fs-xs" aria-labelledby="btnGroupDrop1">
                                                            <a class="dropdown-item px-3 py-2" href="#">Forward</a>
                                                            <a class="dropdown-item px-3 py-2" href="#">Open</a>
                                                            <a class="dropdown-item px-3 py-2" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="btn-group mr-1 mt-1" role="group" aria-label="Button group with nested dropdown ">
                                                    <button type="button" class="btn btn-default btn-xs btn-block px-1 py-1 fw-500" data-action="toggle">
                                                        <span class="d-block text-truncate text-truncate-sm">
                                                            <i class="fal fa-file-pdf mr-1 color-danger-700"></i> Bloodworks Patient 34124BA
                                                        </span>
                                                    </button>
                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop2" type="button" class="btn btn-default btn-xs dropdown-toggle px-2 js-waves-off" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                                        <div class="dropdown-menu p-0 fs-xs" aria-labelledby="btnGroupDrop2">
                                                            <a class="dropdown-item px-3 py-2" href="#">Forward</a>
                                                            <a class="dropdown-item px-3 py-2" href="#">Open</a>
                                                            <a class="dropdown-item px-3 py-2" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- file download end -->
                                        </div>
                                    </div>
                                    <!-- message end -->
                                    <!-- message reply -->
                                    <div class="d-flex flex-row px-3 pt-3 pb-2">
                                        <!-- profile photo : lazy loaded -->
                                        <span class="status status-danger">
                                            <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-admin.png')"></span>
                                        </span>
                                        <!-- profile photo end -->
                                        <div class="ml-3">
                                            <a href="javascript:void(0);" title="Lisa Hatchensen" class="d-block fw-700 text-dark">Dr. Codex Lantern</a>
                                            Thanks for the file! You guys go ahead, I have to call some of my patients.
                                        </div>
                                    </div>
                                    <!-- message reply end -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 bg-faded">
                        <textarea rows="3" class="form-control rounded-top border-bottom-left-radius-0 border-bottom-right-radius-0 border" placeholder="write a reply..."></textarea>
                        <div class="d-flex align-items-center py-2 px-2 bg-white border border-top-0 rounded-bottom">
                            <div class="btn-group dropup">
                                <button type="button" class="btn btn-icon fs-lg dropdown-toggle no-arrow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fal fa-smile"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-animated text-center rounded-pill overflow-hidden" style="width: 280px">
                                    <div class="px-1 py-0">
                                        <a href="javascript:void(0);" class="emoji emoji--like" data-toggle="tooltip" data-placement="top" title="" data-original-title="Like">
                                            <div class="emoji__hand">
                                                <div class="emoji__thumb"></div>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0);" class="emoji emoji--love" data-toggle="tooltip" data-placement="top" title="" data-original-title="Love">
                                            <div class="emoji__heart"></div>
                                        </a>
                                        <a href="javascript:void(0);" class="emoji emoji--haha" data-toggle="tooltip" data-placement="top" title="" data-original-title="Haha">
                                            <div class="emoji__face">
                                                <div class="emoji__eyes"></div>
                                                <div class="emoji__mouth">
                                                    <div class="emoji__tongue"></div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0);" class="emoji emoji--yay" data-toggle="tooltip" data-placement="top" title="" data-original-title="Yay">
                                            <div class="emoji__face">
                                                <div class="emoji__eyebrows"></div>
                                                <div class="emoji__mouth"></div>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0);" class="emoji emoji--wow" data-toggle="tooltip" data-placement="top" title="" data-original-title="Wow">
                                            <div class="emoji__face">
                                                <div class="emoji__eyebrows"></div>
                                                <div class="emoji__eyes"></div>
                                                <div class="emoji__mouth"></div>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0);" class="emoji emoji--sad" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sad">
                                            <div class="emoji__face">
                                                <div class="emoji__eyebrows"></div>
                                                <div class="emoji__eyes"></div>
                                                <div class="emoji__mouth"></div>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0);" class="emoji emoji--angry" data-toggle="tooltip" data-placement="top" title="" data-original-title="Angry">
                                            <div class="emoji__face">
                                                <div class="emoji__eyebrows"></div>
                                                <div class="emoji__eyes"></div>
                                                <div class="emoji__mouth"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-icon fs-lg">
                                <i class="fal fa-paperclip"></i>
                            </button>
                            <div class="custom-control custom-checkbox custom-control-inline ml-auto hidden-sm-down">
                                <input type="checkbox" class="custom-control-input" id="defaultInline1">
                                <label class="custom-control-label" for="defaultInline1">Press <strong>ENTER</strong> to send</label>
                            </div>
                            <button class="btn btn-primary btn-sm ml-auto ml-sm-0">
                                Reply
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="panel-3" class="panel">
                <div class="panel-hdr">
                    <h2 class="js-get-date"></h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div id="panel-4" class="panel">
                <div class="panel-hdr">
                    <h2>Bird's Eyes</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content jqvmap-bg-ocean p-0" style="height: 330px;">
                        <div id="vector-map" class="w-100 h-100 p-4"></div>
                    </div>
                    <div class="panel-content jqvmap-bg-ocean">
                        <div class="d-flex align-items-center">
                            <img class="d-inline-block js-jqvmap-flag mr-3 border-faded" alt="flag" src="https://lipis.github.io/flag-icon-css/flags/4x3/us.svg" style="width:55px; height: auto;">
                            <h4 class="d-inline-block fw-300 m-0 text-muted fs-lg">
                                Showcasing information:
                                <small class="js-jqvmap-country mb-0 fw-500 text-dark">United States of America - $3,760,125.00</small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
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
            <div id="panel-6" class="panel">
                <div class="panel-hdr">
                    <h2>Secession Scale </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content p-0 mb-g">
                        <div class="alert alert-success alert-dismissible fade show border-faded border-left-0 border-right-0 border-top-0 rounded-0 m-0" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                            </button>
                            <strong>Last update was on <span class="js-get-date"></span></strong> - Your logs are all up to date.
                        </div>
                    </div>
                    <div class="panel-content">
                        <div class="row  mb-g">
                            <div class="col-md-6 d-flex align-items-center">
                                <div id="flotPie" class="w-100" style="height:250px"></div>
                            </div>
                            <div class="col-md-6 col-lg-5 mr-lg-auto">
                                <div class="d-flex mt-2 mb-1 fs-xs text-primary">
                                    Current Usage
                                </div>
                                <div class="progress progress-xs mb-3">
                                    <div class="progress-bar" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex mt-2 mb-1 fs-xs text-info">
                                    Net Usage
                                </div>
                                <div class="progress progress-xs mb-3">
                                    <div class="progress-bar bg-info-500" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex mt-2 mb-1 fs-xs text-warning">
                                    Users blocked
                                </div>
                                <div class="progress progress-xs mb-3">
                                    <div class="progress-bar bg-warning-500" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex mt-2 mb-1 fs-xs text-danger">
                                    Custom cases
                                </div>
                                <div class="progress progress-xs mb-3">
                                    <div class="progress-bar bg-danger-500" role="progressbar" style="width: 15%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex mt-2 mb-1 fs-xs text-success">
                                    Test logs
                                </div>
                                <div class="progress progress-xs mb-3">
                                    <div class="progress-bar bg-success-500" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex mt-2 mb-1 fs-xs text-dark">
                                    Uptime records
                                </div>
                                <div class="progress progress-xs mb-3">
                                    <div class="progress-bar bg-fusion-500" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- modal insert sales --}}
        <div class="modal fade" id="tambahsalesorder">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Sales Order</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form id="tambahsalesorder">
                                        {{ csrf_field() }}
                                        <input type="text" name="id_pelanggan" class="form-control" placeholder="ID Pelanggan"> <br>

                                        <input type="text" name="no_meja" class="form-control" placeholder="Nomor Meja">

                                        {{-- <table id="form_penjualan">
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Qty</th>
                                                <th>Harga</th>
                                                <th>Total</th>
                                            </tr>
                                            <tr>
                                                <td id="col0">
                                                    <div class="form-group" style="width: 15rem">
                                                        <select id="id_barang" name="id_barang[]" style="width: 100%" class="form-control form-control-sm select2" onchange="selectTypeNamabarang(this)" required>
                                                            <option disabled selected>Pilih Barang</option>
                                                            @foreach ($databarang as $penjualan)
                                                            <option value="{{ $penjualan->id_barang }}">
                                                                {{ $penjualan->nama_barang }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                                <td id="col1">
                                                    <div class="form-group">
                                                        <input type="text" onkeyup="sum(this.parentElement.parentElement.parentElement);" id="qty_penjualan" name="qty_penjualan[]" required="required" class="form-control form-control-sm" placeholder="Qty">
                                                    </div>
                                                </td>
                                                <td id="col2">
                                                    <div class="form-group">
                                                        <input type="text" onkeyup="sum(this.parentElement.parentElement.parentElement);" id="harga_barang" name="harga_barang[]" id="harga_barang" required="required" class="form-control form-control-sm" placeholder="Harga" readonly>
                                                    </div>
                                                </td>
                                                <td id="col3">
                                                    <div class="form-group">
                                                        <input type="text" id="total_penjualan" name="total_penjualan[]" required="required" class="form-control form-control-sm" placeholder="Total" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <table>
                                            <tr>
                                                <td><input type="button" class="btn btn-primary btn-xs" value="Add Row" onclick="addRows()" /></td>
                                                <td><input type="button" class="btn btn-danger btn-xs" value="Delete Row" onclick="deleteRows()" />
                                                </td>
                                                <td><input type="submit" class="btn btn-success btn-xs" value="Submit" /></td>
                                            </tr>
                                        </table> --}}
                                        <br>
                                        {{-- <button class="btn btn-primary" type="submit">Tambah</button> --}}
                                        <td><input type="button" class="btn btn-primary btn-xs" value="Add Row" onclick="addRows()" /></td>
                                                <td><input type="button" class="btn btn-danger btn-xs" value="Delete Row" onclick="deleteRows()" /></td>
                                                <td><input type="button" class="btn btn-success btn-xs" value="Submit" href="/invoice/salesorder/printsalesorder" /></td>
                                    </form>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> --}}
                                </div>

    </div>
</main>
@endsection