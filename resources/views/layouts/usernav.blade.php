<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">



    <style>
        @media(max-width:1520px) {
            .left-svg {
                display: none;
            }
        }

        /* small css for the mobile nav close */
        #nav-mobile-btn.close span:first-child {
            transform: rotate(45deg);
            top: 4px;
            position: relative;
            background: #a0aec0;
        }

        #nav-mobile-btn.close span:nth-child(2) {
            transform: rotate(-45deg);
            margin-top: 0px;
            background: #a0aec0;
        }

        @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@200;300;400;500;600;700;800;900&display=swap');

* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}

html,
body {
  font-family: 'Roboto Slab', serif;
  scroll-behavior: smooth;
}

li {
  list-style: none;
}

a {
  text-decoration: none;
}

.container {
  max-width: 80%;
  margin: auto;
}

.head_container {
  max-width: 90%;
  margin: auto;
}

/*--------------header--------*/
header {
  height: 8vh;
}

.logo img {
  width: 120px;
}

header nav {
  display: flex;

  justify-content: space-between;
  align-items: center;
  padding:10px;
  background-color: #198450;
  position:fixed;
  width:100%;
  z-index: 100;
 
}

.hambuger {
  display: none;
}

.bar {
  display: block;
  width: 25px;
  height: 3px;
  margin: 5px auto;
  transition: all 0.3s ease-in-out;
  background-color: #fff;
}

header ul {
  display: flex;
  justify-content: space-between;
  align-items: center;
 
}

header ul li {
  margin-left:3rem;

}

header ul li a {
  font-size: 1.2rem;
  font-weight: 400;
  color: white;

  transition: 0.5s;
}

header ul li a:hover {
  color: #C1B086;
}

@media only screen and (max-width: 768px) {
  header ul {
    display: block;
    position: fixed;
    left: -100%;
    top: 5rem;
    flex-direction: column;
    background-color: #fff;
    width: 100%;
    border-radius: 10px;
    text-align: center;
    transition: 0.5s;
    box-shadow: 0 10px 27px rgba(0, 0, 0, 0.05);
    z-index: 20;
  }

  header ul.active {
    left: 0%;
  }

  header ul li {
    margin: 2.5rem 0;
  }

  header ul li a {
    color: black;
  }

  .hambuger {
    display: block;
    cursor: pointer;
  }

  .hambuger.active .bar:nth-child(2) {
    opacity: 0;
  }

  .hambuger.active .bar:nth-child(1) {
    transform: translateY(8px) rotate(45deg);
  }

  .hambuger.active .bar:nth-child(3) {
    transform: translateY(-8px) rotate(-45deg);
  }
}

/*--------------header--------*/
/*--------------home--------*/
.home .image img {
  position: absolute;
  top: 0;
  left: 0;
  z-index: -1;
  width: 100%;
  height: 100%;
}

.home .text {
  max-width: 50%;
  color: white;
  margin: 20% 0 0 10%;
}

.home h1 {
  font-size: 80px;
  font-weight: 400;
}

.home p {
  font-weight: 400;
  line-height: 25px;
  font-family: sans-serif;
  font-size: 17px;
  margin: 50px 0 0 50px;
}

button {
  padding: 20px 40px;
  background: none;
  outline: none;
  border: 2px solid white;
  border-radius: 50px;
  color: white;
  margin-top: 20px;
}

.home button {
  margin-left: 50px;
}

.home .image_item {
  position: absolute;
  top: 20%;
  right: 20%;
  display: flex;
  flex-direction: column;
  cursor: pointer;
}

.home .image_item img {
  width: 140px;
  height: 94px;
  margin: 10px;
  transition: 0.5s;
}

.home .image_item img.active {
  border: 2px solid white;
}

.home .box .text {
  position: relative;
}

.home .box .text::after {
  position: absolute;
  content: 'H';
  font-size: 500px;
  top: -120%;
  font-weight: bold;
  opacity: 0.1;
}

/*--------------home--------*/
/*--------------book--------*/
.flex {
  display: flex;
}

.grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  grid-gap: 30px;
}

.book {
  margin-top: 5%;
  width: 100%;
  height: 20vh;
  color: white;
}

.book .input {
  background: #242e5a;
  padding: 20px 20px 40px 20px;
}

.book .search {
  background: #3f9cc1;
  padding: 20px;
}

input {
  width: 100%;
  padding: 15px;
  border: 2px solid rgba(255, 255, 255, 0.1);
  outline: none;
  background: #263760;
  margin-top: 20px;
  color: white;
}

::placeholder {
  color: white;
}

.book .search {
  width: 20%;
}

