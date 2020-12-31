<?php

namespace Tests\Unit\Model;

use App\Models\Followship;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;

class FollowShipTest extends TestCase
{
   protected $follow;

   public function setUp() : void 
   {
       parent::setUp();
       $this->follow = new Followship();
   }

   public function tearDown() : void
   {
       parent::tearDown();
   }

   public function test_model_configuation()
   {
       $this->assertEquals('followships', $this->follow->getTable());
   }

   public function test_follower_belongsto_user()
   {
       $relation = $this->follow->follower();
       $this->assertInstanceOf(BelongsTo::class, $relation);
       $this->assertEquals('follower_id', $relation->getForeignKeyName());
   }

   public function test_following_belongsto_user()
   {
       $relation = $this->follow->following();
       $this->assertInstanceOf(BelongsTo::class, $relation);
       $this->assertEquals('followed_id', $relation->getForeignKeyName());
   }
}
