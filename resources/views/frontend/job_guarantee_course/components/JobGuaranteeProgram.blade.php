<style>
    .hero {
        background: linear-gradient(
            to bottom,
            rgba(43, 33, 85, 0.92),
            rgba(43, 33, 85, 0.75)
        ),
        url('https://www.networkbulls.com/images/training-lab.jpg') no-repeat center center;
        background-size: cover;
        color: #fff;
        padding: 3rem 0;
        text-align: center;
    }

    .hero h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1.2rem;
        text-shadow: 0 2px 5px rgba(0,0,0,0.6);
    }

    .hero p {
        font-size: 1.25rem;
        max-width: 800px;
        margin: 0 auto 2.5rem;
        line-height: 1.6;
        text-shadow: 0 1px 3px rgba(0,0,0,0.5);
    }

    .hero .btn-primary {
        background-color: #2b2155;
        border-color: #5c4db1;
        font-weight: 600;
        padding: 0.75rem 2rem;
        font-size: 1rem;
        transition: all 0.3s ease-in-out;
        border-radius: 5px;
        color: #fff;
    }

    .hero .btn-primary:hover {
        background-color: #2b2155;
        border-color: #483c96;
        transform: translateY(-2px);
    }
</style>

<section class="hero">
    <div class="container">
        <h1>Job Guarantee Program</h1>
        <p>
            Get trained by industry experts and secure your future with our 100% job guarantee.
            We're so confident in our training that we guarantee you'll get a job—or we'll refund your fees.
        </p>
        <a href="{{ route('customer.login') }}" class="btn btn-primary">
            Enroll Now <i class="fa fa-arrow-right ms-2"></i>
        </a>
    </div>
</section>
