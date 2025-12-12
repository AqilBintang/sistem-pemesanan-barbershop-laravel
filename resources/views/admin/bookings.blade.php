@extends('layouts.admin')

@section('title', 'Kelola Booking')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Kelola Booking</h3>
                </div>
                <div class="card-body">
                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-2">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <h4>{{ $stats['total'] }}</h4>
                                    <p class="mb-0">Total Booking</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card bg-warning text-white">
                                <div class="card-body text-center">
                                    <h4>{{ $stats['pending'] }}</h4>
                                    <p class="mb-0">Menunggu</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <h4>{{ $stats['confirmed'] }}</h4>
                                    <p class="mb-0">Dikonfirmasi</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h4>{{ $stats['completed'] }}</h4>
                                    <p class="mb-0">Selesai</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card bg-danger text-white">
                                <div class="card-body text-center">
                                    <h4>{{ $stats['cancelled'] }}</h4>
                                    <p class="mb-0">Dibatalkan</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card bg-dark text-white">
                                <div class="card-body text-center">
                                    <h4>{{ $stats['today'] }}</h4>
                                    <p class="mb-0">Hari Ini</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bookings Table -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Pelanggan</th>
                                    <th>Kontak</th>
                                    <th>Kapster</th>
                                    <th>Layanan</th>
                                    <th>Tanggal & Waktu</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->id }}</td>
                                    <td>
                                        <strong>{{ $booking->customer_name }}</strong>
                                        @if($booking->notes)
                                        <br><small class="text-muted">{{ Str::limit($booking->notes, 30) }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <div>{{ $booking->customer_phone }}</div>
                                        @if($booking->customer_email)
                                        <small class="text-muted">{{ $booking->customer_email }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($booking->barber->photo)
                                            <img src="{{ asset('storage/' . $booking->barber->photo) }}" 
                                                 alt="{{ $booking->barber->name }}" 
                                                 class="rounded-circle me-2" 
                                                 style="width: 32px; height: 32px; object-fit: cover;">
                                            @endif
                                            <div>
                                                <strong>{{ $booking->barber->name }}</strong>
                                                <br><small class="text-muted">{{ $booking->barber->level_display }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <strong>{{ $booking->service->name }}</strong>
                                        <br><small class="text-muted">{{ $booking->service->duration }} menit</small>
                                    </td>
                                    <td>
                                        <div>{{ $booking->formatted_date }}</div>
                                        <strong>{{ $booking->formatted_time }}</strong>
                                    </td>
                                    <td>
                                        <strong>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</strong>
                                    </td>
                                    <td>
                                        <select class="form-select form-select-sm status-select" 
                                                data-booking-id="{{ $booking->id }}"
                                                style="min-width: 120px;">
                                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                                            <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-info" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#bookingModal{{ $booking->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <a href="{{ route('admin.bookings.receipt', $booking->id) }}" 
                                               class="btn btn-sm btn-outline-success" 
                                               target="_blank">
                                                <i class="fas fa-receipt"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger delete-booking" 
                                                    data-booking-id="{{ $booking->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Booking Detail Modal -->
                                <div class="modal fade" id="bookingModal{{ $booking->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detail Booking #{{ $booking->id }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h6>Informasi Pelanggan</h6>
                                                        <table class="table table-sm">
                                                            <tr>
                                                                <td><strong>Nama:</strong></td>
                                                                <td>{{ $booking->customer_name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Telepon:</strong></td>
                                                                <td>{{ $booking->customer_phone }}</td>
                                                            </tr>
                                                            @if($booking->customer_email)
                                                            <tr>
                                                                <td><strong>Email:</strong></td>
                                                                <td>{{ $booking->customer_email }}</td>
                                                            </tr>
                                                            @endif
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6>Informasi Booking</h6>
                                                        <table class="table table-sm">
                                                            <tr>
                                                                <td><strong>Tanggal:</strong></td>
                                                                <td>{{ $booking->formatted_date }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Waktu:</strong></td>
                                                                <td>{{ $booking->formatted_time }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Status:</strong></td>
                                                                <td>
                                                                    <span class="badge bg-{{ $booking->status_color }}">
                                                                        {{ $booking->status_display }}
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Total:</strong></td>
                                                                <td><strong>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</strong></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                
                                                <div class="row mt-3">
                                                    <div class="col-md-6">
                                                        <h6>Kapster</h6>
                                                        <div class="d-flex align-items-center">
                                                            @if($booking->barber->photo)
                                                            <img src="{{ asset('storage/' . $booking->barber->photo) }}" 
                                                                 alt="{{ $booking->barber->name }}" 
                                                                 class="rounded-circle me-3" 
                                                                 style="width: 64px; height: 64px; object-fit: cover;">
                                                            @endif
                                                            <div>
                                                                <h5>{{ $booking->barber->name }}</h5>
                                                                <p class="mb-1">{{ $booking->barber->level_display }}</p>
                                                                <p class="mb-0 text-muted">{{ $booking->barber->specialty }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6>Layanan</h6>
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h5 class="card-title">{{ $booking->service->name }}</h5>
                                                                @if($booking->service->description)
                                                                <p class="card-text">{{ $booking->service->description }}</p>
                                                                @endif
                                                                <p class="card-text">
                                                                    <small class="text-muted">Durasi: {{ $booking->service->duration }} menit</small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if($booking->notes)
                                                <div class="row mt-3">
                                                    <div class="col-12">
                                                        <h6>Catatan</h6>
                                                        <div class="alert alert-info">
                                                            {{ $booking->notes }}
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-calendar-times fa-3x mb-3"></i>
                                            <p>Belum ada booking yang masuk</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($bookings->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $bookings->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Status change handler
    document.querySelectorAll('.status-select').forEach(select => {
        select.addEventListener('change', function() {
            const bookingId = this.dataset.bookingId;
            const newStatus = this.value;
            
            fetch(`/admin/bookings/${bookingId}/status`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    const alert = document.createElement('div');
                    alert.className = 'alert alert-success alert-dismissible fade show';
                    alert.innerHTML = `
                        ${data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    `;
                    document.querySelector('.container-fluid').insertBefore(alert, document.querySelector('.row'));
                    
                    // Auto dismiss after 3 seconds
                    setTimeout(() => {
                        alert.remove();
                    }, 3000);
                } else {
                    alert('Gagal mengupdate status booking');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengupdate status');
            });
        });
    });

    // Delete booking handler
    document.querySelectorAll('.delete-booking').forEach(button => {
        button.addEventListener('click', function() {
            const bookingId = this.dataset.bookingId;
            
            if (confirm('Apakah Anda yakin ingin menghapus booking ini?')) {
                fetch(`/admin/bookings/${bookingId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Gagal menghapus booking');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus booking');
                });
            }
        });
    });
});
</script>
@endsection