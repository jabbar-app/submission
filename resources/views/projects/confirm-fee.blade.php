@extends('layouts.app')

@section('content')
  <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6 sm:p-8 text-center">
    <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-4">Confirm Commitment Fee</h1>
    <p class="text-gray-600 mb-6">Please complete the payment for your project submission.</p>

    <div class="border border-gray-200 rounded-lg p-4 mb-6 text-left">
      <h2 class="text-lg font-semibold text-gray-800 mb-2">Project Details:</h2>
      <p class="text-gray-700"><span class="font-medium">Title:</span> {{ $project->title }}</p>
      <p class="text-gray-700"><span class="font-medium">Project's Leader:</span> {{ $project->name }}</p>
      <p class="text-gray-700"><span class="font-medium">Commitment Fee:</span> <span class="font-bold">Rp
          {{ number_format($project->payment->amount, 0, ',', '.') }}</span></p>
      <p class="text-gray-700"><span class="font-medium">Unique Code:</span> <span
          class="font-bold">{{ $project->payment->unique_code }}</span></p>
      <p class="text-gray-700"><span class="font-medium">Total Payment:</span> <span class="text-green-600 font-bold">Rp
          {{ number_format($project->payment->amount + $project->payment->unique_code, 0, ',', '.') }}</span></p>
    </div>

    @if ($project->payment->status == 'pending')
      <div class="mb-2">
        <h2 class="text-xl font-semibold text-gray-800 mb-3">Scan QRIS for Payment</h2>
        {{-- Placeholder for QRIS Image --}}
        <img src="{{ asset('assets/images/qris_yfli.jpg') }}" alt="QRIS Code"
          class="w-48 h-48 mx-auto mb-4 border border-gray-300 p-2 rounded-md">
        <p class="text-gray-700 text-sm">Scan dan lakukan pembayaran sebesar Rp
          {{ number_format($project->payment->amount + $project->payment->unique_code, 0, ',', '.') }}</span>,- melalui
          QRIS di atas.</p>
        <p class="mt-3 text-sm text-gray-500">
          You can check the payment status by refreshing this page or waiting for an email confirmation.
        </p>
      </div>

      <a href="{{ route('project.success', $project->id) }}"
        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mt-4">
        I Have Paid (Check Status)
      </a>

      <hr class="mt-10">
      <p class="my-2">
        <small>
          Butuh bantuan?
        </small>
      </p>
      <a href="https://wa.me/6285361205140" target="_blank"
        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        WhatsApp Admin
      </a>
    @else
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Payment Confirmed!</strong>
        <span class="block sm:inline">Your commitment fee has been successfully received.</span>
      </div>
      <a href="{{ route('project.success', $project->id) }}"
        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 mt-6">
        Go to Success Page
      </a>
    @endif
  </div>
@endsection
