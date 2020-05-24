<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\Role;
use App\Model\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NoResultException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use ItAces\ORM\DevelopmentException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RedirectsUsers;
    
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
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $qb = $this->em->createQueryBuilder();
        $query = $qb
            ->select('role')
            ->from(Role::class, 'role')
            ->where($qb->expr()->neq('role.system', true))
            ->addOrderBy('role.name')
            ->getQuery();

        if ($this->em->getConfiguration()->isSecondLevelCacheEnabled()) {
            $query->setLifetime( $this->em->getConfiguration()->getSecondLevelCacheConfiguration()->getRegionsConfiguration()->getDefaultLifetime() );
            $query->setCacheable( true );
        }

        return view('auth.register', ['roles' => $query->getResult()]);
    }
    
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'string', 'max:255', 'email:rfc,dns', 'unique:App\Model\User,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'roles' => ['sometimes', 'nullable', 'arrayofinteger', 'exists:App\Model\Role,id']
        ]);
        
        if (!isset($data['roles']) || !is_array($data['roles'])) {
            $data['roles'] = [];
        }

        $qb = $this->em->createQueryBuilder();
        $query = $qb
            ->select('role')
            ->from(Role::class, 'role')
            ->where($qb->expr()->eq('role.code', ':code'))
            ->setParameter('code', config('itaces.roles.default', 'default'))
            ->getQuery();
        
        if ($this->em->getConfiguration()->isSecondLevelCacheEnabled()) {
            $query->setLifetime( $this->em->getConfiguration()->getSecondLevelCacheConfiguration()->getRegionsConfiguration()->getDefaultLifetime() );
            $query->setCacheable( true );
        }
        
        try {
            /**
             * 
             * @var \App\Model\Role $role
             */
            $role = $query->getSingleResult();
        } catch (NoResultException $e) {
            throw new DevelopmentException('Default user role not found.');
        }

        $user = new User();
        $user->addRole($role);
        $user->setEmail($data['email']);
        $user->setPassword(Hash::make($data['password']));
        $this->em->persist($user);
        $user->setCreatedBy($user);
        $this->em->flush();

        event(new Registered($user));
        Auth::guard()->login($user);
        
        return redirect($this->redirectPath());
    }

    protected function redirectTo()
    {
        if (Gate::allows('dashboard')) {
            return route('admin.index');
        }
        
        return route('home.index');
    }
}
