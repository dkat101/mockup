<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ImageTests extends TestCase {

    /**
     * Testing whether all the CRUD operations in the ImageController can be performed on an image.
     *
     * @return void
     */
    public function testImageCRUD() {
        $faker = factory(App\Image::class)->make();

        /**
         * Testing whether an image can be saved.
         */
        $this->authUserPost('/api/image/new', [
            'i_id' => $faker->i_id,
            'project_id' => $faker->project_id,
            'display_name' => $faker->display_name,
            'file_name' => $faker->file_name
        ])->seeApiSuccess()
            ->seeJson(['data' => true])
            ->seeJson(['errors' => false]);

        /**
         * Testing whether an image exists in database.
         */
        $this->seeInDatabase('images', [
            'i_id' => $faker->i_id,
            'project_id' => $faker->project_id,
            'display_name' => $faker->display_name,
            'file_name' => $faker->file_name
        ]);

        /**
         * Testing whether an image can be retrieved using the id.
         */
        $this->authUserGet('/api/image/single/' . $faker->i_id, [])
            ->seeApiSuccess()
            ->seeJson(['i_id' => $faker->i_id])
            ->seeJson(['project_id' => $faker->project_id])
            ->seeJson(['display_name' => $faker->display_name])
            ->seeJson(['file_name' => $faker->file_name]);

        /**
         * Testing whether all images can be retrieved.
         */
        $this->authUserGet('/api/image/list/', [])
            ->seeApiSuccess()
            ->seeJson(['i_id' => $faker->i_id]);

        /**
         * Testing whether an image can be updated.
         */
        $this->authUserPost('/api/image/edit/' . $faker->i_id, [
            'project_id' => $faker->project_id,
            'display_name' => $faker->display_name,
            'file_name' => $faker->file_name,
            'links' => $faker->links,
            'views' => $faker->views
        ])->seeApiSuccess()
            ->seeJson(['data' => true])
            ->seeJson(['errors' => false]);

        /**
         * Testing whether an image can be updated.
         */
        $this->authUserPost('/api/image/delete/' . $faker->i_id, [])
            ->seeApiSuccess()
            ->seeJson(['data' => true])
            ->seeJson(['errors' => false]);

    }

}
