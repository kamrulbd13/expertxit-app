<style>
    .faq h2 {
        text-align: center;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .accordion {
        max-width: 900px;
        margin: 0 auto;
    }

    .accordion-item {
        border: 1px solid #ddd;
        border-radius: 6px;
        margin-bottom: 1rem;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .accordion-label {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: var(--light);
        padding: 1rem;
        cursor: pointer;
        font-weight: 600;
        transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
        border-left: 4px solid transparent;
    }

    .accordion-label:hover {
        background-color: #2b2155;
        color: #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-left: 4px solid var(--primary); /* optional highlight on hover */
    }

    .accordion-label .accordion-icon {
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .accordion-label:hover .accordion-icon {
        color: #00a834; /* optional accent color */
    }

    .accordion-item:focus-within .accordion-label {
        background-color: #2b2155;
        color: #fff;
    }
    .accordion-checkbox {
        display: none;
    }

    .accordion-content {
        max-height: 0;
        overflow: hidden;
        padding: 0 1rem;
        transition: max-height 0.4s ease, padding 0.3s ease;
        background: #fff;
    }

    .accordion-checkbox:checked ~ .accordion-content {
        max-height: 500px;
        padding: 1rem;
    }

    .accordion-icon {
        transition: transform 0.3s ease;
        font-size: 1.2rem;
        color: #2b2155;
    }

    .accordion-checkbox:checked + .accordion-label .accordion-icon {
        transform: rotate(45deg); /* turns '+' into 'x' */
    }
</style>

<section class="faq">
    <div class="container">
        <h2>Frequently Asked Questions</h2>

        <div class="accordion">
            <div class="accordion-item">
                <input type="checkbox" id="faq1" class="accordion-checkbox">
                <label for="faq1" class="accordion-label">
                    <span>What happens if I don't get a job after completing the program?</span>
                    <span class="accordion-icon">+</span>
                </label>
                <div class="accordion-content">
                    <p>If you meet all program requirements and don't receive a qualifying job offer within 6 months of completing the program, we will refund 100% of your tuition fees as per our guarantee terms.</p>
                </div>
            </div>

            <div class="accordion-item">
                <input type="checkbox" id="faq2" class="accordion-checkbox">
                <label for="faq2" class="accordion-label">
                    <span>What is the minimum salary I can expect?</span>
                    <span class="accordion-icon">+</span>
                </label>
                <div class="accordion-content">
                    <p>While salaries vary by location and company, our guarantee ensures a minimum starting salary of ₹3.5 LPA for entry-level positions. Many of our students secure positions with significantly higher compensation packages.</p>
                </div>
            </div>

            <div class="accordion-item">
                <input type="checkbox" id="faq3" class="accordion-checkbox">
                <label for="faq3" class="accordion-label">
                    <span>How long is the training program?</span>
                    <span class="accordion-icon">+</span>
                </label>
                <div class="accordion-content">
                    <p>The intensive program duration is 6 months, including both classroom training and hands-on lab work. This is followed by our placement assistance period.</p>
                </div>
            </div>

            <div class="accordion-item">
                <input type="checkbox" id="faq4" class="accordion-checkbox">
                <label for="faq4" class="accordion-label">
                    <span>Do I need prior networking experience?</span>
                    <span class="accordion-icon">+</span>
                </label>
                <div class="accordion-content">
                    <p>No prior professional experience is required, though basic computer literacy is expected. Our program is designed to take students from foundational concepts to job-ready skills.</p>
                </div>
            </div>

            <div class="accordion-item">
                <input type="checkbox" id="faq5" class="accordion-checkbox">
                <label for="faq5" class="accordion-label">
                    <span>What kind of companies hire your graduates?</span>
                    <span class="accordion-icon">+</span>
                </label>
                <div class="accordion-content">
                    <p>Our hiring partners include IT service companies, network infrastructure providers, cybersecurity firms, cloud service providers, and enterprise IT departments across various industries.</p>
                </div>
            </div>
        </div>
    </div>
</section>
