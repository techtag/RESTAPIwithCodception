<?php namespace User;

use App\User;
use ApiTester;
use Faker\Factory;

class CreateCest
{
    // public function _before(ApiTester $I)
    // {
    // }

    // tests
    public function createUser(ApiTester $I)
    {
        //Arrange
        // $user=factory(User::class,1)->create();
        // $user=$user->toArray();
        // $user=$user[0];
        $faker = Factory::create();
        $user=[
            User::NAME => $faker->name,
            User::EMAIL => $faker->email,
            User::PASSWORD => $faker->password
        ];
        //Act
        $I->sendPOST('user',$user);
        $response=$I->grabResponse();

        //Assert
        $I->seeResponseCodeIs(200);
        $I->seeRecord(User::TABLE_NAME, $user);
        $I->assertEquals('Success' , $response);
    }
    /**
     * @dataProvider requiredParameters
     */
    public function return400WhenMissingRequiredParameteres(ApiTester $I, \Codeception\Example $requiredParameter){
        $faker = Factory::create();
        $user=[
            User::NAME => $faker->name,
            User::EMAIL => $faker->email,
            User::PASSWORD => $faker->password
        ];
        
        unset($user[$requiredParameter['parameterName']]);
        
        $I->sendPost('user',$user);
        $I->seeResponseCodeIs(400);
    }

    protected function requiredParameters(){
        return [
            ['parameterName'=>User::NAME],
            ['parameterName'=>User::EMAIL],
            ['parameterName'=>User::PASSWORD],           
        ];
    }
}
