@extends('layout')
@section('content')
   <style>
  /* contact.css */
.contact-us {
    padding: 40px;
    background-color: #ffffff;
}

.contact-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

.contact-container h1 {
    font-size: 2.5em;
    margin-bottom: 10px;
    color: #333;
    text-align: center;
}

.contact-container p {
    font-size: 1.1em;
    margin-bottom: 20px;
    color: #666;
    text-align: center;
}

.contact-form {
    display: flex;
    flex-direction: column;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #333;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1em;
}

.form-group textarea {
    resize: vertical;
}

.btn-submit {
    background-color: #4CAF50;
    color: #fff;
    border: none;
    padding: 12px 20px;
    border-radius: 4px;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-submit:hover {
    background-color: #45a049;
}

/* Responsive Design */

@media (max-width: 768px) {
    .contact-container {
        padding: 15px;
    }

    .contact-container h1 {
        font-size: 2em;
    }

    .contact-container p {
        font-size: 1em;
    }

    .form-group input,
    .form-group textarea {
        font-size: 0.9em;
    }

    .btn-submit {
        padding: 10px 15px;
        font-size: 0.9em;
    }
}

@media (max-width: 480px) {
    .contact-container h1 {
        font-size: 1.5em;
    }

    .contact-container p {
        font-size: 0.9em;
    }

    .form-group input,
    .form-group textarea {
        font-size: 0.8em;
    }

    .btn-submit {
        padding: 8px 12px;
        font-size: 0.8em;
    }
}


    </style>
</head>
<body>
    <section class="contact-us">
        <div class="contact-container">
            <h1>Contact Us</h1>
            <p>We'd love to hear from you! Please fill out the form below to get in touch with us.</p>

            <div class="contact-form">
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject">
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">Send Message</button>
                </form>
            </div>
        </div>
    </section>
@endsection
