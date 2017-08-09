<?php

use App\Conference;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NewFriendTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    public function test_it_doesnt_show_new_friends_for_another_users_conference()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $conference1 = factory(Conference::class)->make();
        $conference2 = factory(Conference::class)->make();
        $user1->conferences()->save($conference1);
        $user2->conferences()->save($conference2);

        $this->be($user1);

        $this->json('get', '/api/conferences/' . $conference2->slug . '/new-friends');

        $this->seeStatusCode(404);
    }

    public function test_it_shows_new_friends_for_my_conference()
    {
        $user = factory(User::class)->create();
        $conference = factory(Conference::class)->make();
        $user->conferences()->save($conference);
        $conference->meetNewFriend('taylorotwell');

        $this->be($user);

        $this->json('get', 'api/conferences/' . $conference->slug . '/new-friends');

        $this->seeJson(['username' => 'taylorotwell']);
    }

    public function test_it_can_delete_new_friends()
    {
        $user = factory(User::class)->create();
        $conference = factory(Conference::class)->make();
        $user->conferences()->save($conference);
        $friend = $conference->meetNewFriend('jeffrey_way');

        $this->be($user);

        $this->json('delete', 'api/conferences/' . $conference->slug . '/new-friends/' . $friend->id);

        $this->json('get', 'api/conferences/' . $conference->slug . '/new-friends');

        $this->dontSeeJson(['username' => 'jeffrey_way']);
    }
}
