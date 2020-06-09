<?php namespace Post;

use App\Post;
use ApiTester;


class ShowCest
{
    // public function _before(ApiTester $I)
    // {
    // }

    // tests
    public function showPost(ApiTester $I)
    {
        //Arrange
        $post=$I->have(Post::class);
        $expectedArray=[
            'data'=>[
                $post->id => [
                    POST::TITLE => $post->title,
                    POST::CONTENT => $post->content
                ]
            ]
        ];
        $expectedJson=json_encode($expectedArray);

        //Act
        $I->sendGET('post/'.$post->id);
        $response=$I->grabResponse();

        //Assert
        $I->seeResponseCodeIs(200);
        $I->assertEquals($expectedJson,$response);
    }

    public function return404WhenRecordCannotBeFound(ApiTester $I){
        $id=54;
        $I->sendGET('post/'.$id);
        $I->seeResponseCodeIs(404);
    }
}
