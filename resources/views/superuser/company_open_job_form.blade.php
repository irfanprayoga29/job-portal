<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Post a Job</title>

    @include('superuser.partials.css')

    <link rel="stylesheet" href="../css/styles.css" />

  </head>
  <body>
    <!-- Navbar -->
    <header>
    </header>
    @include('superuser.partials.navbar')
    
    <!-- Background image -->
    <section id="titled-img">
 
      <div
        class="bg-image"
        style="background-image: url('../assets/header-bg.png'); height: 80px"
      >
        <div
          class="mask h-100"
          style="
            background-position: center;
            background-color: rgba(0, 0, 0, 0.6);
          "
        >
          <div class="d-flex h-100 px-5">
            <h3 class="text-white my-auto">Post a Job Advertisement</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- Form -->
    <section id="forms">
      <div class="mt-4 px-5">
        <div class="px-5">
          <form>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Job Position</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Job Description</label>
              <textarea class="form-control" style="resize: none;" rows="6"></textarea>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Job Task</label>
              <textarea class="form-control" style="resize: none;" rows="3"></textarea>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Skill</label>
              <textarea class="form-control" style="resize: none;" rows="3"></textarea>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Qualification</label>
              <textarea class="form-control" style="resize: none;" rows="3"></textarea>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Minimum Education Level</label>
              <select class="form-select" aria-label="Default select example">
                <option selected>None</option>
                <option value="1">Elementary School</option>
                <option value="2">Middle School</option>
                <option value="3">High School</option>
                <option value="4">Diploma</option>
                <option value="5">Bachelor</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Minimum Work Experience</label>
              <select class="form-select" aria-label="Default select example">
                <option selected>None</option>
                <option value="1">Less than a year</option>
                <option value="2">1-2 years</option>
                <option value="3">3-4 years</option>
                <option value="4">More than 4 years</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Position Level</label>
              <select class="form-select" aria-label="Default select example">
                <option selected>Full-time</option>
                <option value="1">Part-time</option>
                <option value="2">Internship</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Working Type</label>
              <select class="form-select" aria-label="Default select example">
                <option selected>Office</option>
                <option value="1">Remote</option>
                <option value="2">Hybird</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Salary Range</label>
              <select class="form-select" aria-label="Default select example">
                <option selected>Not Showing</option>
                <option value="1">1,000,000 - 2,000,000</option>
                <option value="2">2,000,000 - 4,000,000</option>
                <option value="3">4,000,000 - 8,000,000</option>
                <option value="4">8,000,000 - 10,000,000</option>
                <option value="5">Negotiable</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Location</label>
              <select class="form-select" aria-label="Default select example">
                <option selected>Jakarta</option>
                <option value="1">Bandung</option>
                <option value="2">Surabaya</option>
                <option value="3">Semarang</option>
                <option value="4">Yogyakarta</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Age Limit</label>
              <div class="d-flex flex-row">
                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <input type="checkbox" class="form-check-input mx-2" id="exampleCheck1" checked>
                <label class="form-check-label" for="exampleCheck1 ">No limit</label>
              </div>
            </div>
            <div class="mb-3">
              <div class="col">
                <label for="exampleInputEmail1" class="form-label">Gender Preferences</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                <label class="form-check-label" for="inlineRadio1">Male</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                <label class="form-check-label" for="inlineRadio2">Female</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" checked>
                <label class="form-check-label" for="inlineRadio2">No Preference</label>
              </div>
            </div>
            <div class="mb-5">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </section>

    <!-- Footer -->
    @include('superuser.partials.footer')

    <!-- Main Script -->
    @include('superuser.partials.script')

  </body>
</html>
