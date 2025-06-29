<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SuperUserController extends Controller
{
    /**
     * Show login form for superuser
     */
    public function login()
    {
        return view('superuser.login');
    }

    /**
     * Handle superuser login
     */
    public function login_action(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        
        // Debug: Check if user exists with role_id = 2 (Company)
        $user = Users::where('username', $request->username)
                    ->where('role_id', 2)
                    ->first();
        
        if (!$user) {
            return back()->withErrors([
                'username' => 'Company account not found with this username',
            ])->withInput($request->only('username'));
        }
        
        // Debug: Check password
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Password does not match',
            ])->withInput($request->only('username'));
        }
        
        // Attempt login with role check
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password, 'role_id' => 2])) {
            $request->session()->regenerate();
            return redirect()->intended('/superuser/landing')->with('success', 'Company login successful!');
        }

        return back()->withErrors([
            'password' => 'Authentication failed',
        ])->withInput($request->only('username'));
    }

    /**
     * Show register form for superuser
     */
    public function register()
    {
        return view('superuser.register');
    }

    /**
     * Handle superuser registration
     */
    public function register_action(Request $request)
    {
        $validatedData = $request->validate([
            'full_name'     => 'required|max:255',
            'username'      => 'required|max:255|unique:users,username',
            'email'         => 'required|max:255|email:rfc,dns|unique:users,email',
            'password'      => 'required|min:8|max:255',
            'date_of_birth' => 'required|date',
            'gender'        => 'required|max:255',
            'address'       => 'required|max:255',
        ]);

        $user = new Users;
        $user->full_name     = $validatedData['full_name'];
        $user->username      = $validatedData['username'];
        $user->email         = $validatedData['email'];
        $user->password      = Hash::make($validatedData['password']);
        $user->date_of_birth = $validatedData['date_of_birth'];
        $user->gender        = $validatedData['gender'];
        $user->address       = $validatedData['address'];
        $user->role_id       = 2; // Company role
        $user->save();
 
        return redirect()->route('superuser.login')->with('success', 'Company account created successfully! Please login.');
    }

    /**
     * Handle superuser logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/superuser/login')->with('success', 'You have been logged out successfully!');
    }

    /**
     * Show company dashboard
     */
    public function dashboard()
    {
        if (!Auth::check() || !Auth::user()->isCompany()) {
            return redirect()->route('superuser.login');
        }

        $user = Auth::user();
        $stats = $user->stats;
        
        // Get recent applications for company jobs
        $recentApplications = Application::with(['user', 'job'])
            ->whereHas('job', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->orderBy('date_submitted', 'desc')
            ->take(5)
            ->get();

        return view('superuser.landing', compact('user', 'stats', 'recentApplications'));
    }

    /**
     * Show company profile edit form
     */
    public function editProfile()
    {
        try {
            if (!Auth::check()) {
                return redirect()->route('superuser.login')->with('error', 'Please login first.');
            }
            
            if (!Auth::user()->isCompany()) {
                return redirect()->route('superuser.login')->with('error', 'Access denied. Company account required.');
            }

            $user = Auth::user();
            return view('superuser.profile-edit-dynamic', compact('user'));
        } catch (\Exception $e) {
            return redirect()->route('superuser.landing')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Handle company profile update
     */
    public function updateProfile(Request $request)
    {
        try {
            if (!Auth::check()) {
                return redirect()->route('superuser.login')->with('error', 'Please login first.');
            }
            
            if (!Auth::user()->isCompany()) {
                return redirect()->route('superuser.login')->with('error', 'Access denied. Company account required.');
            }

            $request->validate([
                'company_name' => 'required|string|max:255',
                'company_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'company_description' => 'nullable|string|max:2000',
                'company_website' => 'nullable|url|max:255',
                'email' => 'required|email|unique:users,email,' . Auth::id(),
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:500',
            ]);

            $user = Auth::user();
            
            $updateData = [
                'company_name' => $request->company_name,
                'company_description' => $request->company_description,
                'company_website' => $request->company_website,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ];

            // Handle file upload for company logo
            if ($request->hasFile('company_logo')) {
                $logoFile = $request->file('company_logo');
                $logoName = time() . '_' . $logoFile->getClientOriginalName();
                $logoPath = $logoFile->move(public_path('uploads/logos'), $logoName);
                $updateData['company_logo'] = 'uploads/logos/' . $logoName;
            }

            $user->update($updateData);

            return redirect()->route('superuser.profile.edit')
                ->with('success', 'Company profile updated successfully!');
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while updating profile: ' . $e->getMessage())
                ->withInput();
        }
    }
}
