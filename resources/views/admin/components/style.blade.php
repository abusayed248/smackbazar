<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="" />
<meta name="author" content="" />
<title>Smack Bazar Dashboard-@yield('title')</title>
<link href="{{ asset('admin') }}/css/dropify.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<link href="{{ asset('admin') }}/css/styles.css" rel="stylesheet" />
@stack('style')