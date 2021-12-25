<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('./assets/css/bootstrap/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('./assets/fontawesome/css/all.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('./assets/css/animate.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('./assets/css/main.css')}}"/>
    <link rel="stylesheet" href="{{asset('./assets/css/style.css')}}"/>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <livewire:styles/>
    <title>Laravel Blog</title>
</head>
<body dir="rtl">
<livewire:header/>
{{ $slot }}
<livewire:footer/>
<script src="{{asset('./assets/js/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('./assets/js/popper.js')}}"></script>
<script src="{{asset('./assets/js/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('./assets/js/grid.js')}}"></script>
<livewire:scripts/>
<script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false"
        data-turbo-eval="false"></script>
<!--suppress JSUnresolvedVariable -->
{{-- for message in create comment in articles--}}
<script>
    window.livewire.on('showAlert', function (message) {
        swal.fire({
            position: 'top-start',
            icon: 'success',
            title: message,
            showConfirmButton: false,
            timer: 3000,
        });
    });
</script>
</body>
</html>
