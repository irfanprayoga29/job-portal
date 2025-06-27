<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Company Profile</title>

    <!-- Bootstrap CSS -->
    @include('superuser.partials.css')

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ url('front-end/css/styles_employer.css') }}">

</head>

<!-- <body
    data-bs-spy="scroll"
    data-bs-target="#navTabs"
    data-bs-offset="100"
    tabindex="0"
  > -->

<body class="d-flex flex-column">
    <header>

    </header>

    <!-- Navbar -->
    @include('superuser.partials.navbar')

    <!-- Main Content -->
    <div class="main-container">
        <div class="header-banner">
            <button class="btn upload-banner-btn">UPLOAD BANNER</button>
        </div>

        <div class="px5">
            <div class="content-wrapper">
                <div class="mx-5">
                    <h4 class="fw-bold mb-4">Edit Company Profile</h4>
                    <div class="section-card">
                        <ul class="tab-list nav flex-column" id="navTabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="#basic-info">Basic Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#web-link">Web Links</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#company-description">Company Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#photo">Photos</a>
                            </li>
                        </ul>

                        <div class="form-section">
                            <form>
                                <!-- Basic Information -->
                                <section id="basic-info">
                                    <div class="upload-logo mb-3">
                                        <img src="../assets/stewie.jpg" alt="logo" />
                                        <div>
                                            <button class="btn btn-primary-custom btn-sm">
                                                UPLOAD</button><br />
                                            <small class="text-muted">Format: .jpg, .jpeg, .png | Size: 120px x
                                                120px</small>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Company Name</label>
                                        <input type="text" class="form-control" placeholder="PT STEWIE ANDUR" />
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Short Description</label>
                                        <input type="text" class="form-control"
                                            placeholder="What is your company’s vision and mission?" />
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Office Address</label>
                                        <input type="text" class="form-control"
                                            placeholder="Unit number, building, and street" />
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <select class="form-select">
                                                <option selected>Indonesia</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-select">
                                                <option selected>DKI Jakarta</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-select">
                                                <option selected>Central Jakarta</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Number of Employees</label>
                                            <select class="form-select">
                                                <option selected>11–50 employees</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Industry</label>
                                            <select class="form-select">
                                                <option selected>Animation</option>
                                            </select>
                                        </div>
                                    </div>
                                </section>

                                <!-- Web Links -->
                                <section id="web-link">
                                    <div class="mb-3">
                                        <label class="form-label">Company Website</label>
                                        <input type="text" class="form-control" placeholder="mycompany.com" />
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control"
                                            placeholder="www.instagram.com/username" />
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control"
                                            placeholder="www.facebook.com/username" />
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control"
                                            placeholder="www.linkedin.com/company/username" />
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control"
                                            placeholder="www.twitter.com/username" />
                                    </div>
                                </section>

                                <!-- Company Description -->
                                <section id="company-description">
                                    <div class="mb-3">
                                        <label class="form-label">Company Description</label>
                                        <textarea class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Company Culture</label>
                                        <textarea class="form-control" rows="3"></textarea>
                                    </div>
                                </section>

                                <!-- Photos -->
                                <section id="photo">
                                    <div class="mb-3">
                                        <label class="form-label">Photos</label><br />
                                        <button type="button" class="btn btn-outline-secondary">
                                            Add Photos
                                        </button>
                                        <p class="text-muted mt-1">
                                            Show and tell applicants about your team, benefits, and
                                            work environment!
                                        </p>
                                    </div>
                                </section>

                                <div class="d-flex justify-content-end gap-2">
                                    <button type="button" class="btn btn-secondary-custom">
                                        CANCEL
                                    </button>
                                    <button type="submit" class="btn btn-primary-custom">
                                        SAVE CHANGES
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>

        <!-- Footer -->
        @include('superuser.partials.footer')


        <!-- Bootstrap JS -->
        @include('superuser.partials.script')

</body>

</html>
