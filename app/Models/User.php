<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;//模型工厂相关功能的引用
use Illuminate\Foundation\Auth\User as Authenticatable;//授权相关功能的引用
use Illuminate\Notifications\Notifiable;//消息通知相关功能引用
use Laravel\Sanctum\HasApiTokens; //API 令牌修改功能
use Illuminate\Support\Str;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * $fillable属性：在过滤用户提交的字段，只有包含在该属性中的字段才能够被正常更新
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     * $hidden属性：对用户密码或其它敏感信息在用户实例通过数组或 JSON 显示时进行隐藏
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     * $casts属性：是用来指定数据库字段使用的数据类型
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * 用来生成用户的头像
     */
    public function gravatar($size='100'){
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "https://cdn.v2ex.com/gravatar/$hash?s=$size";
    }

    public static function boot(){
        parent::boot();
        static::creating(function($user){
            $user->activation_token=Str::random(10);
        });
    }

    public function statuses(){
        return $this->hasMany(Status::class);
    }

    public function feed(){
        return $this->statuses()
                    ->orderBy('created_at','desc');
    }
}
