<?php

namespace Tests\Unit\Model;

use App\Models\Course;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class CourseTest extends TestCase
{
    protected $course;

    public function setUp() : void
    {
        parent::setUp();
        $this->course = new Course();
    }

    public function tearDown() : void 
    {
        parent::tearDown();
    }

    public function test_model_configuation()
    {
        $this->assertEquals('courses', $this->course->getTable());
        $this->assertEquals('id', $this->course->getKeyName());
        $this->assertEquals(
            [
                'name',
                'image',
                'description',
            ], 
            $this->course->getFillable()
        );
    }

    public function test_course_belongtomany_users()
    {
        $relation = $this->course->users();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('course_user', $relation->getTable());
        $this->assertEquals('course_user.course_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('course_user.user_id', $relation->getQualifiedRelatedPivotKeyName());
    }

    public function test_course_many_lessons()
    {
        $relation = $this->course->lessons();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('course_id', $relation->getForeignKeyName());
        $this->assertEquals('courses.id', $relation->getQualifiedParentKeyName());
    }

    public function test_course_hasmany_words()
    {
        $relation = $this->course->words();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('course_id', $relation->getForeignKeyName());
        $this->assertEquals('courses.id', $relation->getQualifiedParentKeyName());
    }

    public function test_is_complete_getter()
    {
        $this->course->setAttribute('is_enrolled', true);
        $this->assertEquals(true, $this->course->getAttributes()['is_enrolled']);
    }
}
