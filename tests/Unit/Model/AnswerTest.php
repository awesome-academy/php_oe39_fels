<?php

namespace Tests\Unit\Model;

use App\Models\Answer;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;

class AnswerTest extends TestCase
{
    protected $answer;

    public function setUp() : void 
    {
        parent::setUp();
        $this->answer = new Answer();
    }

    public function tearDown() : void
    {
        parent::tearDown();
    }

    public function test_model_configuation()
    {
        $this->assertEquals('answers', $this->answer->getTable());
        $this->assertEquals(['question_id', 'name', 'is_correct'], $this->answer->getFillable());
    }

    public function test_answer_belongsto_question()
    {
        $relation = $this->answer->question();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('question_id', $relation->getForeignKeyName());
    }

    public function test_answer_belongsto_word()
    {
        $relation = $this->answer->word();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('word_id', $relation->getForeignKeyName());
    }
}
