<?php include('header.php') ?>
<style>
  .summary.mb-4 {
    background-color: #f6f7f9;
    padding: 27px 15px;
    border-radius: 10px;
  }

  .product-name-section a {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    width: 303px;
    color: black;
  }

  table.shop-table.cart-table {
    width: 100%;
  }

  thead {
    background-color: #f6f7f9;
    height: 50px;
    text-align: center;
  }

  input[type=number]::-webkit-inner-spin-button,
  input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0;
  }



  td.product-price {
    text-align: center;
  }

  table.shipping {
    width: 100%;
  }

  td.summary-subtotal-price {
    text-align: right;
    font-family: 'Syne';
    font-size: 16px;
  }

  table.total {
    width: 100%;
    margin: 16px 0;
  }

  td.summary-total-price.ls-s {
    text-align: right;
    font-size: 19px;
    font-family: 'Syne';


  }

  h3.summary-title.text-left {
    margin-bottom: 22px;
    border-bottom: 1px solid #d9d9d9;
    padding-bottom: 10px;
  }
@media(max-width: 768px){
      h1.text-center img {
    width: 100%;
}
}
</style>
<main class="main cart">
  <!-- breadcrumb-area -->
  <div class="breadcrumb-area breadcrumb-bg-two">
    <div class="container custom-container">
      <div class="row">
        <div class="col-12">
          <div class="breadcrumb-content">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- breadcrumb-area-end -->
  <div class="cartPage cart-area pt-90 pb-90">
    <div id="resetCart">
      <?php
      //show cart List
      $items = $cart->cartDetail();

      if (isset($items['cartEmpty'])) {
      ?>

        <h1 class="text-center">
          <img src="assets/img/empty_cart.jpg" alt="" width="500px">
        </h1>
        <br>
        <div class="text-center cart_submit">
          <a href="index.php"><button type="button" class="btn btn-primary btn-rounded btn-md ml-2">Shop
              Now</button></a>
        </div>
        <br>
      <?php
      } else {
      ?>
        <div class="container mt-7 mb-2">
          <div class="row">
            <div class="col-lg-8 col-md-12 pr-lg-4">
              <table class="shop-table cart-table">
                <thead>
                  <tr>
                    <th><span>Product</span></th>
                    <th></th>
                    <th><span>Unit Price</span></th>
                    <th><span>Quantity</span></th>
                    <th>Total Price</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($items as $item) {
                    $query1 = "";
                    if ($item['class2'] != '')
                      $query1 = '+' . mysqli_fetch_assoc(mysqli_query($con, "SELECT symbol FROM size_class WHERE id=" . $item['class2']))['symbol'];

                  ?>
                    <tr>
                      <td class="product-thumbnail">
                        <figure>

                          <a href="product-detail.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&product_id=<?= $item['id']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>">
                            <img src="asset/image/product/<?= $item['image']; ?>" width="100" height="100" alt="product">
                          </a>
                        </figure>
                      </td>
                      <td class="product-name">
                        <div class="product-name-section">
                          <a href="product-detail.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&product_id=<?= $item['id']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>"><?= $item['product_name']; ?></a>
                          <?php 
                                if ($item['symbol'] != '') {
                                    echo ' - (' . $item['symbol'] . $query1;
                                    if ($item['class1'] != '') {
                                        echo ', ' . $item['class1'];
                                    }
                                    echo ')';
                                }
                                ?>

                        </div>
                      </td>
                      <td class="product-subtotal">
                        <span class="amount"><?= $currency; ?>

                        <?php
                          $isdeal = $homePage->isDealByProduct($item['id']);
                          if (!empty($isdeal)) {
                            if ($isdeal[0]['stock'] != 0) {
                              $price = $isdeal[0]['price'];
                            } else {
                              if (($item['price'] == $item['discount']) || ($item['discount'] == 0)) {
                                $price = $item['price'];
                              } else {
                                $price = $item['discount'];
                              }
                            }
                          } else {
                            if (($item['price'] == $item['discount']) || ($item['discount'] == 0)) {
                              $price = $item['price'];
                            } else {
                              $price = $item['discount'];
                            }
                          }
                          ?><?= $price; ?></span>
                      </td>

                      <td class="product-quantity">
                        <div class="input-group hny-crt">
                          <button onclick="decreaseQuantity(this)" class="quantity-minus"><i class="fas fa-minus"></i></button>
                          <input class="action-input itemQuantity" title="Quantity Number" type="number" min="<?= $item['minimum']; ?>" max="<?= $item['maximum']; ?>" value="<?= $item['quantity']; ?>" name="itemQuantity" onchange="changeItemQuantity(<?= $item['id']; ?>,this.value,<?= $item['class0']; ?>);" disabled>
                          <button onclick="increaseQuantity(this)" class="quantity-plus"><i class="fas fa-plus"></i></button>
                        </div>
                      </td>

                      <td class="product-price">
                        <span class="amount" id="productTotal<?= $item['id']; ?>"><?= $currency; ?> <?= ($price * $item['quantity']); ?></span>
                      </td>
                      <td class="product-close">
                        <a onclick="removeFromCart(<?= $item['id']; ?>)" class="product-remove" title="Remove this product">
                          <i class="fas fa-times"></i>
                        </a>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
              <div class="cart-actions mb-6 pt-4">
                <a href="index.php" class="btn hny"><i class="d-icon-arrow-left"></i>Continue Shopping</a>
                <button type="submit" class="btn hny btn-dark btn-md" onclick="clearCart();">Clear Cart</button>
              </div>

            </div>
            <aside class="col-lg-4 sticky-sidebar-wrapper">
              <div class="sticky-sidebar" data-sticky-options="{'bottom': 20}">
                <div class="summary mb-4">
                  <h3 class="summary-title text-left">Cart Totals</h3>
                  <table class="shipping">
                    <tr class="summary-subtotal">

                      <td>
                        <h4 class="summary-subtitle">Subtotal</h4>
                      </td>

                      <td class="summary-subtotal-price"><?= $currency; ?><span class="cartSubTotalAmount">
                          <?= $cart->cartSubTotalAmount(); ?></span></td>
                    </tr>

                    <tr class="summary-subtotal">
                      <td>
                        <h4 class="summary-subtitle">Shipping</h4>
                      </td>

                      <td class="summary-subtotal-price"><?= $currency; ?><span> 100.00</span>
                      </td>
                    </tr>

                  </table>
                  <table class="total">
                    <tr class="summary-subtotal">
                      <td>
                        <h4 class="summary-subtitle">Total</h4>
                      </td>

                      <td class="summary-total-price ls-s"><?= $currency; ?> <span class="cartTotalAmount"><strong>
                            <?= $cart->cartTotalAmount() +100; ?></strong></span></td>
                    </tr>
                  </table>
                  <div class="text-center pt-3">
                  <a class="btn btn-checkout checkout-button  btn-sqr" onclick="checkStock()">Proceed to
                    checkout</a>
                  </div>
           
                </div>
              </div>
            </aside>
          </div>
        </div>

      <?php
      }
      ?>
    </div>
  </div>
  </div>
</main>
<script type="text/javascript">
  var max = 0;
</script>
<?php include('include/footer.php') ?>