<?php namespace Post;

use App\Post;
use ApiTester;
use Faker\Factory;


class UpdateCest
{
    // tests
    public function updatePost(ApiTester $I)
    {
        //Arrange
        $post=$I->have(Post::class);
        $faker=Factory::create();
        $updates=[
            POST::TITLE => $faker->sentence(5),
            POST::CONTENT => $faker->paragraph(4,true)
            ];
        $expectedArray=[
            'data'=>[
                $post->id => [
                    POST::TITLE => $updates[Post::TITLE],
                    POST::CONTENT => $updates[Post::CONTENT]
                ]
            ]
        ];
        $expectedJson=json_encode($expectedArray);

        //Act
        $I->sendPUT('post/'.$post->id,$updates);
        $response=$I->grabResponse();

        //Assert
        $I->seeResponseCodeIs(200);
        $I->seeRecord(Post::TABLE_NAME,$updates);
        $I->assertEquals($expectedJson,$response);
    }
    public function return404WhenItCantFindRecordsToUpdate(ApiTester $I){
        $id=99;

        $I->sendPUT('post/'.$id);
        $I->seeResponseCodeIs(404);
    }
}
