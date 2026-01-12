<?php

namespace App\Http\Controllers\Front;

use App\Models\Slide;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\ContactRequest;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Slide::latest()->get();
        $categories = Category::latest()->get();
        $saleProducts = Product::whereNotNull('sale_price')->where('sale_price', '>', 0)
            ->inRandomOrder()->limit(8)->get();

        $featuredProducts = Product::where('featured', 1)->limit(8)->get();
        return view('front.home', compact('slides','categories', 'saleProducts', 'featuredProducts'));
    }

    public function about()
    {
        return view('front.about');
    }

    public function contact()
    {
        return view('front.contact');
    }
    public function store(ContactRequest $request)
    {
        Contact::create($request->validated());
        return redirect()->route('contact.index')->with('success','Your message has been sent successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $requests = Product::where('name', 'LIKE', "%{$query}%")->take(8)->get();
        return response()->json($requests);
    }
}
