<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="ozaswei">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Ozaswei | Portfolio</title>
<meta name="keywords"
    content="Ozaswei, Ozaswei Bahadur, Ozaswei Bahadur Tamrakar, ozaswei, ozaswei bahadur, ozaswei bahadur tamrakar, OZASWEI, OZASWEI BAHADUR, OZASWEI BAHADUR TAMRAKAR" />

<meta name="author" content="Ozaswei Bahadur Tamrakar" />

<meta property="og:type" content="website">

<!--    <link rel="icon" type="image/gif/png" href="{{ URL::to('/images/logo2.png') }}">-->
<meta name="description" content="Brief portfolio of Ozaswei" />

<meta name="title" property="og:title" content="Ozaswei | Portfolio">

<meta property="og:description" content="Brief portfolio of Ozaswei">

<meta property="og:site_name" content="Ozaswei | Portfolio">

<meta property="og:url" content="http://ozaswei.com.np/">
<!--    <meta name="image" property="og:image" content="@yield('og_image')">-->
<meta property="og:image:width" content="200" />
<meta property="og:image:height" content="200" />
<!-- font icons -->
<link rel="stylesheet" href="{{ asset('/frontPage/assets/vendors/themify-icons/css/themify-icons.css') }}">

<!-- google fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caprasimo&display=swap" rel="stylesheet">

<!-- Bootstrap + JohnDoe main styles -->
<link rel="stylesheet" href="{{ asset('/frontPage/assets/css/johndoe.css') }}">
<!-- project section css  -->
<link rel="stylesheet" href="{{ asset('/frontPage/assets/css/projectSection.css') }}">
<!-- portfolio section css  -->
<link rel="stylesheet" href="{{ asset('/frontPage/assets/css/portfolioSection.css') }}">
<!-- Cdn bootstrap -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> -->
<!--font awesome -->
<!-- Custom Header -->
@yield('customHeader')
<style>
    .portfolio-item img {
        transition: transform 0.3s ease;
    }

    .portfolio-item:hover img {
        transform: scale(1.1);
    }

    .project1 {
        background-color: transparent;
        font-size: 30px;
        font-weight: bold;
        letter-spacing: 1px;
    }

    .myresume {
        background-color: #34495e;
    }

    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap');

    .get-in-touch-container {
        font-family: 'Roboto', sans-serif;
        max-width: 600px;
        margin: 0 auto;
        padding: 40px;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .getintouch {
        display: flex;
        flex-direction: column;
    }

    .getintouch h2 {
        color: #333;
        font-size: 28px;
        margin-bottom: 20px;
        text-align: center;
    }

    .getintouch p {
        color: #666;
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 30px;
        text-align: center;
    }

    .contact {
        background-image: url('frontPage/images/image8.1.gif');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .contact-methods {
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin-bottom: 30px;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        background-color: white;
        border-radius: 8px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .contact-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .contact-item i {
        font-size: 24px;
        color: #4a90e2;
    }

    .contact-item span {
        font-size: 16px;
        color: #333;
    }

    .contact-button {
        display: block;
        width: 100%;
        padding: 15px;
        background-color: #4a90e2;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .contact-button:hover {
        background-color: #3a7bc8;
    }

    .animationDiv {
        position: relative;
        width: 100%;
        height: 12vh;
        /* Responsive height (adjustable) */
        overflow: hidden;
        /* Ensures elements that move out of the container are hidden */
    }

    .walkingMan,
    .walkingDog,
    .walkingCat {
        position: absolute;
        bottom: 0;
        /* Align all images to the bottom */
        width: 60px;
        /* Fixed width for all images */
        height: auto;
        /* Maintain aspect ratio */
        animation: moveLeft 10s linear infinite;
        /* Move left with 10s duration, infinite loop */
    }

    .walkingMan {
        left: 100%;
        /* Start outside the right edge */
    }

    .walkingDog {
        left: calc(100% + 70px);
        animation-delay: 0.5s;
        /* Start next to the man, keeping a gap */
    }

    .walkingCat {
        left: calc(100% + 140px);
        animation-delay: 1s;
        /* Start next to the dog, maintaining spacing */
    }

    @keyframes moveLeft {
        0% {
            left: 100%;
            /* Start from the right */
        }

        100% {
            left: -200px;
            /* Move off the left side */
        }
    }

    @yield('customStyle')
</style>
