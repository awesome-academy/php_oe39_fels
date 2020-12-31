<?php

namespace Tests\Unit\Model;

use App\Models\Word;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class WordTest extends TestCase
{
    protected $word;

    public function setUp() : void 
    {
        parent::setUp();
        $this->word = new Word();
    }

    public function tearDown() : void 
    {
        parent::tearDown();
    }

    public function test_model_configuation()
    {
        $this->assertEquals('words', $this->word->getTable());
        $this->assertEquals(['text', 'course_id'], $this->word->getFillable());
    }

    public function test_word_belongsto_course()
    {
        $relation = $this->word->course();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('course_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getOwnerKeyName());
    }

    public function test_word_belongstomany_users()
    {
        $relation = $this->word->users();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('users_word', $relation->getTable());
        $this->assertEquals('users_word.word_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('users_word.user_id', $relation->getQualifiedRelatedPivotKeyName());
    }

    public function test_word_hasmany_answers()
    {
        $relation = $this->word->answers();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('word_id', $relation->getForeignKeyName());
        $this->assertEquals('words.id', $relation->getQualifiedParentKeyName());
    }
}
