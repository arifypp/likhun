<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Backend\Checkout;
use App\Models\Backend\OurPackage;
use App\Http\Controllers\Controller;
use Auth;
class PackageController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $packages = OurPackage::with('features')->get();
        return view('frontend.users.package', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function payment($slug)
    {
        //
        $package = OurPackage::where('slug', $slug)->first();
        return view('frontend.users.payment', compact('package'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function paymentgateway(Request $request)
    {
        $package = OurPackage::where('slug', $request->slug)->first();
        $token = rand(1000, 9999);
        $html = '
        <div class="modal fade" id="paymentProcess" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="paymentProcessLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content" style="background-color:#D9165F;">
                    <div class="modal-header bg-light">
                        <a href="'.route('frontend.package').'" class="text-center m-auto">
                            <img src="https://raw.githubusercontent.com/Shipu/bkash-example/master/bkash_payment_logo.png" width="300px"/>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="company_details bg-light p-3 rounded">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="company_name">
                                        <span class="d-block"> <h6 class="mb-0"> <i class="fas fa-building"></i> '.config('app.name').'</h6></span>
                                        <small>Invoice #'.$token.'</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="company_amount text-end">
                                        <span class="d-block"> <h4 class="mb-0">৳ '.$package->price.'</h4></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="payment_details py-3">
                            <h6 class="text-light">Enter Transaction ID</h6>
                            <input type="text" id="transaction_id" class="form-control form-control-sm" placeholder="Enter Transaction ID" />
                            <!-- Guidelines -->
                            <div class="payment_details_guide text-light mt-3">
                                <ul>
                                    <li>1. Dial *247#</li>
                                    <li>2. Select \'Send Money\'</li>
                                    <li>3. Enter bKash Account Number: <strong>01953291938</strong></li>
                                    <li>4. Enter Amount: <strong>'.$package->price.'</strong></li>
                                    <li>5. Enter Reference: <strong>Invoice #'.$token.'</strong></li>
                                    <li>6. Enter Counter Number: <strong>1</strong></li>
                                    <li>7. Now enter your bKash PIN to confirm</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-center d-block bg-light">
                        <a href="'.route('frontend.package').'" class="btn btn-secondary">Cancel Payment</a>
                        <a href="#" class="btn btn-success btn-block" id="confirmPayment">Confirm Payment</a>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $("#confirmPayment").on("click", function(e) {
                e.preventDefault();
                // check transaction id is not empty and length is 6 digit and validate for bkash
                $.ajax({
                    url: "'.route('frontend.package.payment.success', $package->slug).'",
                    type: "GET",
                    beforeSend: function() {
                        $("#confirmPayment").html("<i class=\'fas fa-spinner fa-spin\'></i> Please wait...");
                    },
                    data: {
                        "transaction_id": $("#transaction_id").val(),
                        "package_id": "'.$package->id.'",
                        "token": "'.$token.'"
                    },
                    success: function(response) {
                        if (response.status == "success") {
                            $("#confirmPayment").html("Confirm Payment");
                            $("#paymentProcess").modal("hide");
                            // Redirect to the same page with success flash message
                            var url = "'.route('frontend.package.payment', $package->slug).'";
                            url += "?success=true&token=" + '.rand().';
                            window.location.href = url;
                        } else {
                            $("#confirmPayment").html("Confirm Payment");
                            alert(response.message);
                        }
                    },                    
                    error: function(xhr, status, error) {
                        var response = JSON.parse(xhr.responseText);
                        var errorMessage = response.message;
                        $("#confirmPayment").html("Confirm Payment");
                        alert(errorMessage);

                        // invalid class to transaction id input
                        if (errors && errors.transaction_id) {
                            var transactionIdInput = $("#transaction_id");
                            transactionIdInput.addClass("is-invalid");
                            transactionIdInput.parent().find(".invalid-feedback").html(errors.transaction_id[0]);
                        }
                    }
                });
            });
        </script>
        ';
        
        return $html;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function paymentSuccess(Request $request, string $id)
    {
        //
        $request->validate([
            'transaction_id' => 'required',
            'package_id' => 'required|exists:our_packages,id'
        ]);

        $transaction_id = $request->transaction_id;
        $package_id = $request->package_id;

        $checkout = Checkout::where('transaction_id', $transaction_id)->first();
        if($checkout) {
            return response()->json([
                'status' => 'error',
                'message' => 'Transaction ID already exists.'
            ]);
        }
        else
        {
            $package = OurPackage::find($package_id);
            $checkout = new Checkout();
            $checkout->transaction_id = $transaction_id;
            $checkout->package_id = $package_id;
            $checkout->user_id = Auth::user()->id;
            $checkout->payment_amount = $package->price;
            $checkout->payment_method = 'bkash';
            $checkout->payment_currency = 'BDT';
            $checkout->invoice_no = "INV-".$request->token;
            $checkout->save();

            // send response to user
            return response()->json([
                'status' => 'success',
                'message' => 'Payment successfully completed.'
            ]);
        }

        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Payment successfully completed.'
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
