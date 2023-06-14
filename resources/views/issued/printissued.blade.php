<html>
<head>
<title></title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<style>
.page {
            width: 210mm;
            height: 297mm;
            margin-left: 10mm;
            margin-right: 10mm;
            margin-top: 10mm;
            margin-bottom: 10mm;
        }

.header{
    margin-right: 10mm;
}

.dataitem{
    width: 80%;
    font-size: 10pt;
    border: 1px solid black;
}

p{
    margin-right: 10mm;
    font-size: 10pt;
    padding: 0px;
    margin: 0px;
}

th{
    text-align: center;
}

#bestregard, #nama{
    margin-right: 30mm;
}

img {
            max-width: inherit;
            width: 70px;
            height: 70px;
        }

        @media print {
            .page {
               width: 210mm;
               height: 297mm;
                margin-left: 10mm;
            margin-right: 10mm;
            }
            .hidden-print {
                display: none !important;
            }
        }
</style>
<div class="page">
<table class="header table-sm">
<tr>
<td colspan="2" rowspan="4"><img src="{{ asset('assets/img/logo_PHS.png') }}"></td>
<td style="font-size:10pt" colspan="2">DELIVERY ORDER</td>
</tr>

<tr>
<td style="font-size:10pt">#</td>
<td style="font-size:10pt">{{ $issued->CodeIssued}}</td>
</tr>

<tr>
<td style="font-size:10pt">Delivery Order Date</td>
<td style="font-size:10pt">{{ $issued->CreatedAt}}</td>
</tr>

<tr>
<td style="font-size:10pt">Sales Order</td>
<td style="font-size:10pt">{{ $detailissued->CodeSales}}</td>
</tr>

<tr>
<td colspan ="2">Delivered To</td>
{{-- <td style="font-size:10pt">BOM</td> --}}
{{-- <td style="font-size:10pt">{{ $detailissued->BomCode }}</td> --}}
</tr>

<tr>
<td colspan="4"><h2>{{ $detailissued->SOFrom}}</h2></td>
</tr>

<tr>
<td style="font-size:10pt">Phone</td>
<td style="font-size:10pt">+62 264 202041</td>
<td style="font-size:10pt">Ship to</td>
<td style="font-size:10pt">{{ $detailissued->DeliveredTo }}</td>
</tr>

<tr>
<td style="font-size:10pt">Email</td>
<td style="font-size:10pt">factory.ibr@adityabirla.com</td>
<td style="font-size:10pt">Email</td>
<td style="font-size:10pt">factory.ibr@adityabirla.com</td>
</tr>

<tr>
<td style="font-size:10pt">address</td>
<td style="font-size:10pt">{{ $detailissued->Address }}	
</td>
<td style="font-size:10pt">address</td>
<td style="font-size:10pt">{{ $detailissued->Address}}
</td>
</tr>
</table>

<br>

<table class="dataitem table table-sm table-striped" style="border-width:1px; border-style:solid" >
<thead style="background-color:#1F4E78; color:white">
<tr>
<th>NO</th>
<th>PRODUCT</th>
<th>QUANTITY</th>
<th>UNIT</th>
<th>RATE</th>
<th>AMOUNT</th>
</tr>
</thead>

<tbody class="table table-striped">
@php
$subtotal = 0;
$ppn = 0;
$disc = 0;
$total = 0;
$i=1
@endphp

@foreach($detailIssued as $item)
<tr>
<td>{{ $i++ }}</td>
<td>{{ $item->NameProduct }}</td>
<td align="right">@currency($item->Qty)</td>
<td>{{ $item->NameUnit }}</td>
<td align="right">@currency($item->HargaSatuan)</td>
<td align="right">@currency($item->Amount)</td>
</tr>

@php
$subtotal += $item->Amount;
$ppn = $subtotal * 11 / 100;
$total = $subtotal + $ppn;
@endphp
@endforeach

<tr>
<td colspan="5">SUBTOTAL</td>
<td align="right">@currency($subtotal)</td>
</tr>
<tr>
<td colspan="5">PPN 11 %</td>
<td align="right">@currency($ppn)</td>
</tr>
<tr>
<td colspan="5">DISC 0%</td>
<td align="right">@currency($disc)</td>
</tr>
<tr>
<td colspan="5">TOTAL</td>
<td align="right"> @currency($total) </td>
</tr>
</tbody>
</table>


<br>
<br>
<p>NOTE</p>
<table border="1" width="20%" height="10%" class="note">
<tr>
<td></td>
</tr>
</table>
<br><br><br>
<table>
    <tr>
        <td>Prepared By</td>
        <td>Checked By</td>
        <td>Approved By</td>
        <td>Driver</td>
        <td>Security</td>

    </tr>
    <tr>
        <td width="20%" height="50%">1</td>
        <td width="20%" height="10%">2</td>
        <td width="20%" height="10%">3</td>
        <td width="20%" height="10%">4</td>
        <td width="20%" height="10%">5</td>
    </tr>
    <tr>
        <td>Nama Created</td>
        <td>Nama Checked</td>
        <td>Nama Approval</td>
        <td>Nama Driver</td>
        <td>Nama Security</td>
    </tr>
</table>

<br><br><br><br><br>
<table>
<tr>
<td>
<p> PT. PUTRA HAMZAH SEJAHTERAH</p>
<p> Jl. Mastrip No. 113, Sukomulyo, Kec. Lamongan</p>
<p> Kabupaten Lamongan, Jawa Timur 62216</p>
</td>
<td>
<p>+62322 3326 898</p>
<p>nurhamzah@putrahamzahsejahterah.co.id</p>
</td>
</tr>
</table>
<button id="btnPrint" class="hidden-print">Print</button>
</div>

    <script>
        const $btnPrint = document.querySelector("#btnPrint");
        $btnPrint.addEventListener("click", () => {
            window.print();
        });
    </script>

</html>