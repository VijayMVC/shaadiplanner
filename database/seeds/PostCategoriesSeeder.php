<?php

use Illuminate\Database\Seeder;
use App\PostCategories;
use App\Post;

class PostCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $cat=PostCategories::create(array(
            'name'     => 'Πύλη πελατών',
            'slug'     => 'client-portal'
        ));

        $cat=PostCategories::create(array(
            'name'     => 'Ιστοσελίδες',
            'slug'     => 'websites'
        ));
        $post=Post::create(array(
            'author_id'     => 1,
            'cat_id'     => $cat->id,
            'title'     =>  'Διαχείριση Άρθρων',
            'slug'      =>  'diaxeirisi-arthrwn',
            'content'      =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
            'status'    =>  'published',
        ));
        $post=Post::create(array(
            'author_id'     => 1,
            'cat_id'     => $cat->id,
            'title'     =>  'Διαχείριση Πελατολογίου',
            'slug'      =>  'diaxeirisi-pelatologioy',
            'content'      =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
            'status'    =>  'published',
        ));
        $post=Post::create(array(
            'author_id'     => 1,
            'cat_id'     => $cat->id,
            'title'     =>  'Διαχείριση Ημερολογίου',
            'slug'      =>  'diaxeirisi-hmerologioy',
            'content'      =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
            'status'    =>  'published',
        ));
        $post=Post::create(array(
            'author_id'     => 1,
            'cat_id'     => $cat->id,
            'title'     =>  'Διαχείριση Προσωπικού',
            'slug'      =>  'diaxeirisi-proswpikoy',
            'content'      =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
            'status'    =>  'published',
        ));


        $cat=PostCategories::create(array(
            'name'     => 'Ηλεκτρονικό κατάστημα',
            'slug'     => 'eshop'
        ));
        $post=Post::create(array(
            'author_id'     => 1,
            'cat_id'     => $cat->id,
            'title'     =>  'Διαχείριση Προϊόντων',
            'slug'      =>  'diaxeirisi-proiontwn',
            'content'      =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
            'status'    =>  'published',
        ));
        $post=Post::create(array(
            'author_id'     => 1,
            'cat_id'     => $cat->id,
            'title'     =>  'Διαχείριση Παραγγελιών',
            'slug'      =>  'diaxeirisi-paraggeliwn',
            'content'      =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
            'status'    =>  'published',
        ));
        $post=Post::create(array(
            'author_id'     => 1,
            'cat_id'     => $cat->id,
            'title'     =>  'Διαχείριση Μεταφορικών',
            'slug'      =>  'diaxeirisi-metaforikwn',
            'content'      =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
            'status'    =>  'published',
        ));


        $cat=PostCategories::create(array(
            'name'     => 'Λογαριασμοί Email',
            'slug'     => 'email-accounts'
        ));

        $post=Post::create(array(
            'author_id'     => 1,
            'cat_id'     => $cat->id,
            'title'     =>  'Ρυθμίσεις Android',
            'slug'      =>  'rythmiseis-android',
            'content'      =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
            'status'    =>  'published',
        ));
        $post=Post::create(array(
            'author_id'     => 1,
            'cat_id'     => $cat->id,
            'title'     =>  'Ρυθμίσεις iOS',
            'slug'      =>  'rythmiseis-ios',
            'content'      =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
            'status'    =>  'published',
        ));
        $post=Post::create(array(
            'author_id'     => 1,
            'cat_id'     => $cat->id,
            'title'     =>  'Ρυθμίσεις Outlook',
            'slug'      =>  'rythmiseis-outlook',
            'content'      =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
            'status'    =>  'published',
        ));
        $post=Post::create(array(
            'author_id'     => 1,
            'cat_id'     => $cat->id,
            'title'     =>  'Ρυθμίσεις Thunderbird',
            'slug'      =>  'rythmiseis-thunderbird',
            'content'      =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
            'status'    =>  'published',
        ));
    }
}
