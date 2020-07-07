<?php
session_start();
require "conf.inc.php";
require "functions.php";

if (isConnected() && isActivated() ) {

    include "header.php";
    include "navbar.php";
    ?>
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4">Paiement</h1>
                <?php
                if (isset($_SESSION["errors"])) {
                    $errors = $_SESSION["errors"];
                    echo "<div class='alert alert-danger col-md-7 mx-auto text-left' role='alert'>";
                    foreach ($errors as $error) {
                        echo "<li>" . $error . "</li>";
                    }
                    echo "</div>";
                    unset($_SESSION["errors"]);
                }
                ?>
            </div>
        </div>
        <div class="row mr-5">
            <div class="col-lg-6 mx-auto">
                <div class="card ">
                    <div class="card-header">
                        <div class="bg-white shadow-sm">
                            <ul role="tablist" class="nav bg-light nav-pills nav-tabs rounded nav-fill mb-4" id="myTab">
                                <li class="nav-item"  role="presentation">
                                    <a data-toggle="tab" href="#creditCard" id="creditLink" class="nav-link active"
                                       aria-controls="creditCard" aria-selected="true">
                                        <i class="fas fa-credit-card mr-2"></i>&nbsp;Carte de crédit
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a data-toggle="tab" href="#money" id="moneyLink" class="nav-link"
                                       aria-controls="money" aria-selected="false">
                                        <i class="fas fa-money-bill-wave"></i>
                                        Espèces
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div id="creditCard" class="tab-pane fade show active pt-3" role="tabpanel" aria-labelledby="creditLink">
                                <form role="form" method="POST" action="functions/payMyCart.php">
                                    <div class="form-group">
                                        <label for="username">
                                            <h6>Propriétaire de la carte</h6>
                                        </label>
                                        <input type="text" name="username" placeholder="Propriétaire de la carte"
                                               required class="form-control" value="<?php echo (isset($_SESSION["input"]))
                                            ? $_SESSION["input"]["username"]
                                            : ""; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="cardNumber">
                                            <h6>Numéro de carte</h6>
                                        </label>
                                        <div class="input-group">
                                            <input type="text" name="cardNumber"
                                                   placeholder="Numéro de carte"
                                                   class="form-control " required
                                                   value="<?php echo (isset($_SESSION["input"]))
                                                       ? $_SESSION["input"]["cardNumber"]
                                                       : "";
                                                   if (isset($_SESSION['input'])) {
                                                       unset($_SESSION["input"]);
                                                   }?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text text-muted">
                                                    <i class="fab fa-cc-visa mx-1"></i>
                                                    <i class="fab fa-cc-mastercard mx-1"></i>
                                                    <i class="fab fa-cc-amex mx-1"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label>
                                                    <span class="hidden-xs">
                                                        <h6>Date d'expiration</h6>
                                                    </span>
                                                </label>
                                                <div class="input-group">
                                                    <input type="number" placeholder="MM" name="month" class="form-control"
                                                           required>
                                                    <input type="number" placeholder="AA" name="year" class="form-control"
                                                           required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group mb-4">
                                                <label data-toggle="tooltip"
                                                       title="Three digit CV code on the back of your card">
                                                    <h6>CVV
                                                        <i class="fa fa-question-circle d-inline"></i>
                                                    </h6>
                                                </label>
                                                <input type="text" name="ccv" required class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="genric-btn primary circle arrow mx-auto col-md-12 shadow-sm">
                                            <i class="far fa-credit-card"></i>
                                            &nbsp;Confirmer le paiement
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div id="money" class="tab-pane fade pt-3" role="tabpanel" aria-labelledby="moneyLink">
                                <a href="#">
                                    <h5 class="text-center">
                                        Payer au camion
                                    </h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4 mt-5">
            <div class="col-lg-8 mx-auto text-center">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Mon panier</span>
                    <span class="badge badge-secondary badge-pill">
                        <?php
                        echo $quantity;
                        ?>
                    </span>
                </h4>
            </div>
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <?php
                    $cart = lastCart($_SESSION["email"]);
                    $menus = menusInCart($cart);
                    $total = 0;
                    if (!empty($menus)) {
                        foreach ($menus as $menu) {
                            $total += $menu["menuPrice"] * $menu["quantity"];
                            ?>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0 text-muted">
                                        <?php
                                        echo $menu["quantity"] . "x&nbsp;" . $menu["menuName"];
                                        ?>
                                    </h6>
                                </div>
                                <span class="text-muted">
                                <?php
                                $final = $menu["menuPrice"] * $menu["quantity"];
                                echo number_format($final, 2) . "&nbsp;€";
                                ?>
                            </span>
                            </li>
                            <?php
                        }
                    }
                    $products = productsInCart($cart);
                    if (!empty($products)) {
                        foreach ($products as $product) {
                            $total += $product["productPrice"] * $product["quantity"];
                            ?>
                            <li class="list-group-item justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0 text-muted">
                                        <?php
                                        echo $product["quantity"] . "x&nbsp;" . $product["productName"];
                                        ?>
                                    </h6>
                                </div>
                                <span class="text-muted">
                                    <?php
                                    $final = $menu["prodductPrice"] * $menu["quantity"];
                                    echo number_format($final, 2) . "&nbsp;€";
                                    ?>
                                </span>
                            </li>
                    <?php
                        }
                    }
                        ?>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0 text-muted">
                                <strong>Total:</strong>
                            </h6>
                        </div>
                        <span class="text-muted">
                            <?php
                            echo number_format($total, 2) . "&nbsp;€";
                            $points = number_format($total, 0);
                            ?>
                        </span>
                    </li>
                </div>
            </div>
        </div>
    </div>


    <?php
    include "footer.php";
} else {
    header("Location: login.php");
}
?>