<?php include("header.php") ?>
<style>
  .inner-box {
    margin: 30px 0;
  }

  .inner-box p {
    font-size: 16px;
    line-height: 1.5;
    margin: 15px 0;
    color: #444;
  }

  .faq-box-contain .faq-contain h2 {
    font-weight: 700;
    font-size: calc(28px + (56 - 28) * ((100vw - 320px) / (1920 - 320)));
    line-height: 1.4;
  }

  .faq-box-contain .faq-contain {
    margin-bottom: 0;
    position: sticky;
    top: 92px;
  }

  .section-b-space {
    padding-bottom: calc(30px + (50 - 30) * ((100vw - 320px) / (1920 - 320)));
  }

  section,
  .section-t-space {
    padding-top: calc(30px + (50 - 30) * ((100vw - 320px) / (1920 - 320)));
  }

  h3 {
    font-size: calc(16px + (20 - 16) * ((100vw - 320px) / (1920 - 320)));
    font-weight: 500;
    line-height: 1.2;
    margin: 0;
  }
</style>
<main>
  <section class="breadcrumb-area breadcrumb-bg">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="breadcrumb-content">
            <h2 class="title">Terms &amp; Conditions</h2>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Terms &amp; Conditions</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="faq-box-contain section-b-space">
    <!-- breadcrumb-area -->

    <div class="container">
      <div class="row">
        <div class="col-xl-10 mx-auto text-center">
          <div class="faq-contain">
            <h2 class="m-0">Terms &amp; Conditions</h2>
          </div>
        </div>
      </div>
      <?php
      $getTermsAndConditions = $homePage->getTermsAndConditions();

      if (!empty($getTermsAndConditions)) {
        foreach ($getTermsAndConditions as $tAndC) {
      ?>
          <div class="inner-box">

            <h3><?= $tAndC['title']; ?></h3>
            <?php
            foreach ($tAndC['description'] as $des) {
            ?>
              <p><?= $des['description']; ?></p>
            <?php
            }
            ?>
        <?php
        }
      } ?>
          </div>
  </section>
</main>

<?php include("include/footer.php") ?>