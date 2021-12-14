@component('mail::message', ['reseturl' => $actionUrl])
{{-- Greeting --}}
# {{ $greeting }}

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@component('mail::button', ['url' => $actionUrl, 'color' => 'primary'])
{{ $actionText }}
@endcomponent

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Subcopy --}}
@slot('subcopy')
Enjoyat<br>
URL:【決定後に設定】

お問い合せフォーム:【決定後に設定】

Facebook:【決定後に設定】<br>
Twitter:【決定後に設定】
@endslot
@endcomponent
