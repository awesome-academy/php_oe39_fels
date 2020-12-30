<?php

namespace Tests\Unit\Model;

use App\Models\Question;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    protected $question;

    public function setUp() : void
    {
        parent::setUp();
        $this->question = new Question();
    }

    public function tearDown() : void
    {
        parent::tearDown();
    }

    public function test_model_configuation()
    {
        $this->assertEquals('questions', $this->question->getTable());
        $this->assertEquals(['lesson_id','name'], $this->question->getFillable());
    }

    public function test_question_belongsto_lesson()
    {
        $relation = $this->question->lession();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('lesson_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getOwnerKeyName());
    }

    public function test_question_hasmany_answers()
    {
        $relation = $this->question->answers();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('question_id', $relation->getForeignKeyName());
        $this->assertEquals('questions.id', $relation->getQualifiedParentKeyName());
    }
}
