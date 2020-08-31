<?php
namespace App\Http\Controllers;

use App\Model\User;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use OrmBackend\Rules\PasswordMatch;

class AccountController extends Controller
{
    
    /**
     *
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    protected $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editPassword()
    {
        return view('auth.account.password');
    }
    
    /**
     * 
     * @param Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'old_password' => ['required', new PasswordMatch],
            'password' => ['required', 'string', 'min:8'],
            'password_confirmation' => ['required', 'string', 'min:8', 'same:password']
        ]);

        /**
         * 
         * @var \App\Model\User $user
         */
        $user = $this->em->getRepository(User::class)->find(Auth::id());
        
        if (!$user) {
            abort(404, 'Not found.');
        }
        
        $user->setPassword(  Hash::make( $data['password'] ) );
        $this->em->flush();
        
        return view('auth.account.passwordchanged');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editEmail()
    {
        $user = $this->em->getRepository(User::class)->find(Auth::id());
        
        if (!$user) {
            abort(404, 'Not found.');
        }
        
        return view('auth.account.email', ['user' => $user]);
    }
    
    /**
     * 
     * @param Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateEmail(Request $request)
    {
        $data = $request->validate([
            'password' => ['required', new PasswordMatch],
            'email' => ['required', 'string', 'max:255', 'email:rfc,dns', 'unique:App\Model\User,email,'.Auth::id()],
        ]);
        
        /**
         *
         * @var \App\Model\User $user
         */
        $user = $this->em->getRepository(User::class)->find(Auth::id());
        
        if (!$user) {
            abort(404, 'Not found.');
        }
        
        $user->setEmail($data['email']);
        $user->setEmailVerifiedAt(null);
        $user->sendEmailVerificationNotification();
        
        return redirect()->route('verification.notice')->with('resent', true);
    }

}
