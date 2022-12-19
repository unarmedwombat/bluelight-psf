<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">

    <style>
        @page { margin: 0; }
        body { margin: 5mm; }
        /*main { height: 24cm; background: blue; }*/
        a {
            text-decoration: none;
        }
        h1, h2, h3, h4 { font-weight:normal; line-height:1.25; margin:0; padding:0;}
        td { padding: 1mm 2.5mm 2mm; vertical-align: top;}
        div.nl {
            padding: 0.4rem 0 0;
            margin: 0;
        }
        .fs-xl { font-size: 1.75rem; }
        .fs-lg { font-size: 1.5rem; }
        .fs-md { font-size: 1.125rem; }
        .fs-sm { font-size: 0.9rem; }
        .fs-xs { font-size: 0.75rem; }
        .lh-lg { line-height: 1.5; }
        .lh-md { line-height: 1.25; }
        .lh-sm { line-height: 1; }
        .bb { border-bottom: 1px solid #999; }
        .br { border-right: 1px solid #999; }
        .bold {
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .w-full {
            width: 100%;
        }
        .w-half {
            width: 50%;
        }
        .p-12 {
            padding: 3rem;
        }
        .py-8 {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }
        .ib {
        }
        .footer {
            position: absolute;
            bottom: 5mm;
        }
        .pba {
            page-break-after: always;
        }
    </style>
{{--    <link rel="stylesheet" href="/css/app.css">--}}

</head>

<body style='font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;'>

<div class="header">
    <img src="https://bl.dsctest.co.uk/img/pdf-logo.jpg" style="float:left;width:6cm;margin-right:3cm;">
    <h1 class="fs-xl lh-sm" style="margin-top:2.9rem;">Construction Frameworks</h1>
</div>

<div style='box-sizing: border-box;margin-top:1.5rem;'>
    <table cellspacing="0" cellpadding="0" width="100%" style="border: solid 1px black;">
        <tr><td width="25%"></td><td width="25%"></td><td width="25%"></td><td width="25%"></td></tr>
        <tr>
            <td colspan="4" class="w-full fs-lg bold">
                {{ $framework->fullTitle }}
            </td>
        </tr>
        <tr class="bb">
            <td colspan="2"><span class="fs-xs">Selected region:</span> {{ $region->title }}</td>
            <td colspan="2"><span class="fs-xs">Budget:</span> £{{ number_format($budget) }}</td>
        </tr>
        <tr class="bb">
            <td colspan="4"><span class="fs-xs">Organisation overview</span><br>
                {!! nl2br($framework->organisation->overview) !!}
            </td>
        </tr>
        <tr class="bb">
            <td colspan="4"><span class="fs-xs">Framework website</span><br><a href="{{ $framework->url }}" target="_blank">{{ $framework->url }}</a></td>
        </tr>
        <tr class="bb">
            <td colspan="2"><span class="fs-xs">Contact details</span>
                <br>{!! $framework->getContact() !!}
                <br>{!! $framework->getJobTitle() !!}
            </td>
            <td colspan="2"><span class="fs-xs">&nbsp;</span>
                <br>{!! $framework->getPhone() !!}
                <br><a href="mailto:{!! $framework->getEmail() !!}">{!! $framework->getEmail() !!}</a>
            </td>
        </tr>
        <tr class="bb">
            <td colspan="2" class="br"><span class="fs-xs">Approach to social value</span><br>{!! nl2block($framework->organisation->social_values) !!}</td>
            <td colspan="2"><span class="fs-xs">Benefits & notes</span><br>{!! nl2block($framework->organisation->benefits) !!}</td>
        </tr>
        <tr class="bb">
            <td colspan="2" class="br"><span class="fs-xs">Value bands</span><br>
                @foreach($lots as $lot)
                    <div class="{{ ($loop->first) ? '' : 'nl' }}">{{ $lot->fullTitle }}</div>
                @endforeach
                @if (count($otherLots))
                    <div style="color:#999999;margin-top:8px;">Other Value Bands</div>
                    <div style="color:#999999;font-size:0.8rem;">
                        @foreach($otherLots as $lot)
                            {{ $lot }}<br>
                        @endforeach
                    </div>
                @endif
            </td>
            <td class="br"><span class="fs-xs">Expiry date</span><br>{{ $framework->expiry->format('jS M Y') }}</td>
            <td><span class="fs-xs">Extension options</span><br>{!! nl2br($framework->extension_options) !!}</td>
        </tr>
        <tr class="bb">
            <td colspan="4"><span class="fs-xs">Contract award notice</span><br>{{ $framework->award_notice_title }}</td>
        </tr>
        <tr class="bb">
            <td colspan="4"><span class="fs-xs">Award notice URL</span><br><a href="{{ $framework->award_notice_url }}" target="_blank">{{ $framework->award_notice_url }}</a></td>
        </tr>
        <tr>
            <td class="br" colspan="2"><span class="fs-xs">Contract types</span><br>{!! nl2br($framework->contract_types) !!}</td>
            <td colspan="2"><span class="fs-xs">Call-off routes</span><br>{!! nl2br($framework->calloff_routes) !!}</td>
        </tr>
    </table>
</div>
<div class="footer pba">For further information please contact: <a href="mailto:enquiries@BlueLight.police.uk">enquiries@BlueLight.police.uk</a></div>

<div class="header">
    <img src="https://bl.dsctest.co.uk/img/pdf-logo.jpg" style="float:left;width:6cm;margin-right:3cm;">
    <h1 class="fs-xl lh-sm" style="margin-top:2.9rem;">Construction Frameworks</h1>
</div>

<div style='box-sizing: border-box;margin-top:1.5rem;'>
    <table cellspacing="0" cellpadding="0" width="100%" style="border: solid 1px black;">
        <tr>
            <td width="50%"></td>
            <td width="50%"></td>
        </tr>
        <tr>
            <td colspan="2" class="w-full fs-lg bold">
                {{ $framework->fullTitle }}
            </td>
        </tr>
        <tr class="bb">
            <td><span class="fs-xs">Selected region:</span> {{ $region->title }}</td>
            <td><span class="fs-xs">Budget:</span> £{{ number_format($budget) }}</td>
        </tr>
        <tr>
            <td colspan="2"><span class="fs-xs">Approved suppliers (by value lot)</span></td>
        </tr>
    @foreach($suppliers as $lot_title => $lot)
        @php $half = (count($lot) < 5) ? 0 : round(count($lot)/2) @endphp
        <tr>
            <td colspan="2" class="bold">{{ $lot_title }}</td>
        </tr>
        <tr>
            <td>
        @foreach($lot as $supplier)
            @php
                if ($supplier['alert']) $alert = true;
            @endphp
            <p style="margin:0;padding:0;{{ ($supplier['alert']) ? 'color:#cc0000;' : '' }}">{{ $supplier['title'] }} {{ ($supplier['alert']) ? '*' : '' }}</p>
            @if ($loop->iteration == $half)
                </td><td>
            @endif
        @endforeach
        @if(count($lot) < 5)
            </td><td>
        @endif
            </td>
        </tr>
    @endforeach
    @if ($alert)
        <tr><td colspan="2" style="color:#cc0000;font-size:0.8rem;font-style:italic;">* Please contact BlueLight Commercial for the latest status of these suppliers</td></tr>
    @endif
    </table>
</div>
<div class="footer">For further information please contact: <a href="mailto:enquiries@BlueLight.police.uk">enquiries@BlueLight.police.uk</a></div>
</body>
</html>


