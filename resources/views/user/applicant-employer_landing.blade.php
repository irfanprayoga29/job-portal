<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Job Search Landing</title>
    
    @include('user.partials.css')
    <link rel="stylesheet" href="{{ url('front-end/css/styles_damar.css')}}">
    
    <!-- <style>
      .search-box {
        max-width: 500px;
        margin: 20px auto;
      }
      .search-input {
        border-radius: 10px 0 0 10px;
      }
      .search-btn {
        background-color: #f82c6b;
        color: white;
        border-radius: 0 10px 10px 0;
      }
      .section-title {
        font-weight: bold;
        font-size: 2rem;
      }
      .section-subtitle {
        color: #666;
      }
    </style> -->
  </head>
  <body>
    
    <header>

    </header>
          @include('user.partials.navbar') 


    <div class="container" style="height: 40px"></div>
    <main class="text-center py-5 mb-3">
      <h1 class="section-title">Find your dream job</h1>
      <p class="section-subtitle">
        Explore thousands of job opportunities from top companies
      </p>

      <div class="search-box d-flex justify-content-center">
        <input
          type="text"
          class="form-control search-input"
          placeholder="Search job titles or keywords"
        />
        <button class="btn search-btn">
          <i class="bi bi-search"></i> Search
        </button>
      </div>
    </main>

   @include('user.partials.footer')
    @include('user.partials.script')
  </body>
</html>
