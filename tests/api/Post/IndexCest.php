<?php namespace Post;

use App\Post;
use ApiTester;


class IndexCest
{
    // public function _before(ApiTester $I)
    // {
    // }

    // tests
    public function showAllPosts(ApiTester $I)
    {
        // $I->sendGET('');
        // $I->seeResponseCodeIs(200);
        // $I->seeResponseContains("Laravel");

        //Arrange
        $posts=$I->haveMultiple(Post::class,13);
        
        $expectedArray= [
            Post::CURRENT_PAGE=>1,
            Post::DATA => [
              0 => [
                POST::TITLE => $posts[0]->title,
                POST::CONTENT => $posts[0]->content
              ],
              1 =>  [
                POST::TITLE => $posts[1]->title,
                POST::CONTENT => $posts[1]->content
              ],
              2 =>  [
                POST::TITLE => $posts[2]->title,
                POST::CONTENT => $posts[2]->content
              ]
            ],
            Post::FIRST_PAGE_URL => env('APP_URL').'/api/post?page=1',
            Post::FROM => 1,
            Post::LAST_PAGE => 5,
            Post::LAST_PAGE_URL => env('APP_URL')."/api/post?page=5",
            Post::NEXT_PAGE_URL => env('APP_URL')."/api/post?page=2",
            Post::PATH => env('APP_URL')."/api/post",
            Post::PER_PAGE => 3,
            Post::PREV_PAGE_URL => null,
            Post::TO => 3,
            Post::TOTAL => 13
        ];
          

        //$expectedJson=json_encode($expectedArray);

        //Act
        $I->sendGET('post');
        //$response=$I->grabResponse();

        //Assert
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson($expectedArray);
    }
    public function return404WhenNoRecordsFound(ApiTester $I){
        $I->sendGET('post');
        $I->seeResponseCodeIs(404);
    }
}
