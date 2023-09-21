<?php

namespace App\Http\Controllers;

use App\Mail\NotifyEmail;
use Illuminate\Http\Request;
use App\Models\{Product, User};
use Auth;
use Mail;

class HomeController extends Controller
{
    public function index(Product $product)
    {
        $products = $product->orderBy('id', 'asc')->get();
        return view('web.welcome', compact('products'));
    }

    public function dashboard(User $user)
    {
        $users = [];
        if (Auth::user()->hasRole(['admin'])) {
            $users = $user->whereNotIn('id', [Auth::user()->id])->get();
        }
        return view('dashboard', compact('users'));
    }

    public function accessCancellation(Request $request, User $user)
    {
        $user = $user->find($request->user_id);
        if ($user) {
            $user->status = ($user->status == 1) ? 0 : 1;
            $user->update();


            $content = [
                'subject' => 'Access Notification',
                'body' => ($user->status == 1) ? '<h3>Hello ' . $user->name . '</h3><br/><p>Your access to  ' . strtolower(config('app.name')) . ' has been revoked.</p>' : '<h3>Hello ' . $user->name . '</h3><br/><p>Your access to  ' . strtolower(config('app.name')) . ' has been granted.</p>'

            ];
            Mail::to($user->email)->send(new NotifyEmail($content));
            return $user;
        }
    }
}
