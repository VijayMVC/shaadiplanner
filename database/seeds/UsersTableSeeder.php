<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Listing;
use App\ListingCategories;
use App\Gallery;
use App\Page;
use Kodeine\Acl\Models\Eloquent\Permission;
use Kodeine\Acl\Models\Eloquent\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $admin=User::create(array(
            'name'     => 'Luke Deakin',
            'email'    => 'test@instantwebsitesolutions.co.uk',
            'password' => Hash::make('instant'),
        ));
        $admin->assignRole('administrator');

        $business=User::create(array(
            'name'     => 'Business User',
            'email'    => 'business@instantwebsitesolutions.co.uk',
            'password' => Hash::make('instant'),
        ));
        $business->assignRole('business');

        $cat=new ListingCategories();
        $cat->name="Category 1";
        $cat->slug="category-1";
        $cat->parent_id=0;
        $cat->save();

        $cat=new ListingCategories();
        $cat->name="Subcategory 1";
        $cat->slug="subcategory-1";
        $cat->parent_id=2;
        $cat->save();

        $cat=new ListingCategories();
        $cat->name="Subcategory 2";
        $cat->slug="subcategory-2";
        $cat->parent_id=2;
        $cat->save();

        $cat=new ListingCategories();
        $cat->name="Category 2";
        $cat->slug="category-2";
        $cat->parent_id=0;
        $cat->save();

        $cat=new ListingCategories();
        $cat->name="Category 3";
        $cat->slug="category-3";
        $cat->parent_id=0;
        $cat->save();

        $listing=new Listing();
        $listing->business_name="Instant";
        $listing->slug="instant";
        $listing->contact="Luke Deaken";
        $listing->display_contact=1;
        $listing->address_1="Equipoint, Coventry Road ";
        $listing->address_2="";
        $listing->town="Birmingham";
        $listing->county="West Midlands";
        $listing->postcode="B25 8AD";
        $listing->country="United Kingdom";
        $listing->latitude=52.45743;
        $listing->longitude=-1.795737;
        $listing->phone="0121 270 6259";
        $listing->display_phone=1;
        $listing->phone_2="0121 270 6260";
        $listing->display_phone_2=1;
        $listing->email="enquiries@instantwebsitesolutions.co.uk ";
        $listing->website="http://www.instantwebsitesolutions.co.uk";
        $listing->description="We make websites!";
        $listing->cat_id=2;
        $listing->cat2_id=1;
        $listing->listing_type="";
        $listing->user_id=$business->id;
        $listing->status=1;
        $listing->visits=0;
        $listing->save();

        $galleries=new Gallery();
        $galleries->listing_id=$listing->id;
        $galleries->name="Our Office";
        $galleries->filename="office3.jpg";
        $galleries->save();

        $galleries=new Gallery();
        $galleries->listing_id=$listing->id;
        $galleries->name="Workers";
        $galleries->filename="teamwork.jpg";
        $galleries->save();

        $business=User::create(array(
            'name'     => 'Member User',
            'email'    => 'member@instantwebsitesolutions.co.uk',
            'password' => Hash::make('instant'),
        ));
        $business->assignRole('member');

        $page=new Page();
        $page->title="About";
        $page->slug="about";
        $page->content="About page";
        $page->save();
    }
}
