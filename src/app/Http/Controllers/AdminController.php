<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    //管理画面を呼び出し
    public function admin(){
        $contacts = Contact::paginate(7);
        $categories = Category::all();
        $genders = Contact::GENDERS;
        return view('admin', compact('contacts','categories','genders',));
    }

    //検索機能
    public function search(Request $request){
        $contacts = Contact::with('category')
            ->KeywordSearch($request->keyword)
            ->GenderSearch($request->gender)
            ->CategorySearch($request->category_id)
            ->DateSearch($request->created_at)
            ->paginate(7);
        $categories = Category::all();
        $genders = Contact::GENDERS;

        return view('admin', compact('contacts','categories','genders'));
    }

    //削除機能
    public function destroy(Request $request){
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }
}

