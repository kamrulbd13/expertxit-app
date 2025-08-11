<style>
    .cta-section {
        background: linear-gradient(to right, #2b2155, #3e2f84);
        color: #fff;
        padding: 4rem 1rem;
        text-align: center;
    }

    .cta-section .container {
        max-width: 900px;
        margin: 0 auto;
    }

    .cta-section h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .cta-section p {
        font-size: 1.125rem;
        margin-bottom: 1.5rem;
    }

    .cta-section .btn {
        display: inline-block;
        background-color: #fff;
        color: #2b2155;
        padding: 0.75rem 2rem;
        font-weight: 600;
        font-size: 1rem;
        border-radius: 30px;
        text-decoration: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
    }

    .cta-section .btn:hover {
        background-color: #f1f1f1;
        transform: translateY(-3px);
    }

    .cta-section .contact-info {
        margin-top: 1rem;
        font-size: 1rem;
        opacity: 0.9;
    }

    @media (max-width: 576px) {
        .cta-section h2 {
            font-size: 2rem;
        }

        .cta-section p,
        .cta-section .contact-info {
            font-size: 1rem;
        }
    }
</style>

<section class="cta-section " id="enroll-now">
    <div class="container">
        <h2>Ready to Launch Your Career?</h2>
        <p>Take the first step toward a guaranteed future in IT. Seats are limited for the upcoming batch <br> — don’t miss out.</p>
        <a href="{{ route('customer.login') }}" class=" btn btn-success shadow-sm ">
            Apply Now
            <i class="fa fa-arrow-alt-circle-right"></i>
        </a>
        <div class="contact-info">or call us at <strong>{{$systemInfo->number1 ?? ''}}</strong> for more information</div>
    </div>
</section>
