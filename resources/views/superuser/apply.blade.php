<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kerja.in - Apply Applicant</title>

    {{-- Style --}}
    @include('superuser.partials.css')

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ url('front-end/css/apply-applicant.css') }}">

</head>

<body>
    <!-- Navbar -->
    <header>
    </header>

    <!-- Navbar -->
    @include('superuser.partials.navbar')

    {{-- Content --}}
    <div class="applicant-container">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold" style="color: var(--primary-dark);">List of Applicants</h2>
                <div class="d-flex gap-3">
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                            data-bs-toggle="dropdown">
                            Filter Status
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">All</a></li>
                            <li><a class="dropdown-item" href="#">New</a></li>
                            <li><a class="dropdown-item" href="#">Proccesseed</a></li>
                            <li><a class="dropdown-item" href="#">Accepted</a></li>
                            <li><a class="dropdown-item" href="#">Declined</a></li>
                        </ul>
                    </div>
                    <div class="input-group" style="width: 300px;">
                        <input type="text" class="form-control" placeholder="Find Applicant...">
                        <button class="btn btn-primary" type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Applicant List -->
            <div class="applicant-list">
                <!-- Applicant Card 1 -->
                <div class="applicant-card p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-4">
                            <div class="rounded-circle bg-light" style="width: 60px; height: 60px;"></div>
                            <div>
                                <h5 class="mb-1">John Doe</h5>
                                <p class="text-muted mb-0">Frontend Developer - Apply 2 days ago</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="status-badge status-new">NEW</span>
                            <button class="btn btn-primary action-btn" data-bs-toggle="modal"
                                data-bs-target="#detailModal">
                                <i class="bi bi-eye"></i> Detail
                            </button>
                            <div class="dropdown">
                                <button class="btn btn-light" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"
                                            onclick="updateStatus('accepted', this)"><i class="bi bi-check-circle"></i>
                                            Accept</a></li>
                                    <li><a class="dropdown-item" href="#"
                                            onclick="updateStatus('rejected', this)"><i class="bi bi-x-circle"></i>
                                            Decline</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-download"></i> Download
                                            CV</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Applicant Card 2 -->
                <div class="applicant-card p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-4">
                            <div class="rounded-circle bg-light" style="width: 60px; height: 60px;"></div>
                            <div>
                                <h5 class="mb-1">Jane Smith</h5>
                                <p class="text-muted mb-0">Backend Developer - Melamar 5 hari lalu</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="status-badge status-accepted">ACCEPTED</span>
                            <button class="btn btn-outline-secondary action-btn">
                                <i class="bi bi-envelope"></i> Contact
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Applicant Card 2 -->
                <div class="applicant-card p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-4">
                            <div class="rounded-circle bg-light" style="width: 60px; height: 60px;"></div>
                            <div>
                                <h5 class="mb-1">Jane Smith</h5>
                                <p class="text-muted mb-0">Backend Developer - Melamar 5 hari lalu</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="status-badge status-declined">DECLINED</span>
                            <button class="btn btn-outline-secondary action-btn">
                                <i class="bi bi-envelope"></i> Contact
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Applicant Detail Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Pelamar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <div class="rounded-circle bg-light mx-auto"
                                            style="width: 100px; height: 100px;"></div>
                                    </div>
                                    <h5>John Doe</h5>
                                    <p class="text-muted">Frontend Developer</p>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="bi bi-linkedin"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm">
                                            <i class="bi bi-github"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6>Informasi Kontak</h6>
                            <ul class="list-unstyled">
                                <li><i class="bi bi-envelope me-2"></i>john.doe@email.com</li>
                                <li><i class="bi bi-phone me-2"></i>0812-3456-7890</li>
                                <li><i class="bi bi-geo-alt me-2"></i>Jakarta, Indonesia</li>
                            </ul>

                            <h6 class="mt-4">Keterampilan</h6>
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-primary">JavaScript</span>
                                <span class="badge bg-primary">React</span>
                                <span class="badge bg-primary">HTML/CSS</span>
                            </div>

                            <h6 class="mt-4">Catatan Tambahan</h6>
                            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do
                                eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('superuser.partials.footer')

    <!-- Script -->
    @include('superuser.partials.script')

    {{-- Custom JS --}}
    <script src="{{ url('/js/apply-applicant.js') }}"></script>

</body>

</html>
