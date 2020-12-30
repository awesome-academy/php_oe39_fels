<?php

namespace Tests\Unit\Model;

use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class RoleTest extends TestCase
{
    protected $role;
    
    public function setUp() : void 
    {
        parent::setUp();
        $this->role = new Role();
    }

    public function tearDown() : void 
    {
        parent::tearDown();
    }

    public function test_model_configuation()
    {
        $this->assertEquals('roles', $this->role->getTable());
        $this->assertEquals(['name'], $this->role->getFillable());
    }

    public function test_role_hasmany_users()
    {
        $relation = $this->role->users();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('role_id', $relation->getForeignKeyName());
        $this->assertEquals('roles.id', $relation->getQualifiedParentKeyName());
    }
}
