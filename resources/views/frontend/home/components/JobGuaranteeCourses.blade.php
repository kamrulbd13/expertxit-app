<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style scoped>
    .it-section {
        background: linear-gradient(160deg, #0a1b2e 0%, #04101e 100%);
        color: #fff;
        padding: 80px 0;
        position: relative;
    }

    .it-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .it-header h2 {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        color: #eaf4ff;
    }

    .it-header p {
        font-size: 1rem;
        color: #b0c7e0;
        max-width: 620px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .it-card {
        background: rgba(255, 255, 255, 0.04);
        border-radius: 14px;
        padding: 2rem 1.5rem;
        height: 100%;
        text-align: center;
        transition: all 0.35s ease;
        border: 1px solid rgba(255, 255, 255, 0.06);
        position: relative;
        overflow: hidden;
    }

    .it-card:hover {
        transform: translateY(-6px);
        background: rgba(255, 255, 255, 0.07);
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.35);
    }

    .it-icon {
        font-size: 2.5rem;
        margin-bottom: 1.2rem;
        color: #2bb7ff;
        transition: transform 0.35s ease, color 0.35s ease;
    }

    .it-card:hover .it-icon {
        transform: scale(1.15) rotate(5deg);
        color: #4dd3ff;
    }

    .it-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: #ffffff;
    }

    .it-description {
        font-size: 0.95rem;
        color: #b0c7e0;
        line-height: 1.6;
    }

    .it-btn {
        display: inline-block;
        margin-top: 1.3rem;
        padding: 0.55rem 1.3rem;
        border-radius: 6px;
        background: linear-gradient(135deg, #2bb7ff, #0066dc);
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .it-btn:hover {
        background: linear-gradient(135deg, #0066dc, #004a99);
        transform: translateY(-2px);
    }
</style>

<div class="it-section">
    <div class="container">
        <div class="it-header">
            <h2>Professional Software & IT Services</h2>
            <p>Delivering future-ready IT solutions, software innovation, and reliable support to help businesses thrive in the digital era.</p>
        </div>

        <div class="row g-4">
            <!-- Custom Software Development -->
            <div class="col-lg-3 col-md-6">
                <div class="it-card">
                    <div class="it-icon"><i class="bi bi-code-slash"></i></div>
                    <h3 class="it-title">Custom Software Development</h3>
                    <p class="it-description">Tailored applications and systems designed to streamline operations and drive business efficiency.</p>
                    <a href="#" class="it-btn">Discover More</a>
                </div>
            </div>

            <!-- Cloud & Infrastructure Solutions -->
            <div class="col-lg-3 col-md-6">
                <div class="it-card">
                    <div class="it-icon"><i class="bi bi-cloud-check"></i></div>
                    <h3 class="it-title">Cloud & Infrastructure</h3>
                    <p class="it-description">Secure, scalable, and optimized cloud environments to support modern business demands.</p>
                    <a href="#" class="it-btn">Explore Cloud</a>
                </div>
            </div>

            <!-- IT Support & Managed Services -->
            <div class="col-lg-3 col-md-6">
                <div class="it-card">
                    <div class="it-icon"><i class="bi bi-headset"></i></div>
                    <h3 class="it-title">IT Support & Managed Services</h3>
                    <p class="it-description">Round-the-clock monitoring, troubleshooting, and maintenance to keep your systems running smoothly.</p>
                    <a href="#" class="it-btn">Get Support</a>
                </div>
            </div>

            <!-- Cybersecurity & Data Protection -->
            <div class="col-lg-3 col-md-6">
                <div class="it-card">
                    <div class="it-icon"><i class="bi bi-shield-check"></i></div>
                    <h3 class="it-title">Cybersecurity & Data Protection</h3>
                    <p class="it-description">Advanced security strategies to safeguard your business from evolving cyber threats.</p>
                    <a href="#" class="it-btn">Secure Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
