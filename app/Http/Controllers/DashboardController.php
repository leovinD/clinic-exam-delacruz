<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Prescription;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Blog posts
        $totalPosts = Post::count();
        $publishedPosts = Post::where('is_published', true)->count();
        $unpublishedPosts = Post::where('is_published', false)->count();

        $categories = Category::withCount('posts')->get();
        $categoryNames = $categories->pluck('cat_name');
        $categoryCounts = $categories->pluck('posts_count');

        $postsPerMonth = Post::selectRaw('DATE_FORMAT(published_at, "%b %Y") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderByRaw('MIN(published_at) DESC')
            ->get();

        $postMonths = $postsPerMonth->pluck('month');
        $postCountsPerMonth = $postsPerMonth->pluck('count');

        // Clinic-related stats

        // Total doctors and patients
        $totalDoctors = Doctor::count();
        $totalPatients = Patient::count();

        // Appointments by status
        $appointmentStatusCounts = Appointment::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray(); // Ensure it's an array

        // Prescriptions count
        $totalPrescriptions = Prescription::count();

        // Treatments with total quantities
        $treatmentQuantities = Prescription::with('treatments')
            ->get()
            ->flatMap(function ($prescription) {
                return $prescription->treatments->mapWithKeys(function ($treatment) {
                    return [$treatment->name => $treatment->pivot->quantity];
                });
            })
            ->groupBy(function ($quantity, $name) {
                return $name;
            })
            ->map(function ($quantities) {
                return $quantities->sum();
            })
            ->toArray();

        return view('dashboard', compact(
            'totalDoctors',
            'totalPatients',
            'appointmentStatusCounts',
            'totalPrescriptions',
            'treatmentQuantities',
            'totalPosts',
            'publishedPosts',
            'unpublishedPosts',
            'categoryNames',
            'categoryCounts',
            'postMonths',
            'postCountsPerMonth'
        ));
    }
}