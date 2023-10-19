@extends('layouts.frontend')

@section('content')
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
          <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Kontak Kami</h1>
          </div>
        </div>
      </header>
      <!-- Section-->
      <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
          <div class="row justify-content-center">
            <div class="col-lg-10 m-auto">
              <div class="contact-form">
                <form action="index.html">
                  <div class="row">
                    <div class="col-lg-6 col-md-6 mb-2">
                      <div class="name-input form-group">
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Isikan nama lengkap"
                        />
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mb-2">
                      <div class="email-input form-group">
                        <input
                          type="email"
                          class="form-control"
                          placeholder="Isikan alamat email"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12 col-md-6 mb-2">
                      <div class="subject-input form-group">
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Isikan subject email"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="message-input form-group mb-3">
                    <textarea
                      name="review"
                      cols="30"
                      rows="10"
                      placeholder="Isikan pesan anda"
                      class="form-control"
                    ></textarea>
                  </div>
                  <div class="input-submit form-group">
                    <button
                      type="submit"
                      style="height: 50px; width: 400px; margin: 0 auto"
                      class="d-block btn btn-primary"
                    >
                      Kirim Pesan
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
@endsection