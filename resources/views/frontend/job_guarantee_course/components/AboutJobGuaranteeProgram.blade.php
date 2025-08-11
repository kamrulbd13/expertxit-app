<style>


    .tabs {
        display: flex;
        justify-content: center;
        margin: 2rem 0;
        border-bottom: 1px solid #ddd;
    }

    .tab-btn {
        padding: 1rem 2rem;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 1rem;
        font-weight: bold;
        color: var(--dark);
        position: relative;
    }

    .tab-btn.active {
        color: var(--primary);
    }

    .tab-btn.active::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: var(--primary);
    }

    .tab-content {
        display: none;
        padding: 2rem 0;
    }

    .tab-content.active {
        display: block;
    }


    .program-highlights {

        padding: 10px;
    }

    .highlight-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .card {
        background-color: white;
        border-radius: 8px;
        padding: 2rem;
        transition: transform 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card h3 {
        color: var(--primary);
        margin-top: 0;
    }

    .guarantee-badge {
        display: inline-block;
        text-align: center;
        color: white;
        padding: 0.5rem .5rem;
        border-radius: 20px;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .placement-stats {

        color: white;
        background-color: #00a834;
        text-align: center;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }
    .stat-item h2 {
        font-size: 2.5rem;
        color: var(--primary);
        margin: 0.5rem 0;
    }

</style>



<div class="container bg-light shadow-sm mb-5">
    <div class="tabs">
        <button class="tab-btn active" data-tab="overview">Program Overview</button>
        <button class="tab-btn" data-tab="eligibility">Eligibility</button>
        <button class="tab-btn" data-tab="courses">Courses Covered</button>
        <button class="tab-btn" data-tab="terms">Terms & Conditions</button>
    </div>

    <div id="overview" class="tab-content active">
        <h2>About the Job Guarantee Program</h2>
        <p>Our Job Guarantee Program is designed to provide students with the skills and certifications needed to launch successful careers in networking and cybersecurity. With our intensive hands-on training, expert instructors, and industry connections, we ensure you're job-ready upon completion.</p>

        <div class="program-highlights mb-3">
            <h2>Program Highlights</h2>
            <div class="highlight-cards">
                <div class="card shadow-sm">
                    <div class="guarantee-badge" style="background-color: #44bd32">100% Guarantee</div>
                    <h3>Job Placement Assurance</h3>
                    <p>We guarantee you'll secure a job within 6 months of completing the program or we'll refund your tuition fees.</p>
                </div>
                <div class="card shadow-sm">
                    <h3>Industry-Aligned Curriculum</h3>
                    <p>Our courses are designed in collaboration with industry leaders to ensure you learn the most in-demand skills.</p>
                </div>
                <div class="card shadow-sm">
                    <h3>Hands-On Training</h3>
                    <p>Gain practical experience with real-world projects and scenarios in our state-of-the-art labs.</p>
                </div>
                <div class="card shadow-sm">
                    <h3>Career Support</h3>
                    <p>From resume building to interview preparation, we provide comprehensive career support services.</p>
                </div>
                <div class="card shadow-sm">
                    <h3>Industry Certifications</h3>
                    <p>Prepare for and earn valuable certifications that employers look for in candidates.</p>
                </div>
                <div class="card shadow-sm">
                    <h3>Alumni Network</h3>
                    <p>Join our extensive network of successful alumni working in top companies worldwide.</p>
                </div>
            </div>
        </div>

        <div class="placement-stats py-4 rounded-2 shadow-sm">
            <h2>Our Placement Statistics</h2>
            <div class="stats-grid">
                <div class="stat-item">
                    <h2>98%</h2>
                    <p>Placement Rate</p>
                </div>
                <div class="stat-item">
                    <h2>250+</h2>
                    <p>Hiring Partners</p>
                </div>
                <div class="stat-item">
                    <h2>5000+</h2>
                    <p>Students Placed</p>
                </div>
                <div class="stat-item">
                    <h2>4.8/5</h2>
                    <p>Student Satisfaction</p>
                </div>
            </div>
        </div>
    </div>

    <div id="eligibility" class="tab-content">
        <h2>Eligibility Criteria</h2>
        <p>To enroll in our Job Guarantee Program, candidates must meet the following requirements:</p>
        <ul>
            <li>Minimum educational qualification: Bachelor's degree in any discipline (IT/CS preferred but not mandatory)</li>
            <li>Basic understanding of computer systems and networking concepts</li>
            <li>Commitment to complete the entire training program</li>
            <li>Willingness to relocate for job opportunities (if required)</li>
            <li>Pass our technical aptitude assessment</li>
        </ul>

        <h3>Selection Process</h3>
        <div class="steps">
            <div class="step">
                <div class="step-number">1</div>
                <div class="step-content rounded-2 shadow-sm">
                    <h4>Application Submission</h4>
                    <p>Fill out our online application form with your details and educational background.</p>
                </div>
            </div>
            <div class="step">
                <div class="step-number ">2</div>
                <div class="step-content rounded-2 shadow-sm">
                    <h4>Aptitude Test</h4>
                    <p>Complete our technical aptitude assessment to evaluate your foundational knowledge.</p>
                </div>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <div class="step-content rounded-2 shadow-sm">
                    <h4>Interview</h4>
                    <p>Participate in a personal interview with our admissions team.</p>
                </div>
            </div>
            <div class="step">
                <div class="step-number">4</div>
                <div class="step-content rounded-2 shadow-sm">
                    <h4>Enrollment</h4>
                    <p>Upon acceptance, complete the enrollment process and begin your journey.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="courses" class="tab-content p-3">
        <h2>Courses Covered in the Program</h2>
        <p>Our comprehensive curriculum covers the most in-demand networking and cybersecurity skills:</p>

        <h3>Core Courses</h3>
        <ul>
            <li>CCNA (Cisco Certified Network Associate)</li>
            <li>CCNP (Cisco Certified Network Professional)</li>
            <li>Network Security Fundamentals</li>
            <li>Firewall Technologies</li>
            <li>Cloud Networking</li>
            <li>Python for Network Engineers</li>
        </ul>

        <h3>Certification Preparation</h3>
        <ul>
            <li>CCNA Certification Exam Prep</li>
            <li>CCNP Certification Exam Prep</li>
            <li>CompTIA Security+</li>
            <li>Certified Ethical Hacker (CEH)</li>
        </ul>

        <h3>Practical Training</h3>
        <ul>
            <li>Hands-on lab sessions with real networking equipment</li>
            <li>Network design and implementation projects</li>
            <li>Troubleshooting real-world network scenarios</li>
            <li>Internship opportunities with partner companies</li>
        </ul>
    </div>

    <div id="terms" class="tab-content p-3">
        <h2>Terms & Conditions</h2>
        <p>Our Job Guarantee comes with certain terms that ensure both parties are committed to the success of the program:</p>

        <h3>Student Responsibilities</h3>
        <ul>
            <li>Maintain 90% or higher attendance throughout the program</li>
            <li>Complete all assignments, projects, and lab work on time</li>
            <li>Score 80% or higher in all course assessments</li>
            <li>Participate in all career preparation activities (resume workshops, mock interviews, etc.)</li>
            <li>Apply to a minimum of 5 job opportunities per week during the placement period</li>
            <li>Be open to job opportunities anywhere in India</li>
            <li>Accept any reasonable job offer (minimum salary as specified in contract)</li>
        </ul>

        <h3>Network Bulls Guarantees</h3>
        <ul>
            <li>Provide comprehensive training as outlined in the curriculum</li>
            <li>Offer career support services including resume building and interview preparation</li>
            <li>Provide access to our job portal and hiring partners</li>
            <li>Refund tuition fees if qualified student is not placed within 6 months of program completion</li>
        </ul>

        <h3>Refund Policy</h3>
        <p>To qualify for the refund under the job guarantee:</p>
        <ul>
            <li>Student must have met all program requirements</li>
            <li>Refund will be processed within 30 days of guarantee expiration</li>
            <li>Refund amount will be 100% of tuition fees paid</li>
            <li>Placement guarantee is valid for 6 months from program completion date</li>
        </ul>
    </div>
</div>

