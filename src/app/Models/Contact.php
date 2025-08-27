<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public function category(){
    return $this->belongsTo(Category::class);
    }

    //ラベルの作成
    public const GENDERS = [
        1 => '男性',
        2 => '女性',
        3 => 'その他',
        ];

    //必要なければ消してもいいかも
    public function getGenderNameAttribute(): string
    {
        return match($this->gender) {
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        };
    }

    //書き換え可能
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
        'category_id',
    ];

    //検索機能ーテキストボックス
    public function scopeKeywordSearch($query, $keyword){
        if(!empty($keyword)){

            $keywords = preg_split('/\s+/', $keyword);

            $query->where(function ($q) use ($keywords){
                    foreach($keywords as $word){
                        $q->where(function ($q2) use ($word){
                            $q2->whereRaw("REPLACE(CONCAT(first_name, last_name), ' ', '') LIKE ?", ["%{$word}%"])
                            ->orWhere('first_name', 'like', '%' . $word . '%')
                            ->orWhere('last_name', 'like', '%' . $word . '%')
                            ->orWhere('email', 'like', '%' . $word . '%')
                            //完全一致も検索
                            ->orWhere('first_name', $word)
                            ->orWhere('last_name', $word)
                            ->orWhere('email', $word);
                        });
                    }
                });
        }
    }

    //検索機能ー性別
    public function scopeGenderSearch($query, $gender){
        if(!empty($gender)){
            $query->where('gender', $gender);
        }
    }

    //検索機能ー問い合わせ種類
    public function scopeCategorySearch($query, $category_id){
        if (!empty($category_id)){
            $query->where('category_id', $category_id);
        }
    }

    //検索機能ー日付
    public function scopeDateSearch($query, $created_at){
        if(!empty($created_at)){
            if (!empty($created_at)){
                $query->whereDate('created_at', $created_at);
            }
        }
    }

}
