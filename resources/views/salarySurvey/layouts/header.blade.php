<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="ozaswei">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Salary Survey System</title>
<meta name="keywords"
    content="Salary, Salary Survey, Salary Survey System, salary, salary survey, salary survey system, SALARY, SALARY SURVEY, SALARY SURVEY SYSTEM" />

<meta name="author" content="Ozaswei Bahadur Tamrakar" />

<meta property="og:type" content="website">

<!--    <link rel="icon" type="image/gif/png" href="{{ URL::to('/images/logo2.png') }}">-->
<meta name="description" content="Allows users to search for any job title in any location and get their lowest, highest and average salary. It also shows top 5 job listing related to the searched title" />

<meta name="title" property="og:title" content="Salary Survey System">

<meta property="og:description" content="Allows users to search for any job title in any location and get their lowest, highest and average salary. It also shows top 5 job listing related to the searched title">

<meta property="og:site_name" content="Salary Survey System">

<meta property="og:url" content="https://github.com/ozaswei/Salary-Survey">
<!--    <meta name="image" property="og:image" content="@yield('og_image')">-->
<meta property="og:image:width" content="200" />
<meta property="og:image:height" content="200" />
<!-- font icons -->
<link rel="stylesheet" href="{{ asset('/salarySurvey/assets/vendors/themify-icons/css/themify-icons.css') }}">

<!-- google fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caprasimo&display=swap" rel="stylesheet">

<!-- Bootstrap + JohnDoe main styles -->
<link rel="stylesheet" href="{{ asset('/salarySurvey/assets/css/johndoe.css') }}">

<!-- Salary Survey main css  -->
<link rel="stylesheet" href="{{ asset('/salarySurvey/css/salarySurveyMain.css') }}">
<!-- Cdn bootstrap -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> -->
<!--font awesome -->
<!-- Custom Header -->
@yield('customHeader')
<style>
    @yield('customStyle')
</style>
