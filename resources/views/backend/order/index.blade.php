@extends('backend.layout')
@section('backend_content')
    <div class="container-fluid py-4">
        <!-- Header -->


        <!-- Filters & Search -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('dashboard.order.index') }}" method="GET" id="filterForm">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label small text-muted">Search Orders</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" name="search" class="form-control"
                                    placeholder="Order ID, Customer name..." value="{{ request('search') }}">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label small text-muted">Status</label>
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>
                                    Processing</option>
                                <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered
                                </option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                                </option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label small text-muted">Date From</label>
                            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}"
                                onchange="this.form.submit()">
                        </div>

                        <div class="col-md-2">
                            <label class="form-label small text-muted">Date To</label>
                            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}"
                                onchange="this.form.submit()">
                        </div>


                    </div>
                </form>
            </div>
        </div>

        <!-- Statistics Cards -->
        @if(isset($statistics))
            <div class="row g-3 mb-4 justify-content-between">
                <div class="col-md-2">
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                        <div class="card-body p-4 position-relative">
                            <div class="position-absolute top-0 end-0 p-3 opacity-25">
                                <i class="bi bi-cart-check" style="font-size: 3rem; color: #0d6efd;"></i>
                            </div>
                            <h6 class="text-muted small mb-2 text-uppercase fw-semibold">Total Orders</h6>
                            <h2 class="mb-0 fw-bold text-primary">{{ $statistics['total'] }}</h2>
                        </div>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                        <div class="card-body p-4 position-relative">
                            <div class="position-absolute top-0 end-0 p-3 opacity-25">
                                <i class="bi bi-clock-history" style="font-size: 3rem; color: #6c757d;"></i>
                            </div>
                            <h6 class="text-muted small mb-2 text-uppercase fw-semibold">Pending</h6>
                            <h2 class="mb-0 fw-bold" style="color: #6c757d;">{{ $statistics['pending'] }}</h2>
                        </div>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                        <div class="card-body p-4 position-relative">
                            <div class="position-absolute top-0 end-0 p-3 opacity-25">
                                <i class="bi bi-gear" style="font-size: 3rem; color: #ffc107;"></i>
                            </div>
                            <h6 class="text-muted small mb-2 text-uppercase fw-semibold">Processing</h6>
                            <h2 class="mb-0 fw-bold" style="color: #ffc107;">{{ $statistics['processing'] }}</h2>
                        </div>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                        <div class="card-body p-4 position-relative">
                            <div class="position-absolute top-0 end-0 p-3 opacity-25">
                                <i class="bi bi-check-circle" style="font-size: 3rem; color: #198754;"></i>
                            </div>
                            <h6 class="text-muted small mb-2 text-uppercase fw-semibold">Delivered</h6>
                            <h2 class="mb-0 fw-bold text-success">{{ $statistics['delivered'] }}</h2>
                        </div>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                        <div class="card-body p-4 position-relative">
                            <div class="position-absolute top-0 end-0 p-3 opacity-25">
                                <i class="bi bi-x-circle" style="font-size: 3rem; color: #dc3545;"></i>
                            </div>
                            <h6 class="text-muted small mb-2 text-uppercase fw-semibold">Cancelled</h6>
                            <h2 class="mb-0 fw-bold" style="color: #dc3545;">{{ $statistics['cancelled'] }}</h2>
                        </div>

                </div>
            </div>
        @endif

        <!-- Orders Table -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="py-3">Transaction ID</th>
                                <th class="py-3">Customer</th>
                                <th class="py-3">Amount</th>
                                <th class="py-3">Phone</th>
                                <th class="py-3">Status</th>
                                <th class="py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>
                                        <span class="fw-semibold text-primary">{{ $order->transaction_id }}</span>
                                        <br>
                                        <small class="text-muted"></small>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle me-2">{{ strtoupper(substr($order->name, 0, 1)) }}</div>
                                            <div>
                                                <div class="fw-medium">{{ $order->name }}</div>
                                                <small class="text-muted">{{ $order->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="fw-semibold">{{ $order->formatted_amount }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>
                                        <span class="badge {{ $order->status_badge }}" id="status-badge-{{ $order->id }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{ route('dashboard.order.show', $order->id) }}" class="btn btn-sm lh-1 btn-outline-primary" title="View">
                                                <iconify-icon icon="lsicon:view-outline" width="24" height="24"></iconify-icon>
                                            </a>
                                            <a href="{{ route('dashboard.order.destroy', $order->id) }}"
                                                class="btn btn-sm lh-1 btn-outline-danger" title="Delete">
                                                <iconify-icon icon="material-symbols-light:delete" width="24"
                                                    height="24"></iconify-icon>
                                            </a>

                                            <div class="dropdown">
                                                <button class="btn btn-sm lh-1 btn-outline-info" type="button"
                                                    title="Change Status" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <iconify-icon icon="cuida:edit-outline" width="24"
                                                        height="24"></iconify-icon>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('dashboard.order.updateStatus', ['id' => $order->id, 'status' => 'pending']) }}">Pending</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('dashboard.order.updateStatus', ['id' => $order->id, 'status' => 'processing']) }}">Processing</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('dashboard.order.updateStatus', ['id' => $order->id, 'status' => 'delivered']) }}">Delivered</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('dashboard.order.updateStatus', ['id' => $order->id, 'status' => 'cancelled']) }}">Cancelled</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                            <h5>No orders found</h5>
                                            <p>Try adjusting your search or filter criteria</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($orders->hasPages())
                    <div class="d-flex justify-content-between align-items-center p-3 border-top">
                        <div class="text-muted small">
                            Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} orders
                        </div>
                        <nav>
                            {{ $orders->links('pagination::bootstrap-5') }}
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .avatar-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
        }

        .card {
            border: none;
            border-radius: 0.5rem;
        }

        .badge {
            padding: 0.35rem 0.65rem;
            font-weight: 500;
            font-size: 0.75rem;
        }
    </style>

    <script>
        // CSRF Token Setup
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Update Order Status
        function updateStatus(orderId, status) {
            event.preventDefault();

            if (!confirm('Are you sure you want to change the status?')) {
                return;
            }

            fetch(`/admin/orders/${orderId}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ status: status })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update badge
                        const badge = document.getElementById(`status-badge-${orderId}`);
                        badge.className = 'badge ' + getStatusBadgeClass(status);
                        badge.textContent = status.charAt(0).toUpperCase() + status.slice(1);

                        // Show success message
                        showNotification('Status updated successfully', 'success');

                        // Reload page to update statistics
                        setTimeout(() => location.reload(), 1000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Failed to update status', 'error');
                });
        }

        // Delete Order
        function deleteOrder(orderId) {
            if (!confirm('Are you sure you want to delete this order? This action cannot be undone.')) {
                return;
            }

            fetch(`/admin/orders/${orderId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Order deleted successfully', 'success');
                        setTimeout(() => location.reload(), 1000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Failed to delete order', 'error');
                });
        }

        // Export Orders
        function exportOrders() {
            const urlParams = new URLSearchParams(window.location.search);
            window.location.href = '/admin/orders/export/csv?' + urlParams.toString();
        }

        // Get Status Badge Class
        function getStatusBadgeClass(status) {
            const classes = {
                'pending': 'bg-secondary-subtle text-secondary',
                'processing': 'bg-warning-subtle text-warning',
                'delivered': 'bg-success-subtle text-success',
                'cancelled': 'bg-danger-subtle text-danger'
            };
            return classes[status] || 'bg-secondary-subtle text-secondary';
        }

        // Show Notification
        function showNotification(message, type) {
            // You can use any notification library here (e.g., toastr, sweetalert)
            // For now, using simple alert
            if (type === 'success') {
                alert('✓ ' + message);
            } else {
                alert('✗ ' + message);
            }
        }

        // Auto-submit search on Enter key
        document.querySelector('input[name="search"]').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('filterForm').submit();
            }
        });
    </script>
@endsection
