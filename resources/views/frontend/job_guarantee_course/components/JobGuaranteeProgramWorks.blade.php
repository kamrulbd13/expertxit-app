<style>
    .how-it-works {
        padding: 3rem 0;
    }

    .steps {
        display: flex;
        flex-direction: column;
        gap: 2rem;
        margin-top: 2rem;
        position: relative;
    }

    .step {
        display: flex;
        align-items: flex-start;
        gap: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .step-number {
        background-color: var(--primary);
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-weight: bold;
    }

    .step-content {
        background-color: var(--light);
        padding: 1.5rem;
        border-radius: 8px;
        flex-grow: 1;
    }

    .steps::before {
        content: '';
        position: absolute;
        top: 20px;
        left: 20px;
        width: 2px;
        height: calc(100% - 40px);
        background-color: var(--primary);
        z-index: 0;
    }
</style>


<section class="how-it-works">
    <div class="container">
        <h2>How Our Job Guarantee Program Works</h2>
        <div class="steps">
            <div class="step">
                <div class="step-number">1</div>
                <div class="step-content">
                    <h4>Enrollment & Training</h4>
                    <p>Complete our intensive training program with hands-on labs and real-world projects.</p>
                </div>
            </div>
            <div class="step">
                <div class="step-number">2</div>
                <div class="step-content">
                    <h4>Skill Certification</h4>
                    <p>Earn industry-recognized certifications to validate your skills to employers.</p>
                </div>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <div class="step-content">
                    <h4>Career Preparation</h4>
                    <p>Work with our career counselors to polish your resume and interview skills.</p>
                </div>
            </div>
            <div class="step">
                <div class="step-number">4</div>
                <div class="step-content">
                    <h4>Job Placement</h4>
                    <p>Get matched with our hiring partners and secure your dream job in networking.</p>
                </div>
            </div>
        </div>
    </div>
</section>
