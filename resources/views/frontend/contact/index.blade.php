@extends('frontend.layout.master')
@section('mainContent')


    <style>
        .container {
            width: 85%;
            max-width: 1200px;
            margin: 0 auto;

        }

        .contact-hero {
            background: linear-gradient(
                to bottom,
                rgba(43, 33, 85, 0.92),
                rgba(43, 33, 85, 0.75)
            ),
            url('https://www.networkbulls.com/images/training-lab.jpg') no-repeat center center;
            background-size: cover;
            color: #fff;
            padding: 4rem 0;
            text-align: center;
        }

        .contact-hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1.2rem;
            text-shadow: 0 2px 5px rgba(0,0,0,0.6);
        }

        .contact-hero p {
            font-size: 1.2rem;
            max-width: 750px;
            margin: 0 auto;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .contact-info,
        .contact-form {
            background-color: #fff;
            border-radius: 8px;
            padding: 1rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .contact-info h2,
        .contact-form h2 {
            color: var(--primary);
            margin-top: 0;
            margin-bottom: 1.5rem;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }

        .info-icon {
            background-color: var(--light);
            color: var(--primary);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .info-content h3 {
            margin: 0 0 0.3rem 0;
            font-size: 1.1rem;
            color: var(--dark);
        }

        .info-content p {
            margin: 0;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.4rem;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.4rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-family: inherit;
            font-size: 1rem;
            transition: border 0.2s ease-in-out;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: var(--primary);
            outline: none;
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .btn {
            display: inline-block;
            background-color: var(--primary);
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #201945;
        }

        .map-container {
            margin: 3rem 0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 5px rgba(0, 0, 0, 0.1);
        }

        .map-container iframe {
            width: 100%;
            height: 400px;
            border: none;
        }

        @media (max-width: 768px) {
            .contact-hero h1 {
                font-size: 2rem;
            }

            .contact-hero p {
                font-size: 1rem;
            }
        }
    </style>


    <section class="contact-hero">
        <div class="container">
            <h1>Contact Us</h1>
            <p>Have questions about our training programs or placement services? <br> Reach out to us - our team is ready to help you start your career.</p>
        </div>
    </section>

    <div class="container">
        <div class="contact-grid">
            <!-- Contact Info -->
            <div class="contact-info">
                <h2>Get in Touch</h2>

                <div class="info-item">
                    <div class="info-icon"><i class="fa fa-globe"></i></div>
                    <div class="info-content">
                        <h3>Our Location</h3>
                        <p>IVA-Network Headquarters<br>Dhaka, Bangladesh</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i class="fa fa-envelope"></i></div>
                    <div class="info-content">
                        <h3>Email Us</h3>
                       <p> {{$systemInfo->mail1 ?? ''}}<br>{{$systemInfo->mail2 ?? ''}}</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i class="fa fa-phone"></i></div>
                    <div class="info-content">
                        <h3>Call Us</h3>
                        <p>{{$systemInfo->number1 ?? ''}}<br>{{$systemInfo->number2 ?? ''}} (General Inquiry)</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i class="fa fa-clock"></i></div>
                    <div class="info-content">
                        <h3>Working Hours</h3>
                        <p>Monday - Saturday: 8:00 AM - 8:00 PM<br>Sunday: 10:00 AM - 4:00 PM</p>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form">
                <h2>Send Us a Message</h2>
                <form id="contactForm">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control form-control-sm" id="name" name="name" required />
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required />
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" required />
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <select id="subject" name="subject" required>
                            <option value="">Select a subject</option>
                            <option value="training">Training Programs</option>
                            <option value="admission">Admission Inquiry</option>
                            <option value="placement">Placement Assistance</option>
                            <option value="corporate">Corporate Training</option>
                            <option value="other">Other Inquiry</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message">
                            Your Message
                        </label>
                        <textarea id="message" name="message" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-paper-plane me-1"></i> Send Message
                    </button>

                </form>
            </div>
        </div>

        <!-- Google Map -->
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d233668.06396725783!2d90.25487754014735!3d23.780753031632905!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka!5e0!3m2!1sen!2sbd!4v1751760622530!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const name = this.name.value;
            const email = this.email.value;
            const phone = this.phone.value;
            const subject = this.subject.value;
            const message = this.message.value;
            console.log({ name, email, phone, subject, message });
            alert('Thank you for your message! We will contact you shortly.');
            this.reset();
        });
    </script>


@endsection
