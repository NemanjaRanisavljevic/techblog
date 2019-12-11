<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\PostModel;

class IndexController extends Controller
{
    
    private $postModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
    }

    public function IndexPrikaz()
    {
        $postovi = $this->postModel->PrikazPostova();

        $slajderPost = $this->postModel->PrikazSlajda();
        
       
        return view('Pages/pocetna',['postovi'=>$postovi,'slajderData'=>$slajderPost]);
    }
}