.book .search input {
  background: none;
  border: none;
  font-weight: bold;
  font-size: 20px;
  margin-top: 40px;
}

/*--------------book--------*/
/*--------------about--------*/
.top {
  margin-top: 10%;
}

.mtop {
  margin-top: 5%;
}

.left, .right {
  width: 50%;
}

.about {
  margin-bottom: 50px;
}

.about .img {
  position: relative;
}

.about .image1 {
  width: 310px;
  height: 450px;
}

.about .image2 {
  width: 325px;
  height: 220px;
  position: absolute;
  bottom: 5px;
  z-index: 2;
  right: 30%;
}

.heading {
  position: relative;
}

.heading::after {
  position: absolute;
  top: 0;
  left: 0;
  content: '';
  width: 100px;
  height: 4px;
  background: #C1B086;
}

.heading h5 {
  font-weight: 400;
  letter-spacing: 2px;
  padding-top: 20px;
  color: #5f5f5f;
}

.heading h2 {
  font-size: 30px;
  font-weight: 400;
  margin: 20px 0 40px 0;
  color: #222222;
}

.heading p {
  margin-bottom: 20px;
  line-height: 25px;
  color: #5f5f5f;
  margin: 0 0 20px 50px;
}

.heading .btn1 {
  margin: 50px 0 20px 50px;
}

.btn1 {
  background: #C1B086;
  color: white;
}

/*--------------about--------*/
/*--------------wrapper--------*/
.wrapper {
  background-image: url("../image/ami.jpg");
  background-repeat: no-repeat;
  background-size: cover;
  width: 100%;
  height: 480px;
  position: relative;
}

.wrapper .text {
  background: #3f9cc1;
  padding: 50px;
  width: 40%;
  height: 600px;
  position: absolute;
  top: -13%;
  right: 10%;
  padding-top: 10%;
  color: white;
}

.wrapper .content {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  grid-row-gap: 30px;
}

.wrapper h2 {
  font-weight: 400;
}

.wrapper p {
  margin: 20px 0 50px 0;
  line-height: 30px;
}

.wrapper i {
  margin: 5px 20px 0 0;
}

/*--------------wrapper--------*/
/*--------------room--------*/
.flex1 {
  display: flex;
  justify-content: space-between;
}

.room .grid {
  grid-template-columns: repeat(3, 1fr);
}

.room img {
  width: 100%;
  height: 100%;
}

.room .box {
  box-shadow: 0 13px 43px 0 rgb(37 46 89/10%);
}

.room .text {
  padding: 20px;
}

.room h3 {
  font-weight: 400;
  margin-bottom: 10px;
}

.room p span {
  font-size: 12px;
  color: grey;
}

.room p {
  font-size: 20px;
}

/*--------------room--------*/
/*--------------wrapper2--------*/
.wrapper2 {
  background-image: url("../image/w1.jpg");
}

.wrapper2 .text {
  left: 10%;
}

.wrapper2 h5,
.wrapper2 h2 {
  color: white;
}

.wrapper2 img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  margin-right: 20px;
}

.wrapper2 .para h5 {
  font-size: 13px;
  font-weight: 300;
  margin-top: 5px;
}

.wrapper2 .para {
  margin-left: 10%;
}

/*--------------wrapper2--------*/
/*--------------restaurant--------*/
.restaurant img {
  width: 100%;
  height: 100%;
}

.restaurant .right {
  padding: 50px 50px 50px 100px;
}

.restaurant h2 {
  margin-bottom: 20px;
  font-weight: 400;
}

.restaurant .text p {
  margin-bottom: 50px;
  line-height: 25px;
}

.accordionItem {
  margin-top: 30px;
}

.accordionItem p {
  font-size: 15px;
  opacity: 0.8;
  font-family: sans-serif;
  line-height: 20px;
}

.accordionIHeading {
  cursor: pointer;
  width: 100%;
  border-radius: 3px;
  font-weight: 400;
  font-size: 17px;
  color: #C1B086;
  margin-bottom: 20px;
}

.close .accordionItemContent {
  height: 0px;
  transition: height 1s ease-out;
  transform: scaleY(0);
  float: left;
  display: block;
  background-color: #fff;
}

.open .accordionItemContent {
  padding: 30px;
  background-color: #fff;
  width: 100%;
  margin: 0 0 10px 0;
  display: block;
  transform: scaleY(1);
  transform-origin: top;
  transition: transform 0.4s ease;
  box-sizing: border-box;
  box-shadow: 0 13px 43px 0 rgb(37 46 89 / 10%);
}

/*--------------restaurant--------*/
/*--------------gallary--------*/
.gallary img {
  width: 270px;
  height: 350px;
}

