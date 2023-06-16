<div class="print_vouchers">
    <div class="main-container">
        <div class="ctn_cell ">
            <div class="text-center mb-3">
                @if($logo)
                <img src="{{ asset($logo) }} " alt="Logo">
                @endif
                <h3 style="color: rgb(50, 50, 50);"><span>Wi-Fi</span> Internet</h3>
            </div>
            @if($vouchers_type == 'with_password')
            <div>
                <p class="special" style="color: rgb(50, 50, 50);"><span>Username</span> {{ $username }}</p>
            </div>
            <div>
                <p class="special" style="color: rgb(50, 50, 50);"><span>Password</span> {{ $password }}</p>
            </div>
            @else
            <div>
                <p class="special" style="color: rgb(50, 50, 50);"><span>Access Code</span> {{ $access_code }}</p>
            </div>
            @endif
            <div>
                <p style="color: rgb(50, 50, 50);"><span>Valid until</span> {{ $valid_until }}</p>
            </div>
            <div>
                <p style="color: rgb(50, 50, 50);"><span>Time limit</span> {{ $time_limit }}</p>
            </div>

            <ul style="color: rgb(50, 50, 50);">How to Use:
                @foreach($invoice as $index => $item)
                <li style="color: rgb(50, 50, 50);">{{ $item['name'] }}</li>
                @endforeach
            </ul>
            <p class="p1" style="color: rgb(50, 50, 50);">S/N: {{ $serial_number }}</p>
        </div>
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/backend/voucher.css') }}" />
@endpush
