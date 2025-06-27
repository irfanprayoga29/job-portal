<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Software Engineer - Front End</title>
    <!-- Bootstrap -->
    @include('user.partials.css')
    <link rel="stylesheet" href="{{ url('front-end/css/styles_damar.css')}}">
    
  </head>
  <body>
    <!-- Navbar -->
    <header>
 
    </header>
         @include('user.partials.navbar')

    <header class="mb-3">
      <div class="container" style="height: 40px"></div>

      <h1>SOFTWARE ENGINEER<br /><small>(FRONT END)</small></h1>
      <p>TechNova Solutions &bull; Jakarta, Indonesia</p>
      <div class="info-box">
        <div class="info-item">Full time - Hybrid</div>
        <div class="info-item">Posted 2 days ago</div>
        <div class="info-item">Deadline: May 30, 2025</div>
      </div>
      <div class="salary">IDR 12,000,000 – 18,000,000/month</div>
    </header>

    <main class="mb-3">
      <div class="my-2">
        <div class="section">
          <span class="highlight">Job Description</span>
          <p>
            We are looking for a talented and enthusiastic Frontend Software
            Engineer to join our growing development team. You will be
            responsible for building and maintaining user interfaces that are
            fast, accessible, and engaging.
          </p>
        </div>

        <div class="section">
          <span class="highlight">Responsibilities</span>
          <ul>
            <li>
              Develop responsive web applications using React.js and Next.js
            </li>
            <li>
              Collaborate with UX/UI designers to translate designs into code
            </li>
            <li>Write clean, maintainable, and efficient code</li>
            <li>Optimize components for speed and scalability</li>
            <li>Participate in code reviews and technical discussions</li>
          </ul>
        </div>

        <div class="section">
          <span class="highlight">Requirements</span>
          <ul>
            <li>Bachelor’s degree in Computer Science or related field</li>
            <li>
              2+ years of experience with JavaScript and modern frontend
              frameworks
            </li>
            <li>
              Proficiency in React, TypeScript, HTML, CSS (Tailwind is a plus)
            </li>
            <li>Experience with RESTful APIs and Git</li>
            <li>Strong problem-solving skills and attention to detail</li>
          </ul>
        </div>

        <div class="section">
          <span class="highlight">Preferred Qualifications</span>
          <ul>
            <li>Experience with CI/CD and testing tools (Jest, Cypress)</li>
            <li>Familiarity with Agile/Scrum methodology</li>
            <li>Contributions to open-source projects</li>
          </ul>
        </div>

        <div class="section">
          <span class="highlight">About TechNova Solutions</span>
          <p>
            TechNova is a leading SaaS company focused on developing modern
            software tools for productivity and collaboration. Our culture
            promotes continuous learning, innovation, and work-life balance.
          </p>
        </div>

        <div class="section">
          <span class="highlight">Benefits</span>
          <ul>
            <li>Competitive salary and performance bonuses</li>
            <li>BPJS Kesehatan & Ketenagakerjaan</li>
            <li>Remote work flexibility</li>
            <li>Annual training and conference budget</li>
            <li>Modern working equipment (MacBook, external monitor, etc.)</li>
          </ul>
        </div>

        <a class="apply-btn" href="#">Apply Now!</a>
      </div>
    </main>

    @include('user.partials.footer')
    @include('user.partials.script')
  </body>
</html>
