@extends('layouts.app')

@section('content')
  <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6 sm:p-8 text-center">
    <div class="flex justify-center mb-6">
      <svg class="h-16 w-16 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    </div>
    <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-4">Submission Successful!</h1>

    @if ($project->payment->status == 'paid')
      <p class="text-green-600 font-semibold text-lg mb-4">Your Commitment Fee has been <span
          class="uppercase">Paid</span> and Confirmed.</p>
      <p class="text-gray-700 mb-6">Thank you for submitting your Leadership Project and completing the commitment fee
        payment.</p>
      <div class="border border-gray-200 rounded-lg p-4 mb-6 text-left">
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Project Summary:</h2>
        <p class="text-gray-700"><span class="font-medium">Title:</span> {{ $project->title }}</p>
        <p class="text-gray-700"><span class="font-medium">Leader:</span> {{ $project->leader_name }}</p>
        <p class="text-gray-700"><span class="font-medium">Payment Status:</span> <span
            class="text-green-600 font-bold uppercase">{{ $project->payment->status }}</span></p>
        <p class="text-gray-700"><span class="font-medium">Paid At:</span>
          {{ $project->paid_at ? $project->paid_at->format('d M Y H:i') : '-' }}</p>
      </div>
    @else
      <p class="text-red-600 font-semibold text-lg mb-4">Payment Status: <span
          class="uppercase">{{ $project->payment->status }}</span></p>
      <p class="text-gray-700 mb-6">Your project has been submitted, but the commitment fee payment is still pending or
        failed.</p>
      <a href="{{ route('project.confirmFee', $project->id) }}"
        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 mt-4">
        Go Back to Payment Confirmation
      </a>
    @endif

    <p class="text-sm text-gray-500 mt-6">We will review your project and get back to you shortly.</p>
  </div>
@endsection
