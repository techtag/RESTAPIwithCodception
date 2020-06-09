<?php namespace Post;

use App\Post;
use ApiTester;


class DeleteCest
{
    // public function _before(ApiTester $I)
    // {
    // }

    // tests
    public function deletePost(ApiTester $I)
    {
        //Arrange
        $post=$I->have(Post::class);
        //Act
        $I->sendDELETE('post/'.$post->id);
        $response=$I->grabResponse();

        //Assert
        $I->seeResponseCodeIs(200);
        $I->dontSeeRecord(Post::TABLE_NAME,[Post::ID=>$post->id]);
        $I->assertEquals('Success',$response);
    }

    public function return404WhenCantFindRecordToDelete(ApiTester $I){
        $id=99;
        $I->sendDELETE('post/'.$id);
        $I->seeResponseCodeIs(404);
    }
}
