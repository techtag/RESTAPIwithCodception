<?php namespace Post;

use App\Post;
use ApiTester;
use Faker\Factory;

class CreateCest
{
    // public function _before(ApiTester $I)
    // {
    // }

    // tests
    public function createPost(ApiTester $I)
    {
        //Arrange
        $post=factory(Post::class,1)->create();
        $post=$post->toArray();
        $post=$post[0];
        //Act
        $I->sendPOST('post',$post);
        $response=$I->grabResponse();

        //Assert
        $I->seeResponseCodeIs(200);
        $I->seeRecord(Post::TABLE_NAME,$post);
        $I->assertEquals('Success' , $response);
    }
    /**
     * @dataProvider requiredParameters
     */
    public function return400WhenMissingRequiredParameteres(ApiTester $I, \Codeception\Example $requiredParameter){
        $post = Factory(Post::class,1)->create();
        $post->toArray();
        $post=$post[0];
        //unset($post[Post::TITLE]);
        unset($post[$requiredParameter['parameterName']]);
        
        $I->sendPost('post',$post);
        $I->seeResponseCodeIs(400);
    }

    protected function requiredParameters(){
        return [
            ['parameterName'=>Post::TITLE],
            ['parameterName'=>Post::CONTENT],
            ['parameterName'=>Post::PRIMARY_IMAGE],
            ['parameterName'=>Post::THUMBNAIL_IMAGE],
            ['parameterName'=>Post::SLUG],
            ['parameterName'=>Post::AUTHOR]
        ];
    }
}
