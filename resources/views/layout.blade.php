<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mountain Artisan Collective</title>
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
	<!-- <link rel="stylesheet" type="text/css" href="/css/footer.css"> -->


</head>
<body>
    @include('navs.header')
    
    @yield('content')
    
    
    @include('navs.footer') 
</body>
</html>