<?php

namespace App\Http\Middleware;

use App\Models\PrimaryPlan;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPurchasedCredit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check the current purchased license
        if (Auth::user()->role === 'admin') {
            return $next($request);
        }

        if (Auth::user()->role === 'company_admin' || Auth::user()->role  =='manager') {
            // Check the total credit purchased
            $total = PrimaryPlan::where('company_id', Auth::user()->id)->sum('quantity');
            if(Auth::user()->role =='manager'){
                $total = PrimaryPlan::where('company_id', Auth::user()->company_id)->sum('quantity');

            }

            if ($total > 0) {
                return $next($request);
            } else {
                return redirect()->back()->with('error', 'Your License has been expired or you have not puchased any license yet! please purchase or upgrade your plan!');
            }
        }

        // Handle other roles or unauthorized access
        return redirect()->back()->with('error', 'Unauthorized access.');
    }
}
