<html>
<table border="1">
<tr>
<td colspan="2" rowspan="4"><img src="{{ asset('assets/img/logo_PHS.png') }}"></td>
{{-- <td colspan="2" rowspan="4"></td> --}}
<td colspan="2">SALES ORDER</td>
</tr>

<tr>
{{-- <td></td> --}}
{{-- <td></td> --}}
<td>#</td>
<td>001/SO-PHS/III/23</td>
</tr>

<tr>
{{-- <td></td> --}}
{{-- <td></td> --}}
<td>Sales Order Date</td>
<td>March 29, 2023</td>
</tr>

<tr>
{{-- <td></td> --}}
{{-- <td></td> --}}
<td>Ship Date</td>
<td>April 29, 2023</td>
</tr>

<tr>
<td colspan ="2">Sales Order From</td>
<td>BOM</td>
<td>001/BM-PHS/IV/23</td>
{{-- <td>{{ $detailSales->BomCode }}</td> --}}
</tr>

<tr>
<td colspan="4"><h2>PT. INDO BHARAT RAYON</h2></td>
</tr>

<tr>
<td>Phone</td>
<td>+62 264 202041</td>
<td>Ship to</td>
<td>PT Indo Bharat Rayon</td>
</tr>

<tr>
<td>Email</td>
<td>factory.ibr@adityabirla.com</td>
<td>Email</td>
<td>factory.ibr@adityabirla.com</td>
</tr>

<tr>
<td>address</td>
<td>Menara Batavia, 16th Floor		
Kl. K.H Mas Mansyur Kav.126		
Jakarta 10220, Indonesia		
</td>
<td>address</td>
<td>Desa Cilangkap, Curug
Purwakarta 41101
Jawa Barat, Indonesia
</td>
</tr>
</table>

<br>

<table border="1">
<thead>
<tr>
<th>NO</th>
<th>PRODUCT</th>
<th>QUANTITY</th>
<th>UNIT</th>
<th>RATE</th>
<th>AMOUNT</th>
</tr>
</thead>

<tbody>
@php
$subtotal = 0;
@endphp

@foreach($detailSales as $item)
<tr>
<td>1</td>
<td>{{ $item->NameProduct }}</td>
<td>{{ $item->Qty }}</td>
<td>{{ $item->NameUnit }}</td>
<td>{{ $item->IdHarga }}</td>
<td>{{ $item->Amount }}</td>
</tr>

@endforeach

<tr>
<td colspan="5">SUBTOTAL</td>
<td></td>
</tr>
<tr>
<td colspan="5">PPN</td>
<td></td>
</tr>
<tr>
<td colspan="5">DISC%</td>
<td></td>
</tr>
</tbody>
</table>
</html>