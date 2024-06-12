<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarketProfileController extends Controller
{ 

    //Show list product of Profile Seller 
     public function ProfileSeller() {  
        return  view('profileSeller.profileSeller');

     }
}
