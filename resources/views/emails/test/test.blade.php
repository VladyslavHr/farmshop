<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
  {{-- <img src="{{asset('svg/logo.svg')}}" alt="logo"> --}}
</x-mail::header>
</x-slot:header>

{{-- Body --}}
{{-- {{ $slot }} --}}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{{ $subcopy }}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
</x-mail::footer>
</x-slot:footer>
  {{-- <div class="row">{{ __('notification.apps') }}</div> --}}
  {{-- <div class="row">
    AppStore <div class="md:col-span-6"><img src="{{asset('apps_qr/appstore.png')}}" alt="appstore" style="width: 20%;"></div>
    Google play <div class="md:col-span-6"><img src="{{asset('apps_qr/google_play.png')}}" alt="google_play" style="width: 20%;"></div>
  </div> --}}
</x-mail::layout>
