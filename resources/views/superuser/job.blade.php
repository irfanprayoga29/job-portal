<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- Add Bootstrap CSS -->
   @include('superuser.partials.css')
    <link rel="stylesheet" href="{{ url('front-end\css\style_job.css') }}" >
  </head>
  <body>
    <!-- Navbar -->
    <header>
      @include('superuser.partials.navbar')
    </header>

    <!-- Add padding to content below fixed navbar -->
    <div style="padding-top: 80px">
      <!-- Rest of your content remains the same -->
      <div class="job-app">
        <h1><b>Job Application</b></h1>
        <!-- ... rest of your content ... -->
         <p>
  1,223 inspirational designs, illustrations, and graphic elements from
  the world’s best designers. Want more inspiration? Browse our search
  results.
</p>
<br />
</div>
<div class="container">
<div class="post">
  <a href="https://id.jobstreet.com/best-jobs">
    <img src="{{ url('front-end/img/frame2.png')}}" width="400" />
  </a>
  <p style="display: flex; align-items: center">
    <img src="{{ url('front-end/img/logo1.png')}}" width="15" style="margin-right: 8px" />
    Ronas IT | UI/UX Team
    <i>🩶270k</i>
  </p>
</div>
<div class="post2">
  <a href="https://nexthrsolutions.com/">
    <img src="{{ url('front-end/img/frame3.png')}}" width="400" />
  </a>
  <p style="display: flex; align-items: center">
    <img src="{{ url('front-end/img/logo2.png')}}" width="15" style="margin-right: 8px" />
    Pixelate Studio
    <i>🩶150k</i>
  </p>
</div>
<div class="post3">
  <a href="https://www.keitoto.com/">
    <img src="{{ url('front-end/img/frame4.png')}}" width="400" />
  </a>
  <p style="display: flex; align-items: center">
    <img src="{{ url('front-end/img/logo3.png')}}" width="15" style="margin-right: 8px" />
    Keitoto
    <i>🩶180k</i>
  </p>
</div>
<div class="post4">
  <a href="https://id.jobstreet.com/best-jobs">
    <img src="{{ url('front-end/img/frame2.png')}}" width="400" />
  </a>
  <p style="display: flex; align-items: center">
    <img src="{{ url('front-end/img/logo3.png')}}" width="15" style="margin-right: 8px" />
    Keitoto
    <i>🩶270k</i>
  </p>
</div>
<div class="post5">
  <a href="https://www.upwork.com/freelance-jobs/">
    <img src="{{ url('front-end/img/frame5.png')}}" width="400" />
  </a>
  <p style="display: flex; align-items: center">
    <img src="{{ url('front-end/img/logo4.png')}}" width="15" style="margin-right: 8px" />
    Odama
    <i>🩶500k</i>
  </p>
</div>
<div class="post6">
  <a
    href="https://id.jobstreetexpress.com/"
  >
    <img src="{{ url('front-end/img/frame6.png')}}" width="400" />
  </a>
  <p style="display: flex; align-items: center">
    <img src="{{ url('front-end/img/logo4.png')}}" width="15" style="margin-right: 8px" />
    Odama
    <i>🩶50k</i>
  </p>
</div>
<div class="post7">
  <a href="https://www.upwork.com/freelance-jobs/">
    <img src="{{ url('front-end/img/frame4.png')}}" width="400" />
  </a>
  <p style="display: flex; align-items: center">
    <img src="{{ url('front-end/img/logo3.png')}}" width="15" style="margin-right: 8px" />
    Lavala
    <i>🩶270k</i>
  </p>
</div>
<div class="post8">
  <a href="https://id.jobstreet.com/best-jobs">
    <img src="{{ url('front-end/img/frame6.png')}}" width="400" />
  </a>
  <p style="display: flex; align-items: center">
    <img src="{{ url('front-end/img/logo1.png')}}" width="15" style="margin-right: 8px" />
    Ronas IT | UI/UX Team
    <i>🩶190k</i>
  </p>
      </div>
    </div>

     @include('user.partials.footer')
     @include('user.partials.script')
  </body>
</html>
