<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
<meta name="author" content="Universitas 17 Agustus 1945 Surabaya">
<meta name="keyword" content="Teknik Informatika, Untag Surabaya, Informatika Untag">
<!--[if IE]><link rel="shortcut icon" href="{{base_url('assets/website/images/ico/favicon.ico')}}"><![endif]-->
<link rel="apple-touch-icon" sizes="57x57" href="{{base_url('assets/website/images/ico/apple-icon-57x57.png')}}">
<link rel="apple-touch-icon" sizes="60x60" href="{{base_url('assets/website/images/ico/apple-icon-60x60.png')}}">
<link rel="apple-touch-icon" sizes="72x72" href="{{base_url('assets/website/images/ico/apple-icon-72x72.png')}}">
<link rel="apple-touch-icon" sizes="76x76" href="{{base_url('assets/website/images/ico/apple-icon-76x76.png')}}">
<link rel="apple-touch-icon" sizes="114x114" href="{{base_url('assets/website/images/ico/apple-icon-114x114.png')}}">
<link rel="apple-touch-icon" sizes="120x120" href="{{base_url('assets/website/images/ico/apple-icon-120x120.png')}}">
<link rel="apple-touch-icon" sizes="144x144" href="{{base_url('assets/website/images/ico/apple-icon-144x144.png')}}">
<link rel="apple-touch-icon" sizes="152x152" href="{{base_url('assets/website/images/ico/apple-icon-152x152.png')}}">
<link rel="apple-touch-icon" sizes="180x180" href="{{base_url('assets/website/images/ico/apple-icon-180x180.png')}}">
<link rel="icon" type="image/png" sizes="192x192"  href="{{base_url('assets/website/images/ico/android-icon-192x192.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{base_url('assets/website/images/ico/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="96x96" href="{{base_url('assets/website/images/ico/favicon-96x96.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{base_url('assets/website/images/ico/favicon-16x16.png')}}">
<link rel="manifest" href="{{base_url('assets/website/images/ico/manifest.json')}}">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="{{base_url('assets/website/images/ico/ms-icon-144x144.png')}}">
<meta name="theme-color" content="#ffffff">
<meta property="og:title" content="Teknik Informatika | Universitas 17 Agustus 1945 Surabaya">
<meta property="og:description" content="Teknik Informatika Universitas 17 Agustus 1945 Surabaya">
<script>
//Google Analiytics ======================================================================================
addLoadEvent(loadTracking);
var trackingId = 'UA-121052246-1';

function addLoadEvent(func) {
    var oldonload = window.onload;
    if (typeof window.onload != 'function') {
        window.onload = func;
    } else {
        window.onload = function () {
            oldonload();
            func();
        }
    }
}

function loadTracking() {
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date(); a = s.createElement(o),
        m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', trackingId, 'auto');
    ga('send', 'pageview');
}
//========================================================================================================

</script>
<title>@yield('title')</title>