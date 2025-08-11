<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style scoped>
    .training-section {
        background: linear-gradient(to bottom, #ffffff 0%, #f8fafc 100%);
        padding: 50px 0;
        position: relative;
        overflow: hidden;
    }

    .training-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 8px;
        background: linear-gradient(90deg, #0066dc, #0f172a);
    }

    .training-header {
        text-align: center;
        margin-bottom: 4rem;
        position: relative;
        z-index: 2;
    }

    .training-header h2 {
        font-size: 2.5rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 1rem;
        position: relative;
        display: inline-block;
    }

    .training-header h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, #0066dc, #0f172a);
        border-radius: 2px;
    }

    .training-header p {
        color: #64748b;
        font-size: 1.1rem;
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .training-card {
        background: #fff;
        border-radius: 16px;
        padding: 2.5rem 2rem;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        height: 100%;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .training-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #0066dc, #0f172a);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .training-card:hover {
        transform: translateY(-8px);
        border-color: rgba(0, 102, 220, 0.2);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
    }

    .training-card:hover::after {
        transform: scaleX(1);
    }

    .training-icon {
        width: 80px;
        height: 80px;
        background: rgba(0, 102, 220, 0.08);
        color: #0066dc;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        margin: 0 auto 1.5rem;
        transition: all 0.4s ease;
    }

    .training-card:hover .training-icon {
        background: linear-gradient(135deg, #0066dc, #0f172a);
        color: #fff;
        transform: scale(1.1) rotate(5deg);
    }

    .training-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 1rem;
        position: relative;
    }

    .training-desc {
        font-size: 1rem;
        color: #64748b;
        line-height: 1.7;
        margin-bottom: 1.5rem;
    }

    .training-btn {
        display: inline-block;
        color: #0066dc;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        position: relative;
        transition: all 0.3s ease;
    }

    .training-btn::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 2px;
        background: #0066dc;
        transform: scaleX(0);
        transform-origin: right;
        transition: transform 0.3s ease;
    }

    .training-card:hover .training-btn {
        color: #0f172a;
    }

    .training-card:hover .training-btn::after {
        transform: scaleX(1);
        transform-origin: left;
        background: #0f172a;
    }

    @media (max-width: 991.98px) {
        .training-header h2 {
            font-size: 2rem;
        }

        .training-card {
            padding: 2rem 1.5rem;
        }
    }

    @media (max-width: 767.98px) {
        .training-section {
            padding: 70px 0;
        }

        .training-header h2 {
            font-size: 1.8rem;
        }

        .training-icon {
            width: 70px;
            height: 70px;
            font-size: 2rem;
        }
    }
</style>

<div class="training-section">
    <div class="container">
        <div class="training-header">
            <h2>Professional Training & Kids Programming</h2>
            <p>Bridging the gap between professional development and youth education through comprehensive technology training programs that inspire innovation at every age.</p>
        </div>

        <div class="row g-4">
            <!-- Professional IT Training -->
            <div class="col-md-6 col-lg-3">
                <div class="training-card">
                    <div class="training-icon"><i class="bi bi-laptop"></i></div>
                    <h3 class="training-title">Professional IT Training</h3>
                    <p class="training-desc">Advanced certification programs in networking, cybersecurity, and cloud computing for career advancement.</p>
                    <a href="#" class="training-btn">Explore Programs →</a>
                </div>
            </div>

            <!-- Corporate Upskilling -->
            <div class="col-md-6 col-lg-3">
                <div class="training-card">
                    <div class="training-icon"><i class="bi bi-building-gear"></i></div>
                    <h3 class="training-title">Corporate Upskilling</h3>
                    <p class="training-desc">Tailored training solutions to enhance your team's technical capabilities and digital transformation.</p>
                    <a href="#" class="training-btn">Learn More →</a>
                </div>
            </div>

            <!-- Kids Coding Camps -->
            <div class="col-md-6 col-lg-3">
                <div class="training-card">
                    <div class="training-icon"><i class="bi bi-code-slash"></i></div>
                    <h3 class="training-title">Kids Coding Camps</h3>
                    <p class="training-desc">Interactive programming courses designed to spark creativity and logical thinking in young minds.</p>
                    <a href="#" class="training-btn">View Camps →</a>
                </div>
            </div>

            <!-- STEM & Robotics -->
            <div class="col-md-6 col-lg-3">
                <div class="training-card">
                    <div class="training-icon"><i class="bi bi-cpu"></i></div>
                    <h3 class="training-title">STEM & Robotics</h3>
                    <p class="training-desc">Hands-on learning experiences in robotics, AI, and engineering principles for future innovators.</p>
                    <a href="#" class="training-btn">Discover Courses →</a>
                </div>
            </div>
        </div>
    </div>
</div>