.owl-carousel .owl-next,
.owl-carousel .owl-prev {
  height: 50px;
  position: absolute;
  width: 50px;
  cursor: pointer;
  top: 35%;
  background: white !important;
  transition: 0.5s;
}

.owl-carousel .owl-prev {
  left: 33px;
}

.owl-carousel .owl-next {
  right: 33px;
}

.owl-carousel .owl-next:hover,
.owl-carousel .owl-prev:hover {
  background: #C1B086 !important;
}

/*--------------gallary--------*/
/*--------------map--------*/
.map iframe {
  width: 100%;
}

/*--------------map--------*/
/*--------------footer--------*/
footer h3 {
  margin-bottom: 20px;
}

footer li {
  margin-bottom: 15px;
  transition: 0.5s;
}

footer li:hover {
  color: #C1B086;
  cursor: pointer;
}

/*--------------footer--------*/
@media only screen and (max-width:768px) {
  .home .box .text {
    max-width: 100%;
  }

  .home .box .text::after,
  .home .image_item {
    display: none;
  }

  .restaurant .container,
  .about .container,
  .book .container {
    flex-direction: column;
  }

  .grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .book {
    margin-top: 10%;
    height: auto;
  }

  .book .search {
    width: 100%;
  }

  .book .search input {
    margin-top: 0;
  }

  .left, .right {
    width: 100%;
  }

  .wrapper .text {
    width: 80%;
  }

  .room {
    margin-bottom: 100px;
  }

  .room .grid {
    grid-template-columns: repeat(1, 1fr);
  }

  .restaurant .right {
    padding: 0;
    margin-top: 50px;
  }

  footer .payment {
    grid-template-columns: repeat(4, 1fr);
  }
}

@media only screen and (max-width:768px) {
  .grid {
    grid-template-columns: repeat(1, 1fr);
  }

  .home .text {
    margin: 10% 0 0 0;
  }

  .home h1 {
    font-size: 40px;
  }

  .about p,
  .home p {
    margin: 50px 0 0 0;
  }

  .wrapper .text {
    padding: 10px;
    height: 600px;
  }

  .heading_top {
    margin-top: 100px;
  }

  .heading_top button {
    display: none;
  }

  .restaurant .flex {
    flex-direction: column-reverse;
  }
}
    </style>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../../css/index.css">

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous"
  referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />

    <header class="header" id="navigation-menu">
    <div class="container">
      <nav>
        <a href="#" class="logo text-xl font-bold"> <img src="" alt=""><span class="text-xl font-bold text-gray-300 "> Rk</span> Hotel</a>

        <div>
        <ul class="nav-menu mx-5">
          <li> <a href="{{route('user.index')}}" class="nav-link">Home</a> </li>
          <li> <a href="#about" class="nav-link">About</a> </li>
          <li> <a href="{{route('user.hotel')}}" class="nav-link">Rooms</a> </li>
          <li> <a href="#restaurant" class="nav-link">Restaurant</a> </li>
          <li> <a href="#gallery" class="nav-link">Gallery</a> </li>
          <li> <a href="#contact" class="nav-link">Contact</a> </li>
        </ul>
        </div>

        <div>
          @auth
          <a href="" class="user-link text-gray-800 font-semibold text-base no-underline py-2 px-4 border border-transparent rounded-md transition duration-300 ease-in-out hover:bg-gray-100 hover:text-gray-900">Hi, {{ auth()->user()->name }}</a>

          <form action="{{route('logout')}}" method="post" class="inline">
            @csrf

          <Button type="submit" class="nav-link bg-gray-200 px-5 py-1 rounded text-gray-600 font-bold">Logout</Button>
          </form>
          @else
          <a href="{{route('login')}}" class="bg-blue-800 px-5 py-1 rounded font-semibold text-gray-200 mx-2">Login</a>
          <a href="{{route('register')}}" class="bg-gray-200 px-5 py-1 rounded font-semibold text-gray-800 mx-2">Register</a>
          @endauth
        </div>

        <div class="hambuger">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </div>
      </nav>
    </div>
  </header>
 
    <div class="p-4 flex-1">
        @yield('content')
    </div>
    <script>
    const hambuger = document.querySelector('.hambuger');
    const navMenu = document.querySelector('.nav-menu');

    hambuger.addEventListener("click", mobileMenu);

    function mobileMenu() {
      hambuger.classList.toggle("active");
      navMenu.classList.toggle("active");
    }

    const navLink = document.querySelectorAll('.nav-link');
    navLink.forEach((n) => n.addEventListener("click", closeMenu));

    function closeMenu() {
      hambuger.classList.remove("active");
      navMenu.classList.remove("active");
    }
  </script>
</body>

</html>