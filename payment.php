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
                        <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">

                            <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-4">
                                <li class="nav-item">
                                    <a data-toggle="pill" href="#credit-card" class="nav-link active ">
                                        <i class="fas fa-credit-card mr-2"></i>&nbsp;Carte de crédit
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="credit-card" class="tab-pane fade show active pt-4">
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
                                        <button type="submit" class="subscribe btn btn-success btn-block shadow-sm">
                                            <i class="fas fa-money-check"></i>
                                            &nbsp;Confirmer le paiement
                                        </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-8 mx-auto text-center">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Mon panier</span>
                    <span class="badge badge-secondary badge-pill">
                        <?php
                        echo $quantity["quantity"];
                        ?>
                    </span>
                </h4>
            </div>
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <?php
                    $cart = lastCart($_SESSION["email"]);

                    $pdo = connectDB();
                    $queryPrepared = $pdo->prepare("SELECT menuName, menuImage, quantity, idMenu, cartPrice
                                                                FROM MENUS, CARTMENU, CART
                                                                WHERE CARTMENU.menu = idMenu 
                                                                  AND CARTMENU.cart = idCart 
                                                                  AND idCart = :cart");
                    $queryPrepared->execute([
                        ":cart" => $cart
                    ]);
                    $menu = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
                    $total = $menu[0]["cartPrice"];
                    foreach ($menu as $priceMenu) {
                        $queryPrepared = $pdo->prepare("SELECT menuPrice FROM MENUS, CARTMENU WHERE menu = idMenu AND idMenu = :menu");
                        $queryPrepared->execute([
                            ":menu" => $priceMenu["idMenu"]
                        ]);
                        $price = $queryPrepared->fetch(PDO::FETCH_ASSOC);
                        $price = $price["menuPrice"];
                        ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0 text-muted">
                                    <?php
                                    echo $priceMenu["quantity"] . "x&nbsp;" . $priceMenu["menuName"];
                                    ?>
                                </h6>
<!--                                <small class="text-muted">-->
<!--                                    --><?php
//                                    echo $menu["ingredientCategory"];
//                                    ?>
<!--                                </small>-->
                            </div>
                            <span class="text-muted">
                                <?php
                                $final = $price * $priceMenu["quantity"];
                                echo number_format($final, 2) . "&nbsp;€";
                                ?>
                            </span>
                        </li>
                        <?php
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