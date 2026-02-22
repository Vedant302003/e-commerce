@extends('layouts.landing.app')

@section('title', 'Contact Us | Lumina Beauty')

@section('content')
    <div class="container">
        <!-- Page Header -->
        <div class="section-header text-center" style="margin-top: 3rem;">
            <h1>Contact Us</h1>
            <p>We'd love to hear from you. Reach out to our team.</p>
        </div>

        <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 4rem; margin-bottom: 4rem;">
            
            <!-- Contact Form -->
            <div class="contact-form-wrapper">
                <form class="contact-form" onsubmit="event.preventDefault();">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" placeholder="Your Name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" placeholder="your@email.com">
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" placeholder="How can we help?">
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" rows="5" placeholder="Write your message here..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message</button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="contact-info-wrapper">
                <div class="info-card">
                    <h3>Get in Touch</h3>
                    <p style="margin-bottom: 2rem; color: var(--text-light);">Have a question about our products or your order? We're here to help you glow.</p>
                    
                    <ul class="info-list">
                        <li>
                            <div class="icon-box"><i data-lucide="map-pin"></i></div>
                            <div>
                                <strong>Headquarters</strong>
                                <p>123 Beauty Lane, Los Angeles, CA 90210</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon-box"><i data-lucide="phone"></i></div>
                            <div>
                                <strong>Phone</strong>
                                <p>+1 (555) 123-4567</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon-box"><i data-lucide="mail"></i></div>
                            <div>
                                <strong>Email</strong>
                                <p>hello@luminabeauty.com</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon-box"><i data-lucide="clock"></i></div>
                            <div>
                                <strong>Business Hours</strong>
                                <p>Mon - Fri: 9am - 6pm PST</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Placeholder Map -->
                <div class="map-placeholder" style="margin-top: 2rem; background: #eaddcf; height: 200px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--text-dark);">
                    <span>Map Area (Google Maps Embed)</span>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-dark);
            font-size: 0.95rem;
        }
        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-family: var(--font-main);
            font-size: 1rem;
            background: #fff;
            transition: all 0.3s ease;
        }
        .contact-form input:focus,
        .contact-form textarea:focus {
            border-color: var(--text-dark);
            box-shadow: 0 0 0 3px rgba(0,0,0,0.05);
        }
        
        .info-list li {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            align-items: flex-start;
        }
        .icon-box {
            width: 40px;
            height: 40px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border);
            color: var(--text-dark);
            flex-shrink: 0;
        }
        .icon-box svg {
            width: 20px;
            height: 20px;
        }
    </style>
@endsection
