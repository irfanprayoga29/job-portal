<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Search Job</title>
    <!-- Bootstrap -->
    @include('user.partials.css')

    <link rel="stylesheet" href="../css/styles.css" />

  </head>
  <body class="">
    <!-- Navbar -->
    <header>
    </header>
    @include('user.partials.navbar')
    
    <!-- Search -->
    <section id="searching">

      <div class="mt-4 px-5">
        <div class="px-3">

          <form class="">
            <div class="d-flex flex-row justify-content-between my-auto">
              <div class="col-5">
                <div class="input-group shadow bg-body rounded">
                  <div class="input-group-text bg-transparent ">
                      <span class="material-icons">search</i>
                    </div>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Search by Job, Skill, or Company" aria-describedby="emailHelp">
                </div>
              </div>
              <div class="col-5">
                <div class="input-group shadow bg-body rounded">
                  <div class="input-group-text bg-transparent ">
                      <span class="material-icons">location_on</i>
                    </div>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Search by Location" aria-describedby="emailHelp">
                </div>
              </div>
              
              <div class="">
                <button type="submit" class="btn btn-primary shadow">Search</button>
              </div>
            </div>
          </form>

        </div>

        <div class="mt-4 px-4">Find Your Desired Job</div>
      </div>

    </section>

    <!-- Cards -->
    <section id="job-cards">
      <div class="mt-4 px-5">
        <div class="px-3">

          <!-- Col-1 -->
          <!-- <div class="card-group">

            <div class="col-sm-4">
                <div class="card mx-1">
                  <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="card  mx-1">
                  <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card  mx-1">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
          
          </div> -->
          <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
              <div class="card h-100 shadow">
                <div class="card-body">
                  <div class="d-flex flex-row justify-content-between">
                    <div class="d-flex flex-row justify-content-between mb-2">
                      <i class="material-icons my-auto mx-4">corporate_fare</i>
                      <div class="col">
                        <h6 class="ms-1">Company Name</h6>
                        <h5 class="ms-1">Job Name</h5>
                        <div class="d-flex flex-row">
                          <i class="material-icons">location_on</i>
                          <p class="card-subtitle text-muted my-auto">Location</p>
                        </div>
                      </div>
                    </div>
                    <i class="material-icons">bookmark</i>
                  </div>
                  <div class="">

                    <div class="col">
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Satu</button>
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Dua</button>
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Tiga</button>
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Empat</button>
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Lima</button>
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Enam</button>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100 shadow">
                <div class="card-body">
                  <div class="d-flex flex-row justify-content-between">
                    <div class="d-flex flex-row justify-content-between mb-2">
                      <i class="material-icons my-auto mx-4">corporate_fare</i>
                      <div class="col">
                        <h6 class="ms-1">Company Name</h6>
                        <h5 class="ms-1">Job Name</h5>
                        <div class="d-flex flex-row">
                          <i class="material-icons">location_on</i>
                          <p class="card-subtitle text-muted my-auto">Location</p>
                        </div>
                      </div>
                    </div>
                    <i class="material-icons">bookmark</i>
                  </div>
                  <div class="">

                    <div class="col">
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Satu</button>
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Dua</button>
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Tiga</button>
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Empat</button>
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Lima</button>
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Enam</button>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100 shadow">
                <div class="card-body">
                  <div class="d-flex flex-row justify-content-between">
                    <div class="d-flex flex-row justify-content-between mb-2">
                      <i class="material-icons my-auto mx-4">corporate_fare</i>
                      <div class="col">
                        <h6 class="ms-1">Company Name</h6>
                        <h5 class="ms-1">Job Name</h5>
                        <div class="d-flex flex-row">
                          <i class="material-icons">location_on</i>
                          <p class="card-subtitle text-muted my-auto">Location</p>
                        </div>
                      </div>
                    </div>
                    <i class="material-icons">bookmark</i>
                  </div>
                  <div class="">

                    <div class="col">
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Satu</button>
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Dua</button>
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Tiga</button>
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Empat</button>
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Lima</button>
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Enam</button>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100 shadow">
                <div class="card-body">
                  <div class="d-flex flex-row justify-content-between">
                    <div class="d-flex flex-row justify-content-between mb-2">
                      <i class="material-icons my-auto mx-4">corporate_fare</i>
                      <div class="col">
                        <h6 class="ms-1">Company Name</h6>
                        <h5 class="ms-1">Job Name</h5>
                        <div class="d-flex flex-row">
                          <i class="material-icons">location_on</i>
                          <p class="card-subtitle text-muted my-auto">Location</p>
                        </div>
                      </div>
                    </div>
                    <i class="material-icons">bookmark</i>
                  </div>
                  <div class="">

                    <div class="col">
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Satu</button>
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Dua</button>
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Tiga</button>
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Empat</button>
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Lima</button>
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Enam</button>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100 shadow">
                <div class="card-body">
                  <div class="d-flex flex-row justify-content-between">
                    <div class="d-flex flex-row justify-content-between mb-2">
                      <i class="material-icons my-auto mx-4">corporate_fare</i>
                      <div class="col">
                        <h6 class="ms-1">Company Name</h6>
                        <h5 class="ms-1">Job Name</h5>
                        <div class="d-flex flex-row">
                          <i class="material-icons">location_on</i>
                          <p class="card-subtitle text-muted my-auto">Location</p>
                        </div>
                      </div>
                    </div>
                    <i class="material-icons">bookmark</i>
                  </div>
                  <div class="">

                    <div class="col">
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Satu</button>
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Dua</button>
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Tiga</button>
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Empat</button>
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Lima</button>
                      <button type="button" class="btn btn-secondary btn-sm shadow mb-1" disabled>Requirement Enam</button>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>

    </section>
    
        
    <!-- Pagination -->
    <section id="pagination">
      <div class="d-flex center">

        <div class="mx-auto my-5">
          
          
            <ul class="pagination justify-content-center shadow">
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                  <span aria-hidden="true">&lt;</span>
                </a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                  <span aria-hidden="true">&gt;</span>
                </a>
              </li>
            </ul>
        </div>
      </div>
    </section>


    <!-- footer -->
        @include('user.partials.footer')


    <!-- Main Script -->
        @include('user.partials.script')

  </body>
</html>
