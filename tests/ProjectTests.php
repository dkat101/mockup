<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProjectTests extends TestCase {

    /**
     * Testing whether project related pages can be accessed.
     *
     * @return void
     */
    /*public function testProjectPagesCode() {
        $this->assertEquals(200, $this->call('GET', '/project/new')->status());
        $this->assertEquals(200, $this->call('GET', '/project/list')->status());
        $this->assertEquals(200, $this->call('GET', '/project/item/' . 1)->status());
        $this->assertEquals(200, $this->call('GET', '/project/edit/' . 1)->status());
    }*/

    /**
     * Testing whether all the CRUD operations in the ProjectController can be performed on a project.
     *
     * @return void
     */
    public function testProjectCRUD() {
        $faker = factory(App\Project::class)->make();

        /**
         * Testing whether a project can be created.
         */
        $this->authUserPost('/api/project/new', [
            'p_id' => $faker->p_id,
            'user_id' => $faker->user_id,
            'name' => $faker->name,
            'description' => $faker->description
        ])->seeApiSuccess()
            ->seeJson(['data' => true])
            ->seeJson(['errors' => false]);

        /**
         * Testing whether a project exists in database.
         */
        $this->seeInDatabase('projects', [
            'p_id' => $faker->p_id,
            'user_id' => $faker->user_id,
            'name' => $faker->name,
            'description' => $faker->description
        ]);

        /**
         * Testing whether a project can be retrieved using the id.
         */
        $this->authUserGet('/api/project/single/' . $faker->p_id, [])
            ->seeApiSuccess()
            ->seeJson(['p_id' => $faker->p_id])
            ->seeJson(['user_id' => $faker->user_id])
            ->seeJson(['name' => $faker->name])
            ->seeJson(['description' => $faker->description]);

        /**
         * Testing whether all projects can be retrieved.
         */
        $this->authUserGet('/api/project/list/', [])
            ->seeApiSuccess()
            ->seeJson(['p_id' => $faker->p_id]);

        /**
         * Testing whether a project can be updated.
         */
        $this->authUserPost('/api/project/edit/' . $faker->p_id, [
            'user_id' => $faker->user_id,
            'name' => $faker->name . ' test',
            'description' => $faker->description
        ])->seeApiSuccess()
            ->seeJson(['data' => true])
            ->seeJson(['errors' => false]);

        /**
         * Testing whether a project can be updated.
         */
        $this->authUserPost('/api/project/delete/' . $faker->p_id, [])
            ->seeApiSuccess()
            ->seeJson(['data' => true])
            ->seeJson(['errors' => false]);

    }

}
