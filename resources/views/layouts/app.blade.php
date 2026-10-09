<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GAK Construction')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

@include('partials.header')

@yield('content')

@include('partials.footer')

<script>
    window.addEventListener('scroll', () => {
        document.getElementById('mainHeader').classList.toggle('scrolled', window.scrollY > 50);
    });
    document.getElementById('hamburger').addEventListener('click', () => {
        document.getElementById('navMenu').classList.toggle('active');
    });
</script>
</body>
</html>