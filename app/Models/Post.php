<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','image','description','category_id','user_id','published_at','is_active','created_at','updated_at'];

    protected $dates = ['created_at','updated_at'];
    
    ////////////////////////////////////////////////////////

    public function user(){
        return $this->belongsTo(User::class);
    }

    ////////////////////////////////////////////////////////

    public function category(){
    	return $this->belongsTo(Category::class);
    }

    ////////////////////////////////////////////////////////

    public function tags(){
    	return $this->belongsToMany(Tag::class, 'post_tag');	
    }

    ////////////////////////////////////////////////////////

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    ////////////////////////////////////////////////////////

    public function scopePublished($query){
        return $query->where('is_published',1);
    }

    public function scopeDrafted($query)
    {
        return $query->where('is_published', 0);
    }

    ////////////////////////////////////////////////////////

    public function getPublishedAttribute()
    {
        return ($this->is_published) ? 'Yes' : 'No';
    }

    ////////////////////////////////////////////////////////


}