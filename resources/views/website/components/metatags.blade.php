@if(isset($model))
    <meta name="description" content="{{ $model[app()->getlocale()]->desc }}">
    <meta property='og:title' content="{{ $model[app()->getlocale()]->desc }}"/>
    <meta property='og:image' content="{{ image($model->thumb) }}"/>
    <meta property='og:description' content='{{ $model[app()->getlocale()]->desc }}'/>
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <meta name="google" content="nositelinkssearchbox">
    <meta name="googlebot" content="notranslate">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="+nxGUDJ4QpAZ5l9Bsjdi102tLVC21AIh5d1Nl23908vVuFHs34=">
    <link rel="canonical" href="{{ url()->current() }}"/>
@endif
