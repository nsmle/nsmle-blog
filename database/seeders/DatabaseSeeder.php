<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Post;
use App\Models\RoleUser;
use App\Models\PostTags;
use App\Models\Follower;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        
        
        User::create([
            'name' => 'Fiki Pratama',
            'username' => 'nsmle',
            'biography' => 'Be Humble:)',
            'email' => 'fikiproductionofficial@gmail.com',
            'email_verified_at' => now(),
            'phone' => '+6289531538005',
            'role_id' => 3,
            'password' => bcrypt('sleep'),
            'remember_token' => "tCETcDuu39",
            'last_seen' => now()
        ]);
        User::create([
            'name' => 'Wulan Fernikasari',
            'username' => 'wulanfernikasari',
            'biography' => 'Be Smart:)',
            'email' => 'wulan@xxx.com',
            'email_verified_at' => now(),
            'phone' => '+6289531538005',
            'role_id' => 3,
            'password' => bcrypt('sleep'),
            'remember_token' => "tCETcDuu39",
            'last_seen' => now()
        ]);
        User::create([
            'name' => 'Winda Puspitasari',
            'username' => 'windapuspitasari',
            'biography' => 'Be Smart:)',
            'email' => 'winda@xxx.com',
            'email_verified_at' => now(),
            'phone' => '+6289531538005',
            'role_id' => 3,
            'password' => bcrypt('sleep'),
            'remember_token' => "tCETcDuu39",
            'last_seen' => now()
        ]);
        User::create([
            'name' => 'Sleepy',
            'username' => 'sleepy',
            'biography' => 'Be Smart:)',
            'email' => 'sleepy@xxx.com',
            'email_verified_at' => now(),
            'phone' => '+6289531538005',
            'role_id' => 3,
            'password' => bcrypt('sleep'),
            'remember_token' => "tCETcDuu39",
            'last_seen' => now()
        ]);
        
        Post::factory(100)->create();
        
        
        RoleUser::create([
            'name' => 'user',
            'permisions' => 'post'
        ]);
        RoleUser::create([
            'name' => 'moderator',
            'permisions' => 'post, category'
        ]);
        RoleUser::create([
            'name' => 'admin',
            'permisions' => 'post, category, user'
        ]);
        RoleUser::create([
            'name' => 'owner',
            'permisions' => 'post, category, user, moderator, admin'
        ]);
        
        
        
        $categories = [
            [
                "name" => 'Programming',
                'slug' => 'programming',
                'creator_id' => 10
            ],
            [
                'name' => 'Web Design',
                'slug' => 'web-design',
                'creator_id' => 10
            ],
            [
                'name' => 'Personal',
                'slug' => 'personal',
                'creator_id' => 10
            ],
            [
                'name' => 'YouTube',
                'slug' => 'youtube',
                'creator_id' => 10
            ],
            [
                'name' => 'PHP',
                'slug' => 'php',
                'creator_id' => 10
            ],
            [
                'name' => 'Java',
                'slug' => 'java',
                'creator_id' => 10
            ],
            [
                'name' => 'Javascript',
                'slug' => 'javascript',
                'creator_id' => 10
            ],
            [
                'name' => 'Ruby',
                'slug' => 'ruby',
                'creator_id' => 10
            ],
            [
                'name' => '.NET',
                'slug' => 'dotnet',
                'creator_id' => 10
            ],
            [
                'name' => 'Python',
                'slug' => 'python',
                'creator_id' => 10
            ],
            [
                'name' => 'Kotlin',
                'slug' => 'kotlin',
                'creator_id' => 10
            ],
            [
                'name' => 'Flutter',
                'slug' => 'flutter',
                'creator_id' => 10
            ],
            [
                'name' => 'ReactJS',
                'slug' => 'reactjs',
                'creator_id' => 10
            ],
            [
                'name' => 'ReactNative',
                'slug' => 'react-native',
                'creator_id' => 10
            ],
            [
                'name' => 'Laravel',
                'slug' => 'laravel',
                'creator_id' => 10
            ]
        ];
        
        foreach ($categories as $category) {
            \App\Models\Category::create([
                'name' => $category['name'],
                'slug' => $category['slug'],
                'creator_id' => $category['creator_id']
            ]);
        }
        foreach ($categories as $tag) {
            \App\Models\Tags::create([
                'name' => $tag['name'],
                'slug' => $tag['slug'],
                'creator_id' => $tag['creator_id']
            ]);
        }
        
        for ($i=0; $i < 100; $i++) {
            PostTags::create([
                'post_id' => mt_rand(1, 99),
                'tags_id' => mt_rand(1, count($categories))
            ]);
        }
        
        for ($i=0; $i < 15; $i++) {
            if ($i !== 11){
                Follower::create([
                    'user_id' => 11,
                    'follower_id' => $i
                ]);
            }
        }
        
        
        
    }
}
