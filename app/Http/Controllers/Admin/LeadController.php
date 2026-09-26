<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class LeadController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('viewAny', Lead::class);
        $status = $request->string('status')->toString();
        $search = $request->string('search')->toString();
        $leads = Lead::query()
            ->when($status, fn ($query) => $query->where('status', $status))
            ->when($search, fn ($query) => $query->where(fn ($query) => $query->where('full_name', 'like', "%{$search}%")->orWhere('phone', 'like', "%{$search}%")))
            ->latest()
            ->paginate(20)
            ->withQueryString();
        $counts = Lead::query()->selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');

        return view('admin.leads.index', compact('leads', 'counts', 'status', 'search'));
    }

    public function show(Lead $lead): View
    {
        Gate::authorize('view', $lead);

        return view('admin.leads.show', compact('lead'));
    }

    public function update(Request $request, Lead $lead): Response
    {
        Gate::authorize('update', $lead);
        $data = $request->validate([
            'status' => ['required', 'in:new,contacted,qualified,invalid,closed'],
            'internal_notes' => ['nullable', 'string', 'max:5000'],
        ]);
        $lead->update($data);

        return response()->noContent();
    }

    public function export(Request $request): Response
    {
        Gate::authorize('viewAny', Lead::class);
        $status = $request->string('status')->toString();
        $leads = Lead::query()->when($status, fn ($query) => $query->where('status', $status))->latest()->get();
        $rows = [['Name', 'Phone', 'Email', 'Service', 'Pickup', 'Destination', 'Status', 'Created']];

        foreach ($leads as $lead) {
            $rows[] = collect([$lead->full_name, $lead->phone, $lead->email, $lead->service_type, $lead->pickup_city, $lead->destination, $lead->status, $lead->created_at?->toIso8601String()])->map(fn ($value) => $this->safeCell($value))->all();
        }

        $csv = collect($rows)->map(fn (array $row): string => collect($row)->map(fn ($value): string => '"'.str_replace('"', '""', (string) $value).'"')->implode(','))->implode("\r\n");

        return response($csv, 200, ['Content-Type' => 'text/csv', 'Content-Disposition' => 'attachment; filename="masslimo-leads.csv"']);
    }

    private function safeCell(mixed $value): string
    {
        $value = (string) ($value ?? '');

        return preg_match('/^[=+\-@]/', $value) === 1 ? "'{$value}" : $value;
    }
}
