<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<base href="{{url('')}}">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="robots" content="index,follow" />
@hasSection('seo')
@yield('seo')
@else
<title>{{ $siteTitle ?? setting("seo_title_{$composerLocale}",'') }}</title>
<meta property="og:type" content="website"/>
<meta property="og:image" content="{{ assetVersion('images/logo.png') }}" />
<meta property="og:image:alt" content="{{ env('APP_NAME_SUMMARY') }}"/>
<meta property="og:title" content="{{ $share_setting["seo_title_{$composerLocale}"] ?? '' }}" />
<meta property="og:description" content="{{ $share_setting["seo_description_{$composerLocale}"] ?? '' }}" />
<meta property="og:url" content="{{ url()->current() }}"/>
<meta property="og:site_name" content="{{ $share_setting["seo_title_{$composerLocale}"] ?? '' }}"/>
<meta name="keywords" content="{{ $share_setting["seo_keywords_{$composerLocale}"] }}" />
<meta name="description" content="{{ $share_setting["seo_description_{$composerLocale}"] ?? '' }}" />

<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@<?=env('APP_NAME_SUMMARY')?>">
<meta name="twitter:creator" content="@<?=env('APP_NAME_SUMMARY')?>">
<meta name="twitter:title" content="{{ $share_setting["seo_title_{$composerLocale}"] ?? '' }}">
<meta name="twitter:description" content="{{ $share_setting["seo_description_{$composerLocale}"] ?? '' }}">
<meta name="twitter:image" content="{{ asset('images/logo.png') }}">
@endif

<link rel="canonical" href="{{ url()->current() }}"/>
<link rel="alternate" hreflang="{{ app()->getLocale() }}" href="{{ url()->current() }}" />
<link rel="alternate" hreflang="en" href="{{ url()->current() }}"/>

<link rel="shortcut icon" href="{{ assetVersion('images/favicon.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ assetVersion('images/favicon.png') }}"/>
<link rel="icon" href="{{ assetVersion('images/favicon.png') }}" sizes="32x32" />
<link rel="icon" href="{{ assetVersion('images/favicon.png') }}" sizes="192x192" />
<link rel="apple-touch-icon-precomposed" href="{{ assetVersion('images/favicon.png') }}" />
<meta name="msapplication-TileImage" content="{{ assetVersion('images/favicon.png') }}" />
<meta name="theme-color" content="#ff3636">

<link rel="stylesheet" href="bootstrap/v4/css/bootstrap.min.css">
<link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="plugins/jquery-confirm/jquery-confirm.min.css">
<link rel="stylesheet" href="{{ assetVersion('css/style.css') }}">
<link rel="stylesheet" href="{{ assetVersion('css/responsive.css') }}">

@stack('css')

<script type="application/ld+json">
        {
            "@context": "http:\/\/schema.org\/",
            "@type": "WebPage",
            "url": {!! json_encode(url()->current()) !!},
            "name": {!! json_encode($share_setting["seo_title_{$composerLocale}"]) !!},
            "description": {!! json_encode($share_setting["seo_description_{$composerLocale}"]) !!},
        }
</script>
{!! setting('google_analytics') !!}
