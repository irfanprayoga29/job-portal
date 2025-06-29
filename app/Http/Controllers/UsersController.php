<?php
namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user/login');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $table = Users::create([
        //     "full_name"   => $request->name,
        //     "username"   => $request->name,
        //     "email"   => $request->name,
        //     "name"   => $request->name,
        //     "name"   => $request->name,
        //     "name"   => $request->name,
        //     "name"   => $request->name,
        //     "gender" => $request->gender,
        //     "age"    => $request->age,
        // ]);

        // return response()->json([
        //     "message" => "Store Success!",
        //     "data"    => $table,
        // ], 201);

        // dd($request->all());
        // $book = Book::create($request->all());
        // $book->save();

        $validatedData = $request->validate([
            'full_name'     => 'required|max:255',
            'username'      => 'required|max:255|unique:users,username,',
            'email'         => 'required|max:255|email:rfc,dns|unique:users,email,',
            'password'      => 'required|max:255',
            'date_of_birth' => 'required|max:255',
            'gender'        => 'required|max:255',
            'address'       => 'required|max:255',
            'role_id'       => 'required',
        ]);

        $d = Carbon::createFromFormat('Y-m-d', $validatedData['date_of_birth'])->format('Y/m/d');

        $book                = new Users;
        $book->full_name     = $validatedData['full_name'];
        $book->username      = $validatedData['username'];
        $book->email         = $validatedData['email'];
        $book->password      = Hash::make($validatedData['password']);
        $book->date_of_birth = $d;
        $book->gender        = $validatedData['gender'];
        $book->address       = $validatedData['address'];
        $book->role_id       = $validatedData['role_id'];
        $book->save();
 
        return redirect()->route('users.index')->with('success', 'Data berhasil disimpan!');

    }

    //LOGIN FUNGCTION

        public function login()
    {
        $data['title'] = 'Login';
        return view('user/login', $data);
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        
        $credentials = $request->only('username', 'password');
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Redirect based on role
            if ($user->role_id == 1) {
                return redirect('/user/landing')->with('success', 'Welcome back, ' . $user->full_name . '!');
            } elseif ($user->role_id == 2) {
                return redirect('/superuser/landing')->with('success', 'Welcome back, ' . $user->full_name . '!');
            }
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('username'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'You have been logged out successfully!');
    }

    /**
     * Display the dashboard for the user.
     */
    public function dashboard()
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to access the dashboard.');
        }

        $user = Auth::user();
        
        // Ensure user is an applicant (role_id = 1)
        if (!$user || $user->role_id != 1) {
            Auth::logout(); // Logout if wrong role
            return redirect()->route('login')->with('error', 'Access denied. This dashboard is for job seekers only.');
        }

        $stats = $user->stats;
        
        // Get recommended jobs for applicants
        $recommendedJobs = collect();
        if ($user->isApplicant()) {
            $recommendedJobs = Job::with(['company', 'categories'])
                ->active()
                ->recent()
                ->take(4)
                ->get();
        }

        return view('user.landing', compact('user', 'stats', 'recommendedJobs'));
    }

    public function profile()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        return view('user.applicant-profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $validatedData = $request->validate([
            'full_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'address' => 'required|max:500',
            'password' => 'nullable|min:6',
        ]);

        $user->full_name = $validatedData['full_name'];
        $user->email = $validatedData['email'];
        $user->date_of_birth = $validatedData['date_of_birth'];
        $user->gender = $validatedData['gender'];
        $user->address = $validatedData['address'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    public function updateContact(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $validatedData = $request->validate([
            'phone' => 'nullable|string|max:20',
            'linkedin' => 'nullable|url|max:255',
            'website' => 'nullable|url|max:255',
        ]);

        $user->update($validatedData);

        return back()->with('success', 'Contact information updated successfully!');
    }

    public function updateAbout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $validatedData = $request->validate([
            'about_me' => 'required|string|max:1000',
        ]);

        $user->update($validatedData);

        return back()->with('success', 'About me description updated successfully!');
    }

    public function updateWorkExperience(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $validatedData = $request->validate([
            'work_experience' => 'required|array',
            'work_experience.*.position' => 'required|string|max:255',
            'work_experience.*.company' => 'required|string|max:255',
            'work_experience.*.start_date' => 'required|string',
            'work_experience.*.end_date' => 'nullable|string',
            'work_experience.*.description' => 'nullable|string|max:1000',
        ]);

        // Merge with existing work experience
        $existingExperience = $user->work_experience ?? [];
        $newExperience = array_merge($existingExperience, $validatedData['work_experience']);

        $user->update(['work_experience' => $newExperience]);

        return back()->with('success', 'Work experience added successfully!');
    }

    public function updateEducation(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $validatedData = $request->validate([
            'education' => 'required|array',
            'education.*.degree' => 'required|string|max:255',
            'education.*.institution' => 'required|string|max:255',
            'education.*.start_year' => 'required|integer|min:1950|max:2030',
            'education.*.end_year' => 'nullable|integer|min:1950|max:2030',
            'education.*.gpa' => 'nullable|numeric|min:0|max:4',
        ]);

        // Merge with existing education
        $existingEducation = $user->education ?? [];
        $newEducation = array_merge($existingEducation, $validatedData['education']);

        $user->update(['education' => $newEducation]);

        return back()->with('success', 'Education added successfully!');
    }

    public function updateSkills(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $validatedData = $request->validate([
            'skills' => 'nullable|array',
            'skills.*' => 'string|max:100',
        ]);

        // If no skills provided, set to empty array
        $skills = $validatedData['skills'] ?? [];

        $user->update(['skills' => $skills]);

        return back()->with('success', 'Skills updated successfully!');
    }

    public function updateInterests(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Get interests from request, default to empty array if not provided
        $interests = $request->input('interests', []);

        // Ensure it's an array
        if (!is_array($interests)) {
            $interests = [];
        }

        // Validate individual interest items if they exist
        foreach ($interests as $interest) {
            if (!is_string($interest) || strlen($interest) > 100) {
                return back()->withErrors(['interests' => 'Each interest must be a string with maximum 100 characters.']);
            }
        }

        $user->update(['interests' => $interests]);

        return back()->with('success', 'Interests & preferences updated successfully!');
    }

    public function updateAwards(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $validatedData = $request->validate([
            'awards' => 'required|array',
            'awards.*.title' => 'required|string|max:255',
            'awards.*.issuer' => 'required|string|max:255',
            'awards.*.date' => 'required|string',
            'awards.*.description' => 'nullable|string|max:1000',
        ]);

        // Merge with existing awards
        $existingAwards = $user->awards ?? [];
        $newAwards = array_merge($existingAwards, $validatedData['awards']);

        $user->update(['awards' => $newAwards]);

        return back()->with('success', 'Awards added successfully!');
    }

    public function updateCertificates(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $validatedData = $request->validate([
            'certificates' => 'required|array',
            'certificates.*.name' => 'required|string|max:255',
            'certificates.*.issuer' => 'required|string|max:255',
            'certificates.*.issue_date' => 'required|string',
            'certificates.*.expiry_date' => 'nullable|string',
            'certificates.*.credential_id' => 'nullable|string|max:255',
        ]);

        // Merge with existing certificates
        $existingCertificates = $user->certificates ?? [];
        $newCertificates = array_merge($existingCertificates, $validatedData['certificates']);

        $user->update(['certificates' => $newCertificates]);

        return back()->with('success', 'Certificates added successfully!');
    }

    public function deleteWorkExperience($index)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $workExperience = $user->work_experience ?? [];

        if (isset($workExperience[$index])) {
            unset($workExperience[$index]);
            $workExperience = array_values($workExperience); // Reindex array

            $user->update(['work_experience' => $workExperience]);
            return back()->with('success', 'Work experience deleted successfully!');
        }

        return back()->with('error', 'Work experience not found!');
    }

    public function deleteEducation($index)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $education = $user->education ?? [];

        if (isset($education[$index])) {
            unset($education[$index]);
            $education = array_values($education); // Reindex array

            $user->update(['education' => $education]);
            return back()->with('success', 'Education deleted successfully!');
        }

        return back()->with('error', 'Education not found!');
    }

    public function deleteAward($index)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $awards = $user->awards ?? [];

        if (isset($awards[$index])) {
            unset($awards[$index]);
            $awards = array_values($awards); // Reindex array

            $user->update(['awards' => $awards]);
            return back()->with('success', 'Award deleted successfully!');
        }

        return back()->with('error', 'Award not found!');
    }

    public function deleteCertificate($index)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $certificates = $user->certificates ?? [];

        if (isset($certificates[$index])) {
            unset($certificates[$index]);
            $certificates = array_values($certificates); // Reindex array

            $user->update(['certificates' => $certificates]);
            return back()->with('success', 'Certificate deleted successfully!');
        }

        return back()->with('error', 'Certificate not found!');
    }

    public function alternativeLanding()
    {
        $recentJobs = Job::with('categories', 'company')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();
            
        return view('user.applicant-employer_landing', compact('recentJobs'));
    }
}
