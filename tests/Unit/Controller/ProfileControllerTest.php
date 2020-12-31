<?php

namespace Tests\Unit\Controller;

use App\Http\Controllers\ProfileController;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use App\Repositories\User\Profile\ProfileRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Tests\TestCase;
use Mockery as m;
use Symfony\Component\HttpFoundation\ParameterBag;

class ProfileControllerTest extends TestCase
{
    protected $profileRepositoryMock;
    public function setUp() : void 
    {
        $this->profileRepositoryMock = m::mock(ProfileRepository::class);
        parent::setUp();
    }

    public function tearDown() : void
    {
        unset($this->profileRepositoryMock);
        parent::tearDown();
    }

    public function test_edit_profile()
    {
        $this->profileRepositoryMock->shouldReceive('edit', 'displayProfile');
        $controller = new ProfileController($this->profileRepositoryMock);
        $response = $controller->edit(1);
        $this->assertEquals('user.edit_profile', $response->getName());
        $this->assertArrayHasKey('profile', $response->getData());
    }

    public function test_update_profile()
    {
        $this->profileRepositoryMock->shouldReceive('update', 'updateProfile');
        $controller = new ProfileController($this->profileRepositoryMock);
        $profile = [
            'name' => 'Thien Pro',
            'avatar' => 'profile.png',
            'gender' => 1,
        ];
        $request = new ProfileRequest();
        $request->headers->set('content-type', 'multipart/form-data');
        $request->setJson(new ParameterBag($profile));
        
        $response = $controller->update($request);
        
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(session('success'), Lang::get('messages.front_end.profile.update_success'));
    }

    public function test_update_password()
    {
        $this->profileRepositoryMock->shouldReceive('updatePassword');
        $controller = new ProfileController($this->profileRepositoryMock);
        $profile = [
            'old_password' => 'Thien123',
            'password' => 'Thien123123',
            'password_confirmation' => 'Thien123123',
        ];
        $request = new PasswordRequest();
        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag($profile));
        
        $response = $controller->updatePasswordd($request);
        $this->assertInstanceOf(RedirectResponse::class, $response);
    }
}
