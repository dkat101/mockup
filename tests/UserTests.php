<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTests extends TestCase {

    //use DatabaseMigrations;

    /**
     * Testing whether all the CRUD operations in the ImageController can be performed on a user.
     *
     * @return void
     */
    public function testUserCRUD() {
        //$faker = factory(App\User::class)->make();

        /**
         * Testing whether a user can be saved.
         */
        $this->authUserPost('user/new', [
            'u_id' => 'a20e0620-353d-36b1-9c87-0d985c2a8162',
            'f_name' => 'admin',
            'l_name' => 'admin',
            'email' => 'admin@local.test',
            'password' => bcrypt(1234),
            'remember_token' => str_random(10)
        ])/*->seeApiSuccess()
            ->seeJson(['data' => true])
            /*->seeJson(['errors' => false])
            ->seeJson(['message' => 'Unable to authenticate with invalid token.'])
            ->seeJson(['status_code' => 401])*/;

        /**
         * Testing whether a user exists in database.
         */
        /*$this->seeInDatabase('users', [
            'u_id' => $faker->u_id,
            'f_name' => $faker->f_name,
            'l_name' => $faker->l_name,
            'email' => $faker->email,
            'password' => $faker->password
        ]);*/

        /**
         * Testing whether a user can be retrieved using the id.
         */
        /*$this->authUserGet('/api/user/single/' . $faker->u_id, [])
            ->seeApiSuccess()
            ->seeJson(['u_id' => $faker->u_id])
            ->seeJson(['f_name' => $faker->f_name])
            ->seeJson(['l_name' => $faker->l_name])
            ->seeJson(['email' => $faker->email])
            ->seeJson(['password' => $faker->password]);*/

        /**
         * Testing whether all users can be retrieved.
         */
        /*$this->authUserGet('/api/user/list/', [])
            ->seeApiSuccess()
            ->seeJson(['u_id' => $faker->u_id]);*/

        /**
         * Testing whether a user can be updated.
         */
        /*$this->authUserPost('/api/user/edit/' . $faker->u_id, [
            'f_name' => $faker->f_name,
            'l_name' => $faker->l_name,
            'email' => $faker->email,
            'password' => $faker->password
        ])->seeApiSuccess()
            ->seeJson(['data' => true])
            ->seeJson(['errors' => false]);*/

        /**
         * Testing whether a user can be updated.
         */
        /*$this->authUserPost('/api/user/delete/' . $faker->u_id, [])
            ->seeApiSuccess()
            ->seeJson(['data' => true])
            ->seeJson(['errors' => false]);*/

    }

}
