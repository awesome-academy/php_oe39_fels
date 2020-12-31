<?php

namespace Tests\Unit\Model;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class LessonTest extends TestCase
{
    protected $lesson;

    public function setUp() : void
    {
        parent::setUp();
        $this->lesson = new Lesson();
    }

    public function tearDown() : void 
    {
        parent::tearDown();
    }

    public function test_model_configuation()
    {
        $this->assertEquals('lessons', $this->lesson->getTable());
        $this->assertEquals('id', $this->lesson->getKeyName());
        $this->assertEquals(
            [
                'name',
                'course_id',
            ], 
            $this->lesson->getFillable()
        );
    }

    public function test_lesson_belongtomany_users()
    {
        $relation = $this->lesson->users();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('lesson_user', $relation->getTable());
        $this->assertEquals('lesson_user.lesson_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('lesson_user.user_id', $relation->getQualifiedRelatedPivotKeyName());
    }

    public function test_lesson_belongsto_course()
    {
        $relation = $this->lesson->course();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('course_id', $relation->getForeignKeyName());
    }

    public function test_lesson_hasmany_questions()
    {
        $relation = $this->lesson->questions();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('lesson_id', $relation->getForeignKeyName());
        $this->assertEquals('lessons.id', $relation->getQualifiedParentKeyName());
    }

    public function test_is_complete_getter()
    {
        $this->lesson->setAttribute('is_complete', true);
        $this->assertEquals(true, $this->lesson->getAttributes()['is_complete']);
    }
}
