@extends('layouts.app')

@section('title', 'Заявки на звонок — WhiteSmile')

@section('content')
<div class="container" style="margin-top: 40px; margin-bottom: 50px;">
    <h1 class="section-title">Заявки на звонок</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-end align-items-center mb-3">
        <span class="text-muted small">Всего: {{ $leads->total() }}</span>
    </div>

    <div class="card-service">
        <div class="card-body p-0" style="overflow-x: auto;">
            <table class="table table-striped mb-0 align-middle" style="text-align: center;">
                <thead>
                    <tr>
                        <th class="text-center">Дата</th>
                        <th class="text-center">Имя</th>
                        <th class="text-center">Телефон</th>
                        <th class="text-center">Комментарий</th>
                        <th class="text-center">Статус</th>
                        <th class="text-center" style="width: 1%; white-space: nowrap;">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($leads as $lead)
                        <tr>
                            <td style="white-space: nowrap;">{{ $lead->created_at->format('d.m.Y H:i') }}</td>
                            <td style="font-weight: 600;">{{ $lead->name }}</td>
                            <td style="white-space: nowrap;">
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $lead->phone) }}"
                                   style="color: var(--brand); text-decoration: none; font-weight: 600;">
                                    {{ $lead->phone }}
                                </a>
                            </td>
                            <td style="max-width: 380px; white-space: normal; word-wrap: break-word; line-height: 1.5; text-align: left;" title="{{ $lead->comment }}">
                                {{ $lead->comment ?: '—' }}
                            </td>
                            <td>
                                @if ($lead->status === 'new')
                                    <span class="badge bg-warning text-dark">Новая</span>
                                @else
                                    <span class="badge bg-success">Обработана</span>
                                @endif
                            </td>
                            <td style="width: 1%; white-space: nowrap;">
                                @if ($lead->status === 'new')
                                    <form action="{{ route('admin.leads.processed', $lead->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn-icon btn-icon-approve" title="Обработана">✓</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.leads.processed', $lead->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn-icon btn-icon-unapprove" title="Вернуть в новые">⊘</button>
                                    </form>
                                @endif

                                <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn-icon btn-icon-delete"
                                            title="Удалить"
                                            onclick="return confirm('Удалить заявку?')">🗑</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Заявок пока нет.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($leads->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $leads->links() }}
        </div>
    @endif
</div>
@endsection