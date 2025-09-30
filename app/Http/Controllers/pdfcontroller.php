<?php
namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\http\Request;
use Inertia\Inertia;

class generatepdf extends Controller{

    public function generate(){
    return Pdf::loadView('');
    }

}