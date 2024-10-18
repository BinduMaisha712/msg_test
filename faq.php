<?php include('header.php') ?>
<style>
  .card-header{
    padding: 0px;
  }
</style>
<main class="main">
  <section class="breadcrumb-area breadcrumb-bg">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="breadcrumb-content">
            <h2 class="title">FAQ</h2>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Frequently Asked Questions</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section>
    <div class="container mt-5 mb-5">
      <div class="row">
        <div class="col-10 m-auto">
          <h2 class="title mb-4" style="font-size: 20px;">Frequently Asked Questions</h2>

          <div class="accordion" id="accordionExample">
            <?php
            // show faq
            $getFAQ = $homePage->getFAQ();
            // echo'<pre>';
            // print_r($getFAQ);
            if (!empty($getFAQ)) {
              foreach ($getFAQ as $faq) {
            ?>
                <div class="card">
                  <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                      <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseTwo<?= $faq['id']; ?>" aria-expanded="true" aria-controls="collapseOne">
                        <?= $faq['title']; ?>
                      </button>
                    </h2>
                  </div>

                  <div id="collapseTwo<?= $faq['id']; ?>" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                      <?php
                      foreach ($faq['description'] as $des) {
                      ?>
                        <p><?= $des['description']; ?> </p>
                      <?php
                      }

                      ?>
                    </div>
                  </div>
                </div>
            <?php
              }
            } ?>
          </div>

        </div>
      </div>
    </div>
  </section>


</main>
<?php include('include/footer.php') ?>