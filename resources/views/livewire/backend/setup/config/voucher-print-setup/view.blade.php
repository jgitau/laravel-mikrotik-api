<div class="print_vouchers">
    <div class="main-container">
        <div class="ctn_cell ">
            <div class="text-center mb-3">
                @if($logo)
                <img src="{{ asset($logo) }} " alt="Logo">
                @endif
                <h3><span class="text-dark">Wi-Fi</span> Internet</h3>
            </div>
            @if($vouchers_type == 'with_password')
            <div>
                <p class="special"><span>Username</span> {{ $username }}</p>
            </div>
            <div>
                <p class="special"><span>Password</span> {{ $password }}</p>
            </div>
            @else
            <div>
                <p class="special"><span>Access Code</span> {{ $access_code }}</p>
            </div>
            @endif
            <div>
                <p><span>Valid until</span> {{ $valid_until }}</p>
            </div>
            <div>
                <p><span>Time limit</span> {{ $time_limit }}</p>
            </div>

            <ul>How to Use:
                @foreach($invoice as $index => $item)
                <li>{{ $item['name'] }}</li>
                @endforeach
            </ul>
            <p class="p1">S/N: {{ $serial_number }}</p>
        </div>
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/backend/voucher.css') }}" />
@endpush
