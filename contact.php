<?php include('header.php') ?>
<style>
  .p-4 {
    padding: 20px;
  }

  .contact-message {
    width: 100%;
  }

  .form-control {
    height: calc(2.5em + 0.75rem + 2px);
  }
</style>
<main>
  <!-- breadcrumb-area -->
  <section class="breadcrumb-area breadcrumb-bg">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="breadcrumb-content">
            <h2 class="title">Contact US</h2>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact US</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb-area-end -->

  <div class="contact-area pt-90 pb-90">
    <section class="container ">
      <div class="container-inner-wrap">
        <div class="row justify-content-center justify-content-lg-between">

          <div class="col-xl-5 col-lg-6 col-md-8">
            <div class="contact-info-wrap">
              <div class="contact-img">
                <img src="assets/img/images/contact_img.png" alt="">
              </div>
              <div class="contact-info-list">
                <ul>
                  <li>
                    <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div class="content">
                      <p><?= $homePage->contactInfo('address'); ?></p>
                    </div>
                  </li>
                  <li>
                    <div class="icon"><i class="fas fa-phone-alt"></i></div>
                    <div class="content">
                      <p><a href="tel:<?= $homePage->contactInfo('phone'); ?>"><?= $homePage->contactInfo('phone'); ?></a></p>
                    </div>
                  </li>
                  <li>
                    <div class="icon"><i class="fas fa-envelope-open"></i></div>
                    <div class="content">
                      <p><a href="mailto:<?= $homePage->contactInfo('email'); ?>"><?= $homePage->contactInfo('email'); ?></a></p>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="contact-social">
                <ul>
                  <?php
                  $social_media = mysqli_query($con, "SELECT * FROM social_media WHERE url != '' AND status ='Active'");
                  while ($url = mysqli_fetch_assoc($social_media)) { ?>
                    <li><a href="<?= $url['url']; ?>" target="_blank"><i class="<?= $url['icon']; ?>"></i></a></li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>


          <div class="col-lg-6 col-md-8 order-2 order-lg-0">
            <div class="w-100">
              <form id="contactFormSubmit" method="post" class="contact-form">
                <h4 class="ls-m font-weight-bold">Let’s Connect</h4>
                <p>Your email address will not be published. Required fields are
                  marked *</p>
                <div class="contact-input">
                  <div class="row">

                    <div class="col-lg-12">
                      <div class="first-name form-grp">
                        <input type="text" name="fullName" id="fullName" value="" class="form-control" placeholder="Full Name" required title="Only Alphabet with Space Allow" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
                        <div class="err_msg" id="fullNameErrMsg"></div>
                      </div>
                    </div>

                    <div class="col-lg-12">
                      <div class="last-name form-grp">
                        <input type="text" name="phone" id="phone" value="" class="form-control" length="10" required title="Please enter exactly 10 digits" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )" maxlength="10" placeholder="Enter Your Number">
                        <div class="err_msg" id="phoneErrMsg"></div>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="email form-grp">
                        <input type="email" name="email" id="email" value="" class="form-control" placeholder="Email" required maxlength="150">
                        <div class="err_msg" id="emailErrMsg"></div>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="subject form-grp">
                        <input type="text" name="subject" id="subject" value="" class="form-control" placeholder="Subject" required maxlength="100">
                        <div class="err_msg" id="subjectErrMsg"></div>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="contact-message mb-20">
                        <div class="custom-textarea message form-grp">
                          <textarea class="form-control" name="message" id="message" required placeholder="Enter Your Message" rows="6" spellcheck="false" data-ms-editor="true" maxlength="3600"></textarea>
                          <span>Max message length: <span id="charsrb">3600</span> Characters</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="contact-submit mt-2">
                        <button type="submit" class="btn btn-dark btn-rounded contactsbt">Submit <i class="d-icon-arrow-right"></i></button>
                      </div>
                    </div>

                  </div>
                </div>
              </form>
              <p class="form-messege"></p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="grey-section google-map" id="googlemaps">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6944.651863498079!2d75.09771113814024!3d29.50685748810284!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39114e2de8f81d89%3A0x86f7be517363c401!2sBajekan%2C%20Haryana%20125055!5e0!3m2!1sen!2sin!4v1715067505758!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>

  </div>
</main>
<?php include('include/footer.php') ?>