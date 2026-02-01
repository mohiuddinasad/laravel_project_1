@extends('backend.layout')

@section('backend_content')
    <div class="container-fluid py-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.order.index') }}">Orders</a></li>
                <li class="breadcrumb-item active">Order #{{ $order->id }}</li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-md-8">
                <h2 class="fw-bold mb-1">Order Details</h2>
                <p class="text-muted">Order ID: #{{ $order->id }}</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('dashboard.order.index') }}" class="btn btn-outline-secondary">
                    Back to Orders
                </a>
                <button class="btn btn-primary ms-2" onclick="window.print()">
                    Print
                </button>
            </div>
        </div>

        <div class="row g-4">
            <!-- Order Information Card -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0 fw-bold">Order Information</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <!-- Customer Name -->
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0">
                                        <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                                            <i class="bi bi-person text-primary fs-5"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <label class="text-muted small mb-1">Customer Name</label>
                                        <h6 class="mb-0 fw-semibold">{{ $order->name }}</h6>
                                    </div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0">
                                        <div class="rounded-circle bg-info bg-opacity-10 p-3">
                                            <i class="bi bi-envelope text-info fs-5"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <label class="text-muted small mb-1">Email Address</label>
                                        <h6 class="mb-0 fw-semibold">
                                            <a href="mailto:{{ $order->email }}" class="text-decoration-none">
                                                {{ $order->email }}
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0">
                                        <div class="rounded-circle bg-success bg-opacity-10 p-3">
                                            <i class="bi bi-telephone text-success fs-5"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <label class="text-muted small mb-1">Phone Number</label>
                                        <h6 class="mb-0 fw-semibold">
                                            <a href="tel:{{ $order->phone }}" class="text-decoration-none">
                                                {{ $order->phone }}
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0">
                                        <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                                            <i class="bi bi-flag text-warning fs-5"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <label class="text-muted small mb-1">Order Status</label>
                                        <h6 class="mb-0">
                                            @if($order->status == 'pending')
                                                <span class="badge bg-secondary">Pending</span>
                                            @elseif($order->status == 'processing')
                                                <span class="badge bg-warning">Processing</span>
                                            @elseif($order->status == 'delivered')
                                                <span class="badge bg-success">Delivered</span>
                                            @elseif($order->status == 'cancelled')
                                                <span class="badge bg-danger">Cancelled</span>
                                            @else
                                                <span class="badge bg-dark">{{ ucfirst($order->status) }}</span>
                                            @endif
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="col-12">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0">
                                        <div class="rounded-circle bg-danger bg-opacity-10 p-3">
                                            <i class="bi bi-geo-alt text-danger fs-5"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <label class="text-muted small mb-1">Delivery Address</label>
                                        <h6 class="mb-0 fw-semibold">{{ $order->address }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Information Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0 fw-bold">Payment Information</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <!-- Transaction ID -->
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0">
                                        <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                                            <i class="bi bi-receipt text-primary fs-5"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <label class="text-muted small mb-1">Transaction ID</label>
                                        <h6 class="mb-0 fw-semibold font-monospace">
                                            {{ $order->transaction_id ?? 'N/A' }}
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <!-- Currency -->
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0">
                                        <div class="rounded-circle bg-success bg-opacity-10 p-3">
                                            <i class="bi bi-currency-exchange text-success fs-5"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <label class="text-muted small mb-1">Currency</label>
                                        <h6 class="mb-0 fw-semibold text-uppercase">
                                            {{ $order->currency ?? 'USD' }}
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <!-- Amount -->
                            <div class="col-12">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0">
                                        <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                                            <i class="bi bi-cash-stack text-warning fs-5"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <label class="text-muted small mb-1">Total Amount</label>
                                        <h4 class="mb-0 fw-bold text-success">
                                            {{ $order->currency ?? 'USD' }} {{ number_format($order->amount, 2) }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary Sidebar -->
            <div class="col-lg-4">
                <!-- Quick Actions Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0 fw-bold">Quick Actions</h5>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#changeStatusModal">
                                <i class="bi bi-pencil-square me-2"></i>Change Status
                            </button>
                            <a href="mailto:{{ $order->email }}" class="btn btn-outline-info">
                                <i class="bi bi-envelope me-2"></i>Send Email
                            </a>
                            <a href="tel:{{ $order->phone }}" class="btn btn-outline-success">
                                <i class="bi bi-telephone me-2"></i>Call Customer
                            </a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <!-- Change Status Modal -->
    <div class="modal fade" id="changeStatusModal" tabindex="-1" aria-labelledby="changeStatusModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeStatusModalLabel">Change Order Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted">Select a new status for order #{{ $order->id }}</p>
                    <div class="list-group">
                        <a href="{{ route('dashboard.order.updateStatus', ['id' => $order->id, 'status' => 'pending']) }}"
                            class="list-group-item list-group-item-action {{ $order->status == 'pending' ? 'active' : '' }}">
                            <i class="bi bi-clock-history me-2"></i>Pending
                        </a>
                        <a href="{{ route('dashboard.order.updateStatus', ['id' => $order->id, 'status' => 'processing']) }}"
                            class="list-group-item list-group-item-action {{ $order->status == 'processing' ? 'active' : '' }}">
                            <i class="bi bi-gear me-2"></i>Processing
                        </a>
                        <a href="{{ route('dashboard.order.updateStatus', ['id' => $order->id, 'status' => 'delivered']) }}"
                            class="list-group-item list-group-item-action {{ $order->status == 'delivered' ? 'active' : '' }}">
                            <i class="bi bi-check-circle me-2"></i>Delivered
                        </a>
                        <a href="{{ route('dashboard.order.updateStatus', ['id' => $order->id, 'status' => 'cancelled']) }}"
                            class="list-group-item list-group-item-action {{ $order->status == 'cancelled' ? 'active' : '' }}">
                            <i class="bi bi-x-circle me-2"></i>Cancelled
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 7px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e9ecef;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 20px;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .timeline-marker {
            position: absolute;
            left: -23px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 3px solid #fff;
            box-shadow: 0 0 0 2px #e9ecef;
        }

        .timeline-content {
            padding-left: 10px;
        }

        @media print {

            .btn,
            .breadcrumb,
            .card-header,
            nav,
            .modal {
                display: none !important;
            }

            .card {
                border: 1px solid #dee2e6 !important;
                box-shadow: none !important;
            }
        }
    </style>
@endsection
