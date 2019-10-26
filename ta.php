<div id="main_div" class="main_sec_div">
    <div class="col-lg-12 col-ml-12">
        <button style="margin:1rem 1rem 0 0;" type="button" name="add" id="add" class="btn btn-success btn-sm add"><i class="fas fa-plus"></i></button>
    </div>


    <div class="col-lg-12 col-ml-12">
        <div class="row" style="padding:0rem 1rem 1rem 1rem; padding-bottom:1.5rem; margin:2rem 0.2rem 2rem 0.2rem; background:#ccc;">
            <div class="col-12 mt-5" style="margin:-1rem;">
                <span style="margin-left:1rem;" class="status-p bg-primary">Passanger #1</span>
            </div>
            <!-- Add Ticket Information start -->
            <div class="col-3 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Ticket Infromation</h4>
                        <p class="text-muted font-14 mb-4">Here are want to add <code>Ticket Infromation</code> of Exchange Order.</p>
                        <div class="form-group">
                            <label for="example-text-input" class="col-form-label">Passenger Name</label>
                            <input name="p_name[]" class="form-control" type="text" id="p_name" required>
                        </div>
                        <div class="form-group">
                            <label for="validationCustom03">Ticket No.</label>
                            <input name="ticket_no[]" type="text" class="form-control" id="ticket_no" required>
                        </div>

                        <div class="form-group">
                            <label for="example-date-input" class="col-form-label">Ticket Date</label>
                            <input name="ticket_date[]" class="form-control" type="date" id="ticket_date" required>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End Ticket Infromation -->

            <!-- Fare Section start -->
            <div class="col-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Fare Section</h4>
                        <p class="text-muted font-14 mb-4">Here are want to add <code>Fare Section</code> of Exchange Order.</p>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom03">Basic (0.00)</label>
                                <input name="basicc[]" type="number" step=".01" class="form-control form-control-sm" id="basicc" onkeyup="calc(this)" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom04">yq (0.00)</label>
                                <input name="yq[]" type="number" step=".01" class="form-control form-control-sm" id="yq" onkeyup="calc(this)" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom03">yr (0.00)</label>
                                <input name="yr[]" type="number" step=".01" class="form-control form-control-sm" id="yr" onkeyup="calc(this)" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom04">Tax-3 (0.00)</label>
                                <input name="tax_3[]" type="number" step=".01" class="form-control form-control-sm" id="tax_3" onkeyup="calc(this)" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom03">Tax-4 (0.00)</label>
                                <input name="tax_4[]" type="number" step=".01" class="form-control form-control-sm" id="tax_4" onkeyup="calc(this)" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom04">Total Tax (0.00)</label>
                                <input style="background:#ccc;" name="total_tax[]" type="number" step=".01" class="form-control form-control-sm" id="total_tax" value="0.00" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom03">Supplier Charge (0.00)</label>
                                <input name="supp_charge[]" type="number" step=".01" class="form-control form-control-sm" id="supp_charge" onkeyup="calc(this)" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom03">Service Amount (0.00)</label>
                                <input name="service_amt[]" type="number" step=".01" class="form-control form-control-sm" id="service_amt" onkeyup="calc(this)" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-text-input" class="col-form-label">Net Profit (0.00)</label>
                            <input style="background:#ccc;" name="net_profit[]" class="form-control form-control-sm" type="number" step=".01" id="net_profit" value="0.00" required>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom03">Net Due (0.00)</label>
                                <input style="background:#ccc;" name="net_due[]" type="number" step=".01" class="form-control form-control-sm" id="net_due" value="0.00" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom04">Net to Supplier (0.00)</label>
                                <input style="background:#ccc;" name="net_to_supplier[]" type="number" step=".01" class="form-control form-control-sm" id="net_to_supplier" value="0.00" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Coupon Information start -->
            <div class="col-3 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Coupon Information</h4>
                        <p class="text-muted font-14 mb-4">Here are want to add <code>Coupon Information</code> of Exchange Order.</p>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">From&nbsp;&nbsp; <i class="fa fa-arrow-right"></i> &nbsp;&nbsp;To</span>
                            </div>
                            <textarea name="from_to[]" class="form-control" aria-label="With textarea" id="from_to" required></textarea>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom03">Class Code</label>
                                <input name="class_code[]" type="text" class="form-control" id="class_code" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom04">Airline Code</label>
                                <input name="airline_code[]" type="text" class="form-control" id="airline_code" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom03">Flight No.</label>
                                <input name="flight_no[]" type="text" class="form-control" id="flight_no" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom04">Departure Date</label>
                                <input name="depart_date[]" class="form-control" type="date" id="depart_date" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>