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
    padding-top: 0mm
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
<td style="font-size:10pt" colspan="2">PURCHASING ORDER</td>
</tr>

<tr>
<td style="font-size:10pt">#</td>
<td style="font-size:10pt">{{ $detailpurchasing->CodePurchasing}}</td>
</tr>

<tr>
<td style="font-size:10pt">Purchasing Date</td>
<td style="font-size:10pt">{{ $detailpurchasing->DatePurchasing}}</td>
</tr>

<tr>
<td style="font-size:10pt">Delivery Date</td>
{{-- <td style="font-size:10pt">{{ $sales->ShipDate}}</td> --}}
</tr>

<tr>
<td colspan ="2">Purchasing Order To</td>
<td style="font-size:10pt">BOM</td>
<td style="font-size:10pt">{{ $detailpurchasing->BomCode }}</td>
</tr>

<tr>
    <td> CV SUPLIER</td>
    <td></td>
    <td style="font-size:10pt">Sales Order</td>
<td style="font-size:10pt">{{ $detailpurchasing->CodeSales }}</td>
{{-- <td colspan="4"><h2>{{ $detailsales->SOFrom}}</h2></td> --}}
</tr>

<tr>
<td style="font-size:10pt">Phone</td>
<td style="font-size:10pt">+62 264 202041</td>
<td style="font-size:10pt">Phone</td>
<td style="font-size:10pt">+62 264 202041</td>

</tr>

<tr>
<td style="font-size:10pt">Email</td>
<td style="font-size:10pt">factory.ibr@adityabirla.com</td>
<td style="font-size:10pt">Email</td>
<td style="font-size:10pt">factory.ibr@adityabirla.com</td>
</tr>

<tr>
<td style="font-size:10pt">address</td>
<td style="font-size:10pt">address 1</td>
{{-- <td style="font-size:10pt">{{ $detailsales->Address }}	 --}}
</td>
<td style="font-size:10pt">address</td>
<td style="font-size:10pt">address 2</td>
{{-- <td style="font-size:10pt">{{ $detailsales->Address}} --}}
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

@foreach($detailPurchasing as $item)
<tr>
<td>{{ $i++ }}</td>
<td>{{ $item->MaterialName }}</td>
<td align="right">@currency($item->Qty)</td>
<td>{{ $item->NameUnit }}</td>
<td align="right">@currency($item->Price)</td>
<td align="right">@currency($item->Total)</td>
</tr>

@php
$subtotal += $item->Total;
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

<p align="right" id="bestregard">Best Regard</p><br><br><br>
<p align="right" id="nama"><b>Nur Hamzah</b></p>

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