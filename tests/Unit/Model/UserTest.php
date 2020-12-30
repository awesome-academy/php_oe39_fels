<?php

namespace Tests\Unit\Model;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Tests\TestCase;

class UserTest extends TestCase
{
    protected $user;

    public function setUp() : void
    {
        parent::setUp();
        $this->user = new User();
    }

    public function tearDown() : void 
    {
        parent::tearDown();
    }

    public function test_model_configuation()
    {
        $this->assertEquals('users', $this->user->getTable());
        $this->assertEquals('id', $this->user->getKeyName());
        $this->assertEquals(
            [
                'name',
                'email',
                'password',
                'role_id',
            ], 
            $this->user->getFillable()
        );
        $this->assertEquals(
            [
                'password', 
                'remember_token',
            ],
            $this->user->getHidden()
        );
    }

    public function test_user_has_one_profile()
    {
        $relation = $this->user->profile();
        $this->assertInstanceOf(HasOne::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertEquals('users.id', $relation->getQualifiedParentKeyName());
    }

    public function test_user_belongsto_role()
    {
        $relation = $this->user->role();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('role_id', $relation->getForeignKeyName());
    }

    public function test_user_belongstomany_courses()
    {
        $relation = $this->user->courses();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('course_user', $relation->getTable());
        $this->assertEquals('course_user.user_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('course_user.course_id', $relation->getQualifiedRelatedPivotKeyName());
    }

    public function test_user_belongstomany_lessons()
    {
        $relation = $this->user->lessons();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('lesson_user', $relation->getTable());
        $this->assertEquals('lesson_user.user_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('lesson_user.lesson_id', $relation->getQualifiedRelatedPivotKeyName());
    }

    public function test_user_belongstomany_words()
    {
        $relation = $this->user->words();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('users_word', $relation->getTable());
        $this->assertEquals('users_word.user_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('users_word.word_id', $relation->getQualifiedRelatedPivotKeyName());
    }
}
