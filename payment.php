<?php
session_start();
require "conf.inc.php";
require "functions.php";

if (!isConnected() || !isActivated()) {
    header("Location: login.php");
}
    include "navbar.php";
    ?>
    <section class="banner-area banner-area2 menu-bg text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="style-change">
                        <i>
                            <?php echo getTranslate("Paiement", $tabLang, $setLanguage); ?>
                        </i>
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Food Area starts -->
    <section class="food-area section-padding3">
        <div class="container py-5">
            <div class="row mb-4">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4">
                        <?php echo getTranslate("Paiement", $tabLang, $setLanguage) ?>
                    </h1>
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
                                    <li class="nav-item" role="presentation">
                                        <a data-toggle="tab" href="#creditCard" id="creditLink" class="nav-link active"
                                           aria-controls="creditCard" aria-selected="true">
                                            <i class="fas fa-credit-card mr-2"></i>&nbsp;
                                            <?php echo getTranslate("Carte de crédit", $tabLang, $setLanguage); ?>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a data-toggle="tab" href="#money" id="moneyLink" class="nav-link"
                                           aria-controls="money" aria-selected="false">
                                            <i class="fas fa-money-bill-wave"></i>
                                            <?php echo getTranslate("Espèces", $tabLang, $setLanguage); ?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content" id="myTabContent">
                                <div id="creditCard" class="tab-pane fade show active pt-3" role="tabpanel"
                                     aria-labelledby="creditLink">
                                    <form role="form" method="POST" action="functions/payMyCart.php">
                                        <div class="form-group">
                                            <label for="username">
                                                <h6 class="text-muted">
                                                    <?php echo getTranslate("Propriétaire de la carte", $tabLang, $setLanguage); ?>
                                                </h6>
                                            </label>
                                            <input type="text" name="username"
                                                   placeholder="<?php echo getTranslate("Propriétaire de la carte", $tabLang, $setLanguage); ?>"
                                                   required class="form-control"
                                                   value="<?php echo (isset($_SESSION["input"]))
                                                       ? $_SESSION["input"]["username"]
                                                       : ""; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="cardNumber">
                                                <h6 class="text-muted">
                                                    <?php echo getTranslate("Numéro de carte", $tabLang, $setLanguage); ?>
                                                </h6>
                                            </label>
                                            <div class="input-group">
                                                <input type="text" name="cardNumber"
                                                       placeholder="<?php echo getTranslate("Numéro de carte", $tabLang, $setLanguage); ?>"
                                                       class="form-control " required
                                                       value="<?php echo (isset($_SESSION["input"]))
                                                           ? $_SESSION["input"]["cardNumber"]
                                                           : "";
                                                       if (isset($_SESSION['input'])) {
                                                           unset($_SESSION["input"]);
                                                       } ?>">
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
                                                        <h6 class="text-muted">
                                                            <?php echo getTranslate("Date d'expiration", $tabLang, $setLanguage); ?>
                                                        </h6>
                                                    </span>
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="number" placeholder="MM" name="month"
                                                               class="form-control"
                                                               required>
                                                        <input type="number" placeholder="<?php echo getTranslate("AA", $tabLang, $setLanguage); ?>" name="year"
                                                               class="form-control"
                                                               required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group mb-4">
                                                    <h6 class="text-muted">CCV</h6>
                                                    <input type="text" name="ccv" required class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                        $pdo = connectDB();
                                        $queryPrepared = $pdo->prepare("SELECT points FROM USER, FIDELITY WHERE emailAddress = :email AND idFidelity = fidelityCard");
                                        $queryPrepared->execute([
                                            ":email" => $_SESSION["email"]
                                        ]);
                                        $fidelity = $queryPrepared->fetch(PDO::FETCH_ASSOC);
                                        if (!empty($fidelity) && $fidelity["points"] > 0) {
                                            ?>
                                            <div class="form-group">
                                                <label for="select">
                                                    <h6 class="text-muted">
                                                        <?php echo getTranslate("Avantages disponibles", $tabLang, $setLanguage); ?>
                                                    </h6>
                                                </label>
                                                <select class="custom-select" id="select" name="advantageSelect">
                                                    <option selected value="">
                                                        <?php echo getTranslate("Liste des avantages disponibles", $tabLang, $setLanguage); ?>
                                                    </option>
                                                    <?php
                                                    $queryPrepared = $pdo->prepare("SELECT idAdvantage, advantageName FROM ADVANTAGE WHERE advantagePoints <= :points");
                                                    $queryPrepared->execute([
                                                        ":points" => $fidelity["points"]
                                                    ]);
                                                    $advantages = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
                                                    if (!empty($advantages)) {
                                                        foreach ($advantages as $advantage) {
                                                            echo "<option value='" . $advantage["idAdvantage"] . "'>" . $advantage["advantageName"] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <div class="card-footer">
                                            <button type="submit"
                                                    class="genric-btn primary circle arrow mx-auto col-md-12 shadow-sm">
                                                <i class="far fa-credit-card"></i>
                                                &nbsp;<?php echo getTranslate("Confirmer le paiement", $tabLang, $setLanguage); ?>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div id="money" class="tab-pane fade pt-3" role="tabpanel" aria-labelledby="moneyLink">
                                    <p class="text-muted">
                                        <?php echo getTranslate("La validation de votre avantage se fera une fois votre solde de points présenté à notre franchisé via l'utilisation de notre application", $tabLang, $setLanguage); ?>
                                    </p>
                                    <a href="./functions/orderMyCart.php" class="genric-btn primary circle">
                                        <i class="fas fa-truck-loading"></i>&nbsp;
                                        <?php echo getTranslate("Payer au camion", $tabLang, $setLanguage); ?>
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
                        <span class="text-muted">
                            <?php echo getTranslate("Mon panier", $tabLang, $setLanguage); ?>
                        </span>
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
                                    $final = $product["productPrice"] * $product["quantity"];
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
    </section>


<?php include "footer.php"; ?>