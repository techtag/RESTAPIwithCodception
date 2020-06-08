<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    const TABLE_NAME = 'posts';
    const ID = 'id';
    const TITLE = 'title';
    const CONTENT = 'content';
    const PRIMARY_IMAGE = 'primary_image';
    const THUMBNAIL_IMAGE = 'thumbnail_image';
    const SLUG = 'slug';
    const AUTHOR = 'author';
}
