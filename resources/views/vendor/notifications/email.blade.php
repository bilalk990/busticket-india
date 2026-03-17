@php
$primaryColor = '#1f75d8';
$accentColor = '#0099e5';
$bgColor = '#f4f6fb';
$cardBg = '#fff';
$footerBg = '#f4f6fb';
@endphp

<table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="background:{{ $bgColor }}; min-height:100vh; width:100%; font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;">
    <tr>
        <td align="center" style="padding: 40px 0;">
            <table cellpadding="0" cellspacing="0" role="presentation" style="background:{{ $cardBg }}; border-radius:14px; box-shadow:0 4px 24px rgba(0,0,0,0.07); max-width:480px; width:100%; border-top: 6px solid {{ $primaryColor }};">
                <tr>
                    <td style="padding: 32px 32px 0 32px; text-align:center;">
                        {{-- Logo --}}
                        <img src="{{ asset('assets/images/logo-small.png') }}" alt="{{ config('app.name') }} Logo" style="height: 48px; margin-bottom: 18px;">
                        {{-- Title --}}
                        <div style="font-size: 2rem; font-weight: 700; color: {{ $primaryColor }}; margin-bottom: 18px; letter-spacing:0.5px;">
                            {{ $title ?? (isset($greeting) ? $greeting : (__('Account Notification'))) }}
                        </div>
                        {{-- Icon --}}
                        <div style="margin-bottom: 24px;">
                            <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="72" height="72" rx="16" fill="#e6f4fa"/>
                                <path d="M20 28L36 40L52 28" stroke="{{ $accentColor }}" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <rect x="20" y="28" width="32" height="16" rx="3" stroke="{{ $accentColor }}" stroke-width="2.5"/>
                                <circle cx="52" cy="44" r="7" fill="#fff" stroke="{{ $accentColor }}" stroke-width="2.5"/>
                                <path d="M49.5 44.5L51.5 46.5L54.5 42.5" stroke="{{ $accentColor }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        {{-- Greeting --}}
                        <div style="font-size:1.1rem; font-weight:600; color:#222; margin-bottom: 12px;">
                            @if (! empty($greeting))
                                {{ $greeting }}
                            @else
                                @if ($level === 'error')
                                    @lang('Whoops!')
                                @else
                                    @lang('Hello!')
                                @endif
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0 32px 0 32px; text-align:center;">
                        {{-- Intro Lines --}}
                        @foreach ($introLines as $line)
                            <p style="font-size:1.08rem; color:#222; margin: 0 0 16px 0; line-height:1.6;">{{ $line }}</p>
                        @endforeach
                    </td>
                </tr>
                @isset($actionText)
                <tr>
                    <td style="padding: 0 32px 24px 32px; text-align:center;">
                        <?php
                            $color = match ($level) {
                                'success', 'error' => $level,
                                default => 'primary',
                            };
                        ?>
                        <x-mail::button :url="$actionUrl" :color="$color" style="font-size:1.08rem; padding: 16px 0; border-radius: 6px; font-weight:700; background:{{ $primaryColor }}; border:none; width:100%; max-width:320px; text-transform:uppercase; letter-spacing:1px;">{{ strtoupper($actionText) }}</x-mail::button>
                    </td>
                </tr>
                @endisset
                <tr>
                    <td style="padding: 0 32px 0 32px; text-align:center;">
                        {{-- Outro Lines --}}
                        @foreach ($outroLines as $line)
                            <p style="font-size:1.08rem; color:#222; margin: 0 0 16px 0; line-height:1.6;">{{ $line }}</p>
                        @endforeach
                        {{-- Thank you note --}}
                        <p style="font-size:1.05rem; color:#888; margin: 24px 0 0 0;">Thank you for choosing {{ config('app.name') }}.</p>
                        {{-- Salutation --}}
                        @if (! empty($salutation))
                            <p style="margin: 0 0 16px 0;">{{ $salutation }}</p>
                        @else
                            <p style="margin: 0 0 16px 0; color:#888;">@lang('Regards,')<br>{{ config('app.name') }}</p>
                        @endif
                    </td>
                </tr>
                @isset($actionText)
                <tr>
                    <td style="padding: 0 32px 24px 32px;">
                        <div style="font-size:0.95rem; color:#888; background:#f8fafc; border-radius:6px; padding:12px 16px; word-break:break-all;">
                            @lang(
                                "If you're having trouble clicking the \" :actionText \" button, copy and paste the URL below into your web browser:",
                                ['actionText' => $actionText]
                            ) <br>
                            <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
                        </div>
                    </td>
                </tr>
                @endisset
            </table>
            {{-- Footer --}}
            <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="background:{{ $footerBg }}; margin-top: 24px;">
                <tr>
                    <td style="text-align:center; padding: 24px 0 8px 0; color:#b0b3b8; font-size:0.93rem;">
                        <a href="#" style="color:#b0b3b8; text-decoration:underline; font-size:0.93rem;">View as a Web Page</a>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center; color:#b0b3b8; font-size:0.93rem; padding-bottom: 8px;">
                        &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.<br>
                        123 Incredible Street, SomeTown, OR, 87466 US, (123) 456-7890
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center; padding-bottom: 16px;">
                        <a href="#" style="display:inline-block; margin:0 8px;"><img src="https://cdn-icons-png.flaticon.com/512/145/145807.png" alt="LinkedIn" width="24" style="vertical-align:middle;"></a>
                        <a href="#" style="display:inline-block; margin:0 8px;"><img src="https://cdn-icons-png.flaticon.com/512/145/145812.png" alt="Twitter" width="24" style="vertical-align:middle;"></a>
                        <a href="#" style="display:inline-block; margin:0 8px;"><img src="https://cdn-icons-png.flaticon.com/512/145/145808.png" alt="RSS" width="24" style="vertical-align:middle;"></a>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center; color:#b0b3b8; font-size:0.93rem; padding-bottom: 24px;">
                        You received this email because you signed up for {{ config('app.name') }}
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
