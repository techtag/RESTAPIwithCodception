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

    const CURRENT_PAGE='current_page';
    const DATA = 'data';
    const FIRST_PAGE_URL = "first_page_url";
    const FROM ="from" ;
    const LAST_PAGE ="last_page";
    const LAST_PAGE_URL ="last_page_url";
    const NEXT_PAGE_URL ="next_page_url";
    const PATH ="path";
    const PER_PAGE ="per_page";
    const PREV_PAGE_URL ="prev_page_url";
    const TO ="to";
    const TOTAL ="total";
  
}
