@extends('user.generalLayout')

@section('content')

<section class="contact_section layout_padding py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="font-weight-bold">Get In Touch</h2>
      <p class="text-muted">Have questions or need support? We'd love to hear from you.</p>
    </div>

    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <div class="row">
      <!-- Contact Form -->
      <div class="col-md-6 mb-4">
        <div class="bg-white p-4 rounded border shadow-sm h-100">
          <h4 class="mb-4">Send Us a Message</h4>
          <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="name" class="form-control rounded" placeholder="Your Name" required>
              </div>
              <div class="form-group col-md-6">
                <input type="text" name="subject" class="form-control rounded" placeholder="Subject" required>
              </div>
            </div>
            <div class="form-group">
              <textarea name="message" class="form-control rounded" rows="5" placeholder="Your Message" required></textarea>
            </div>
            <div class="text-right">
              <button type="submit" class="btn2 mx-auto">Send</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Contact Info -->
      <div class="col-md-6 mb-4">
        <div class="bg-white p-4 rounded border shadow-sm h-100">
          <h4 class="mb-4">Contact Information</h4>
          <ul class="list-unstyled text-muted">
            <li class="mb-3"><i class="fa fa-map-marker text-primary mr-2"></i>Amman, Jordan</li>
            <li class="mb-3"><i class="fa fa-phone text-primary mr-2"></i>077 865 3663</li>
            <li class="mb-3"><i class="fa fa-envelope text-primary mr-2"></i>sondosjalowdi@gmail.com</li>
            <li class="mb-3"><i class="fa fa-clock-o text-primary mr-2"></i> 24/7 Support</li>
          </ul>
          <h5 class="mt-4 mb-3">Follow Us</h5>
          <div>
            <a href="#" class="mr-3" style="color: #0069d9"><i class="fa fa-facebook fa-lg"></i></a>
            <a  href="https://www.linkedin.com/in/sondos-a-321398253/" target="_blank" class="text-info mr-3"><i class="fa fa-linkedin fa-lg"></i></a>
            <a href="" class="text-danger mr-3"><i class="fa fa-instagram fa-lg"></i></a>
            <a href="https://wa.me/962778653663?text=Hello%2C%20I%20would%20like%20to%20inquire%20about%20your%20services" target="_blank" class="text-success"><i class="fa fa-whatsapp fa-lg"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<style>
    .text-primary {
        color: #178066!important;
    }
</style>
@endsection
