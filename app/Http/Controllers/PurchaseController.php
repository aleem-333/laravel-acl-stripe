<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Product, User, Purchase};
use App\Mail\NotifyEmail;
use Auth;
use Mail;

class PurchaseController extends Controller
{
    public function purchaseProduct(Request $request, Product $product, Purchase $purchase)
    {
        try {
            $purchase = \DB::transaction(function () use ($request, $product, $purchase) {

                $product = Product::find($request->product_id);

                if (isset($product->id)) {
                    $user =  User::where('email', $request->email)->first();

                    if (!isset($user->id)) {
                        $user = User::create([
                            'name' => $request->name,
                            'email' => $request->email,
                            'password' => \Hash::make('12345678'),
                        ]);

                        if ($product->type == "B2C") {
                            $user->assignRole('b2c-customer');
                        } else if ($product->type == "B2B") {
                            $user->assignRole('b2b-customer');
                        }
                    }

                    $user->createOrGetStripeCustomer();
                    $user->updateDefaultPaymentMethod($request->payment_method);
                    $resp = $user->charge($product->price * 100, $request->payment_method);

                    $purchase = $purchase->create([
                        'user_id' => $user->id,
                        'product_id' => $product->id,
                        'price' => $product->price,
                        'last_card_digit' => $user->pm_last_four,
                        'payment_status' => ucwords($resp->status),
                    ]);

                    $content = [
                        'subject' => 'Purchase Notification',
                        'body' => '<h3>Hello ' . $user->name . '</h3><br/><p> You have successfully purchased ' . $product->title . '.</p>'
                    ];

                    Mail::to($user->email)->send(new NotifyEmail($content));
                    return with($purchase);
                }
            });

            if ($purchase) {
                if ($purchase->payment_status == "Succeeded") {
                    return redirect('/')->with('success', 'Your purchase has been successfully processed.');
                } else {
                    return redirect('/')->with('success', 'Your payment request has been unsuccessful.');
                }
            } else {
                return redirect('/')->with('error', 'ERROR!! Something went wrong.');
            }
        } catch (\Exception $exception) {
            return back()->with('error', 'ERROR!! Something went wrong.');
        }
    }

    public function purchaseCancellation(Request $request, Purchase $purchase)
    {
        try {
            $purchase = Purchase::find($request->purchase_id);
            if ($purchase) {
                $purchase->status = "Cancelled";
                $purchase->update();
                return redirect('dashboard')->with('success', 'Your purchase has been cancelled.');
            }
        } catch (\Exception $exception) {
            return redirect('dashboard')->with('error', 'ERROR!! Something went wrong.');
        }
    }
}
