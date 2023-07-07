@extends('print.master')

@section('content')
<div class="report-header">
    <h3>{{ $schema }}</h3>
</div>


<div class="page_break" style="padding:2px;">
    <table id="tableTop">

        @foreach ($categories as $category )
            <tr style="text-align: center; background-color:rgb(228, 228, 227);" >
                <td colspan="5" style="padding:5px;"><strong>{{ $category->title }}</strong></td>
            </tr>
            <tr style="text-align: center; background-color:beige;">
                <td style="padding:10px; width:20px;"><strong>Order</strong></td>
                <td style="padding:10px;"><strong>Context</strong></td>
                <td style="padding:10px; width:20px;"><strong>Female</strong></td>
                <td style="padding:10px; width:20px;"><strong>Male</strong></td>
                <td style="padding:10px; width:20px;"><strong>Total</strong></td>
            </tr>

            @foreach($category->category_worksheets as  $worksheet)
                <tr  style="text-align: center;">
                    <td style="padding:5px; width:20px;">{{ $worksheet->preliminary->sequence }}</td>
                    <td style="padding:5px;">
                        @if(strlen($worksheet->preliminary->pretext) > 0)
                            {{ $worksheet->preliminary->pretext }}<br/>
                        @endif
                        {{ $worksheet->preliminary->context }}
                    </td>
                    <td style="padding:5px; width:20px;">{{ $worksheet->female }}</td>
                    <td style="padding:5px; width:20px;">{{ $worksheet->male }}</td>
                    <td style="padding:5px; width:20px;">{{ ($worksheet->female + $worksheet->male) }}</td>
                </tr>
            @endforeach
        @endforeach

    </table>
</div>

@endsection
