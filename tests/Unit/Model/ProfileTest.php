<?php

namespace Tests\Unit\Model;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    protected $profile;

    public function setUp() : void 
    {
        parent::setUp();
        $this->profile = new Profile();
    }

    public function tearDown() : void
    {
        parent::tearDown();
    }

    public function test_model_configuation()
    {
        $this->assertEquals('profiles', $this->profile->getTable());
        $this->assertEquals(['user_id', 'avatar', 'gender'], $this->profile->getFillable());
    }

    public function test_profile_belongsto_user()
    {
        $relation = $this->profile->user();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
    }
}
