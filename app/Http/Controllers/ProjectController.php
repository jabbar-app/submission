<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Project;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProjectController extends Controller
{
    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title'                 => 'required|string|max:255',
                'description'           => 'required|string',
                'name'                  => 'required|string|max:255',
                'email'                 => 'required|email|max:255',
                'phone'                 => 'required|string|max:20',
                'team_members'          => 'nullable|string',
                'problems'              => 'nullable|string',
                'solutions'             => 'nullable|string',
                'target_beneficiaries'  => 'nullable|string',
                'unique_value'          => 'nullable|string',
                'key_features'          => 'nullable|string',
                'funding_needs'         => 'nullable|string',
            ]);

            $project = Project::create([
                'title'                 => $validatedData['title'],
                'description'           => $validatedData['description'],
                'name'                  => $validatedData['name'],
                'email'                 => $validatedData['email'],
                'phone'                 => $validatedData['phone'],
                'team_members'          => $validatedData['team_members'] ?? null,
                'problems'              => $validatedData['problems'] ?? null,
                'solutions'             => $validatedData['solutions'] ?? null,
                'target_beneficiaries'  => $validatedData['target_beneficiaries'] ?? null,
                'unique_value'          => $validatedData['unique_value'] ?? null,
                'key_features'          => $validatedData['key_features'] ?? null,
                'funding_needs'         => $validatedData['funding_needs'] ?? null
            ]);

            Payment::create([
                'project_id' => $project->id,
                'amount' => 10,
                'unique_code' => rand(400, 900),
            ]);

            return redirect()->route('project.confirmFee', $project->id);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function confirmFee(Project $project)
    {
        if ($project->payment->status === 'paid') {
            return redirect()->route('project.success', $project->id);
        }

        return view('projects.confirm-fee', compact('project'));
    }

    public function success(Project $project)
    {
        $amount = number_format($project->payment->amount + $project->payment->unique_code, 0, ',', '.');
        $notification = Notification::where('status', 'ready')
            ->where('package_name', 'com.gojek.gopaymerchant')
            ->where('title', 'Pembayaran diterima')
            ->where('text', 'LIKE', "%Rp $amount%")
            ->first();

        if ($notification) {
            $notification->update([
                'status' => 'used',
            ]);

            $project->payment->update(['status' => 'paid']);
        }

        if ($project->payment->status !== 'paid') {
            return redirect()->route('project.confirmFee', $project->id)
                ->with('error', 'Pembayaran Anda belum terkonfirmasi.');
        }

        return view('projects.success', compact('project'));
    }
}
