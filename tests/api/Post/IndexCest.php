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
        $posts=$I->haveMultiple(Post::class,2);
        $expectedArray=[
            'data'=>[
                $posts[0]->id=>[
                    POST::TITLE => $posts[0]->title,
                    POST::CONTENT => $posts[0]->content
                ],
                $posts[1]->id=>[
                    POST::TITLE => $posts[1]->title,
                    POST::CONTENT => $posts[1]->content
                ]
            ]
        ];
        $expectedJson=json_encode($expectedArray);

        //Act
        $I->sendGET('post');
        $response=$I->grabResponse();

        //Assert
        $I->seeResponseCodeIs(200);
        $I->assertEquals($expectedJson,$response);
    }
}
