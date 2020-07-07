<div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
    <ul role="tablist" class="nav bg-light nav-pills nav-tabs rounded nav-fill mb-4" id="myTab">
        <li class="nav-item" role="presentation">
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
    <div class="tab-content" id="myTabContent">
        <div id="creditCard" class="tab-pane fade show active" role="tabpanel" aria-labelledby="creditLink">
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
                    <button type="submit" class="btn btn-primary btn-block mx-auto col-md-12 shadow-sm">
                        <i class="far fa-credit-card"></i>
                        &nbsp;Confirmer le paiement
                    </button>
            </form>
        </div>
        <div id="money" class="tab-pane fade" role="tabpanel" aria-labelledby="moneyLink">
            <h5>
                Vous paierez en arrivant au camion
            </h5>
        </div>
    </div>
</div>