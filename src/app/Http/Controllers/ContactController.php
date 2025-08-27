<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    //お問い合わせフォームを呼び出し
    public function index(){
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    // 確認画面に進む処理
    public function confirm(ContactRequest $request)
    {
        $contact = $request->validated();

        //telを結合
        $contact['tel'] = $contact['tel1'] . '-' . $contact['tel2'] . '-' . $contact['tel3'];

        //性別ラベルを格納
        $gender = [1 => '男性', 2 => '女性', 3 => 'その他'];
        $contact['gender_name'] = $gender[$contact['gender']];

        //カテゴリーラベルを格納
        $category = Category::find($contact['category_id']);
        $contact['category_name'] = $category->content;

        // セッションに保存
        $request->session()->put('contact', $contact);

        return view('confirm', ['contact' => $contact]);
    }

    // 入力画面に戻る修正ボタン
    public function back(Request $request)
    {
        $contact = $request->session()->get('contact');
        return redirect('/index')->withInput($contact);
    }

    //DBに保存してサンクスページへ推移
    public function store(Request $request)
    {
        $contact = $request->session()->get('contact');
        Contact::create($contact);
        $request->session()->forget('contact');
        return view('thanks');
    }

    // サンクスページの表示
    public function thanks()
    {
        return view('thanks');
    }

}
