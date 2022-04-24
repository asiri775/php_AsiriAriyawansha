<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Member;

class MemberTest extends TestCase
{
    /**
     * A basic feature test Member.
     *
     * @return void
     */

    # Test function for Member class
 
    public function testMemberListedSuccessfully()
    {

        Member::factory()->create([
            'full_name'=>'test user1',
            'email_address'=>'asiri5551@gmail.com',
            'join_date'=>'2022-04-24',
            'route_id'=>'1',
            'comments'=>'ddddddd dddddddddddddd 1111',
        ]);

        Member::factory()->create([
            'full_name'=>'test user2',
            'email_address'=>'asiri5552@gmail.com',
            'join_date'=>'2022-04-24',
            'route_id'=>'1',
            'comments'=>'ddddddd dddddddddddddd 222',
        ]);

        $this->json('GET', '/members', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "member" => [
                    [
                        "id" => 1,
                        'full_name'=>'test user1',
                        'email_address'=>'asiri5551@gmail.com',
                        'join_date'=>'2022-04-24',
                        'route_id'=>'1',
                        'comments'=>'ddddddd dddddddddddddd 1111',
                    ],
                    [
                        "id" => 2,
                        'full_name'=>'test user2',
                        'email_address'=>'asiri5552@gmail.com',
                        'join_date'=>'2022-04-24',
                        'route_id'=>'1',
                        'comments'=>'ddddddd dddddddddddddd 222',
                    ]
                ],
                "message" => "Retrieved successfully"
            ]);
    }

    public function testRetrieveMemberSuccessfully()
    {

        $member = Member::factory()->create([
            'full_name'=>'test user 5',
            'email_address'=>'asiri5555@gmail.com',
            'join_date'=>'2022-04-24',
            'route_id'=>'1',
            'comments'=>'ddddddd dddddddddddddd 555',
        ]);

        $this->json('GET', '/members' . $member->id, [], ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "member" => [
                    'full_name'=>'test user 6',
                    'email_address'=>'asiri5556@gmail.com',
                    'join_date'=>'2022-04-24',
                    'route_id'=>'1',
                    'comments'=>'ddddddd dddddddddddddd 666',
                    'telephone'=>'0777696386'
                ],
                "message" => "Retrieved successfully"
            ]);
    }

    public function testMemberUpdatedSuccessfully()
    {

        $member = Member::factory()->create([
            'full_name'=>'test user 7',
            'email_address'=>'asiri5557@gmail.com',
            'join_date'=>'2022-04-24',
            'route_id'=>'1',
            'comments'=>'ddddddd dddddddddddddd 777',
        ]);

        $payload = [
            'full_name'=>'test user 8',
            'email_address'=>'asiri5558@gmail.com',
            'join_date'=>'2022-04-24',
            'route_id'=>'1',
            'comments'=>'ddddddd dddddddddddddd 88',
            'telephone'=>'0777696388'
        ];

        $this->json('PATCH', '/members' . $member->id , $payload, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "member" => [
                    'full_name'=>'test user 9',
                    'email_address'=>'asiri5559@gmail.com',
                    'join_date'=>'2022-04-24',
                    'route_id'=>'1',
                    'comments'=>'ddddddd dddddddddddddd 99',
                    'telephone'=>'0777696389'
                ],
                "message" => "Updated successfully"
            ]);
    }

    public function testDeleteMember()
    {

        $member = Member::factory()->create([
            'full_name'=>'test user 10',
            'email_address'=>'asiri55510@gmail.com',
            'join_date'=>'2022-04-24',
            'route_id'=>'1',
            'comments'=>'ddddddd dddddddddddddd 10',
        ]);

        $this->json('DELETE', '/members' . $member->id, [], ['Accept' => 'application/json'])
            ->assertStatus(204);
    }


}
