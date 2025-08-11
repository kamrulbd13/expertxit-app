<section class="training-experience" aria-labelledby="training-heading">
    <div class="training-container">
        <header class="training-header">
            <h2 id="training-heading" class="training-title">
                Master In-Demand Skills Through Immersive Training
            </h2>
            <p class="training-subtitle">
                A results-driven approach combining cutting-edge labs, expert-led sessions, and personalized mentorship to accelerate your professional growth.
            </p>
        </header>

        <div class="training-features" role="list">
            <article class="feature-card" role="listitem" tabindex="0">
                <div class="feature-icon" aria-hidden="true">
                    <!-- Live Interactive Sessions: chat bubble icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="none" stroke="#2c3e50" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                    </svg>
                </div>
                <h3 class="feature-title">Live Interactive Sessions</h3>
                <p class="feature-description">
                    Engage in real-time discussions and practical problem-solving led by seasoned industry experts.
                </p>
            </article>

            <article class="feature-card" role="listitem" tabindex="0">
                <div class="feature-icon" aria-hidden="true">
                    <!-- Advanced Lab Access: beaker icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="none" stroke="#2c3e50" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M6 3v12a6 6 0 0 0 12 0V3"/>
                        <line x1="6" y1="3" x2="18" y2="3"/>
                        <line x1="6" y1="15" x2="18" y2="15"/>
                        <line x1="12" y1="3" x2="12" y2="15"/>
                    </svg>
                </div>
                <h3 class="feature-title">Advanced Lab Access</h3>
                <p class="feature-description">
                    Unlimited access to our state-of-the-art virtual and physical labs with industry-standard tools.
                </p>
            </article>

            <article class="feature-card" role="listitem" tabindex="0">
                <div class="feature-icon" aria-hidden="true">
                    <!-- Expert Mentorship: user icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="none" stroke="#2c3e50" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <circle cx="12" cy="7" r="4"/>
                        <path d="M5.5 21a6.5 6.5 0 0 1 13 0"/>
                    </svg>
                </div>
                <h3 class="feature-title">Expert Mentorship</h3>
                <p class="feature-description">
                    Personalized career guidance and project feedback from certified industry professionals.
                </p>
            </article>
        </div>
    </div>
</section>

<style>


    .training-container {
        max-width: 1140px;
        margin: 0 auto;
    }

    .training-header {
        text-align: center;
        margin-bottom: 4rem;
    }

    /* subtle underline decoration */
    .training-title::after {
        content: '';
        display: block;
        width: 60px;
        height: 4px;
        background: #3b82f6; /* blue-500 */
        border-radius: 2px;
        margin: 8px auto 0;
    }

    .training-subtitle {
        font-size: 1.1rem;
        color: #475569;
        max-width: 680px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.5;
    }

    .training-features {
        display: flex;
        gap: 2.5rem;
        flex-wrap: nowrap;
        overflow-x: auto;
        padding-bottom: 0.75rem;
        -webkit-overflow-scrolling: touch;
    }

    .feature-card {
        background: #ffffff;
        border: 1.5px solid #cbd5e1;
        border-radius: 14px;
        padding: 2.5rem 2rem;
        flex: 0 0 340px;
        box-shadow:
            0 6px 10px rgba(60, 64, 67, 0.1),
            0 1px 18px rgba(60, 64, 67, 0.06);
        transition: box-shadow 0.3s ease, transform 0.3s ease;
    }



    .feature-icon {
        margin-bottom: 1.2rem;
        color: #2563eb; /* blue-600 */
    }

    .feature-title {
        font-size: 1.35rem;
        font-weight: 700;
        margin-bottom: 0.8rem;
        color: #1f2937;
    }

    .feature-description {
        font-size: 1rem;
        color: #4b5563;
        line-height: 1.5;
        margin: 0;
    }

    /* Scrollbar styling for modern browsers */
    .training-features::-webkit-scrollbar {
        height: 8px;
    }
    .training-features::-webkit-scrollbar-thumb {
        background-color: #93c5fd; /* blue-300 */
        border-radius: 12px;
    }
    .training-features::-webkit-scrollbar-track {
        background: #e9ebee;
    }

    /* Responsive tweaks */
    @media (max-width: 680px) {
        .feature-card {
            flex: 0 0 300px;
            padding: 2rem 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .training-features {
            gap: 1.25rem;
            padding-bottom: 1rem;
        }
    }
</style>
